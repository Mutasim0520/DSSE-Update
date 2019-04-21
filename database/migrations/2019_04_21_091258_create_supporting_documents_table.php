<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportingDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporting_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('publication_id')->index()->nullable();
            $table->unsignedInteger('project_id')->index()->nullable();
            $table->unsignedInteger('member_id')->index();
            $table->string('belongs_to');
            $table->string('type');
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
        //
    }
}
