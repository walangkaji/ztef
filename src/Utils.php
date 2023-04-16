<?php

namespace ZteF;

use Illuminate\Support\Collection;

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

    /**
     * Generate random integer
     */
    public static function randomNumber(int $length): int
    {
        return random_int((int) pow(10, $length - 1), (int) pow(10, $length) - 1);
    }

    /**
     * Collect all data from transfer meaning method in html
     *
     * @param string $contents html document
     */
    public static function collectTransferMeaning(string $contents): Collection
    {
        preg_match_all('/Transfer_meaning\(\'(.*)\'\);/', $contents, $output);

        if (!isset($output[1])) {
            return collect([]);
        }

        return collect($output[1])->mapWithKeys(function ($value) {
            /** @phpstan-ignore-next-line */
            list($k, $v) = explode("','", $value);

            return [$k => is_numeric($v) ? (int) $v : self::uniDecode($v)];
        });
    }
}
