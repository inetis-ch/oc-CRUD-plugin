<?php namespace Inetis\Crud;

use System\Classes\PluginBase;

/**
 * Crud Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Frontend CRUD example plugin',
            'description' => 'CRUD auto-generated from existing backend model controller',
            'author'      => 'inetis',
            'icon'        => 'icon-list-alt',
            'homepage'    => 'https://github.com/inetis-ch/oc-CRUD-plugin'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Inetis\Crud\Components\Create'    => 'crudCreate',
            'Inetis\Crud\Components\ListItems' => 'crudList',
            'Inetis\Crud\Components\Update'    => 'crudUpdate',
        ];
    }

    /**
     * Register backend widgets
     *
     * @return array
     */
    public function registerFormWidgets()
    {
        return [
            'Backend\FormWidgets\CodeEditor' => [
                'label' => 'Code editor',
                'code'  => 'codeeditor'
            ],

            'Backend\FormWidgets\RichEditor' => [
                'label' => 'Rich editor',
                'code'  => 'richeditor'
            ],

            'Backend\FormWidgets\MarkdownEditor' => [
                'label' => 'Markdown editor',
                'code'  => 'markdown'
            ],

            'Backend\FormWidgets\FileUpload' => [
                'label' => 'File uploader',
                'code'  => 'fileupload'
            ],

            'Backend\FormWidgets\Relation' => [
                'label' => 'Relationship',
                'code'  => 'relation'
            ],

            'Backend\FormWidgets\DatePicker' => [
                'label' => 'Date picker',
                'code'  => 'datepicker'
            ],

            'Backend\FormWidgets\TimePicker' => [
                'label' => 'Time picker',
                'code'  => 'timepicker'
            ],

            'Backend\FormWidgets\ColorPicker' => [
                'label' => 'Color picker',
                'code'  => 'colorpicker'
            ],

            'Backend\FormWidgets\DataTable' => [
                'label' => 'Data Table',
                'code'  => 'datatable'
            ],

            'Backend\FormWidgets\RecordFinder' => [
                'label' => 'Record Finder',
                'code'  => 'recordfinder'
            ],

            'Backend\FormWidgets\Repeater' => [
                'label' => 'Repeater',
                'code'  => 'repeater'
            ],

            'Backend\FormWidgets\TagList' => [
                'label' => 'Tag List',
                'code'  => 'taglist'
            ]
        ];
    }

}
