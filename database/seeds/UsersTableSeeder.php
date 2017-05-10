<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'test',
            'nickname' => 'Mr. Test',
            'email' => str_random(10).'@example.com',
            'password' => Hash::make('secret'),
        ]);
        factory(App\User::class, 10)->create()->each(function ($u) {
            $u->tweets()->save(factory(App\Tweet::class)->make());
        });
    }
}
