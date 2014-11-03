<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StatusesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('statuses', function($table)
		{
			$table->increments('id');
			$table->string('trackid', 20);
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
			$table->integer('parcel_status_id');
			$table->text('message');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('statuses');
	}

}
