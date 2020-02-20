<?php

use App\Constant;
use Illuminate\Database\Seeder;

class TodosTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		for ($i = 1; $i < 25; $i++) {
			App\Todo::create([
				'name' => "Todo $i",
				'description' => "Description Todo $i",
				'status' => json_encode(['status' => Constant::TODOINITIATED, 'time_action' => time()]),
				'user_id' => rand(1, 5),
			]);
		}
	}
}
