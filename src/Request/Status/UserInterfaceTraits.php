<?php

namespace ZteF\Request\Status;

use Illuminate\Support\Collection;
use ZteF\Utils;

trait UserInterfaceTraits
{
    /**
     * Show wlan info
     *
     * @param Collection $data collection from TransferMeaning
     */
    public function showWlanInfo(Collection $data): array
    {
        $ssid = [];
        for ($i = 0; $i < $data->get('IF_INSTNUM'); ++$i) {
            $ssid[$i + 1] = [
                'enable'                      => 0 == $data->get("Enable$i") ? false : true,
                'name'                        => $data->get("ESSID$i"),
                'authentication_type'         => $this->getSSIDAuthType($data, $i),
                'encryption_type'             => $this->getSSIDEncryptionType($data, $i),
                'mac_address'                 => $data->get("Bssid$i"),
                'packets_received'            => $data->get("TotalPacketsReceived$i"),
                'bytes_received'              => $data->get("TotalBytesReceived$i"),
                'packets_sent'                => $data->get("TotalPacketsSent$i"),
                'bytes_sent'                  => $data->get("TotalBytesSent$i"),
                'error_packets_received'      => $data->get("ErrorsReceived$i"),
                'error_packets_sent'          => $data->get("ErrorsSent$i"),
                'discarded_receiving_packets' => $data->get("DiscardPacketsReceived$i"),
                'discarded_sending_packets'   => $data->get("DiscardPacketsSent$i"),
            ];
        }

        return [
            'enable_wireless_rf' => 0 == $data->get('RealRF0') ? false : true,
            'channel'            => $data->get('ChannelInUsed0'),
            'wds'                => $this->showWDSInfo($data),
            'ssid'               => $ssid,
        ];
    }

    /**
     * Get SSID Authentication type
     *
     * @param Collection $data collection from TransferMeaning
     */
    public function getSSIDAuthType(Collection $data, int $i): string
    {
        if ($data->get("Enable$i")) {
            if ('None' == $data->get("BeaconType$i") || ('Basic' == $data->get("BeaconType$i") && 'None' == $data->get("WEPAuthMode$i"))) {
                return 'Open System';
            } elseif ('Basic' == $data->get("BeaconType$i") && 'SharedAuthentication' == $data->get("WEPAuthMode$i")) {
                return 'Shared Key';
            } elseif ('WPA' == $data->get("BeaconType$i") && 'PSKAuthentication' == $data->get("WPAAuthMode$i")) {
                return 'WPA-PSK';
            } elseif ('11i' == $data->get("BeaconType$i") && 'PSKAuthentication' == $data->get("11iAuthMode$i")) {
                return 'WPA2-PSK';
            } elseif ('WPAand11i' == $data->get("BeaconType$i") && 'PSKAuthentication' == $data->get("WPAAuthMode$i") && 'PSKAuthentication' == $data->get("11iAuthMode$i")) {
                return 'WPA/WPA2-PSK';
            } elseif ('WPA' == $data->get("BeaconType$i") && 'EAPAuthentication' == $data->get("WPAAuthMode$i")) {
                return 'WPA-EAP';
            } elseif ('11i' == $data->get("BeaconType$i") && 'EAPAuthentication' == $data->get("11iAuthMode$i")) {
                return 'WPA2-EAP';
            } elseif ('WPAand11i' == $data->get("BeaconType$i") && 'EAPAuthentication' == $data->get("WPAAuthMode$i") && 'EAPAuthentication' == $data->get("11iAuthMode$i")) {
                return 'WPA/WPA2-EAP';
            }

            return '';
        }

        return '';
    }

