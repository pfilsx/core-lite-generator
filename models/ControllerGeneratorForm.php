<?php


namespace core\generator\models;


use Core;
use core\components\Model;
use core\components\View;
use core\helpers\FileHelper;

/**
 * @property string|null controller_name
 * @property string|null controller_namespace
 * @property string|null controller_actions
 * @property string|null controller_path
 */
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
        if (!$this->validate()){
            return 'One of the attributes failed validation';
        }
        $path = FileHelper::normalizePath(Core::getAlias($this->controller_path));
        $result = View::renderPartial('@core-gen/views/templates/controller.php',[
            'generator' => $this
        ]);
        if ($result == null){
            return 'Unable to generate controller class';
        }

        if (@FileHelper::createDirectory($path, 0777)){
            $fileName = $path.DIRECTORY_SEPARATOR.$this->controller_name.'.php';
            if (@file_put_contents($fileName, $result) !== false){
                chmod($fileName, 0777);
                return true;
            }
            return 'Unable to save controller file. Permission denied.';
        }
        return 'Unable to create controller directory. Permission denied.';
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

    public function getActions(){
        $actions = [];
        foreach (explode(',', $this->controller_actions) as $action) {
            $actions[] = 'action'.ucfirst(str_replace(' ', '', $action));
        }
        return $actions;
    }
}