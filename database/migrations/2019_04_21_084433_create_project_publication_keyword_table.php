<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectPublicationKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_publication_keyword', function (Blueprint $table) {
            $table->unsignedInteger('publication_id')->index()->nullable();
            $table->unsignedInteger('project_id')->index()->nullable();
            $table->unsignedInteger('keyword_id')->index();
        
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
