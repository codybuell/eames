<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftwaresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('softwares', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');                                 // name of the software
			$table->string('make');                                 // manufacturer of the software
			$table->string('model');                                // specific name of the software
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
		Schema::drop('softwares');
	}

}
