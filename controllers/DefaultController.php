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
        return $this->render('index');
    }

    public function actionSingleModelGenerator(){
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
                    App::$instance->session->setFlash('message', "Model {$model->model_name} successfully generated");
                } else {
                    App::$instance->session
                        ->setFlash('error_message', "An error occurred while creating {$model->model_name}: {$result}");
                }
            }
        }
        $tables = App::$instance->db->getSchema()->getTableNames();
        if (($idx = array_search('migrations', $tables)) !== false){
            unset($tables[$idx]);
        }
        return $this->render('model', ['tables' => $tables, 'model' => $model]);
    }

    public function actionMultipleModelGenerator(){
        return 'Not implemented yet';
    }

    public function actionCrudGenerator(){
        return 'Not implemented yet';
    }
}