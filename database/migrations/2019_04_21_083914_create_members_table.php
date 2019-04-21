<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('member_id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('current_designation');
            $table->string('organization');
            $table->string('status');
            $table->string('publication_name')->nullable();
            $table->string('external_author')->nullable();
            $table->string('additional_email')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedInteger('user_id')->index()->nullable();
        
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
