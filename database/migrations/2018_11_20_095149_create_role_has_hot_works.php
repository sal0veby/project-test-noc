<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleHasHotWorks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_has_step_hot_works', function (Blueprint $table) {
            $table->integer('step_hot_work_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('step_hot_work_id')
                ->references('id')
                ->on('step_hot_works')
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->primary(['step_hot_work_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_has_hot_works');
    }
}
