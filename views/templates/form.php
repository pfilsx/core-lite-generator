<?php
echo '<?php '.PHP_EOL;
?>
use core\web\Html;
use core\helpers\Url;
use <?= $generator->getFormClass() ?>;
?>

/**
* @var ActiveForm $form
* @var <?= $generator->model_class ?> $model
*/
<?= "<?php " ?>$form = ActiveForm::begin(['method' => 'post']); ?>

<?php foreach ($generator->getModel()->attributes as $attribute) { ?>
    <?= "<?= " ?>$form->field($model, '<?= $attribute ?>'); ?>
<?php } ?>
<div class="form-group">
    <?= "<?= " ?>Html::submitButton('Submit', ['class' => '<?= $generator->getSubmitClasses() ?>']) ?>
</div>
<?= "<?php " ?>ActiveForm::end(); ?>


