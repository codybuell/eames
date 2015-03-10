<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('calendar');                             // event group, calendar name
			$table->string('title');                                // name of event
			$table->string('location');                             // location of event
			$table->mediumText('notes')->nullable();                // notes / details of event
			$table->boolean('all_day');                             // all day event switch
			$table->dateTime('event_start');                        // event start time
			$table->dateTime('event_end');                          // event end time
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
		Schema::drop('events');
	}

}
