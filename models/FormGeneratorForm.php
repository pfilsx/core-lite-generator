<?php


namespace core\generator\models;


use core\components\Model;

/**
 * Class FormGeneratorForm
 * @package core\generator\models
 *
 * @property string model_class
 * @property string view_name
 * @property string view_path
 * @property string use_bootstrap
 */
class FormGeneratorForm extends Model
{
    public $rules = [
        [['model_class', 'view_name', 'view_path'], 'required'],
        ['model_class', 'mask', 'pattern' => '/^[\w\\\\]+$/', 'message' => 'Only word characters and backslashes are allowed.'],
        ['viewName', 'mask', 'pattern' => '/^\w+[\\-\\/\w]*$/', 'message' => 'Only word characters, dashes and slashes are allowed.'],
        ['viewPath', 'mask', 'pattern' => '/^@?\w+[\\-\\/\w]*$/', 'message' => 'Only word characters, dashes, slashes and @ are allowed.'],
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
}