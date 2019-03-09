<?php
/**
 * Created by PhpStorm.
 * User: SALOVEBY JOKE
 * Date: 13-Dec-18
 * Time: 15:27
 */

namespace App\Http\Controllers\Admin\Setup;


use App\Models\Classes;
use App\Models\JobList;
use App\Models\Location;
use App\Models\WorkType;
use Illuminate\Support\Facades\App;

trait ProcessJobList
{
    public function processJobOne()
    {
        $lastDocument = $this->getLastDocument();

        $this->crud->addField([
            'name' => 'iso_document_no',
            'label' => __("Document No"),
            'type' => 'text',
            'grid_options' => 'col-md-4',
            'attributes' => ['readonly' => 'readonly'],
            'default' => $lastDocument
        ]);

        $this->crud->addField([
            'name' => 'job_code_no',
            'label' => __("Job Code No"),
            'type' => 'text',
            'grid_options' => 'col-md-4'
        ]);

        $this->crud->addField([
            'name' => 'create_document',
            'label' => __("Create Document"),
            'type' => 'text',
            'grid_options' => 'col-md-4',
            'attributes' => ['readonly' => 'readonly'],
            'default' => \Carbon\Carbon::now()
        ]);

        $this->crud->addField([
            'name' => 'coming_work_date',
            'label' => __("Coming Work Date"),
            'type' => 'datetime_picker',
            'grid_options' => 'col-md-4',
            // optional:
            'datetime_picker_options' => [
                'format' => 'DD/MM/YYYY',
                'language' => App::getLocale()
            ]
        ]);

        $this->crud->addField([
            'name' => 'start_work_time',
            'label' => __("Start Work Time"),
            'type' => 'datetime_picker',
            'grid_options' => 'col-md-2',
            'datetime_picker_options' => [
                'format' => 'HH:mm',
                'language' => App::getLocale()
            ],
            'icon' => 'glyphicon glyphicon-time',
//            'default' => '00.00'
        ]);

        $this->crud->addField([
            'name' => 'end_work_time',
            'label' => __("End Work Time"),
            'type' => 'datetime_picker',
            'grid_options' => 'col-md-2',
            'datetime_picker_options' => [
                'format' => 'HH:mm',
                'language' => App::getLocale()
            ],
            'icon' => 'glyphicon glyphicon-time',
//            'default' => '00.00'
        ]);

        $this->crud->addField([
            'label' => __("Work Type"),
            'type' => 'select',
            'name' => 'work_type_id',
            'entity' => 'work_types',
            'attribute' => 'name',
            'model' => WorkType::class,
            'grid_options' => 'col-md-4',
            'description' => true
        ]);

        $this->crud->addField([
            'label' => __("Class"),
            'type' => 'select',
            'name' => 'classes_id',
            'entity' => 'classes',
            'attribute' => 'name',
            'model' => Classes::class,
            'grid_options' => 'col-md-4',
        ]);

        $this->crud->addField([
            'label' => __("Location"),
            'type' => 'select_location',
            'name' => 'location_id',
            'name_relation' => 'classes_id',
            'entity' => 'locations',
            'attribute' => 'name',
            'model' => Location::class,
            'grid_options' => 'col-md-4',
            'description' => true
        ]);

        $this->crud->addField([
            'name' => 'requirement',
            'label' => __("Requirement"),
            'type' => 'textarea',
            'grid_options' => 'col-md-12',
            'attributes' => ['rows' => 4],
        ]);

        $this->crud->addField([
            'name' => 'owners',
            'type' => 'table_custom',
            'entity_singular' => 'option',
            'columns' => [
                'name' => __('Name'),
                'tel' => __('Tel'),
                'company_name' => __('Company name')
            ],
            'max' => 100,
            'min' => 1,
            'tab' => __('Owners'),
        ]);

        $this->crud->addField([
            'name' => 'supervisors',
            'type' => 'table_custom',
            'entity_singular' => 'option',
            'columns' => [
                'name' => __('Name'),
                'tel' => __('Tel'),
                'company_name' => __('Company name')
            ],
            'max' => 100,
            'min' => 1,
            'tab' => __('Supervisors'),
        ]);

        $this->crud->addField([
            'name' => 'contractors',
            'type' => 'table_custom',
            'entity_singular' => 'option',
            'columns' => [
                'name' => __('Name'),
                'tel' => __('Tel'),
                'company_name' => __('Company name')
            ],
            'max' => 100,
            'min' => 1,
            'tab' => __('Contractors'),
        ]);

        $this->crud->addField([
            'name' => 'taskmasters',
            'type' => 'table_custom',
            'entity_singular' => 'option',
            'columns' => [
                'name' => __('Name'),
                'tel' => __('Tel'),
                'company_name' => __('Company name')
            ],
            'max' => 100,
            'min' => 1,
            'tab' => __('Taskmasters'),
        ]);

        $this->crud->addField([
            'name' => 'participants',
            'type' => 'table_custom',
            'entity_singular' => 'option',
            'columns' => [
                'name' => __('Name'),
                'tel' => __('Tel'),
                'company_name' => __('Company name')
            ],
            'max' => 100,
            'min' => 1,
            'tab' => __('Participants'),
        ]);

        $this->crud->addField([
            'name' => 'car_registrations',
            'type' => 'table_custom',
            'entity_singular' => 'option',
            'columns' => [
                'license_plate' => __('License plate')
            ],
            'max' => 100,
            'min' => 1,
            'tab' => __('Imported car registration'),
        ]);

        $this->crud->addField([
            'name' => 'config_hot_work',
            'label' => __('Hot work'),
            'type' => 'radio_custom',
            'options' => [
                0 => __("Don't have"),
                1 => __('Have')
            ],
            'grid_options' => 'col-md-3',
            'inline' => true,
        ]);
    }

    public function processJobTwo()
    {
        $this->crud->addField([
            'name' => 'status',
            'label' => '2.1 ' . __('Authorized') . ': ' . __('True Internet Data Center') . ' (' . __('Building Management') . ')',
            'type' => 'radio',
            'options' => [
                0 => __("Don't Approve"),
                1 => __("Approve")
            ],
            'grid_options' => 'col-md-6',
            'inline' => true,
        ]);
    }

    protected function getLastDocument()
    {
        $last_document = JobList::orderBy('id', 'DESC')->first();

        $document_no = '';
        if (!empty($last_document)) {
            $document_no = str_pad(
                array_get($last_document, 'iso_document_no') + 1,
                strlen(array_get($last_document, 'iso_document_no')),
                "0",
                STR_PAD_LEFT);
        } else {
            $document_no = '0000001';
        }

        return $document_no;
    }
}
