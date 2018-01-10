<?php


namespace core\generator\models;


use Core;
use core\components\ActiveModel;
use core\components\Model;
use core\helpers\FileHelper;

/**
 * @property null model_class
 * @property null controller_class
 * @property null view_path
 * @property ActiveModel|null model
 * @property null model_name
 * @property null model_primary
 * @property null controller_name
 * @property null controller_namespace
 */
class CrudGeneratorForm extends Model implements IGenerator
{
    private $_model;
    private $_controller_name;
    private $_controller_namespace;
    private $_model_name;
    private $_model_primary;


    public $rules = [
        [['model_class', 'controller_class', 'view_path'], 'required'],
        [['model_class', 'controller_class'], 'mask', 'pattern' => '/^[\w\\\\]+$/', 'message' => 'Only word characters and backslashes are allowed.'],
        ['view_path', 'mask' , 'pattern' => '/^@?\w+[\\-\\/\w]*$/', 'message' => 'Only word characters, dashes, slashes and @ are allowed.']
    ];

    function generate()
    {
        if (!$this->validate()){
            return 'One of the attributes failed validation';
        }
        if (!$this->createModel()){
            return 'Incorrect model class name';
        }
        $controllerParts = explode('\\',$this->controller_class);
        $this->_controller_name = array_shift($controllerParts);
        $this->_controller_namespace = implode('\\', $controllerParts);
        $this->_model_name = array_shift(explode('\\', $this->model_class));
        $this->_model_primary = $this->model->primaryKey;
        $viewsPath = FileHelper::normalizePath(Core::getAlias($this->view_path));
        $controllerPath = FileHelper::normalizePath(Core::getAlias('@'.$this->_controller_namespace))
            .DIRECTORY_SEPARATOR.(strtolower(str_replace('Controller','',$this->_controller_name)));
        if (@FileHelper::createDirectory($controllerPath)){
            if (@FileHelper::createDirectory($viewsPath)){
                //TODO
            }
            return 'Unable to create views directory. Permission denied.';
        }
        return 'Unable to create controller directory. Permission denied.';

    }

    public function attributeLabels()
    {
        return [
            'model_class' => 'Model Class',
            'controller_class' => 'Controller Class',
            'view_path' => 'Views Directory'
        ];
    }

    public function getModel(){
        return $this->_model;
    }

    public function getController_namespace(){
        return $this->_controller_namespace;
    }

    public function getController_name(){
        return $this->_controller_name;
    }

    public function getModel_name(){
        return $this->_model_name;
    }

    public function getModel_primary(){
        return $this->_model_primary;
    }

    protected function createModel(){
        $className = $this->model_class;
        if (!class_exists($className) || !is_subclass_of($className, '\core\components\ActiveModel')){
            return false;
        }
        $this->_model = new $className();
        return true;
    }
}