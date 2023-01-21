<?php

namespace ZteF\Request\Network;

use ZteF\Request;

class RoutingIpv6 extends Request
{
    /**
     * Default Gateway
     *
     * Default Route Interface Configuration:
     * specify a WAN connection as the default one for routing.
     */
    public function defaultGateway(): void
    {
    }

    /**
     * Static Routing
     *
     * Static Routing Configuration:
     * select a WAN connection as the Route Interface,
     * then configure destination IP, Prefix, and Gateway.
     */
    public function staticRouting(): void
    {
    }

    /**
     * Policy Routing
     *
     * Policy Forwarding Configuration:
     * according to the IP, MAC, Port, Protocol,
     * specify the Route Interface, and then forward packets.
     */
    public function policyRouting(): void
    {
    }

    /**
     * Routing Table
     *
     * Route Information View, such as Network Address,
     * Prefixlen, Gateway, Interface,Route Type Information.
     */
    public function routingTable(): void
    {
    }
}
