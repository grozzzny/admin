<?php


namespace grozzzny\admin\helpers;


use yii\base\BaseObject;

class StringHelper extends BaseObject
{
    public static function cut($str, $length, $postfix='...', $encoding='UTF-8')
    {
        if (mb_strlen($str, $encoding) <= $length) {
            return $str;
        }

        $tmp = mb_substr($str, 0, $length, $encoding);
        return mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding) . $postfix;
    }
}