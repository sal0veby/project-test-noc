<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Queue\Jobs\Job;

class JobList extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'job_lists';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'iso_document_no',
        'job_code_no',
        'create_document',
        'coming_work_date',
        'classes_id',
        'start_work_time',
        'end_work_time',
        'requirement',
        'location_id',
        'description_location',
        'work_type_id',
        'description_work_type',
        'config_hot_work',
        'owners',
        'supervisors',
        'contractors',
        'participants',
        'car_registrations',
        'taskmasters',
    ];

    protected $casts = [
        'owners'            => 'array',
        'supervisors'       => 'array',
        'contractors'       => 'array',
        'participants'      => 'array',
        'car_registrations' => 'array',
        'taskmasters'       => 'array',
    ];

    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'classes_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function work_types()
    {
        return $this->belongsTo(WorkType::class, 'work_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction_job()
    {
        return $this->hasOne(TransactionJob::class, 'job_id', 'id')->orderBy('id', 'DESC');
    }

    public function process_job()
    {
        return $this->hasOne(ProcessJob::class, 'id', 'process_id');
    }

    public function step_job()
    {
        return $this->hasOne(StepJob::class, 'id', 'step_job_id');
    }

    /**
     * @param $value
     */
    public function setStartWorkTimeAttribute($value)
    {
        $splitTimeStamp = explode(" ", $value);
        $this->attributes['start_work_time'] = Carbon::parse("0000-01-01 $splitTimeStamp[1]")->format('Y-m-d H:i:s');
    }

    /**
     * @param $value
     */
    public function setEndWorkTimeAttribute($value)
    {
        $splitTimeStamp = explode(" ", $value);
        $this->attributes['end_work_time'] = Carbon::parse("0000-01-01 $splitTimeStamp[1]")->format('Y-m-d H:i:s');
    }

    public function getProcessJob($job_id)
    {
        $transaction = new TransactionJob();
        $processJob = new ProcessJob();
        $stepJob = new StepJob();

        $result = JobList::query()->select([
            $processJob->getTable() . '.process_id',
            $processJob->getTable() . '.state_id',
            $processJob->getTable() . '.description',
            $processJob->getTable() . '.next_process_id',
            $processJob->getTable() . '.next_state_id',
            $processJob->getTable() . '.next_description',
            $stepJob->getTable() . '.name',
        ])->leftJoin(
            $transaction->getTable(),
            $this->table . '.id',
            '=',
            $transaction->getTable() . '.job_id'
        )->leftJoin($processJob->getTable(), function ($join) {
            $join->on('transaction_jobs.process_id', '=', 'process_jobs.process_id');
            $join->on('transaction_jobs.state_id', '=', 'process_jobs.state_id');
        })->leftJoin(
            $stepJob->getTable(),
            $stepJob->getTable() . '.id',
            '=',
            $processJob->getTable() . '.next_process_id'
        )->where($this->table . '.id', $job_id)->orderByDesc($transaction->getTable() . '.created_at')->first();

        return $result;
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
