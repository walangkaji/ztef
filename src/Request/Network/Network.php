<?php

namespace ZteF\Request\Network;

use ZteF\Request;

class Network extends Request
{
    /**
     * WAN
     */
    public function wan(): Wan
    {
        return new Wan($this->zte);
    }

    /**
     * WLAN Common Setting
     */
    public function wlanCommonSetting(): WlanCommonSetting
    {
        return new WlanCommonSetting($this->zte);
    }

    /**
     * WLAN Radio2.4G
     */
    public function wlan(): Wlan
    {
        return new Wlan($this->zte);
    }

    /**
     * WLAN Radio5G
     */
    public function wlan5G(): Wlan5G
    {
        return new Wlan5G($this->zte);
    }

    /**
     * LAN
     */
    public function lan(): Lan
    {
        return new Lan($this->zte);
    }

    /**
     * PON
     */
    public function pon(): Pon
    {
        return new Pon($this->zte);
    }

    /**
     * Routing(IPv4)
     */
    public function routingIpv4(): RoutingIpv4
    {
        return new RoutingIpv4($this->zte);
    }

    /**
     * Routing(IPv6)
     */
    public function routingIpv6(): RoutingIpv6
    {
        return new RoutingIpv6($this->zte);
    }

    /**
     * Port Locating
     *
     * Configure Port Locating function.
     */
    public function portLocating(): void
    {
    }
}
