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
            'label' => __("ISO Document No"),
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
            'label' => __("Class"),
            'type' => 'select',
            'name' => 'classes_id', // the db column for the foreign key
            'entity' => 'classes', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => Classes::class, // foreign key model
            'grid_options' => 'col-md-4',
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
            'label' => __("Location"),
            'type' => 'select_location',
            'name' => 'location_id', // the db column for the foreign key
            'name_relation' => 'classes_id',
            'entity' => 'locations', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => Location::class, // foreign key model
            'grid_options' => 'col-md-4',
            'description' => true
        ]);

        $this->crud->addField([
            'name' => 'description_location',
            'label' => __("More details"),
            'type' => 'description_select',
            'grid_options' => 'col-md-8',
            'select_name' => 'location_id'
        ]);

        $this->crud->addField([
            'label' => __("Work Type"),
            'type' => 'select_work_type',
            'name' => 'work_type_id', // the db column for the foreign key
            'name_relation' => 'location_id',
            'entity' => 'work_types', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => WorkType::class, // foreign key model
            'grid_options' => 'col-md-4',
            'description' => true
        ]);

        $this->crud->addField([
            'name' => 'description_work_type',
            'label' => __("More details"),
            'type' => 'description_select',
            'grid_options' => 'col-md-8',
            'select_name' => 'work_type_id'
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
            'entity_singular' => 'option', // used on the "Add X" button
            'columns' => [
                'name' => __('Name'),
                'tel' => __('Tel'),
                'company_name' => __('Company name')
            ],
            'max' => 100, // maximum rows allowed in the table
            'min' => 1, // minimum rows allowed in the table
            'tab' => __('Owners'),
        ]);

        $this->crud->addField([
            'name' => 'supervisors',
            'type' => 'table_custom',
            'entity_singular' => 'option', // used on the "Add X" button
            'columns' => [
                'name' => __('Name'),
                'tel' => __('Tel'),
                'company_name' => __('Company name')
            ],
            'max' => 100, // maximum rows allowed in the table
            'min' => 1, // minimum rows allowed in the table
            'tab' => __('Supervisors'),
        ]);

        $this->crud->addField([
            'name' => 'contractors',
            'type' => 'table_custom',
            'entity_singular' => 'option', // used on the "Add X" button
            'columns' => [
                'name' => __('Name'),
                'tel' => __('Tel'),
                'company_name' => __('Company name')
            ],
            'max' => 100, // maximum rows allowed in the table
            'min' => 1, // minimum rows allowed in the table
            'tab' => __('Contractors'),
        ]);

        $this->crud->addField([
            'name' => 'taskmasters',
            'type' => 'table_custom',
            'entity_singular' => 'option', // used on the "Add X" button
            'columns' => [
                'name' => __('Name'),
                'tel' => __('Tel'),
                'company_name' => __('Company name')
            ],
            'max' => 100, // maximum rows allowed in the table
            'min' => 1, // minimum rows allowed in the table
            'tab' => __('Taskmasters'),
        ]);

        $this->crud->addField([
            'name' => 'participants',
            'type' => 'table_custom',
            'entity_singular' => 'option', // used on the "Add X" button
            'columns' => [
                'name' => __('Name'),
                'tel' => __('Tel'),
                'company_name' => __('Company name')
            ],
            'max' => 100, // maximum rows allowed in the table
            'min' => 1, // minimum rows allowed in the table
            'tab' => __('Participants'),
        ]);

        $this->crud->addField([
            'name' => 'car_registrations',
            'type' => 'table_custom',
            'entity_singular' => 'option', // used on the "Add X" button
            'columns' => [
                'license_plate' => __('License plate')
            ],
            'max' => 100, // maximum rows allowed in the table
            'min' => 1, // minimum rows allowed in the table
            'tab' => __('Imported car registration'),
        ]);

        $this->crud->addField([
            'name' => 'config_hot_work',
            'label' => __('Hot work'),
            'type' => 'radio_custom',
            'options' => [ // the key will be stored in the db, the value will be shown as label;
                0 => __("Don't have"),
                1 => __('Have')
            ],
            'grid_options' => 'col-md-3', // col-md-1 to col-md-11
            'inline' => true,
        ]);
    }

    public function processJobTwo()
    {
        $this->crud->addField([
            'name' => 'status', // the name of the db column
            'label' => '2.1 ' . __('Authorized') . ': ' . __('True Internet Data Center') . ' (' . __('Building Management') . ')',
            'type' => 'radio',
            'options' => [ // the key will be stored in the db, the value will be shown as label;
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
