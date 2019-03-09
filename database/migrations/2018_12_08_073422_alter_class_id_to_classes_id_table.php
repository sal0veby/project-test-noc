<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterClassIdToClassesIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_lists', function (Blueprint $table) {
            $table->renameColumn('class_id', 'classes_id');
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
            $table->renameColumn('class_id', 'classes_id');
        });
    }
}
