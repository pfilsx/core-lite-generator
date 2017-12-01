<?php


namespace core\generator\models;


use Core;
use core\bootstrap\ActiveForm;
use core\components\Model;
use core\components\View;
use core\helpers\FileHelper;

/**
 * Class FormGeneratorForm
 * @package core\generator\models
 *
 *
 * @property string model_class
 * @property string view_name
 * @property string view_path
 * @property string use_bootstrap
 */
class FormGeneratorForm extends Model
{
    protected $_model = null;

    public $rules = [
        [['model_class', 'view_name', 'view_path'], 'required'],
        ['model_class', 'mask', 'pattern' => '/^[\w\\\\]+$/', 'message' => 'Only word characters and backslashes are allowed.'],
        ['view_name', 'mask', 'pattern' => '/^\w+[\\-\\/\w]*$/', 'message' => 'Only word characters, dashes and slashes are allowed.'],
        ['view_path', 'mask', 'pattern' => '/^@?\w+[\\-\\/\w]*$/', 'message' => 'Only word characters, dashes, slashes and @ are allowed.'],
        ['use_bootstrap', 'boolean']
    ];

    public function attributeLabels()
    {
        return [
            'model_class' => 'Model Class with Namespace',
            'view_name' => 'View Name',
            'view_path' => 'View Directory',
            'use_bootstrap' => 'Should use bootstrap form'
        ];
    }

    public function generate(){
        if (!$this->validate()){
            return '';
        }
        if (!$this->createModel()){
            return 'Incorrect model class name';
        }

        $path = FileHelper::normalizePath(Core::getAlias($this->view_path));
        $result = View::renderPartial('@core-gen/views/templates/form.php',[
            'generator' => $this
        ]);
        if ($result == null){
            return 'Unable to generate model class';
        }

        if (@FileHelper::createDirectory($path, 0777)){
            $fileName = $path.DIRECTORY_SEPARATOR.$this->view_name.'.php';
            if (@file_put_contents($fileName, $result) !== false){
                chmod($fileName, 0777);
                return true;
            }
            return 'Unable to save view file. Permission denied.';
        }
        return 'Unable to create view directory. Permission denied.';
    }

    public function getFormClass(){
        return ($this->use_bootstrap ? ActiveForm::className() : \core\widgets\activeform\ActiveForm::className());
    }

    public function getModel(){
        return $this->_model;
    }

    public function getSubmitClasses(){
        return ($this->use_bootstrap ? 'btn btn-primary' : '');
    }

    protected function createModel(){
        $className = $this->model_class;
        if (!class_exists($className) || !is_subclass_of($className, '\core\components\Model')){
            return false;
        }
        $this->_model = new $className();
        return true;
    }
}