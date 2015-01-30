<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropFilesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('files');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('files', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('directory');
            $table->string('filename');
            $table->string('mime');
            $table->timestamps();
        });
    }

}
