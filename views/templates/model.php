<?php

echo '<?php '.PHP_EOL;
?>

namespace <?= $model->model_namespace ?>;

use Core;

/**
* This is the model class for table "<?= $model->table_name ?>"
<?php foreach ($props as $prop) { ?>
* @property <?= $prop->phpType.' '.$prop->name.PHP_EOL ?>
<?php } ?>
 */
class <?= $model->model_name  ?> extends <?= $model->model_base_class."\n" ?>
{

    /**
    * @inheritdoc
    */
    public static function schemaTableName(){
        return '<?= $model->table_name ?>';
    }
    /**
    * @inheritdoc
    */
    public function beforeSave()
    {
    }
    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
<?php foreach ($labels as $name => $label): ?>
            <?="'$name' => '$label',\n"?>
<?php endforeach; ?>
        ];
    }
}