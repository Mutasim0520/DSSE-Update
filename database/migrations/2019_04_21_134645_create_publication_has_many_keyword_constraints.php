<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationHasManyKeywordConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keyword_publication', function (Blueprint $table){
            $table->foreign('publication_id')
                  ->references('publication_id')->on('publications')
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
