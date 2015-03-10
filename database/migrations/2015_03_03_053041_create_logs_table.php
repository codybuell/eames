<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type');                                 // hardware | software | license | etc.
			$table->integer('hardware_id');                         // related hardware record
			$table->integer('software_id');                         // related software record
			$table->integer('license_id');                          // related license record
			$table->integer('installation_id');                     // related installation record
			$table->integer('maintenance_id');                      // related maintenance record
			$table->integer('project_id');                          // related project id
			$table->integer('task_id');                             // related task id
			$table->integer('issue_id');                            // related issue id
			$table->integer('event_id');                            // related event id
			$table->string('title');                                // title / summary description of log
			$table->longText('notes')->nullable();                  // log / full details
			$table->dateTime('datetime');                           // date time of the log
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
		Schema::drop('logs');
	}

}
