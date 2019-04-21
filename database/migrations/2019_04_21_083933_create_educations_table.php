<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('degree_name');
            $table->string('institute');
            $table->string('passing_year');
            $table->string('degree_subject');
            $table->string('thesis')->nullable();
            $table->string('supervisor')->nullable();
            $table->unsignedInteger('member_id')->index();
        
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
