<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationProjectHasManyKeywordConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_publication_keyword', function (Blueprint $table){
            $table->foreign('publication_id')
                  ->references('publication_id')->on('publications')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('project_id')
                  ->references('project_id')->on('projects')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('keyword_id')
                  ->references('id')->on('keywords')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
