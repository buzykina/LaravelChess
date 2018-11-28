<?php

use Illuminate\Database\Seeder;

class ChatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('chat')->insert([
			[ 'userid' => 20, 'message' => "new message"],
			[ 'userid' => 21, 'message' => "Yo yo yo!"],
		]);
    }
}
