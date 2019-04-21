<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::create('publications', function (Blueprint $table) {
            $table->increments('publication_id');
            $table->string('name');
            $table->text('abstract');
            $table->string('status');
            $table->string('fundStatus');
            $table->string('fundingOrganization')->nullable();
            $table->string('fundAmount')->nullable();
            $table->string('date');
            $table->string('publication_type');
            $table->string('book_addition')->nullable();
            $table->string('publisher')->nullable();
            $table->string('page')->nullable();
            $table->string('book_section')->nullable();
            $table->string('book_chapter_name')->nullable();
            $table->string('book_chapter')->nullable();
            $table->string('volume')->nullable();
            $table->string('journal_name')->nullable();
            $table->string('conference_name')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('university')->nullable();
            $table->string('project_status')->nullable();
            $table->unsignedInteger('project_id')->index()->nullable();
            $table->string('affiliated_institute')->nullable();
            $table->string('dataset_file')->nullable();
            $table->string('dataset_url')->nullable();
            $table->string('src_code_path')->nullable();
            $table->string('src_code_url')->nullable();
            $table->string('paper_path')->nullable();
            $table->string('paper_url')->nullable();
        
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
