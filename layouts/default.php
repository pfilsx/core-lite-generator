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
            <div class="col-md-4">
                <div class="list-group">
                    <a href="<?= Url::toAction('single-model-generator'); ?>" class="list-group-item">
                        Single Model Generator
                    </a>
                    <a href="<?= Url::toAction('multiple-model-generator'); ?>" class="list-group-item">
                        Multiple Model Generator
                    </a>
                    <a href="<?= Url::toAction('crud-generator'); ?>" class="list-group-item">
                        CRUD Generator
                    </a>
                    <a href="<?= Url::toAction('form-generator'); ?>" class="list-group-item">
                        Form Generator
                    </a>
                    <a href="<?= Url::toAction('controller-generator'); ?>" class="list-group-item">
                        Controller Generator
                    </a>
                    <a href="<?= Url::toAction('module-generator'); ?>" class="list-group-item">
                        Module Generator
                    </a>
                </div>
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
