<?php


namespace core\generator\models;


use core\components\Model;

class ControllerGeneratorForm extends Model implements IGenerator
{
    public $rules = [
        [['controller_name', 'controller_path', 'controller_namespace'], 'required'],
        ['controller_name', 'mask', 'pattern' => '/^\w+$/', 'message' => 'Only word characters are allowed.'],
        ['controller_path', 'mask' , 'pattern' => '/^@?\w+[\\-\\/\w]*$/', 'message' => 'Only word characters, dashes, slashes and @ are allowed.'],
        ['controller_namespace', 'mask', 'pattern' => '/^[\w\\\\]+$/', 'message' => 'Only word characters and backslashes are allowed.'],
        ['controller_actions', 'mask', 'pattern' => '/^[\w,\s]*$/', 'message' => 'Only word characters and comma are allowed']
    ];

    public function generate(){
        // TODO: Implement generate() method.
    }

    public function attributeLabels()
    {
        return [
            'controller_name' => 'Controller Name',
            'controller_namespace' => 'Controller Namespace',
            'controller_path' => 'Controllers Directory',
            'controller_actions' => 'Actions(divided by ",")'
        ];
    }
}