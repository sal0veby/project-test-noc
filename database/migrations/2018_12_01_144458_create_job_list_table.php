<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iso_document_no')->index();
            $table->string('job_code_no')->index();
            $table->dateTime('create_document');
            $table->dateTime('coming_work_date');
            $table->integer('class_id');
            $table->time('start_work_time');
            $table->time('end_work_time');
            $table->text('requirement');
            $table->integer('location_id');
            $table->text('description_location')->nullable();
            $table->integer('work_type_id');
            $table->text('description_work_type')->nullable();
            $table->boolean('config_hot_work')->default(0);
            $table->json('owners')->nullable();
            $table->json('supervisors')->nullable();
            $table->json('contractors')->nullable();
            $table->json('taskmasters')->nullable();
            $table->json('participants')->nullable();
            $table->json('car_registrations')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_lists');
    }
}
