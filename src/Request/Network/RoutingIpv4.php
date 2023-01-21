<?php

namespace ZteF\Request\Network;

use ZteF\Request;

class RoutingIpv4 extends Request
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
     * Static Routing Configuration:select a WAN connection as
     * the Route Interface, then configure destination IP, Mask, Gateway.
     */
    public function staticRouting(): void
    {
    }

    /**
     * Policy Routing
     *
     * Policy Forwarding Configuration:
     * according to the IP, MAC, Port, Protocol, DSCP, TOS,
     * specify the Route Interface, and forward packets.
     */
    public function policyRouting(): void
    {
    }

    /**
     * Routing Table
     *
     * Route Information View, such as Network Address,
     * Subnet Mask, Gateway, Interface Information.
     */
    public function routingTable(): void
    {
    }
}
