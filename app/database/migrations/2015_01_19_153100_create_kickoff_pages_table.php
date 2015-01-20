<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKickoffPagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kickoff_pages', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('kickoff_id')->unsigned();
            $table->foreign('kickoff_id')->references('id')->on('kickoffs');
            $table->string('slug', 80);
            $table->longText('html');
            $table->longText('scripts')->nullable();
            $table->longText('styles')->nullable();
            $table->timestamps();
            $table->unique(['kickoff_id', 'slug']);
            $table->index('slug');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kickoff_pages');
    }

}
