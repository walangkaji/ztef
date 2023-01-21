<?php

namespace ZteF\Request\Application;

use ZteF\Request;

class DnsService extends Request
{
    /**
     * Domain Name
     *
     * Domain Name is represent a small network in LAN side with a name space,
     * it can be configured on interface of LAN side.
     */
    public function domainName(): void
    {
    }

    /**
     * Hosts
     * Host Name is mapped with a IP Address,
     * they can be configured by user to resolve DNS request.
     */
    public function hosts(): void
    {
    }

    /**
     * DNS
     *
     * DNS Server is a database include hostname and IP Address,
     * it can be configured to help DNS request in LAN side.
     */
    public function dns(): void
    {
    }
}
