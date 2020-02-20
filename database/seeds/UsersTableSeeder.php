<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		App\User::create([
			'name' => "Onyx",
			'email' => "email@domain.com",
			'password' => bcrypt("passwd1234"),
		]);

		for ($i = 1; $i < 5; $i++) {
			App\User::create([
				'name' => "User $i",
				'email' => "email$i@domain.com",
				'password' => bcrypt("passwd12" . $i . "34"),
			]);
		}
	}
}
