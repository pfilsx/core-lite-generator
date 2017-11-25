<?php


namespace core\generator;


use core\components\AssetBundle;

class CoreGenAssets extends AssetBundle
{
    public $basePath = '@core-gen/assets';

    public function cssAssets()
    {
        return ['crl.core-gen.main.css'];
    }
    public function jsAssets()
    {
        return ['crl.core-gen.main.js'];
    }
    public function depends()
    {
        return [
            'core\assets\MainAssets',
            'core\bootstrap\BootstrapAsset'
        ];
    }
}