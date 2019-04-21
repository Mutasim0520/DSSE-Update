<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationHasManyExternalAuthorConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('external_author_publication', function (Blueprint $table){
            $table->foreign('external_author_id')
                  ->references('id')->on('external_authors')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('publication_id')
                  ->references('publication_id')->on('publications')
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
