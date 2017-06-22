<?php namespace Inetis\Crud\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use October\Rain\Exception\SystemException;

class ListItems extends ComponentBase
{
    public $items;
    public $field;
    public $createPageUrl;

    private $modelClass;
    private $updatePage;
    private $createPage;

    public function componentDetails()
    {
        return [
            'name'        => 'List items',
            'description' => 'List all items of a model'
        ];
    }

    public function defineProperties()
    {
        return [
            'modelClass' => [
                'title'       => 'Model',
                'description' => 'Full model name (with namespace)',
                'type'        => 'string',
                'required'    => true
            ],
            'field'      => [
                'title'    => 'Field to display',
                'type'     => 'string',
                'required' => true
            ],
            'updatePage' => [
                'title'       => "Page Edit item",
                'description' => "Form for edit an item",
                'type'        => 'dropdown',
                'required'    => true
            ],
            'createPage' => [
                'title'       => "Page New item",
                'description' => "Form for create a new item",
                'type'        => 'dropdown',
                'required'    => true
            ],
        ];
    }

    /**
     * Dropdown for choose edit page
     *
     * @return mixed
     */
    public function getUpdatePageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * Dropdown for choose create page
     *
     * @return mixed
     */
    public function getCreatePageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * Display the list
     */
    public function onRun()
    {
        $this->fillParameters();

        $this->createPageUrl = $this->controller->pageUrl($this->createPage);
        $this->listItems();
    }

    /**
     * AJAX - delete an item
     *
     * @return array
     */
    public function onDelete()
    {
        $this->fillParameters();
        $modelClass = $this->modelClass;

        $model = $modelClass::findOrFail(post('id'));
        $model->delete();

        if (post('list_id')) {
            return [
                '#' . post('list_id') => $this->listItems()
            ];
        }
    }


    /**
     * Trigger exception if a required property is not set
     *
     * @return array Properties indexed by name
     * @throws SystemException
     */
    private function fillParameters()
    {
        $properties = $this->defineProperties();
        foreach ($data = $this->getProperties() as $key => $value) {
            if (!key_exists($key, $properties)) {
                continue;
            }

            if (empty($value) && $properties[$key]['required']) {
                throw new SystemException("Property $key ({$properties[$key]['title']}) can't be empty");
            }

            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Generate list view
     *
     * @return string
     */
    protected function listItems()
    {
        $modelClass = $this->modelClass;

        $this->items = $modelClass::all();
        $this->items->each(function ($item) {
            $item->crudUpdatePage = $this->controller->pageUrl($this->updatePage, ['id' => $item->id]);
        });

        return $this->renderPartial('@default');
    }
}
