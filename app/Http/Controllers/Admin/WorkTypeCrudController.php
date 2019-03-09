<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Setup\WorkTypeCrudSetup;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\WorkTypeStoreRequest as StoreRequest;
use App\Http\Requests\WorkTypeUpdateRequest as UpdateRequest;

/**
 * Class WorkTypeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class WorkTypeCrudController extends CrudController
{
    use WorkTypeCrudSetup;

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
