<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arr = [];
        for($i = 1; $i < 100; $i++ ){
            $tmp['username'] = str_random('20');
            $tmp['email'] = str_random('8') . '@163.com';
            $tmp['password'] = Hash::make('lampbrother');
            $tmp['profile'] = '/Uploads/20170405/1491398575968579.jpg';
            $tmp['intro'] = str_random('80');
            $tmp['created_at'] = date('Y-m-d H:i:s');
            $tmp['updated_at'] = date('Y-m-d H:i:s');

            $arr[] = $tmp;
        }

        DB::table('users')->insert($arr);
    }
}
