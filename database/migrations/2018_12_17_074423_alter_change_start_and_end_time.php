<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterChangeStartAndEndTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_lists', function (Blueprint $table) {
            $table->dateTime('start_work_time')->change();
            $table->dateTime('end_work_time')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_lists', function (Blueprint $table) {
            $table->dateTime('start_work_time')->change();
            $table->dateTime('end_work_time')->change();
        });
    }
}
