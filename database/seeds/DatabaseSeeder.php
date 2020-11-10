<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
		for ($i = 0; $i < 150; $i++) {
			DB::table('trades')->insert([
				'user_id' => 5,
				'exchange_id' => rand(1, 5),
				'coin_id' => rand(1, 20),
				'quantity' => rand(0.3, 5000),
				'open_price' => rand(0.015, 15000),
			]);
		}
	}
}