<?php
/**
 * Created by PhpStorm.
 * User: SALOVEBY JOKE
 * Date: 24-Nov-18
 * Time: 17:01
 */

namespace App\Http\Controllers\Admin\Setup;

use App\Http\Requests\ClassesStoreRequest as StoreRequest;
use App\Http\Requests\ClassesUpdateRequest as UpdateRequest;

trait ClassesCrudSetup
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Classes');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/class');
        $this->crud->setEntityNameStrings(__('class'), __('classes'));

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->column();

        $this->field();

        // add asterisk for fields that are required in ClassesRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    protected function column()
    {
        $this->crud->addColumn([
            'name' => 'row_number',
            'label' => __('#'),
            'type' => 'row_number',
            'orderable' => false,
            'searchLogic' => false
        ])->makeFirstColumn();

        $this->crud->addColumn([
            'name' => 'name',
            'label' => __('Name'),
            'type' => 'text',
            'priority' => 1
        ]);

        $this->crud->addColumn([
            'label' => __('Status'),
            'name' => 'active',
            'type' => 'boolean',
            'options' => ['1' => '<p class="text-green">' . __('Active') . '</p > ', '0' => '<label class="text-red">' . __('Inactive') . '</label >'],
            'orderable' => false,
            'searchLogic' => false
        ]);

        $this->crud->addColumn([
            'label' => __('Created at'),
            'name' => 'created_at',
            'type' => 'datetime',
            'orderable' => false,
            'priority' => 3,
        ]);

        $this->crud->addColumn([
            'label' => __('Updated at'),
            'name' => 'updated_at',
            'type' => 'datetime',
            'orderable' => false,
            'priority' => 3,
        ]);
    }

    protected function field()
    {
        $this->crud->addField([
            'name' => 'name',
            'label' => __("Name"),
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'active',
            'label' => __('Status'),
            'type' => 'boolean',
            'options' => ["1" => __('Active'), "0" => __('Inactive')],
            'allows_null' => false,
        ]);
    }
}
