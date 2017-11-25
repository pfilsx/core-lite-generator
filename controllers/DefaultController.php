<?php


namespace core\generator\controllers;


use core\generator\models\ModelForm;
use core\base\App;
use core\components\Controller;

class DefaultController extends Controller
{

    public $layout = 'default';

    public function beforeAction($action, $params = [])
    {
        App::$instance->assetManager->clearBundles();
        return parent::beforeAction($action, $params);
    }

    public function actionIndex()
    {
        $this->redirect('generator/default/model-generator');
    }

    public function actionModelGenerator(){
        $model = new ModelForm();
        $model->model_namespace = 'app\models';
        $model->model_base_class = 'core\components\ActiveModel';
        $model->models_path = '@app'.DIRECTORY_SEPARATOR.'models';

        if (App::$instance->request->isPost){
            if ($model->load(App::$instance->request->post)){
                if (isset(App::$instance->request->post['validation'])){
                    return $model->ajaxValidate();
                }
                if (($result = $model->generateModel()) === true){
                    return 'good';
                }
                return 'bad';
            }
        }

        $tables = App::$instance->db->getSchema()->getTableNames();
        if (($idx = array_search('migrations', $tables)) !== false){
            unset($tables[$idx]);
        }
        return $this->render('model', ['tables' => $tables, 'model' => $model]);
    }
}