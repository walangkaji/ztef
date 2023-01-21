<?php

namespace ZteF\Request\Security;

use ManCurl\Debug;
use ZteF\Request;
use ZteF\Utils;

class Security extends Request
{
    /**
     * Firewall
     *
     * This page allows the user to set the level
     * of the firewall(IPv4) and protection against attacks.
     * After setting, this page displays the level
     * of the firewall and the new state of protection against attacks.
     */
    public function firewall(): void
    {
    }

    /**
     * IP Filter
     *
     * This page allows the user to set the rule to filter the packet.
     * After setting, this page displays the rule.
     */
    public function ipFilter(): void
    {
    }

    /**
     * MAC Filter
     *
     * MAC Address Filter: The MAC Address Filter settings
     * can set the relevance parameters of the MAC filter function.
     * The user interface will display the set MAC Filter rules after setting completed.
     */
    public function macFilter(): void
    {
    }

    /**
     * URL Filter
     *
     * URL Filter: The URL Filter settings can set rule to filter
     * HTTP packets or accept HTTP packets. The page will display
     * the new URL Filter rules after setting completed.
     */
    public function urlFilter(): void
    {
    }

    /**
     * This method allows the user to set (enable or disable) ALG switch.
     *
     * @param bool $ftp   FTP ALG
     * @param bool $tftp  TFTP ALG
     * @param bool $sip   SIP ALG
     * @param bool $l2tp  L2TP ALG
     * @param bool $h323  H323 ALG
     * @param bool $rtsp  RTSP ALG
     * @param bool $pptp  PPTP ALG
     * @param bool $snmp  SNMP ALG
     * @param bool $ipsec IPSEC ALG
     */
    public function alg(
        bool $ftp = true,
        bool $tftp = true,
        bool $sip = true,
        bool $l2tp = true,
        bool $h323 = true,
        bool $rtsp = true,
        bool $pptp = true,
        bool $snmp = true,
        bool $ipsec = true,
    ): bool {
        $session = Utils::getSession($this->request(self::SEC_ALG)->getRawResponse());
        $request = $this->request(self::SEC_ALG)
            ->addPosts([
                'IsSIPAlg'       => (int) $sip,
                'IsFTPAlg'       => (int) $ftp,
                'IsH323Alg'      => (int) $h323,
                'IsRTSPAlg'      => (int) $rtsp,
                'IsL2TPAlg'      => (int) $l2tp,
                'IsPPTPAlg'      => (int) $pptp,
                'IsTFTPAlg'      => (int) $tftp,
                'IsSNMPAlg'      => (int) $snmp,
                'IsIPSECAlg'     => (int) $ipsec,
                'IF_ACTION'      => 'apply',
                '_SESSION_TOKEN' => $session,
            ])
            ->getRawResponse();

        $check = Utils::checkError($request);

        if ('SUCC' === $check) {
            Debug::success(__FUNCTION__, 'Your data have been stored!');

            return true;
        }

        Debug::error(__FUNCTION__, $check);

        return false;
    }
}
