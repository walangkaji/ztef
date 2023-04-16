<?php

namespace ZteF\Request\Network;

use ManCurl\Debug;
use ZteF\Request;
use ZteF\Utils;

class Lan extends Request
{
    /**
     * Enable or Disable LAN-LAN Isolation.
     */
    public function lanIsolation(bool $enable): bool
    {
        $request = $this->request(self::NET_LAN_ISOLATE)
            ->addPosts([
                'IsolateEnable'  => (int) $enable,
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
     * DHCP Server
     *
     * 1. Supporting the management of the Home Gateway's IP address.
     * 2. Dynamic Address management, including Dynamic Address distribution,
     * and parameters distributed to equipment, such as lease time, address range, DNS, etc.
     */
    public function dhcpServer(): void
    {
    }

    /**
     * DHCP Server(IPv6)
     *
     * 1. Supporting the management of the Home Gateway's IPv6 address and it's prefix length.
     * 2. IPv6 Dynamic Address management: IP Address:
     * configure the IPv6 address and prefix length of the gateway.
     * Enable DHCP Service: enable/disable DHCPv6 service function.
     * DNS Refresh Time: configure the DNS refresh time distributed to client.
     * Distributed Address List: DUID: DUID of client, identifies one client uniquely.
     * IP Address, IPv6 address distributed to client.
     * Residual Rent Time: the residual rent time of IPv6 address distributed to client.
     */
    public function dhcpServerIpv6(): void
    {
    }

    /**
     * DHCP Binding
     *
     * Static address management: based on the dynamic address,
     * it provides the configuration on binding relationship of
     * MAC address and IP address (legal IP address),
     * and reserves the configuration IP function.
     */
    public function dhcpBinding(): void
    {
    }

    /**
     * DHCP Port Service
     *
     * Configure the DHCP serivce of each port.
     */
    public function dhcpPortService(): void
    {
    }

    /**
     * Prefix Management
     *
     * This page is used to display and modify the prefix information.
     * The prefix can be obtained automatically, or configued manually.
     * And the information is not allowed to be modified when prefix source is None.
     */
    public function prefixManagement(): void
    {
    }

    /**
     * DHCP Port Service(IPv6)
     * DHCPv6 or RA service will be enabled on the port when DHCPv6 or RA is checked.
     */
    public function dhcpPortServiceIpv6(): void
    {
    }

    /**
     * RA Service
     *
     * Router Advertisement(RA) is called stateless address autoconfiguration,
     * it can periodically send many information include MTU, prefix, DNS and hop limit.
     * The period in random is between mintime and maxtime.
     * Managed address configuration(M) flag, when set, hosts use
     * the DHCPv6 protocol for address auto configuration.
     * Other stateful configuration(O) flag, When set, hosts use
     * the DHCPv6 protocol for auto configuration of other (non-address) information.
     */
    public function raService(): void
    {
    }
}
