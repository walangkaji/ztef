<?php

namespace ZteF;

class Utils
{
    public static function find(string $content, string $start, string $end): string
    {
        if (1 == preg_match('/' . $start . '(.*?)' . $end . '/', $content, $match)) {
            return $match[1];
        }

        return '';
    }

    public static function toFixed(float $number, int $decimals): string
    {
        return number_format($number, $decimals, '.', '');
    }

    public static function getLoginToken(string $html): int
    {
        return (int) self::find($html, '"Frm_Logintoken", "', '"');
    }

    public static function getLoginCheckToken(string $html): string
    {
        return self::find($html, '"Frm_Loginchecktoken", "', '"');
    }

    public static function passwordMD5(string $password): string
    {
        return md5($password . rand(10000000, 99999999));
    }

    public static function getSession(string $html): string
    {
        return self::find($html, 'session_token = "', '";');
    }

    public static function uniDecode(string $str): string
    {
        return quoted_printable_decode(
            (string) preg_replace('(\\\\x(?=[0-9A-Fa-f]{2}))', '=', $str)
        );
    }

    /**
     * Check error
     *
     * @return string SUCC or Error string
     */
    public static function checkError(string $html): string
    {
        preg_match_all('/Transfer_meaning\(\'IF_ERRORSTR\',\'(.*)\'\);/', $html, $output);

        return self::uniDecode($output[1][1]);
    }

    public static function randomNumber(int $length): int
    {
        $code = '';
        for ($i = 0; $i < $length; ++$i) {
            $code .= mt_rand(0, 9);
        }

        return (int) $code;
    }
}
