<?php
echo '<?php'.PHP_EOL
/**
 * @var \core\generator\models\ModuleGeneratorForm $generator
 */
?>

namespace <?= $generator->module_namespace ?>;

use core\components\Module;

class <?= $generator->module_name ?> extends Module
{
    public function initializeModule($options)
    {
    }
}