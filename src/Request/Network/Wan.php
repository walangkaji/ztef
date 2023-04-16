<?php

namespace ZteF\Request\Network;

use ManCurl\Debug;
use ZteF\Request;
use ZteF\Utils;

class Wan extends Request
{
    /**
     * WAN Connection.
     *
     * PON broadband settings:
     * 1. IPv4 correlative: Connection Mode, including Routing.
     * Routing, including PPPoE(please select it to get IP address
     * dynamically if your ISP uses PPPoE)/ DHCP(get IP address
     * dynamically from your ISP)/ Static(set static IP address), etc.
     * Some other basic options: VLAN, NAT, etc.
     * 2. IPv6 correlative: Manual mode, manually specify GUA, Gateway and DNS.
     * Auto mode, automatically get GUA, Gateway and DNS according to RA.
     * Prefix delegation: get prefix used for LAN equipment.
     * Prefix delegation for allocation address: use the
     * prefix delegation get prefix split out prefix configuration address.
     */
    public function wanConnection(): WanAction
    {
        return new WanAction($this->zte);
    }

    /**
     * 3G/4G WAN Connection.
     *
     * 3G/4G broadband settings. When setting is completed,
     * this page displays general setting information.
     */
    public function wan3G4GConnection(): void
    {
    }

    /**
     * 4in6 Tunnel Connection.
     *
     * Tunnel configuration information, including how to
     * configure relevant parameters of Tunnel Connection,
     * and WAN Connection Name is the name of underlying
     * WAN Connection associated with the Tunnel,
     * and the range of Interface IPv4 address is between 192.0.0.2 and 192.0.0.6.
     */
    public function tunnelConnection4in6(): void
    {
    }

    /**
     * 6in4 Tunnel Connection.
     *
     * 6in4 Tunnel settings. In this page,
     * the WAN Connection represents its underlying Connection name.
     * Please notice that 6in4 Tunnel does not verify the underlying Connection.
     */
    public function tunnelConnection6in4(): void
    {
    }

    /**
     * Port Binding.
     *
     * The management of LAN Port and WAN Connection.
     */
    public function portBinding(): void
    {
    }

    /**
     * DHCP Release First.
     */
    public function dhcpReleaseFirst(bool $enable): bool
    {
        $request = $this->request(self::NET_DHCP_RELEASE)
            ->addPosts([
                'bSendRelease'   => (int) $enable,
                'ZTE'            => 'NULL',
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
}
