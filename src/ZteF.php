<?php

namespace ZteF;

use GuzzleHttp\Middleware;
use ManCurl\Client;
use ManCurl\Debug;
use ManCurl\Request as ManCurlRequest;
use Psr\Http\Message\ResponseInterface;
use ZteF\Exception\LoginException;
use ZteF\Request\Administration\Administration;
use ZteF\Request\Application\Application;
use ZteF\Request\Helpers\Helpers;
use ZteF\Request\Network\Network;
use ZteF\Request\Security\Security;
use ZteF\Request\Status\Status;

class ZteF
{
    private Client $client;
    private static string $ip;
    private static string $scheme;
    public int $loginRandom = 12345678;
    public string $session  = '';

    public function __construct(
        string $ip,
        private string $username,
        private string $password,
        bool $debug = false,
        ?string $proxy = null,
        string $scheme = "http"
    ) {
        self::$ip = $ip;
        self::$scheme = $scheme;

        Debug::activate($debug);

        $this->client = (new Client)
             ->setCookieFile('cookie.txt')
             ->setProxy($proxy)
             ->setDefaultHeaders($this->defaultHeaders());

        $this->login();
    }

    /**
     * User login
     *
     * @return bool `true` on success
     *
     * @throws LoginException
     */
    private function login(): bool
    {
        if ($this->loginCheck()) {
            Debug::success(__FUNCTION__, 'Logged with active session.');

            return true;
        }

        $html              = $this->request()->getRawResponse();
        $this->loginRandom = mt_rand(10000000, 99999999);

        $this->request()->addPosts([
            'action'              => 'login',
            'Username'            => $this->username,
            'Password'            => hash('sha256', $this->password . $this->loginRandom),
            'Frm_Logintoken'      => Utils::getLoginToken($html),
            'UserRandomNum'       => $this->loginRandom,
            'Frm_Loginchecktoken' => Utils::getLoginCheckToken($html),
        ])->makeRequest();

        if ($this->loginCheck()) {
            Debug::success(__FUNCTION__, "Success login with user '{$this->username}'");

            return true;
        }

        throw new LoginException("Failed login with user '{$this->username}'");
    }

    /**
     * Login check
     *
     * @return bool `true` on success, `false` otherwise
     */
    private function loginCheck(): bool
    {
        $statusCode = $this->request(Request::TEMPLATE)
            ->getHttpResponse()
            ->getStatusCode();

        return 200 === $statusCode ? true : false;
    }

    /**
     * Status route
     */
    public function status(): Status
    {
        return new Status($this);
    }

    /**
     * Network route
     */
    public function network(): Network
    {
        return new Network($this);
    }

    /**
     * Security route
     */
    public function security(): Security
    {
        return new Security($this);
    }

    /**
     * Application route
     */
    public function application(): Application
    {
        return new Application($this);
    }

    /**
     * Administration route
     */
    public function administration(): Administration
    {
        return new Administration($this);
    }

    /**
     * Helpers route
     */
    public function helpers(): Helpers
    {
        return new Helpers($this);
    }

    /**
     * Htpp request
     *
     * @param string $path the path after ip url
     */
    public function request(string $path = '/'): ManCurlRequest
    {
        return (new ManCurlRequest(
            $this->client,
            sprintf('%s://%s%s', self::$scheme, self::$ip, $path)
        ))->middleware(Middleware::mapResponse(function (ResponseInterface $response) {
            $this->setSession(
                Utils::getSession($response->getBody()->getContents())
            );

            return $response;
        }));
    }

    /**
     * Set session
     *
     * @param string $session session string from response
     */
    private function setSession(string $session): void
    {
        if ('' !== $session) {
            $this->session = $session;
        }
    }

    /**
     * Get session string from latest request
     */
    public function getSession(): string
    {
        return $this->session;
    }

    /**
     * Default headers for request
     */
    private function defaultHeaders(): array
    {
        return [
            'Cache-Control'             => 'max-age=0',
            'Upgrade-Insecure-Requests' => '1',
            'User-Agent'                => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
            'Accept'                    => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'Accept-Language'           => 'en-US,en;q=0.9,en-GB;q=0.8,id;q=0.7',
            'Connection'                => 'keep-alive',
        ];
    }
}
