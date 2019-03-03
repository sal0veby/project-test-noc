<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropDescriptionTableJobLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_lists', function ($table) {
            $table->dropColumn('description_location');
            $table->dropColumn('description_work_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_lists', function ($table) {
            $table->dropColumn('description_location');
            $table->dropColumn('description_work_type');
        });
    }
}
