<?php

namespace App\Helpers;

use NumberFormatter;
use App\Models\Setting;

Class Currency
{
  public static function format($amount, $currency = null)
  {

    $currency = Setting::where('key', 'currency')->value('value');
      if($currency === null){
        $currency = config('app.currency', 'USD');
      }

    $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($amount, $currency);
  }

}
