<?php
use core\helpers\Url;
?>

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
        <div class="caption">
            <h3>CRUD generator</h3>
            <p>This generator generates a controller and views that implement CRUD(Create, Read, Update, Delete) for a specific Model.</p>
            <p>
                <a href="<?= Url::toAction('multiple-model-generator')?>" class="btn btn-primary" role="button">Start >></a>
            </p>
        </div>
    </div>
</div>
