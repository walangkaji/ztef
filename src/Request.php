<?php

namespace ZteF;

use ManCurl\Client;
use ManCurl\Request as ManCurlRequest;

class Request
{
    public const TEMPLATE             = '/template.gch';
    public const PARAM                = '/getpage.gch?pid=1002&nextpage=';
    public const DEVICE_INFORMATION   = self::PARAM . 'status_dev_info_t.gch';
    public const VOIP_STATUS          = self::PARAM . 'status_voip_4less_t.gch';
    public const WAN_CONNECTION       = self::PARAM . 'IPv46_status_wan2_if_t.gch';
    public const PON_INFORMATION      = self::PARAM . 'pon_status_link_info_t.gch';
    public const MOBILE_NETWORK       = self::PARAM . 'status_mobnet_info_t.gch';
    public const STAT_WLAN_RADIO      = self::PARAM . 'status_wlanm_info1_t.gch';
    public const STAT_WLAN_RADIO_5G   = self::PARAM . 'status_wlanm_info2_t.gch';
    public const ETHERNET             = self::PARAM . 'pon_status_lan_info_t.gch';
    public const USB                  = self::PARAM . 'status_usb_info_t.gch';
    public const NET_WAN              = self::PARAM . 'IPv46_net_wan2_conf_t.gch';
    public const NET_WAN_3G_4G        = self::PARAM . 'net_ttywan_conf_t.gch';
    public const NET_4IN6_TUNNEL      = self::PARAM . 'net_dslite_conf_t.gch';
    public const NET_6IN4_TUNNEL      = self::PARAM . 'net_6in4_conf_t.gch';
    public const NET_PORT_BINDING     = self::PARAM . 'net_portbind_conf_t.gch';
    public const NET_DHCP_RELEASE     = self::PARAM . 'net_dhcpcleanlink_t.gch';
    public const NET_LAN_ISOLATE      = self::PARAM . 'net_lanlanisolate_t.gch';
    public const ADM_BASIC_CONF_3G4G  = self::PARAM . 'pon_manager_3g_t.gch';
    public const ADM_REBOOT           = self::PARAM . 'manager_dev_conf_t.gch';
    public const ADM_USER_MANAGEMENT  = self::PARAM . 'manager_aduser_conf_t.gch';
    public const ADM_LOGIN_TIMEOUT    = self::PARAM . 'manager_login_timeout_t.gch';
    public const ADM_ARP_TABLE        = self::PARAM . 'manager_diag_arpTable_t.gch';
    public const ADM_MAC_TABLE        = self::PARAM . 'manager_diag_macTable_t.gch';
    public const APP_FAX              = self::PARAM . 'app_voip_fax_t.gch';
    public const APP_BPDU             = self::PARAM . 'app_bpdu_conf_t.gch';
    public const APP_USB_PRINT_SERVER = self::PARAM . 'print_server_t.gch';
    public const SEC_ALG              = self::PARAM . 'sec_fw_alg_t.gch';

    // WLAN
    public const WLAN_ASSOCIATED_DEVICE = self::PARAM . 'net_wlanm_assoc1_t.gch';

    public const IP_CHECK = 'https://api.ipify.org/?format=json';

    public function __construct(protected ZteF $zte)
    {
    }

    /**
     * Make request with ZteF client default configuration
     */
    protected function request(string $path): ManCurlRequest
    {
        return $this->zte->request($path);
    }

    /**
     * Make new request
     */
    protected function makeNewRequest(string $url): ManCurlRequest
    {
        return new ManCurlRequest(new Client, $url);
    }

    /**
     * Get session string from latest request
     */
    public function getSession(): string
    {
        return $this->zte->getSession();
    }
}
