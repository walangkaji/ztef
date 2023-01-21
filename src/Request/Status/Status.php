<?php

namespace ZteF\Request\Status;

use DiDom\Document;
use ZteF\Request;
use ZteF\Utils;

class Status extends Request
{
    /**
     * Device Information
     *
     * Display primary information of this device:
     * model name, serial number, soft version, boot version, etc.
     */
    public function deviceInformation(): array
    {
        $request = $this->request(Request::DEVICE_INFORMATION)->getRawResponse();
        $table   = (new Document($request))->find('#TABLE_DEV')[0]->toDocument();

        return array_map('trim', [
            'model'               => $table->find('#Frm_ModelName')[0]->text(),
            'serial_number'       => $table->find('#Frm_SerialNumber')[0]->text(),
            'hardware_version'    => $table->find('#Frm_HardwareVer')[0]->text(),
            'software_version'    => $table->find('#Frm_SoftwareVer')[0]->text(),
            'boot_loader_version' => $table->find('#Frm_BootVer')[0]->text(),
            'pon_serial_number'   => Utils::find($table->__toString(), 'sn = "', '";'),
            'batch_number'        => $table->find('#Frm_SoftwareVerExtent')[0]->text(),
        ]);
    }

    /**
     * Network Interface
     */
    public function networkInterface(): NetworkInterface
    {
        return new NetworkInterface($this->zte);
    }

    /**
     * User Interface
     */
    public function userInterface(): UserInterface
    {
        return new UserInterface($this->zte);
    }

    /**
     * VoIP Status
     *
     * Display the current server status of VoIP users.
     */
    public function voIpStatus(): array
    {
        $request = $this->request(Request::VOIP_STATUS)->getRawResponse();
        $table   = (new Document($request))->find('.tdright');

        $status = [];
        foreach ($table as $value) {
            $status[] = $value->text();
        }

        return [
            'phone_1'           => $status[0],
            'register_status_1' => $status[1],
            'phone_2'           => $status[2],
            'register_status_2' => $status[3],
        ];
    }
}
