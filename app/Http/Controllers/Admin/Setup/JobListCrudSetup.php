<?php
/**
 * Created by PhpStorm.
 * User: SALOVEBY JOKE
 * Date: 26-Nov-18
 * Time: 14:24
 */

namespace App\Http\Controllers\Admin\Setup;

use App\Http\Requests\JobListStoreRequest as StoreRequest;
use App\Http\Requests\JobListUpdateRequest as UpdateRequest;
use App\Models\TransactionJob;


trait JobListCrudSetup
{
    use ProcessJobList;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\JobList');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/job');
        $this->crud->setEntityNameStrings(__('Job List'), __('Job Lists'));

        /*
         |--------------------------------------------------------------------------
         | CrudPanel Configuration
         |--------------------------------------------------------------------------
         */

        // add asterisk for fields that are required in JobListRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        $this->crud->setCreateView('vendor.backpack.crud.create_job_custom');
        $this->crud->setUpdateView('vendor.backpack.crud.edit_job_custom');

        $this->column();

        $this->field();;
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
            'name' => 'iso_document_no',
            'label' => __('ISO Document No'),
            'type' => 'text',
            'priority' => 1
        ]);

        $this->crud->addColumn([
            'name' => 'job_code_no',
            'label' => __('Job Code No'),
            'type' => 'model_function',
            'function_name' => 'getProcessJob'
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
        $id = $this->crud->getCurrentEntryId();
        $process_id = '';

        if ($id) {
            $process = TransactionJob::where('job_id', $id)->orderBy('process_id', 'DESC')->first();
            $process_id = array_get($process, 'process_id') + 1;
        }


        if ($this->crud->actionIs('create') || $process_id == 2) {
            $this->processJobOne();
        } else if (in_array($process_id, [3, 4])) {
//            dd($process_id);
            $this->processJobTwo();
        }
    }

}
