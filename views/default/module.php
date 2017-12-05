<?php
use core\helpers\Url;
use core\base\App;
?>
<div class="row">
    <?= \core\bootstrap\Breadcrumbs::widget(['items' => [
        'Core-Lite Generator' => Url::toAction('index'),
        'Module Generator' => null
    ]]); ?>
</div>
<div class="row">
    <h1>Module generator</h1>
    <p>This generator generates a module template.</p>
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
        Not implemented yet.
    </div>
</div>