<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('issues', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('assigned_id');                         // owner of the issue, individual tasked with resolving
			$table->integer('hardware_id');                         // associated hardware record
			$table->integer('software_id');                         // associated software record
			$table->integer('installation_id');                     // associated installation record
			$table->string('title');                                // title / summary of the issue
			$table->dateTime('event_time');                         // time the issue occured
			$table->string('status');                               // not started | troubleshooting | fixing | completed | staged | etc.
			$table->longText('event')->nullable();                  // events leading up to issue and description of the problem as it occured
			$table->longText('problem')->nullable();                // what the problem was discovered to be, detailed info
			$table->longText('solution')->nullable();               // solution to the problem, what was done to fix it and prevent reoccurence
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
		Schema::drop('issues');
	}

}
