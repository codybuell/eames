<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('role_id');                             // id of the users role, sets their access levels
			$table->boolean('active');                              // enable / disable system access
			$table->string('name')->unique();                       // users unique username
			$table->string('email')->unique();                      // users unique email address
			$table->string('password', 60);                         // users password encrypted
			$table->rememberToken();                                // remember token for password resets
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->timestamps();
			$table->dateTime('ping');
			$table->dateTime('last_login');
			$table->integer('login_count');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
