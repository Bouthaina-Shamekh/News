<?php

namespace App\Helpers;

class FormatSize
{

    public static function formatSize($size)
    {
        if ($size >= 1048576) { // أكبر من أو يساوي 1 ميجابايت
            return number_format($size / 1048576, 2) . ' MB';
        } elseif ($size >= 1024) { // أكبر من أو يساوي 1 كيلوبايت
            return number_format($size / 1024, 2) . ' KB';
        } else {
            return $size . ' bytes';
        }
    }
}
