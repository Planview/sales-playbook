<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKickoffsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kickoffs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->smallInteger('name')->unique();
            $table->string('layout', 100)->nullable();
            $table->mediumText('menu')->nullable();
            $table->boolean('active');
            $table->softDeletes();
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
        Schema::drop('kickoffs');
    }

}
