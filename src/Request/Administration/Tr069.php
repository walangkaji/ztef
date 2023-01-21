<?php

namespace ZteF\Request\Administration;

use ZteF\Request;

class Tr069 extends Request
{
    /**
     * Basic
     *
     * - WAN Connection: TR069 bind WAN.
     * - ACS URL: ACS server URL, eg: http://domain(or IP).
     * - Username/Password: ACS authenticates username and password.
     * - Connection Request URL: Connection Request URL,
     * - eg:http://[IPv6 address]: port, or http://IPv4 address: port.
     * - Connecting Request Username/Password: Connection Request authenticates username and password.
     * - Enable Periodic Inform: Periodic Inform switch, enable when selected.
     * - Periodic Inform Interval: Periodic Inform interval(second).
     * - Authenticating ACS: Authenticating ACS switch, enable when selected.
     * - Authenticating File Server: Authenticating File Server switch, enable when selected.
     */
    public function basic(): void
    {
    }

    /**
     * Certificate
     *
     * Page for importing certificate.
     */
    public function certificate(): void
    {
    }
}
