<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('installations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('hardware_id');                         // hardware location of installation
			$table->integer('software_id');                         // software installed
			$table->integer('license_id');                          // license used for installation
			$table->string('version');                              // version of software installed
			$table->boolean('patch');                               // true for patch, false for full install
			$table->longText('notes')->nullable();                  // notes on process, gotchas, issues, etc.
			$table->integer('performed_by');                        // individual who performed installation
			$table->dateTime('performed_at');                       // date time of installation
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
		Schema::drop('installations');
	}

}
