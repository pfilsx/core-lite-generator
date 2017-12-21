<?php


namespace core\generator;


use Core;
use core\base\App;
use core\components\Module;

class Generator extends Module
{

    public function initializeModule()
    {
        App::$instance->router->addRules([
            'generator' => ['route' => $this->id.'/default/index'],
            'generator/<controller>/<action>' => ['route' => $this->id.'/<controller>/<action>'],
            'generator/<action>' => ['route' => $this->id.'/default/<action>']
        ]);
        Core::setAlias('@core-gen', $this->getBasePath());
    }
}