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
        'owners' => 'array',
        'supervisors' => 'array',
        'contractors' => 'array',
        'participants' => 'array',
        'car_registrations' => 'array',
        'taskmasters' => 'array',
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

    public function getProcessJob()
    {
        $job_id = $this->id;

        $transaction = new TransactionJob();
        $processJob = new ProcessJob();
        $stepJob = new StepJob();

        $a = JobList::query()->select('')
            ->join($transaction->getTable(), '', '', $transaction->getTable() . '.job_id')
            ->join($processJob->getTable(), '', '', '')
            ->join($stepJob->getTable(), '', '', '')
            ->where('id', $job_id)
            ->first();


        $process_job = JobList::with(['transaction_job'])
            ->whereHas('process_job', function ($query) use ($job_id) {
                $query->where('id', $job_id);
            })
            ->where('id', $job_id)
            ->first();

        dd($process_job);
//        $transaction = TransactionJob::where('job_id', $this->id)->orderBy('id', 'DESC')->first();
//        $process_job = ProcessJob::where('id' , array_get($transaction , 'process_id'))->first();
//        dd($transaction_id);

//        $process = JobList::query()->with(['transaction_job' , ''])->get();

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
