<?php

namespace ZteF\Request\Status;

use DiDom\Document;
use ZteF\Request;
use ZteF\Utils;

class NetworkInterface extends Request
{
    /**
     * WAN Connection
     *
     * This page displays basic information of WAN connection.
     */
    public function wanConnection(): array
    {
        $request = $this->request(self::WAN_CONNECTION)->getRawResponse();
        $doc     = (new Document($request))->find('.infor');

        $result = [];
        /** @var \DiDom\Element $value */
        foreach ($doc as $key => $value) {
            if ('TestContent0' == $value->attr('id')) {
                $subnetMask = $value->find('#TR_PPP_SubnetMask')[0];
                $gateway    = $value->find('#TR_PPP_GateWay')[0];

                $result[$key] = [
                    'type'                   => $value->find('#TextPPPMode0')[0]->attr('value'),
                    'connection_name'        => $value->find('#TextWANCName0')[0]->attr('value'),
                    'ip_version'             => $value->find('#TextPPPIpMode0')[0]->attr('value'),
                    'nat'                    => $value->find('#TextPPPIsNAT0')[0]->attr('value'),
                    'ip'                     => $value->find('#TextPPPIPAddress0')[0]->attr('value'),
                    'subnet_mask'            => $subnetMask->find('.uiNoBorder')[0]->attr('value'),
                    'gateway'                => $gateway->find('.uiNoBorder')[0]->attr('value'),
                    'dns'                    => $value->find('#TextPPPDNS0')[0]->attr('value'),
                    'ipv4_connection_status' => $value->find('#TextPPPConStatus0')[0]->attr('value'),
                    'ipv4_online_duration'   => $value->find('#TextPPPUpTime0')[0]->attr('value'),
                    // 'disconnect_reason'      => $value->find('#xxxxxxxxxx')[0]->attr('value'),
                    'lla'                    => $value->find('#TextPPPLLA0')[0]->attr('value'),
                    'gua'                    => $value->find('#TextPPPGua10')[0]->attr('value'),
                    'dnsv6'                  => $value->find('#TextPPPDNSv60')[0]->attr('value'),
                    'gua_prefix_delegation'  => $value->find('#TextPPPGuaPD0')[0]->attr('value'),
                    'ipv6_connection_status' => $value->find('#TextPPPConnStatusV60')[0]->attr('value'),
                    'ipv6_online_duration'   => $value->find('#TextPPPUpTimeV60')[0]->attr('value'),
                    'wan_mac'                => $value->find('#TextPPPWorkIFMac0')[0]->attr('value'),
                ];
            }

            if ('TestContent1' == $value->attr('id')) {
                $subnetMask = $value->find('#TR_IP_SubnetMask')[0];

                $result[$key] = [
                    'type'                   => $value->find('#TextIPMode1')[0]->attr('value'),
                    'connection_name'        => $value->find('#TextWANCName1')[0]->attr('value'),
                    'ip_version'             => $value->find('#TextIPIpMode1')[0]->attr('value'),
                    'nat'                    => $value->find('#TextIPIsNAT1')[0]->attr('value'),
                    'ip'                     => $value->find('#TextIPAddress1')[0]->attr('value'),
                    'subnet_mask'            => $subnetMask->find('.uiNoBorder')[0]->attr('value'),
                    'dns'                    => $value->find('#TextIPDNS1')[0]->attr('value'),
                    'ipv4_gateway'           => $value->find('#TextIPGateWay1')[0]->attr('value'),
                    'ipv4_connection_status' => $value->find('#TextIPConnStatus1')[0]->attr('value'),
                    'ipv4_disconnect_status' => $value->find('#TextIPConnError1')[0]->attr('value'),
                    'ipv4_online_duration'   => $value->find('#TextIPUpTime1')[0]->attr('value'),
                    'remaining_lease_time'   => $value->find('#TextIPRemainLeaseTime1')[0]->attr('value'),
                    'wan_mac'                => $value->find('#TextIPWorkIFMac1')[0]->attr('value'),
                ];
            }
        }

        return $result;
    }

    /**
     * 3G/4G WAN Connection
     *
     * This page displays the information of 3G/4G WAN Connection,
     * including: connection name, type, NAT, IP, DNS,
     * connection status, disconnect reason, online duration, etc.
     */
    public function wanConnection3Gor4G(): void
    {
    }

    /**
     * 4in6 Tunnel Connection
     *
     * Show Tunnel Connection information, including the Tunnel Name,
     * the Tunnel Type, WAN Connection Type, Interface IPv4 Address, AFTR, Connection Status.
     */
    public function tunnelConnection4in6(): void
    {
    }

    /**
     * 6in4 Tunnel Connection
     *
     * This page displays the 6in4 Tunnel information.
     */
    public function tunnelConnection6in4(): void
    {
    }

    /**
     * PON information
     *
     * Show PON state and other information.
     */
    public function ponInformation(): array
    {
        $request   = $this->request(self::PON_INFORMATION)->getRawResponse();
        $regStatus = (int) (Utils::find($request, 'var RegStatus = "', '";'));
        $state     = match ($regStatus) {
            1       => 'Initial State(o1)',
            2       => 'Standby State(o2)',
            3       => 'Serial Number State(o3)',
            4       => 'Ranging State(o4)',
            5       => 'Operation State(o5)',
            6       => 'POPUP State(o6)',
            7       => 'Emergency Stop State(o7)',
            default => 'Unknown State',
        };

        $table   = (new Document($request))->find('#TABLE_DEV_ADVANCE')[0]->toDocument();
        $rxPower = (int) Utils::find($request, 'RxPower = "', '"') / 10000;
        $txPower = (int) Utils::find($request, 'TxPower = "', '"') / 10000;

        return [
            'gpon_state'                          => $state,
            'optical_module_input_power'          => Utils::toFixed($rxPower, 1) . ' dBm',
            'optical_module_output_power'         => Utils::toFixed($txPower, 1) . ' dBm',
            'optical_module_supply_voltage'       => $table->find('#Frm_Volt')[0]->text() . ' uV',
            'optical_transmitter_bias_current'    => $table->find('#Frm_Current')[0]->text() . ' uA',
            'optical_temperature_of_optical_mode' => $table->find('#Frm_Temp')[0]->text() . ' C',
        ];
    }

    /**
     * Mobile Network
     *
     * Display the information of mobile network.
     */
    public function mobileNetwork(): array
    {
        $request = $this->request(self::MOBILE_NETWORK)->getRawResponse();

        return [
            'service_provider' => null,
            'network_mode'     => null,
            'signal_strength'  => \count((new Document($request))->find('.divbox')),
            'imei'             => null,
            'dongle_type'      => null,
        ];
    }
}
