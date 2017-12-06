<?php


namespace core\generator\models;


use core\components\Model;

/**
 * @property null model_class
 * @property null controller_class
 * @property null view_path
 */
class CrudGeneratorForm extends Model implements IGenerator
{

    public $rules = [
        [['model_class', 'controller_class', 'view_path'], 'required'],
        [['model_class', 'controller_class'], 'mask', 'pattern' => '/^[\w\\\\]+$/', 'message' => 'Only word characters and backslashes are allowed.'],
        ['view_path', 'mask' , 'pattern' => '/^@?\w+[\\-\\/\w]*$/', 'message' => 'Only word characters, dashes, slashes and @ are allowed.']
    ];

    function generate()
    {
        // TODO: Implement generate() method.
    }

    public function attributeLabels()
    {
        return [
            'model_class' => 'Model Class',
            'controller_class' => 'Controller Class',
            'view_path' => 'Views Directory'
        ];
    }
}