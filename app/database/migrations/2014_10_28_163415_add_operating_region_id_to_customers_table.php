<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOperatingRegionIdToCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('customers', function(Blueprint $table)
		{
			$table->integer('operating_region_id')->unsigned();
            $table->foreign('operating_region_id')->references('id')->on('operating_regions');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('customers', function(Blueprint $table)
		{
            $table->dropForeign('customers_operating_region_id_foreign');
			$table->dropColumn('operating_region_id');
		});
	}

}
