<?php

namespace ZteF\Request\Administration;

use ZteF\Request;

class LoopbackDetection extends Request
{
    /**
     * Basic Configuration
     *
     * This page is used to configure the loopback global configuration.
     * Port Closing Time is the port's shut down time when loopback detected;
     * Loopback Recovery Time is used to determine if loopback disappears.
     * If the period of this time has not received detection packets, namely, that the loop disappears.
     */
    public function basicConfiguration(): void
    {
    }

    /**
     * Enable Configuration
     *
     * This page is used to configure the loopback enable configuration.
     * Loopback Enable is used to control whether to detecting loopback;
     * Alarm Enable is used to control whether to report alarm when detected loopback;
     * Portdislooped Enable is used to control whether to shut down the port when detected loopback.
     */
    public function enableConfiguration(): void
    {
    }

    /**
     * VLAN Configuration
     *
     * This page is used to configure the VLAN for detection packets,
     * distinguish between the ports.
     */
    public function vlanConfiguration(): void
    {
    }
}
