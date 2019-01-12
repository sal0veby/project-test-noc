<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id');
            $table->integer('process_id');
            $table->boolean('approve')->default(0);
            $table->string('name_user')->nullable();
            $table->string('name_tel')->nullable();
            $table->dateTime('time_of_work')->nullable();
            $table->integer('count_of_worker')->nullable();
            $table->dateTime('time_off_work')->nullable();
            $table->integer('count_time_off_work')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_jobs');
    }
}
