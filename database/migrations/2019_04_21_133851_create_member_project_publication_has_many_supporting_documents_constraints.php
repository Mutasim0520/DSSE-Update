<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberProjectPublicationHasManySupportingDocumentsConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supporting_documents', function (Blueprint $table){
            $table->foreign('member_id')
                  ->references('member_id')->on('members')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('publication_id')
                  ->references('publication_id')->on('publications')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

             $table->foreign('project_id')
                  ->references('project_id')->on('projects')
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