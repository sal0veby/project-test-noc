<?php
/**
 * Created by PhpStorm.
 * User: SALOVEBY JOKE
 * Date: 12-Nov-18
 * Time: 14:59
 */

namespace App\Http\Controllers\Admin\Setup;


trait PermissionCrudSetup
{
    public function setup()
    {
//        $role_model = config('permission.models.role');
        $permission_model = config('permission.models.permission');

        $this->crud->setModel($permission_model);
        $this->crud->setEntityNameStrings(__('Permission'), __('Permissions'));
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/permission');

        $this->column();

        $this->field();

//        if (!config('backpack.permissionmanager.allow_permission_create')) {
//            $this->crud->denyAccess('create');
//        }
//        if (!config('backpack.permissionmanager.allow_permission_update')) {
//            $this->crud->denyAccess('update');
//        }
//        if (!config('backpack.permissionmanager.allow_permission_delete')) {
//            $this->crud->denyAccess('delete');
//        }
    }

    protected function column()
    {
        $this->crud->addColumn([
            'name' => 'name',
            'label' => __('Permission name'),
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'label' => __('Status'),
            'name' => 'active',
            'type' => 'boolean',
            'options' => ['1' => '<p class="text-green">' . __('Active') . '</p > ', '0' => '<label class="text-red">' . __('Inactive') . '</label >'],
            'orderable' => false,
            'searchLogic' => false
        ]);

        $this->crud->denyAccess('delete');
    }

    protected function field()
    {
        $this->crud->addField([
            'name' => 'name',
            'label' => __('Permission name'),
            'type' => 'text',
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
