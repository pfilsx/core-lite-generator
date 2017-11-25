<?php


namespace app\shop_lite\modules\generator;


use core\components\AssetBundle;

class CoreGenAssets extends AssetBundle
{
    public static function cssAssets()
    {
        return ['@core-gen/assets/crl.core-gen.main.css'];
    }
    public static function jsAssets()
    {
        return ['@core-gen/assets/crl.core-gen.main.js'];
    }
    public static function depends()
    {
        return [
            'core\assets\MainAssets'
        ];
    }
}