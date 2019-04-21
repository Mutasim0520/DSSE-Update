<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('projects', function (Blueprint $table) {
            $table->increments('project_id');
            $table->string('name');
            $table->text('description');
            $table->string('status');
            $table->string('fundStatus')->nullable();
            $table->string('fundingOrganization')->nullable();
            $table->string('fundAmount')->nullable();
            $table->string('start_date');
            $table->string('finish_date')->nullable();
            $table->string('src_code_path')->nullable();
            $table->string('src_code_url')->nullable();
            $table->string('srs_path')->nullable();
            $table->string('srs_url')->nullable();
        
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
