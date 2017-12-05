<?php

use core\helpers\Url;

\core\generator\CoreGenAssets::register();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Core-Lite Generator</title>
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <?= $this->head() ?>
</head>
<body class="admin-body">
<?= $this->beginBody() ?>
<header class="navbar navbar-inverse navbar-static-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">Core-Lite Generator</a>
    </div>
</header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">

                <?= \core\bootstrap\Menu::widget([
                        'orientation' => 'vertical',
                        'items' => [
                            ['label' => 'Single Model Generator', 'url' => Url::toAction('single-model-generator')],
                            ['label' => 'Multiple Model Generator', 'url' => Url::toAction('multiple-model-generator')],
                            ['label' => 'CRUD Generator', 'url' => Url::toAction('crud-generator')],
                            ['label' => 'Form Generator', 'url' => Url::toAction('form-generator')],
                            ['label' => 'Controller Generator', 'url' => Url::toAction('controller-generator')],
                            ['label' => 'Module Generator', 'url' => Url::toAction('module-generator')]
                        ]
                ]); ?>
            </div>
            <div class="col-md-8">
                <?= $this->getViewContent(); ?>
            </div>
        </div>
    </div>

<?= $this->endBody() ?>

<div class="loader">
    <div class="pulse"></div>
</div>
</body>
</html>
