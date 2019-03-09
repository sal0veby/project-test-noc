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
use App\Models\JobList;
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
        $result = [];
        $job_list = $this->crud->getEntries();
        if (!empty($job_list)) {

            $jobList = new JobList();

            $id = array_get($job_list[0], 'id');
            $result_process = $jobList->getProcessJob($id);

            $process_name = array_get($result_process, 'name', '');
            $state_name = array_get($result_process, 'description', '');

            if (!empty($process_name)) {
                $process_decode = json_decode($process_name);
                $result['process_name'] = $process_decode->{app()->getLocale()};
            }

            if (!empty($state_name)) {
                $next_state_id = array_get($result_process, 'next_state_id');
                if ($next_state_id == 1) {
                    $result['state_name'] = __('Waiting for save');
                } else {
                    $result['state_name'] = __('Waiting for approve');
                }
            }
        }

        $this->crud->addColumn([
            'name'        => 'row_number',
            'label'       => __('#'),
            'type'        => 'row_number',
            'orderable'   => false,
            'searchLogic' => false,
        ])->makeFirstColumn();

        $this->crud->addColumn([
            'name'     => 'iso_document_no',
            'label'    => __('Document No'),
            'type'     => 'text',
            'priority' => 1,
        ]);

        $this->crud->addColumn([
            'name'     => 'job_code_no',
            'label'    => __('Job Code No'),
            'type'     => 'text',
            'priority' => 2,
        ]);

        $this->crud->addColumn([
            'name'     => 'process',
            'label'    => __('Process'),
            'type'     => 'text',
            'suffix'   => array_get($result, 'process_name', ''),
            'priority' => 1,
        ]);

        $this->crud->addColumn([
            'name'     => 'state',
            'label'    => __('State'),
            'type'     => 'text',
            'suffix'   => array_get($result, 'state_name', ''),
            'priority' => 1,
        ]);

//        $this->crud->addColumn([
//            'name'     => 'process',
//            'label'    => __('Process'),
//            'type'     => 'text',
//            'suffix'   => array_get($result, 'process_name', ''),
//            'priority' => 2,
//        ]);

        $this->crud->addColumn([
            'label'     => __('Created at'),
            'name'      => 'created_at',
            'type'      => 'datetime',
            'orderable' => false,
            'priority'  => 3,
        ]);

        $this->crud->addColumn([
            'label'     => __('Updated at'),
            'name'      => 'updated_at',
            'type'      => 'datetime',
            'orderable' => false,
            'priority'  => 3,
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
        } else {
            if (in_array($process_id, [3, 4])) {
                $this->processJobTwo();
            }
        }
    }

}