    /**
     * Get SSID Encryption type
     *
     * @param Collection $data collection from TransferMeaning
     */
    public function getSSIDEncryptionType(Collection $data, int $i): string
    {
        if ($data->get("Enable$i")) {
            if ('None' == $data->get("BeaconType$i")) {
                return 'None';
            } elseif ('Basic' == $data->get("BeaconType$i")) {
                return 'WEP';
            } elseif (('WPA' == $data->get("BeaconType$i") && 'TKIPEncryption' == $data->get("WPAEncryptType$i")) || ('11i' == $data->get("BeaconType$i") && 'TKIPEncryption' == $data->get("11iEncryptType$i")) || ('WPAand11i' == $data->get("BeaconType$i") && 'TKIPEncryption' == $data->get("WPAEncryptType$i"))) {
                return 'TKIP';
            } elseif (('WPA' == $data->get("BeaconType$i") && 'AESEncryption' == $data->get("WPAEncryptType$i")) || ('11i' == $data->get("BeaconType$i") && 'AESEncryption' == $data->get("11iEncryptType$i")) || ('WPAand11i' == $data->get("BeaconType$i") && 'AESEncryption' == $data->get("WPAEncryptType$i"))) {
                return 'AES';
            } elseif (('WPA' == $data->get("BeaconType$i") && 'TKIPandAESEncryption' == $data->get("WPAEncryptType$i")) || ('11i' == $data->get("BeaconType$i") && 'TKIPandAESEncryption' == $data->get("11iEncryptType$i")) || ('WPAand11i' == $data->get("BeaconType$i") && 'TKIPandAESEncryption' == $data->get("WPAEncryptType$i"))) {
                return 'TKIP+AES';
            }

            return '';
        }

        return '';
    }

    /**
     * Get SSID Encryption type
     *
     * @param Collection $data collection from TransferMeaning
     */
    public function showWDSInfo(Collection $data): array
    {
        $wdsMode = $data->get('WdsMode0');
        $result  = [
            'wds_mode'                  => 'disabled',
            'wds_interface_mac_address' => '',
            'wds_mac_name'              => '',
            'wds_mac'                   => '',
            'connection_status'         => '',
        ];

        if ('WDS_Disable' == $wdsMode) {
            $result['wds_mode'] = 'disabled';
        } elseif ('WDS_Root' == $wdsMode) {
            $result['wds_mode']                  = 'WDS+Root';
            $result['wds_interface_mac_address'] = $data->get('Bssid0');
            $result['wds_mac_name']              = 'Repeater MAC Address';
            $result['wds_mac']                   = '00:00:00:00:00:00' == $data->get('WDSMac1') ? '' : $data->get('WDSMac1');
            $result['connection_status']         = $data->get('WDSConnectStatus1');
        } elseif ('WDS_Repeater' == $wdsMode) {
            $result['wds_mode']                  = 'WDS+Repeater';
            $result['wds_interface_mac_address'] = $data->get('Bssid0');
            $result['wds_mac_name']              = 'Root MAC Address';
            $result['wds_mac']                   = '00:00:00:00:00:00' == $data->get('WDSMac1') ? '' : $data->get('WDSMac1');
            $result['connection_status']         = $data->get('WDSConnectStatus1');
        }

        return $result;
    }

    /**
     * Get packet & bytes value from table
     */
    public function getSentReceivePacketByte(string $value): array
    {
        $split = explode('/', $value);

        return [
            'packet' => $split[0],
            'byte'   => $split[1],
        ];
    }

    /**
     * Get packet & bytes value from table
     */
    public function getErrorFrames(string $value): int
    {
        $inError     = (int) Utils::find($value, 'var str_InError = ', ';');
        $inDiscard   = (int) Utils::find($value, 'var str_InDiscard = ', ';');
        $errorFrames = (int) Utils::find($value, 'var ErrorFrames = "', '"');

        if (null == $inError && null != $inDiscard) {
            $errorFrames = $inDiscard;
        }

        if (null != $inError && null == $inDiscard) {
            $errorFrames = $inError;
        }

        if (null != $inError && null != $inDiscard) {
            $errorFrames = $inError + $inDiscard;
        }

        return $errorFrames;
    }
}
