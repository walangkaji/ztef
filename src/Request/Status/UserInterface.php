<?php

namespace ZteF\Request\Status;

use ZteF\Request;

class UserInterface extends Request
{
    /**
     * WLAN Radio2.4G
     *
     * Display WLAN information, including radio status,
     * channel, SSID name, packets received, packets sent, security, etc.
     */
    public function wlan24G(): void
    {
    }

    /**
     * WLAN Radio5G
     *
     * Display WLAN information, including radio status,
     * channel, SSID name, packets received, packets sent, security, etc.
     */
    public function wlan5G(): void
    {
    }

    /**
     * Ethernet
     *
     * Display the Ethernet port information, including port name,
     * link status, packets/bytes received, packets/bytes sent, etc.
     */
    public function ethernet(): void
    {
    }

    /**
     * USB
     *
     * Display information of USB devices connected.
     */
    public function usb(): void
    {
    }
}
