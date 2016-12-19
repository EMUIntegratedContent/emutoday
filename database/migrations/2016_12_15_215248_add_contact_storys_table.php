<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContactStorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('storys', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreign('contact_id')->references('id')->on('authors');
            //$table->dropColumn('author_info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('storys', function (Blueprint $table) {
            $table->dropForeign('storys_contact_id_foreign');
            //$table->string('author_info', 255);
        });
    }
}
