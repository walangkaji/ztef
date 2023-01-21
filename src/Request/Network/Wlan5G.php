<?php

namespace ZteF\Request\Network;

use ZteF\Request;

class Wlan5G extends Request
{
    /**
     * Basic
     *
     * Configure WLAN basic parameters, such as radio, channel, wireless mode, etc.
     */
    public function basic(): void
    {
    }

    /**
     * SSID Settings
     *
     * Need To be Added.
     */
    public function ssidSetting(): void
    {
    }

    /**
     * Security
     *
     * SSID security setting, supported methods: None, WEP, WPA, WPA2, WPA/WPA2, etc.
     */
    public function security(): void
    {
    }

    /**
     * Access Control List
     *
     * Configure ACL policy and MAC.
     */
    public function accessControlList(): void
    {
    }

    /**
     * Associated Devices
     *
     * Display the IP address and MAC of the STA associated to SSID.
     */
    public function associatedDevices(): void
    {
    }

    /**
     * WDS
     *
     * Configure WDS mode and WDS interface, and add WDS MAC connecting to this AP.
     */
    public function wds(): void
    {
    }

    /**
     * WMM
     *
     * Set WMM parameters, such as AIFSN, ECWMin, ECWMax, TXOP, Qlength, SRL, LRL.
     */
    public function wmm(): void
    {
    }

    /**
     * WPS
     *
     * Set WPS method, PBC or Disabled.
     */
    public function wps(): void
    {
    }
}
