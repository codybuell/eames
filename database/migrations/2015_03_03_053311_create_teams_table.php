<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teams', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');                                 // team name
			$table->integer('leader_id');                           // user id of the team leader
			$table->longText('notes')->nullable();                  // notes on invoice, contacts, renewal process, etc
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
		Schema::drop('teams');
	}

}
