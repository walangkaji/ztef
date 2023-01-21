<?php

namespace ZteF\Request\Administration;

use ManCurl\Debug;
use ZteF\Request;
use ZteF\Utils;

class Administration extends Request
{
    /**
     * TR-069
     */
    public function tr069(): Tr069
    {
        return new Tr069($this->zte);
    }

    /**
     * User Management
     */
    public function userManagement(): UserManagement
    {
        return new UserManagement($this->zte);
    }

    /**
     * Set Login timeout configuration.
     *
     * The changes of Timeout take effect after re-login.
     *
     * @param int $minutes any value between 1 minute and 30 minutes is allowed
     */
    public function loginTimeout(int $minutes): bool
    {
        if ($minutes > 30) {
            Debug::error(__FUNCTION__, 'Timeout is error, please input integer in the range of 1-30');

            return false;
        }

        $session = Utils::getSession($this->request(self::ADM_LOGIN_TIMEOUT)->getRawResponse());
        $request = $this->request(self::ADM_LOGIN_TIMEOUT)
            ->addPosts([
                'Timeout'        => $minutes,
                'IF_ACTION'      => 'apply',
                '_SESSION_TOKEN' => $session,
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
     * System Management
     */
    public function systemManagement(): SystemManagement
    {
        return new SystemManagement($this->zte);
    }

    /**
     * Log Management
     *
     * - Log Management: set the log enable, the log level, the remote log server.
     * - Log Search: based on different log level you chose, device displays the corresponding log.
     * - Log Download: you can download the log files from the device.
     * - Clear Log: delete the current log.
     */
    public function logManagement(): void
    {
    }

    /**
     * Diagnosis
     */
    public function diagnosis(): Diagnosis
    {
        return new Diagnosis($this->zte);
    }

    /**
     * Loopback Detection
     */
    public function loopbackDetection(): LoopbackDetection
    {
        return new LoopbackDetection($this->zte);
    }

    /**
     * IPv6 Switch
     *
     * Enable or disable IPv6 function of this device.
     */
    public function ipv6Switch(): void
    {
    }

    /**
     * VoIP Protocol Switch
     *
     * Swtiching VoIP Protocol.
     */
    public function voIpProtocolSwitch(): void
    {
    }

    /**
     * 3G/4G Basic Configuration
     *
     * 3G/4G uplink parameters settings
     *
     * @param bool $enable `true` or `false`
     * @param int  $time   time in second
     */
    public function basicConfiguration3g4g(bool $enable = true, int $time = 30): bool
    {
        $session = Utils::getSession($this->request(self::ADM_BASIC_CONF_3G4G)->getRawResponse());
        $request = $this->request(self::ADM_BASIC_CONF_3G4G)
            ->addPosts([
                'Enable'         => $enable ? 1 : 0,
                'AutoTransTime'  => $time,
                'IF_ACTION'      => 'apply',
                '_SESSION_TOKEN' => $session,
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
}
