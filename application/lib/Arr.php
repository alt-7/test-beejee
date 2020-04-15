<?php
/**
 * @package Chocolife.me
 * @author  Altynbek <akhmedov.a@chocolife.kz>
 */

namespace application\lib;

class Arr
{
    public static function map($argc)
    {
        $result = array();
        if (is_array($argc)) {
            foreach ($argc as $key => $value) {
                $key = strip_tags($key);
                if (is_array($value)) {
                    $result[$key] = static::map($value);
                } else {
                    $result[$key] = trim(strip_tags($value));
                }
            }
            return $result;
        }
        return trim(strip_tags($argc));
    }
}
