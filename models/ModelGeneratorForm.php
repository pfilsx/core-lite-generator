<?php


namespace core\generator\models;


use Core;
use core\base\App;
use core\components\Model;
use core\components\View;
use core\db\ColumnSchema;
use core\db\Schema;
use core\helpers\FileHelper;

/**
 * @property string model_namespace
 * @property string model_base_class
 * @property string models_path
 * @property string table_name
 * @property string model_name
 * @property bool model_labels
 */
class ModelGeneratorForm extends Model implements IGenerator
{

    public $rules = [
        [['table_name', 'model_name', 'model_namespace', 'model_base_class', 'models_path'], 'required'],
        [['table_name', 'model_name', 'model_namespace', 'model_base_class', 'models_path'], 'string'],
        ['model_name', 'mask', 'pattern' => '/^\w+$/', 'message' => 'Only word characters are allowed.'],
        ['models_path', 'mask', 'pattern' => '/^@?\w+[\\-\\/\w]*$/', 'message' => 'Only word characters, dashes, slashes and @ are allowed.'],
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

    public function generate(){
        if (($result = $this->validate()) !== true){
            return $result;
        }
        $props = App::$instance->db->getTableSchema($this->table_name)->columns;
        $labels = [];
        foreach ($props as $prop){
            $labels[$prop->name] = $this->model_labels ? $prop->comment: '';
        }
        $rules = $this->generateRules($props);

        $result = View::renderPartial('@core-gen/views/templates/model.php',[
            'model' => $this,
            'props' => $props,
            'labels' => $labels,
            'rules' => $rules
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

    /**
     * @param ColumnSchema[] $columns
     * @return array
     */
    private function generateRules($columns)
    {
        $types = [];
        $lengths = [];
        foreach ($columns as $column) {
            if ($column->autoIncrement) {
                continue;
            }
            if (!$column->allowNull) {
                $types['required'][] = $column->name;
            }
            switch ($column->type) {
                case Schema::TYPE_SMALLINT:
                case Schema::TYPE_INTEGER:
                case Schema::TYPE_BIGINT:
                    $types['integer'][] = $column->name;
                    break;
                case Schema::TYPE_BOOLEAN:
                    $types['boolean'][] = $column->name;
                    break;
                case Schema::TYPE_FLOAT:
                case 'double':
                case Schema::TYPE_DECIMAL:
                case Schema::TYPE_MONEY:
                    $types['number'][] = $column->name;
                    break;
                case Schema::TYPE_DATE:
                case Schema::TYPE_TIME:
                case Schema::TYPE_DATETIME:
                case Schema::TYPE_TIMESTAMP:
                    $types['safe'][] = $column->name;
                    break;
                default:
                    if ($column->size > 0) {
                        $lengths[$column->size][] = $column->name;
                    } else {
                        $types['string'][] = $column->name;
                    }
            }
        }
        $rules = [];
        foreach ($types as $type => $columns) {
            $rules[] = "[['" . implode("', '", $columns) . "'], '$type']";
        }
        foreach ($lengths as $length => $columns) {
            $rules[] = "[['" . implode("', '", $columns) . "'], 'string', 'max' => $length]";
        }
        return $rules;
    }
}