<?php


namespace core\generator\models;


use core\web\App;
use core\components\Model;

/**
 * @property mixed|null models_namespace
 * @property mixed|null models_base_class
 * @property mixed|null models_path
 * @property mixed|null models_labels
 */
class MultipleModelGeneratorForm extends Model implements IGenerator
{
    public $models = [];

    public $rules = [
        [['models_namespace', 'models_path', 'models_base_class'], 'required'],
        [['models_namespace', 'models_path', 'models_base_class'], 'string'],
        ['models_labels', 'bool']
    ];

    public function afterLoad($data)
    {
        if (isset(App::$instance->request->post['models'])){
            $this->models = json_decode(App::$instance->request->post['models'], true);
        }
    }


    public function attributeLabels()
    {
        return [
            'models_namespace' => 'Model Namespace',
            'models_base_class' => 'Model Base Class',
            'models_path' => 'Models Directory',
            'models_labels' => 'Generate labels from comments'
        ];
    }

    public function generate(){
        if (!$this->validate()){
            return json_encode(['success' => false, 'message' => 'One of the attributes failed validation']);
        }
        foreach ($this->models as $modelObj){
            $model = new ModelGeneratorForm([
                'table_name' => $modelObj['table_name'],
                'model_name' => $modelObj['model_name'],
                'model_namespace' => $this->models_namespace,
                'model_base_class' => $this->models_base_class,
                'models_path' => $this->models_path,
                'model_labels' => $this->models_labels
            ]);
            $result = $model->generate();
            if ($result !== true){
                return json_encode(['success' => false, 'message' => $result]);
            }
        }
        return json_encode(['success' => true, 'message' => 'Models successfully generated.']);
    }
}