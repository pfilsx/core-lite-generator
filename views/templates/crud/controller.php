<?php
echo '<?php '.PHP_EOL;
/**
 * @var \core\generator\models\CrudGeneratorForm $generator
 */
?>
<!--TODO-->
namespace <?= $generator->controller_namespace ?>;

use core\components\Controller;
use <?= $generator->model_class ?>

class <?= $generator->controller_name ?> extends Controller
{
    public function actionIndex()
    {
<!--        $models = new $modelClass(); //TODO-->
        return $this->render('index', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new <?= $generator->model_name ?>();
        if (App::$instance->request->isPost){
            if ($model->load(App::$instance->request->post)) {
                if ($model->save()){
<!--                    $this->redirect('view') //TODO-->
                }
            }
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = <?= $generator->model_name ?>::find(['<?= $generator->model_primary ?>' => $id]);
        if (App::$instance->request->isPost){
            if ($model->load(App::$instance->request->post)) {
                if ($model->save()){
<!--                    $this->redirect('view') //TODO-->
                }
            }
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = <?= $generator->model_name ?>::find(['<?= $generator->model_primary ?>' => $id]);
        $model->delete();
        $this->redirect('');
    }
}