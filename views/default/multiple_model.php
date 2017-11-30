<?php
use core\helpers\Url;
use core\base\App;
?>
<div class="row">
    <?= \core\bootstrap\Breadcrumbs::widget(['items' => [
        'Core-Lite Generator' => Url::toAction('index'),
        'Multiple Model Generator' => null
    ]]); ?>
</div>
<div class="row">
    <h1>Multiple Model generator</h1>
    <p>This generator generates an ActiveModel classes for the specific database tables</p>
</div>
<div class="row">
    <?php if (($message = App::$instance->session->getFlash('message')) !== null) { ?>
        <div class="alert alert-success" role="alert"><?= $message ?></div>
    <?php } elseif (($message = App::$instance->session->getFlash('error_message')) !== null) { ?>
        <div class="alert alert-danger" role="alert"><?= $message ?></div>
    <?php } ?>
</div>
<div class="row">
    <div class="col-md-12">
        <?php $form = \core\bootstrap\ActiveForm::begin([
            'method' => 'post',
            'ajaxValidation' => true,
            'options' => [
                'class' => 'form-horizontal'
            ]
        ]); ?>
        <?= $form->field($model, 'models_namespace')->input('text'); ?>
        <?= $form->field($model, 'models_path')->input('text'); ?>
        <?= $form->field($model, 'models_base_class')->input('text'); ?>
        <?= $form->field($model, 'models_labels')->input('checkbox'); ?>

        <?php foreach ($tables as $table) { ?>
            <div class="form-group">
                <div class="col-md-6 checkbox">
                    <label><input type="checkbox" class="table_checkbox" data-table="<?= $table ?>"><?= $table ?></label>
                </div>
                <div class="col-md-6 hidden_part">
                    <label class="control-label col-md-2">Model Name</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control model_name" value="<?= ucfirst(str_replace('_', '', $table)); ?>" />
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php \core\bootstrap\ActiveForm::end() ?>
    </div>
</div>
