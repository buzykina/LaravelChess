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
			[ 'userid' => 1, 'message' => "new message",'created_at' => date('Y-m-d H:i:s')],
			[ 'userid' => 2, 'message' => "Yo yo yo!",'created_at' => date('Y-m-d H:i:s')],
		]);
    }
}
