<?php namespace Inetis\Crud\Components;

use Backend\Behaviors\FormController;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Flash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use October\Rain\Exception\SystemException;
use Redirect;

class Update extends ComponentBase
{
    public $form;

    private $modelClass;
    private $controllerClass;
    private $itemId;
    private $formConfigFile;
    private $formControllerContext;
    private $successPage;

    public function componentDetails()
    {
        return [
            'name'        => 'Update existing item',
            'description' => 'Display form for update an existing item'
        ];
    }

    public function defineProperties()
    {
        return [
            'modelClass'            => [
                'title'       => 'Model',
                'description' => 'Full model name (with namespace)',
                'type'        => 'string',
                'required'    => true,
            ],
            'controllerClass'       => [
                'title'       => 'Controller',
                'description' => 'Full controller name (with namespace)',
                'type'        => 'string',
                'required'    => true,
            ],
            'formControllerContext' => [
                'title'       => 'Form context',
                'description' => '',
                'type'        => 'string',
                'default'     => 'frontend',
                'required'    => true,
            ],
            'itemId'                => [
                'title'    => 'ID',
                'type'     => 'string',
                'default'  => '{{ :id }}',
                'required' => true,
            ],
            'formConfigFile'        => [
                'title'       => 'Form config',
                'description' => 'Path to model fields config (by default use the one defined in config_form.yaml) - ex: $/dev/plugin/models/user/fields.yaml',
                'type'        => 'string',
                'required'    => false,
            ],
            'successPage'           => [
                'title'       => 'Success page',
                'description' => 'Page where redirect user when item was successfully created',
                'type'        => 'dropdown',
                'required'    => false
            ],
        ];
    }

    /**
     * Dropdown for choose edit page
     *
     * @return mixed
     */
    public function getSuccessPageOptions()
    {
        return ['' => 'Nothing'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function onRun()
    {
        $this->fillParameters();
        $this->validateModel();

        $formController = new FormController(new $this->controllerClass);

        if (!empty($this->formConfigFile)) {
            $formController->setConfig(array_merge(
                (array)$formController->getConfig(),
                ['form' => $this->formConfigFile]
            ));
        }

        $formController->update($this->itemId, $this->formControllerContext);

        $this->form = $formController;
    }

    /**
     * AJAX - Model edit
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function onUpdate()
    {
        $this->fillParameters();
        $modelClass = $this->modelClass;
        $arrayName = class_basename($modelClass);

        $model = $modelClass::findOrFail($this->itemId);

        foreach (post($arrayName) as $property => $value) {
            $model->{$property} = $value;
        }
        $model->save();

        Flash::success('Item correctly edited');

        if (!$this->successPage) {
            return;
        }

        return Redirect::to($this->controller->pageUrl($this->successPage));
    }

    /**
     * Trigger exception if a required property is not set
     *
     * @return array Properties indexed by name
     * @throws SystemException
     */
    private function fillParameters()
    {
        foreach ($data = $this->getProperties() as $key => $value) {
            if (empty($value) && $this->defineProperties()[$key]['required']) {
                throw new SystemException('Property  ' . $key . ' is can\'t be empty');
            }

            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Trigger exception if model class not exist or if item not exist
     *
     * @param string $modelName
     * @param string $id
     *
     * @throws SystemException|ModelNotFoundException
     */
    private function validateModel($modelName = null, $id = null)
    {
        $modelName = $modelName ?: $this->modelClass;
        $id = $id ?: $this->itemId;

        if (!class_exists($modelName)) {
            throw new SystemException('Model class  ' . $modelName . ' not exist');
        }

        $modelName::findOrFail($id);
    }
}
