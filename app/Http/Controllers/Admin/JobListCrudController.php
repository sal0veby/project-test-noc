<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Setup\JobListCrudSetup;
use App\Models\ProcessJob;
use App\Models\TransactionJob;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\JobListStoreRequest as StoreRequest;
use App\Http\Requests\JobListUpdateRequest as UpdateRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class JobListCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class JobListCrudController extends CrudController
{
    use JobListCrudSetup;

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry

        $this->createTransactionJob(1, 1);

        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        $process = TransactionJob::where('job_id', array_get($this->crud->entry, 'id'))
            ->orderBy('process_id', 'DESC')->first();
        $process_id = array_get($process, 'process_id') + 1;

        $this->createTransactionJob($process_id, false);

        return $redirect_location;
    }

    protected function createTransactionJob($process_id, $state_id)
    {
        TransactionJob::create([
            'job_id'     => array_get($this->crud->entry, 'id'),
            'process_id' => $process_id,
            'state_id'   => $state_id,
            'name_user'  => isset(Auth::user()->name) ? Auth::user()->name : '',
            'name_tel'   => isset(Auth::user()->tel) ? Auth::user()->tel : '',
        ]);
    }
}
