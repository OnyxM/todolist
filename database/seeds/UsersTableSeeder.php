<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		// {"name":"0hn43c5k1_m3","email":"email@domain.com","password":"passwd1234"}
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
