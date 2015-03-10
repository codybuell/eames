<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('licenses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('software_id');                         // associated software
			$table->mediumText('serial');                           // encrypted license key
			$table->integer('seats');                               // number of allowable installations
			$table->string('type');                                 // demo | perpetual | annual | site | development | ...
			$table->string('term');                                 // parsed text "10 days, 2 mo, 1 yr, 2 years" etc...
			$table->dateTime('purchase_date');                      // date license was purchased / term begins
			$table->integer('price');                               // price of license
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
		Schema::drop('licenses');
	}

}
