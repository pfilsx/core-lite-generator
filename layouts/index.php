<?php
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
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= \core\helpers\Url::toAction('index'); ?>">Core-Lite Generator</a>
        </div>
    </div>
</header>
<div class="container">
    <?= $this->getViewContent(); ?>
</div>

<?= $this->endBody() ?>

<div class="loader">
    <div class="pulse"></div>
</div>
</body>
</html>
