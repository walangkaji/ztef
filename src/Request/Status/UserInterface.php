<?php

namespace ZteF\Request\Status;

use DiDom\Document;
use ZteF\Request;
use ZteF\Utils;

class UserInterface extends Request
{
    use UserInterfaceTraits;

    /**
     * WLAN Radio2.4G
     *
     * Display WLAN information, including radio status,
     * channel, SSID name, packets received, packets sent, security, etc.
     */
    public function wlan(): array
    {
        $request = $this->request(Request::STAT_WLAN_RADIO)->getRawResponse();
        $data    = Utils::collectTransferMeaning($request);

        return $this->showWlanInfo($data);
    }

    /**
     * WLAN Radio5G
     *
     * Display WLAN information, including radio status,
     * channel, SSID name, packets received, packets sent, security, etc.
     */
    public function wlan5G(): array
    {
        $request = $this->request(Request::STAT_WLAN_RADIO_5G)->getRawResponse();
        $data    = Utils::collectTransferMeaning($request);

        return $this->showWlanInfo($data);
    }

    /**
     * Ethernet
     *
     * Display the Ethernet port information, including port name,
     * link status, packets/bytes received, packets/bytes sent, etc.
     */
    public function ethernet(): array
    {
        $request = $this->request(Request::ETHERNET)->getRawResponse();
        $doc     = (new Document($request))->find('.infor');

        $result = [];
        /** @var \DiDom\Element $value */
        foreach ($doc as $key => $value) {
            $result[$key] = [];
            $tableValue   = $value->find('.tdright');
            $receive      = $this->getSentReceivePacketByte($tableValue[4]->text());
            $sent         = $this->getSentReceivePacketByte($tableValue[5]->text());
            $result[$key] = [
                'ethernet_port'   => $tableValue[0]->text(),
                'status'          => $tableValue[1]->text(),
                'speed'           => $tableValue[2]->text(),
                'mode'            => $tableValue[3]->text(),
                'packet_received' => (int) $receive['packet'],
                'byte_received'   => (int) $receive['byte'],
                'packet_sent'     => (int) $sent['packet'],
                'byte_sent'       => (int) $sent['byte'],
                'error_frames'    => $this->getErrorFrames($tableValue[6]->text()),
            ];
        }

        return $result;
    }

    /**
     * USB
     *
     * Display information of USB devices connected.
     */
    public function usb(): array
    {
        // $request = file_get_contents(__DIR__ . '/../../../test.html');
        $request = $this->request(Request::USB)->getRawResponse();
        $table   = (new Document($request))->find('.tdright');

        $status = [];
        foreach ($table as $value) {
            $status[] = $value->text();
        }

        return [
            'usb_port'          => (int) $status[0],
            'device_name'       => $status[1],
            'device_type'       => $status[2],
            'vendor_product_id' => $status[3],
            'device_speed'      => $status[4],
            'status'            => $status[5],
        ];
    }
}
