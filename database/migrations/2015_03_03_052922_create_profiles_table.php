<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('profiles', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('user_id');                             // associated user
      $table->integer('manager_id')->nullable();              // managers user id
      $table->string('photo')->nullable();                    // url for user photo
      $table->string('first_name')->nullable();               // users first name
      $table->string('last_name')->nullable();                // users last name
      $table->string('title')->nullable();                    // employment title / position
      $table->string('phone_work_office')->nullable();        // work office phone number
      $table->string('phone_work_mobile')->nullable();        // work cell phone number
      $table->string('phone_personal_home')->nullable();      // personal home phone number
      $table->string('phone_personal_mobile')->nullable();    // personal cell phone number
      $table->string('office_location')->nullable();          // office location
      $table->longText('notes')->nullable();                  // notes about the user (visible only to admin)
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
    Schema::drop('profiles');
  }

}
