<?php
/**
 * Created by PhpStorm.
 * User: SALOVEBY JOKE
 * Date: 25-Nov-18
 * Time: 15:21
 */

namespace App\Http\Controllers\Admin\Setup;

use App\Http\Requests\WorkTypeStoreRequest as StoreRequest;
use App\Http\Requests\WorkTypeUpdateRequest as UpdateRequest;
use App\Models\Classes;
use App\Models\Location;

trait WorkTypeCrudSetup
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\WorkType');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/work_type');
        $this->crud->setEntityNameStrings(__('Work type'), __('Work types'));

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->column();

        $this->field();

        // add asterisk for fields that are required in WorkTypeRequest
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
            'label' => __('Class'), // Table column heading
            'type' => "select",
            'name' => 'classes_id', // the column that contains the ID of that connected entity;
            'entity' => 'classes', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => Classes::class, // foreign key model
        ]);

        $this->crud->addColumn([
            'label' => __('Location'), // Table column heading
            'type' => "select",
            'name' => 'location_id', // the column that contains the ID of that connected entity;
            'entity' => 'locations', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => Location::class, // foreign key model
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
            'label' => __("Class"),
            'type' => 'select',
            'name' => 'classes_id', // the db column for the foreign key
            'entity' => 'classes', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => Classes::class // foreign key model
        ]);

        $this->crud->addField([
            'label' => __("Location"),
            'type' => 'select_location',
            'name' => 'location_id', // the db column for the foreign key
            'name_relation' => 'classes_id',
            'entity' => 'locations', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => Location::class, // foreign key model
        ]);

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
