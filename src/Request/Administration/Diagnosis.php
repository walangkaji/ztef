<?php

namespace ZteF\Request\Administration;

use ZteF\Request;
use ZteF\Utils;

class Diagnosis extends Request
{
    /**
     * Ping Diagnosis
     *
     * This pages is used for diagnosing the network's connectivity
     * from this device to the specified IP address or host name.
     */
    public function pingDiagnosis(): void
    {
    }

    /**
     * Trace Route Diagnosis
     *
     * This pages is used for diagnosing the network status
     * from this device to the specified IP address or host name by traceroute test.
     */
    public function traceRouteDiagnosis(): void
    {
    }

    /**
     * Simulation
     *
     * Setting basic configuration for Simulation.
     */
    public function simulation(): void
    {
    }

    /**
     * Mirror Configuration
     *
     * Mirror configure, which is used to send mirror data of WAN connection to LAN,
     * then developers or maintenance personnel can analyze caught packets.
     */
    public function mirrorConfiguration(): void
    {
    }

    /**
     * Voice Diagnosis
     *
     * Display the register status of VoIP users and the analysis of server domain name.
     */
    public function voiceDiagnosis(): void
    {
    }

    /**
     * ARP Table Information View.
     */
    public function arpTable(): array
    {
        $html = $this->request(self::ADM_ARP_TABLE)->getRawResponse();
        preg_match_all('/Transfer_meaning\(\'(.*)\'\);/', $html, $output);
        $data = [];
        foreach ($output[1] as $value) {
            $split     = explode("','", $value);
            $val       = Utils::uniDecode($split[1]);
            $keyNumber = substr($split[0], -1);

            if (is_numeric($keyNumber)) {
                $key      = str_replace($keyNumber, '', $split[0]);
                $matchKey = match ($key) {
                    'DestIP'    => 'network_address',
                    'MACAddr'   => 'mac_address',
                    'Status'    => 'status',
                    'Interface' => 'interface',
                    default     => strtolower($key),
                };
                $data[(int) $keyNumber][$matchKey] = $val;
            }
        }

        return $data;
    }

    /**
     * MAC Table
     *
     * MAC Information View.
     */
    public function macTable(): array
    {
        $html = $this->request(self::ADM_MAC_TABLE)->getRawResponse();
        preg_match_all('/Transfer_meaning\(\'(.*)\'\);/', $html, $output);
        $data = [];
        foreach ($output[1] as $value) {
            $split     = explode("','", $value);
            $val       = Utils::uniDecode($split[1]);
            $keyNumber = substr($split[0], -1);

            if (is_numeric($keyNumber)) {
                $key       = str_replace($keyNumber, '', $split[0]);
                $keyNumber = (int) $keyNumber;
                $matchKey  = match ($key) {
                    'LanName' => 'port',
                    'MACAddr' => 'mac_address',
                    'AgingTm' => 'active_time',
                    default   => strtolower($key),
                };
                $data[$keyNumber][$matchKey] = $val;
            }
        }

        return $data;
    }
}
