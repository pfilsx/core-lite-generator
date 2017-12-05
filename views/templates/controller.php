<?php
echo '<?php '.PHP_EOL;
/**
 * @var \core\generator\models\ControllerGeneratorForm $generator
 */
?>

namespace <?= $generator->controller_namespace ?>;

use core\components\Controller;

class <?= $generator->controller_name.'Controller' ?> extends Controller
{
<?php foreach ($generator->getActions() as $action) { ?>
    public function <?= $action ?>()
    {

    }

<?php } ?>
}