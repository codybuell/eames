<?php

use EAMES\Models\User;
use EAMES\Models\Role;
use EAMES\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/*
|--------------------------------------------------------------------------
| Database Seeder Class
|--------------------------------------------------------------------------
|
| Calls other classes to perform seeding.
|
*/

class DatabaseSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Model::unguard();

    $this->command->info('Here we go!');
    $this->call('SeedRootUser');
  }

}

/*
|--------------------------------------------------------------------------
| Seed Root User Class
|--------------------------------------------------------------------------
|
| Create the initial root superuser account and base roles.
|
*/

class SeedRootUser extends Seeder {

  public function run() {

    // reset tables
    DB::table('roles')->delete();
    DB::table('users')->delete();
    DB::table('profiles')->delete();

    // read only role
    $readonlyRole = Role::create(array(
      'class' => 000,
      'name' => 'Read Only'
    ));

    // default user role
    $userRole = Role::create(array(
      'class' => 100,
      'name' => 'User'
    ));

    // manater role
    $managerRole = Role::create(array(
      'class' => 200,
      'name' => 'Manager'
    ));

    // site administrator role
    $adminRole = Role::create(array(
      'class' => 300,
      'name' => 'Administrator'
    ));

    // root user account
    $adminUser = User::create(array(
      'active'   => 1,
      'username' => 'root',
      'email'    => 'group@listserver.domain.com',
      'role_id'  => $adminRole->id,
      'password' => Hash::make('root')
    ));

    Profile::create(array(
      'user_id'           => $adminUser->id,
      'first_name'        => 'root',
      'title'             => 'root',
      'notes'             => 'Seeded root account.'
    ));

  }

}

