<?php

namespace ZteF\Request\Network;

use ZteF\Request;
use ZteF\Utils;

class Wlan extends Request
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
     * Display the IP address and MAC of the STA associated to SSID
     *
     * @param int $ssid Choose SSID between 1 - 4. Default: 1
     */
    public function associatedDevices(int $ssid = 1): array
    {
        if (1 == $ssid) {
            $request = $this->request(Request::WLAN_ASSOCIATED_DEVICE)->getRawResponse();
        } else {
            $request = $this->request(self::WLAN_ASSOCIATED_DEVICE)
                ->addPosts([
                    'IF_VIEWID'      => 'IGD.LD1.WLAN' . $ssid,
                    '_SESSION_TOKEN' => $this->getSession(),
                ])
                ->getRawResponse();
        }

        $data   = Utils::collectTransferMeaning($request);
        $result = [];
        for ($i = 0; $i < $data->get('IF_INSTNUM'); ++$i) {
            $result[$i] = [
                'mac_address' => $data->get("ADMACAddress$i"),
                'ip_address'  => $data->get("ADIPAddress$i"),
                'device_name' => $data->get("DeviceName$i"),
                'mcs'         => '-1' == $data->get("MCS$i") ? 'N/A' : $data->get("MCS$i"),
                'rssi'        => $data->get("RSSI$i"),
                'tx_rate'     => $data->get("TXRate$i"),
                'rx_rate'     => $data->get("RXRate$i"),
                'sta_mode'    => $data->get("CurrentMode$i"),
            ];
        }

        return $result;
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
