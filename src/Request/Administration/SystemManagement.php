<?php

namespace ZteF\Request\Administration;

use ManCurl\Debug;
use ZteF\Request;
use ZteF\Utils;

class SystemManagement extends Request
{
    /**
     * Reboot device
     */
    public function reboot(): bool
    {
        $session = Utils::getSession($this->request(self::ADM_REBOOT)->getRawResponse());
        $request = $this->request(self::ADM_REBOOT)
            ->addPosts([
                'flag'           => 1,
                'IF_ACTION'      => 'devrestart',
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
     * Restore default device
     */
    public function restoreDefault(): void
    {
    }

    /**
     * Software Upgrade
     *
     * Upgrade software version by the operation.
     */
    public function softwareUpgrade(): void
    {
    }

    /**
     * User Configuration Management
     *
     * - Export User Configuration: export user configuration file from device.
     * - Import User Configuration: import specified user configuration file to device.
     */
    public function userConfigurationManagement(): void
    {
    }

    /**
     * Default Configuration Management
     *
     * - Export Default Configuration: export default configuration file from device.
     * - Import Default Configuration: import specified default confirmation file to device.
     */
    public function defaultConfigurationManagement(): void
    {
    }

    /**
     * USB Backup
     *
     * You should backup user configuration on USB storage device.
     */
    public function usbBackup(): void
    {
    }

    /**
     * USB Restore
     *
     * You should recovery user configuration from USB storage device.
     */
    public function usbRestore(): void
    {
    }
}
