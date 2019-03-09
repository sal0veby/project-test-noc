<?php
/**
 * Created by PhpStorm.
 * User: SALOVEBY JOKE
 * Date: 12-Nov-18
 * Time: 13:37
 */

namespace App\Http\Controllers\Admin\Setup;


trait UserCrudSetup
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\User');
        $this->crud->setEntityNameStrings(__('User'), __('Users'));
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');

        // Columns.
        $this->column();

        // Fields
        $this->field();
    }

    protected function column()
    {
        $this->crud->setColumns([
            [
                'name' => 'name',
                'label' => __('Name'),
                'type' => 'text',
                'priority' => 1,
            ],
            [
                'name' => 'email',
                'label' => __('Email'),
                'type' => 'email',
                'priority' => 1,
            ],
            [ // n-n relationship (with pivot table)
                'label' => __('Role'), // Table column heading
                'type' => 'select_multiple',
                'name' => 'roles', // the method that defines the relationship in your Model
                'entity' => 'roles', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => config('permission.models.role'), // foreign key model
                'priority' => 2,
            ],
            [
                'label' => __('Status'),
                'name' => 'active',
                'type' => 'boolean',
                'options' => ['1' => '<p class="text-green">' . __('Active') . '</p > ', '0' => '<label class="text-red">' . __('Inactive') . '</label >'],
                'orderable' => false,
                'searchLogic' => false
            ],
            [
                'label' => __('Created at'),
                'name' => 'created_at',
                'type' => 'datetime',
                'orderable' => false,
                'priority' => 3,
            ],
            [
                'label' => __('Updated at'),
                'name' => 'updated_at',
                'type' => 'datetime',
                'orderable' => false,
                'priority' => 3,
            ],
        ]);
    }

    protected function field()
    {
        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => __('Name'),
                'type' => 'text',
            ],
            [
                'name' => 'email',
                'label' => __('Email'),
                'type' => 'email',
            ],
            [
                'name' => 'password',
                'label' => __('Password'),
                'type' => 'password',
            ],
            [
                'name' => 'password_confirmation',
                'label' => __('Password Confirmation'),
                'type' => 'password',
            ],
            [
                // two interconnected entities
                'label' => __('User Role Permissions'),
                'field_unique_name' => 'user_role_permission',
                'type' => 'checklist_dependency',
                'name' => 'roles_and_permissions', // the methods that defines the relationship in your Model
                'subfields' => [
                    'primary' => [
                        'label' => __('Roles'),
                        'name' => 'roles', // the method that defines the relationship in your Model
                        'entity' => 'roles', // the method that defines the relationship in your Model
                        'entity_secondary' => 'permissions', // the method that defines the relationship in your Model
                        'attribute' => 'name', // foreign key attribute that is shown to user
                        'model' => config('permission.models.role'), // foreign key model
                        'pivot' => true, // on create&update, do you need to add/delete pivot table entries?]
                        'number_columns' => 3, //can be 1,2,3,4,6
                    ],
                    'secondary' => [
                        'label' => __('Permission'),
                        'name' => 'permissions', // the method that defines the relationship in your Model
                        'entity' => 'permissions', // the method that defines the relationship in your Model
                        'entity_primary' => 'roles', // the method that defines the relationship in your Model
                        'attribute' => 'name', // foreign key attribute that is shown to user
                        'model' => config('permission.models.permission'), // foreign key model
                        'pivot' => true, // on create&update, do you need to add/delete pivot table entries?]
                        'number_columns' => 3, //can be 1,2,3,4,6
                    ],
                ],
            ],
            [
                'name' => 'active',
                'label' => __('Status'),
                'type' => 'boolean',
                'options' => ["1" => __('Active'), "0" => __('Inactive')],
                'allows_null' => false,
            ],
        ]);
    }
}
