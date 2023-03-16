<?php

namespace app\components\formatter;

use yii\i18n\Formatter;

/**
 * CustomFormatter
 * Collection of data formatter helper
 * @author Defri Indra Mahardika <defrindr@gmail.com>
 */
class CustomFormatter extends Formatter
{
    public static function asMyimage($link, $html = true, $default = null)
    {
        return \app\helpers\FileHelper::image($link, $html, $default);
    }

    public static function asFileLink($link)
    {
        return \app\helpers\FileHelper::link($link);
    }

    public static function asIdtime($time)
    {
        return \app\helpers\DateTimeHelper::getTimeReadable($time, true);
    }

    public static function asDownload($link)
    {
        return \app\helpers\FileHelper::download($link);
    }

    public static function asIddate($date)
    {
        return \app\helpers\DateTimeHelper::toReadableDate($date);
    }

    public static function asRp($value)
    {
        return \app\helpers\NumberHelper::toReadableHarga($value);
    }
}