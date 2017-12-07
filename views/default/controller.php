<?php
use core\helpers\Url;
use core\base\App;
?>
<div class="row">
    <?= \core\bootstrap\Breadcrumbs::widget(['items' => [
        'Core-Lite Generator' => Url::toAction('index'),
        'Controller Generator' => null
    ]]); ?>
</div>
<div class="row">
    <h1>Controller generator</h1>
    <p>This generator helps you to quickly generate a new controller class with one or several controller actions</p>
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
        <?= $form->field($model, 'controller_name')->input('text', [
            'required' => true
        ]); ?>

        <?= $form->field($model, 'controller_namespace')->input('text', [
            'required' => true
        ]); ?>

        <?= $form->field($model, 'controller_path')->input('text', [
            'required' => true
        ]); ?>
        <?= $form->field($model, 'controller_actions')->input('text'); ?>

        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Generate">
        </div>
        <?php \core\bootstrap\ActiveForm::end(); ?>
    </div>
</div>