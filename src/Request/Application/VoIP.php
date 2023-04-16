<?php

namespace ZteF\Request\Application;

use ManCurl\Debug;
use ZteF\Request;
use ZteF\Utils;

class VoIP extends Request
{
    /**
     * WAN Connection
     *
     * Setup the network interface used by VoIP.
     */
    public function wanConnection(): void
    {
    }

    /**
     * Advanced
     *
     * VoIP Function Configure:
     * 1. Echo Cancellation--can be set to Enable or Disable.
     * 2. DTMF transfer Configure--RFC2833 or transparency.
     * 3. Jitter Buffer--Can be set to Adaptive Mode or Fixed Mode,
     * and set the jitter length respectively. After set, new status will show up.
     */
    public function advanced(): void
    {
    }

    /**
     * Enable or disable the FAX transport in T.38 Mode.
     */
    public function fax(bool $enable): bool
    {
        $request = $this->request(self::APP_FAX)
            ->addPosts([
                'Enable'         => (int) $enable,
                'IF_ACTION'      => 'apply',
                '_SESSION_TOKEN' => $this->getSession(),
            ])
            ->getRawResponse();

        $check = Utils::checkError($request);

        if ('SUCC' === $check) {
            Debug::success(__FUNCTION__, 'Your data have been stored!');

            return true;
        }

        Debug::error(__FUNCTION__, $check);

        return false;
    }

    /**
     * SIP
     *
     * SIP general configuration, including server configuration and function options.
     */
    public function sip(): void
    {
    }

    /**
     * SIP Accounts
     *
     * SIP user configurations, including SIP Account, password, authentication user name.
     */
    public function sipAccounts(): void
    {
    }

    /**
     * VoIP Services
     */
    public function voIpServices(): void
    {
    }

    /**
     * Digital Map
     *
     * Configure Digital Map, in which "X" represents a number from 0 to 9 and "," represents many.
     */
    public function digitalMap(): void
    {
    }

    /**
     * Media
     *
     * Set codecs which could be supported on VoIP line and their priorities.
     */
    public function media(): void
    {
    }

    /**
     * Caller ID
     */
    public function callerId(): void
    {
    }

    /**
     * SLIC configuration
     *
     * Configure ringing voltage, loop current and open circuit voltage information.
     */
    public function slicConfiguration(): void
    {
    }
}
