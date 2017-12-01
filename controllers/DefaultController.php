<?php


namespace core\generator\controllers;


use core\generator\models\FormGeneratorForm;
use core\generator\models\ModelForm;
use core\base\App;
use core\components\Controller;
use core\generator\models\MultipleModelForm;

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
        $model = new ModelForm([
            'model_namespace' => 'app\models',
            'model_base_class' => '\core\components\ActiveModel',
            'models_path' => '@app'.DIRECTORY_SEPARATOR.'models'
        ]);
        if (App::$instance->request->isPost){
            if ($model->load(App::$instance->request->post)){
                if (isset(App::$instance->request->post['validation'])){
                    return $model->ajaxValidate();
                }
                if (($result = $model->generate()) === true){
                    App::$instance->session->setFlash('message', "Model {$model->model_name} successfully generated");
                    $model->model_name = null;
                    $model->table_name = null;
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
        $model = new MultipleModelForm([
            'models_namespace' => 'app\models',
            'models_base_class' => '\core\components\ActiveModel',
            'models_path' => '@app'.DIRECTORY_SEPARATOR.'models'
        ]);
        if (App::$instance->request->isPost){
            $post = App::$instance->request->post;
            if ($model->load($post)){
                if (isset($post['validate'])){
                    return $model->ajaxValidate();
                }
                return $model->generate();
            }
        }

        $tables = App::$instance->db->getSchema()->getTableNames();
        if (($idx = array_search('migrations', $tables)) !== false){
            unset($tables[$idx]);
        }
        return $this->render('multiple_model', ['tables' => $tables, 'model' => $model]);
    }

    public function actionFormGenerator(){
        $model = new FormGeneratorForm([
            'view_name' => 'form',
            'view_path' => '@app'.DIRECTORY_SEPARATOR.'views'
        ]);
        if (App::$instance->request->isPost){
            if ($model->load(App::$instance->request->post)){
                if (App::$instance->request->isAjax){
                    return $model->ajaxValidate();
                }
                if (($result = $model->generate()) === true){
                    App::$instance->session->setFlash('message', "Form {$model->view_name} successfully generated");
                    $model->model_class = null;
                } else {
                    App::$instance->session
                        ->setFlash('error_message', "An error occurred while creating {$model->view_name}: {$result}");
                }
            }
        }
        return $this->render('form', ['model' => $model]);

    }

    public function actionCrudGenerator(){
        return 'Not implemented yet';
    }
}