<?php


namespace core\generator\models;


use core\components\Model;

class MultipleModelForm extends Model
{
    public $models = [];

    public $rules = [
        [['models_namespace', 'models_path', 'models_base_class'], 'required'],
        [['models_namespace', 'models_path', 'models_base_class'], 'string'],
        ['models_labels', 'bool']
    ];

    

    public function attributeLabels()
    {
        return [
            'models_namespace' => 'Model Namespace',
            'models_base_class' => 'Model Base Class',
            'models_path' => 'Models Directory',
            'models_labels' => 'Generate labels from comments'
        ];
    }
}