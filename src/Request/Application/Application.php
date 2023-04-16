<?php

namespace ZteF\Request\Application;

use ManCurl\Debug;
use ZteF\Request;
use ZteF\Utils;

class Application extends Request
{
    /**
     * VoIP
     */
    public function voIP(): VoIP
    {
        return new VoIP($this->zte);
    }

    /**
     * DDNS
     *
     * This page allows to enable or disable the function of DDNS.
     * After settings are completed, it shows the new DDNS status.
     */
    public function ddns(): void
    {
    }

    /**
     * DMZ Host
     *
     * This page allows to set DMZ Host and displays the information of DMZ Host.
     */
    public function dmzHost(): void
    {
    }

    /**
     * UPnP
     *
     * This page allows to enable or disable UPnP function,
     * and also allows configuring other settings.
     */
    public function upnp(): void
    {
    }

    /**
     * UPnP Port Mapping
     *
     * This page displays UPnP Port Mapping rules and also allows deleting it.
     */
    public function upnpPortMapping(): void
    {
    }

    /**
     * Port Forwarding
     *
     * Users can use the application name to set a virtual server.
     * if you enable virtual server configuration,
     * you can use Wide Area Network to access the virtual host.
     */
    public function portForwarding(): void
    {
    }

    /**
     * DNS Service
     */
    public function dnsService(): DnsService
    {
        return new DnsService($this->zte);
    }

    /**
     * SNTP
     *
     * This page can display the current time,
     * it can also set the time zone and the time server address.
     */
    public function sntp(): void
    {
    }

    /**
     * MultiCast
     */
    public function multiCast(): MultiCast
    {
        return new MultiCast($this->zte);
    }

    /**
     * BPDU
     *
     * Configuring to control BPDU data frames.
     * if BPDU Forwarding is enabled, BPDU data frames will be replied,
     * otherwise those will be processed in device.
     */
    public function bpdu(bool $enable): bool
    {
        $request = $this->request(self::APP_BPDU)
            ->addPosts([
                'BPDUEnable'     => (int) $enable,
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
     * USB Storage
     *
     * Display the storage information of USB Mass storage devices online.
     */
    public function usbStorage(): void
    {
    }

    /**
     * DMS
     *
     * Custom DMS. DMS(Digital Media Server) can discover
     * media content on the USB storage device, and share this on the network.
     */
    public function dms(): void
    {
    }

    /**
     * FTP Application
     *
     * This page allows to enable or disable FTP server function,
     * and it can also set the parameters just like FTP username and password.
     */
    public function ftpApplication(): void
    {
    }

    /**
     * Port Trigger
     *
     * This page allows the user to set the parameters of port trigger rule.
     * After setting, this page displays the rule.
     */
    public function portTrigger(): void
    {
    }

    /**
     * Port Forwarding ( Application List )
     *
     * Users can use the application name to set a virtual server.
     * If you enable virtual server configuration,
     * you can use Wide Area Network to access the virtual host.
     */
    public function portForwardingAppList(): void
    {
    }

    /**
     * Application List
     *
     * Application list can set virtual host rules and
     * IP filtering rules to associate with an application name.
     * After the configuration is completed, users can use
     * the application name to set the rule.
     */
    public function applicationList(): void
    {
    }

    /**
     * Samba Service
     *
     * Provide the file-sharing services to LAN side users.
     * Windows users can access shared through the
     * following URL: \\hostname, \\hostname\samba, \\LAN IP Address, \\LAN IP Address\samba.
     */
    public function sambaService(): void
    {
    }

    /**
     * Enable/Disable USB print server.
     */
    public function usbPrintServer(bool $enable): bool
    {
        $request = $this->request(self::APP_USB_PRINT_SERVER)
            ->addPosts([
                'UsbPrinterEnable' => (int) $enable,
                'IF_ACTION'        => 'apply',
                '_SESSION_TOKEN'   => $this->getSession(),
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
