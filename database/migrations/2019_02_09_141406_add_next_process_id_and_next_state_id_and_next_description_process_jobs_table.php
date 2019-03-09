<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNextProcessIdAndNextStateIdAndNextDescriptionProcessJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process_jobs', function (Blueprint $table) {
            $table->integer('next_process_id')->after('description');
            $table->integer('next_state_id')->after('next_process_id');
            $table->string('next_description')->after('next_state_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
