<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPlanviewSubRegionIdToCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('customers', function(Blueprint $table)
		{
			$table->integer('planview_sub_region_id')->unsigned();
            $table->foreign('planview_sub_region_id')->references('id')->on('planview_sub_regions');
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
            $table->dropForeign('customers_planview_sub_region_id_foreign');
			$table->dropColumn('planview_sub_region_id');
		});
	}

}
