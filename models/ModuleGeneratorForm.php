<?php


namespace core\generator\models;


use Core;
use core\components\Model;
use core\components\View;
use core\helpers\FileHelper;

/**
 * @property mixed|null module_path
 * @property mixed|null module_name
 * @property mixed|null module_namespace
 */
class ModuleGeneratorForm extends Model implements IGenerator
{

    public $rules = [
        [['module_name', 'module_path', 'module_namespace'], 'required'],
        ['module_name', 'mask', 'pattern' => '/^\w+$/', 'message' => 'Only word characters are allowed.'],
        ['module_path', 'mask', 'pattern' => '/^@?\w+[\\-\\/\w]*$/', 'message' => 'Only word characters, dashes, slashes and @ are allowed.'],
        ['module_namespace', 'mask', 'pattern' => '/^[\w\\\\]+$/', 'message' => 'Only word characters and backslashes are allowed.']
    ];

    function generate()
    {
        if (!$this->validate()){
            return 'One of the attributes failed validation';
        }
        $path = FileHelper::normalizePath(Core::getAlias($this->module_path).'/'.strtolower($this->module_name));
        if (@FileHelper::createDirectory($path, 0777)){
            $moduleFileName = $path.DIRECTORY_SEPARATOR.ucfirst($this->module_name).'.php';
            $moduleContent = View::renderPartial('module', ['generator' => $this]);
            if ($moduleContent == null){
                return 'Unable to generate module class';
            }
            if (@file_put_contents($moduleFileName, $moduleContent) === false){
                return 'Unable to save module file. Permission denied.';
            }
            @chmod($moduleFileName, 0777);
            $controllerPath = $path.DIRECTORY_SEPARATOR.'controllers';
            $controllerGenerator = new ControllerGeneratorForm([
                'controller_name' => 'Default',
                'controller_namespace' => $this->module_namespace.'\controllers',
                'controller_path' => $controllerPath,
                'controller_actions' => 'index'
            ]);
            if (($message = $controllerGenerator->generate()) !== true){
                return 'Unable to create module controller: '.$message;
            }
            $viewPath = $path.DIRECTORY_SEPARATOR.'views';
            if (@FileHelper::createDirectory($viewPath, 0777)){
                $viewFileName = $viewPath.DIRECTORY_SEPARATOR.'index.php';
                if (@file_put_contents($viewFileName, '<?php') === false){
                    return 'Unable to save module view file. Permission denied.';
                }
                @chmod($viewFileName, 0777);
                return true;
            }
            return 'Unable to create module view directory. Permission denied';
        }
        return 'Unable to create module directory. Permission denied.';
    }

    public function attributeLabels()
    {
        return [
            'module_name' => 'Module Name',
            'module_path' => 'Module Directory',
            'module_namespace' => 'Module Namespace'
        ];
    }
}