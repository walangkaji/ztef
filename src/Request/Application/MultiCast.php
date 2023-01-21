<?php

namespace ZteF\Request\Application;

use ZteF\Request;

class MultiCast extends Request
{
    /**
     * IGMP WAN Connection
     *
     * Choose the WAN Connection of bridge or route type for IGMP packet.
     */
    public function igmpWanConnection(): void
    {
    }

    /**
     * MultiCast Mode
     *
     * Enable MultiCast snooping, proxy mode and configure some other parameters.
     */
    public function multiCastMode(): void
    {
    }

    /**
     * MLD WAN Connection
     *
     * Choose the WAN Connection of bridge or route type for MLD packet.
     */
    public function mldWanConnection(): void
    {
    }

    /**
     * Basic Configuration
     *
     * Set the Aging Time and Leave Mode for MultiCast Module.
     */
    public function basicConfiguration(): void
    {
    }

    /**
     * VLAN Configuration
     *
     * The MultiCast VLAN can be set to different port,
     * and the user interface will display the new Configuration.
     */
    public function vlanConfiguration(): void
    {
    }

    /**
     * Maximum Address Configuration
     *
     * The Maximum Number of Addresses can be set to different port,
     * and the user interface will display the new Configuration.
     */
    public function maximumAddressConfiguration(): void
    {
    }
}
