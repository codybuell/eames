<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('assigned_id');                         // owner of the project
			$table->integer('priority');                            // task priority on 0 - N scale, 0 being high
			$table->dateTime('due_date');                           // target completion date of task
			$table->string('status');                               // not started | in progress | complete | staged, used for locking when complete
			$table->string('title');                                // project name
			$table->longText('notes')->nullable();                  // notes on project
			$table->string('prerequisites')->nullable();            // prerequisite projects / tasks
			$table->dateTime('started_at');                         // date project was started, used for age calculation ( use created_at for staleness )
			$table->integer('started_by');                          // user who started the project
			$table->dateTime('completed_at');                       // date project was completed
			$table->integer('completed_by');                        // user who finished the project
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
		Schema::drop('projects');
	}

}
