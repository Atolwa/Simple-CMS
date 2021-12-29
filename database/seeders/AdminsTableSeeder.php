<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('admins')->insert(array(
        	array(
				'name' => "Atolwa",
				'email' => 'atolwa@gmail.com',
				'password' => bcrypt('atolwa123'),
        	),
        	array(
				'name' => "Admin",
				'email' => 'admin@gmail.com',
				'password' => bcrypt('admin'),
        	)
        ));

    }
}