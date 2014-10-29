<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlanviewSubRegionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('planview_sub_regions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
            $table->integer('planview_region_id')->unsigned();
            $table->foreign('planview_region_id')->references('id')->on('planview_regions');
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
        Schema::table('planview_sub_regions', function(Blueprint $table)
        {
            $table->dropForeign('planview_sub_regions_planview_region_id_foreign');
        });
		Schema::drop('planview_sub_regions');
	}

}
