<?php
use core\helpers\Url;
?>
<div class="row">
    <?= \core\bootstrap\Breadcrumbs::widget(['items' => [
        'Core-Lite Generator' => null
    ]]); ?>
</div>
<div class="row">
    <div class="page-header">
        <h1>Welcome to Core-Lite code generator</h1>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <div class="caption">
                <h3>Single model generator</h3>
                <p>This generator will help you to generate an ActiveModel for specific database table.</p>
                <p>
                    <a href="<?= Url::toAction('single-model-generator')?>" class="btn btn-primary" role="button">Start >></a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <div class="caption">
                <h3>Multiple models generator</h3>
                <p>This generator will help you to generate an ActiveModel's classes for specific database tables.</p>
                <p>
                    <a href="<?= Url::toAction('multiple-model-generator')?>" class="btn btn-primary" role="button">Start >></a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <div class="caption">
                <h3>CRUD generator</h3>
                <p>This generator generates a controller and views that implement CRUD(Create, Read, Update, Delete) for a specific Model.</p>
                <p>
                    <a href="<?= Url::toAction('crud-generator')?>" class="btn btn-primary" role="button">Start >></a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <div class="caption">
                <h3>Form generator</h3>
                <p>This generator generates a form view for a specific Model.</p>
                <p>
                    <a href="<?= Url::toAction('form-generator')?>" class="btn btn-primary" role="button">Start >></a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <div class="caption">
                <h3>Controller generator</h3>
                <p>This generator helps you to quickly generate a new controller class with one or several controller actions.</p>
                <p>
                    <a href="<?= Url::toAction('controller-generator')?>" class="btn btn-primary" role="button">Start >></a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <div class="caption">
                <h3>Module generator</h3>
                <p>This generator helps you to generate the code template needed by a Core-Lite module.</p>
                <p>
                    <a href="<?= Url::toAction('module-generator')?>" class="btn btn-primary" role="button">Start >></a>
                </p>
            </div>
        </div>
    </div>
</div>
