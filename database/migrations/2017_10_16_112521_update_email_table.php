<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emails', function (Blueprint $table) {
          /*
            $table->integer('mainstory_id')->unsigned()->nullable();
            $table->dateTime('send_at')->nullable();
            $table->tinyInteger('is_sent');
            $table->softDeletes();
            $table->foreign('mainstory_id')
              ->references('id')->on('storys')
              ->onDelete('cascade');
              */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emails', function (Blueprint $table) {
            //$table->dropForeign(['mainstory_id']);
            //$table->dropColumn('send_at');
            //$table->dropColumn('is_sent');
        });
    }
}
