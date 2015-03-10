<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHardwaresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hardwares', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('owner_id');                            // owner of the hardware
			$table->integer('user_id');                             // end user of the system
			$table->integer('admin_id');                            // administrator of the system
			$table->integer('team_id');                             // team / department managing / using the system
			$table->string('status');                               // end user of the system
			$table->string('name');                                 // hostname / devicename
			$table->string('location');                             // location of the equipment
			$table->string('type');                                 // server | vm | desktop | terminal | etc.
			$table->string('make');                                 // manufacturer of the equipment
			$table->string('model');                                // model number of the equipment
			$table->string('asset_tag');                            // tracking number / inventory number
			$table->string('serial');                               // serial number
			$table->longText('notes')->nullable();                  // description, general notes, etc.
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->timestamps();
			$table->dateTime('ping');
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hardwares');
	}

}
