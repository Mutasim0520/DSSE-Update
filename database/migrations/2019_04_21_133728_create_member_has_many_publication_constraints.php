<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberHasManyPublicationConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_publication', function (Blueprint $table){
            $table->foreign('member_id')
                  ->references('member_id')->on('members')
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
