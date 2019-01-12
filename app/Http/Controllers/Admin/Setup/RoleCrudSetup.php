<?php
/**
 * Created by PhpStorm.
 * User: SALOVEBY JOKE
 * Date: 19-Nov-18
 * Time: 16:00
 */

namespace App\Http\Controllers\Admin\Setup;


use App\Models\StepHotWork;
use App\Models\StepJob;

trait RoleCrudSetup
{
    public function setup()
    {
        $role_model = config('permission.models.role');
        $permission_model = config('permission.models.permission');

        $this->crud->setModel($role_model);
        $this->crud->setEntityNameStrings(trans('backpack::permissionmanager.role'), trans('backpack::permissionmanager.roles'));
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/role');

        $this->column($permission_model);

        $this->field($permission_model);


        if (config('backpack.permissionmanager.allow_role_create') == false) {
            $this->crud->denyAccess('create');
        }
        if (config('backpack.permissionmanager.allow_role_update') == false) {
            $this->crud->denyAccess('update');
        }
        if (config('backpack.permissionmanager.allow_role_delete') == false) {
            $this->crud->denyAccess('delete');
        }
    }

    protected function column($permission_model)
    {
        $this->crud->setColumns([
            [
                'name' => 'name',
                'label' => __('Name'),
                'type' => 'text',
                'priority' => 1
            ],
        ]);

        $this->crud->addColumn([
            'label' => __('Step Jobs'),
            'type' => 'select_multiple',
            'name' => 'step_jobs',
            'entity' => 'step_jobs',
            'attribute' => 'name',
            'model' => StepJob::class,
            'pivot' => true,
            'priority' => 3,
        ]);

        $this->crud->addColumn([
            'label' => __('Step Hot Woks'),
            'type' => 'select_multiple',
            'name' => 'step_hot_works',
            'entity' => 'step_hot_works',
            'attribute' => 'name',
            'model' => StepHotWork::class,
            'pivot' => true,
            'priority' => 3,
        ]);

        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'label' => __('Permissions'),
            'type' => 'select_multiple',
            'name' => 'permissions', // the method that defines the relationship in your Model
            'entity' => 'permissions', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => $permission_model, // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'priority' => 3,
        ]);

        $this->crud->addColumn([
            'label' => __('Created at'),
            'name' => 'created_at',
            'type' => 'datetime',
            'orderable' => false,
            'priority' => 2,
        ]);

        $this->crud->addColumn([
            'label' => __('Updated at'),
            'name' => 'updated_at',
            'type' => 'datetime',
            'orderable' => false,
            'priority' => 2,
        ]);
    }

    protected function field($permission_model)
    {
        $this->crud->addField([
            'name' => 'name',
            'label' => __('Name'),
            'type' => 'text',
        ]);
        $this->crud->addField([
            'label' => __('Step Jobs'),
            'type' => 'custom_checklist',
            'name' => 'step_jobs',
            'entity' => 'step_jobs',
            'attribute' => 'name',
            'model' => StepJob::class,
            'pivot' => true,
        ]);
        $this->crud->addField([
            'label' => __('Step Hot Woks'),
            'type' => 'custom_checklist',
            'name' => 'step_hot_works',
            'entity' => 'step_hot_works',
            'attribute' => 'name',
            'model' => StepHotWork::class,
            'pivot' => true,
        ]);
        $this->crud->addField([
            'label' => __('Permissions'),
            'type' => 'checklist',
            'name' => 'permissions',
            'entity' => 'permissions',
            'attribute' => 'name',
            'model' => $permission_model,
            'pivot' => true,
        ]);
    }
}
