<?php


namespace core\generator\models;


use Core;
use core\base\App;
use core\components\Model;
use core\components\View;
use core\helpers\FileHelper;

/**
 * @property string model_namespace
 * @property string model_base_class
 * @property string models_path
 * @property string table_name
 * @property string model_name
 * @property bool model_labels
 */
class ModelForm extends Model
{

    public $rules = [
        [['table_name', 'model_name', 'model_namespace', 'model_base_class', 'models_path'], 'required'],
        [['table_name', 'model_name', 'model_namespace', 'model_base_class', 'models_path'], 'string'],
        ['model_name', 'mask', 'pattern' => '/^\w+$/', 'message' => 'Only word characters are allowed.'],
        [['model_base_class', 'model_namespace'], 'mask', 'pattern' => '/^[\w\\\\]+$/', 'message' => 'Only word characters and backslashes are allowed.'],
        ['model_labels', 'bool']
    ];

    public function attributeLabels()
    {
        return [
            'table_name' => 'Table Name',
            'model_name' => 'Model Name',
            'model_namespace' => 'Model Namespace',
            'model_base_class' => 'Model Base Class',
            'models_path' => 'Models Directory',
            'model_labels' => 'Generate labels from comments'
        ];
    }

    public function generateModel(){
        if (($result = $this->validate()) !== true){
            return $result;
        }
        $props = App::$instance->db->getTableSchema($this->table_name)->columns;
        $labels = [];
        foreach ($props as $prop){
            $labels[$prop->name] = $this->model_labels ? $prop->comment: '';
        }
        $result = View::renderPartial('@core-gen/views/templates/model.php',[
            'model' => $this,
            'props' => $props,
            'labels' => $labels
        ]);
        if ($result == null){
            return 'Unable to generate model class';
        }
        $path = FileHelper::normalizePath(Core::getAlias($this->models_path));
        if (@FileHelper::createDirectory($path, 0777)){
            $fileName = $path.DIRECTORY_SEPARATOR.$this->model_name.'.php';
            if (@file_put_contents($fileName, $result) !== false){
                chmod($fileName, 0777);
                return true;
            }
            return 'Unable to save model file. Permission denied.';
        }
        return 'Unable to create models directory. Permission denied.';
    }
}