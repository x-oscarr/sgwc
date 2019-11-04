<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;

    public static function getParam($parameter, $returnObject = false) {
       $setting = Setting::where('parameter', $parameter)->first();
       if($returnObject) {
           return $setting;
       }
       return $setting ? $setting->value : null;
    }

    public static function params() {
        $settingsData = Setting::all();
        foreach ($settingsData as $setting) {
            $settings[$setting->parameter] = $setting->value;
        }
        return $settings ?? null;
    }
}
