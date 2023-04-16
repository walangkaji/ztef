<?php

namespace ZteF\Request\Helpers;

use DiDom\Document;
use ManCurl\Debug;
use ZteF\Request;
use ZteF\Request\Administration\Administration;
use ZteF\Utils;

class Helpers extends Request
{
    /**
     * Reboot device
     */
    public function reboot(): bool
    {
        return (new Administration($this->zte))->systemManagement()->reboot();
    }

    /**
     * Change Ip address for indihome without Reboot
     *
     * @param string $connectionName Connection name of indihome pppoe
     *                               we can find this on Network -> WAN,
     *                               this page indicated with showing indihome id on username
     *
     * @throws \Exception
     */
    public function changeIp(string $connectionName = 'omci_ipv4_pppoe_1'): bool
    {
        // Get identity of connection name
        $getIdentity = function (string $connectionName): string {
            $html = $this->request(self::NET_WAN)->getRawResponse();
            preg_match_all('/Transfer_meaning\(\'(.*)\'\);/', $html, $output);
            $data     = [];
            $keyPppoe = '';
            foreach ($output[1] as $value) {
                $split = explode("','", $value);
                $val   = Utils::uniDecode($split[1]);

                if ($val === $connectionName) {
                    $keyPppoe = str_replace('IF_WANNAME', 'IF_WANIDENTITY', $split[0]);
                }
                $data[$split[0]] = $val;
            }

            return '' === $keyPppoe ? '' : $data[$keyPppoe];
        };

        // Get reposition data from page of connection name
        $getReposition = function (string $identity): string {
            return $this->request(self::NET_WAN)
                         ->addPosts([
                             'IF_ACTION'      => 'Reposition',
                             'IF_IDENTITY'    => $identity,
                             '_SESSION_TOKEN' => $this->getSession(),
                         ])
                         ->getRawResponse();
        };

        // Submit modify button, params $authType : auto, PAP or CHAP
        $edit = function (string $reposition, string $authType = 'auto'): string {
            $html = new Document($reposition);
            /** @phpstan-ignore-next-line */
            $html = $html->find('#fSubmit')[0]->__toString();
            preg_match_all('/Transfer_meaning\(\'(.*)\'\);/', $html, $output);

            $remove = ['ConnType','LANDViewName','IsDefGW','IsForward','IPAddress','SubnetMask','GateWay','DNS1','DNS2','DNS3','WorkIFMac','UpTime','ConnStatus','MRU','PPPoEServiceName','IdleTime','ConnError','DestAddress','ATMLinkType','ATMEncapsulation','ATMQoS','ATMPeakCellRate','ATMMaxBurstSize','ATMMinCellRate','ATMSCR','ATMCDV','RxPackets','TxPackets','RxBytes','TxBytes','EnableProxy','MaxUser','EnablePassThrough','ValidWANRx','ValidLANTx','HostTrigger','IsAuto','GuaSrc','GuaNum','Gua1','Gua1PrefixLen','Gua2','Gua2PrefixLen','Gua3','Gua3PrefixLen','DnsSrc','Dns1v6','Dns2v6','Dns3v6','Gateway6Src','Gateway6','IsPd','PdNum','IsPdAddr','PTMLinkType','PrefixSrc','Prefix1','Prefix1Len','ConnStatus6','IF_TYPE','IF_NAME','IF_MODE', 'xDslMode'];

            $postData = [];
            foreach ($output[1] as $value) {
                $split = explode("','", $value);

                if (!\in_array($split[0], $remove)) {
                    $val   = Utils::uniDecode($split[1]);
                    $match = match ($split[0]) {
                        'IF_ACTION' => 'edit',
                        'Password'  => 'NULL',
                        'AuthType'  => 'auto' === $authType ? 'PAP,CHAP,MS-CHAP' : $authType,
                        default     => $val
                    };
                    $postData[$split[0]] = $match;
                }
            }

            $postData['_SESSION_TOKEN'] = $this->getSession();
            $postData['IF_ENCODE']      = 'wlkj';

            return $this->request(self::NET_WAN)
                        ->addPosts($postData)
                        ->getRawResponse();
        };

        $identity = $getIdentity($connectionName);

        if ('' === $identity) {
            throw new \Exception("Cannot find '$connectionName' value, please make sure the Connection Name is right");
        }

        $reposition = $getReposition($identity);

        $getIp = $this->makeNewRequest(self::IP_CHECK)->getResponse();
        $oldIp = $getIp->ip; // @phpstan-ignore-line

        $edit($reposition, 'PAP');
        $edit($reposition, 'auto');
        $getIp = $this->makeNewRequest(self::IP_CHECK)->getResponse();
        $newIp = $getIp->ip; // @phpstan-ignore-line

        Debug::info(__FUNCTION__, "Change from '$oldIp' to '$newIp'");

        return $oldIp !== $newIp;
    }
}
