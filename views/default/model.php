<?php
use core\helpers\Url;
use core\base\App;
?>
<div class="row">
    <?= \core\bootstrap\Breadcrumbs::widget(['items' => [
        'Core-Lite Generator' => Url::toAction('index'),
        'Single Model Generator' => null
    ]]); ?>
</div>
<div class="row">
    <h1>Model generator</h1>
    <p>This generator generates an ActiveModel class for the specific database table</p>
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
        <?php $form = \core\widgets\activeform\ActiveForm::begin([
            'method' => 'post',
            'ajaxValidation' => true,
            'options' => [
                'class' => 'form-horizontal'
            ]
        ]); ?>
        <div class="form-group">
            <label for="table_name" class="control-label">Select table</label>
            <select id="table_name" class="form-control">
                <option value="" selected></option>
                <?php foreach ($tables as $table) { ?>
                    <option value="<?=$table?>"><?=$table?></option>
                <?php } ?>
            </select>
        </div>
        <div class="info-block">
            <div class="form-group">
                <?= $form->field($model, 'table_name')->input('text', [
                    'required' => true,
                    'disabled' => true,
                    'readonly' => true,
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'model_name')->input('text', [
                    'required' => true,
                    'disabled' => true,
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'model_namespace')->input('text', [
                    'required' => true,
                    'disabled' => true,
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'model_base_class')->input('text', [
                    'required' => true,
                    'disabled' => true,
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'models_path')->input('text', [
                    'required' => true,
                    'disabled' => true,
                    'class' => 'form-control'
                ]); ?>
            </div>
            <div class="form-group checkbox">
                <?= $form->field($model, 'model_labels')->input('checkbox', [
                    'disabled' => true,
                ]); ?>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Generate" disabled>
            </div>
        </div>
        <?php \core\widgets\activeform\ActiveForm::end(); ?>
    </div>
</div>
