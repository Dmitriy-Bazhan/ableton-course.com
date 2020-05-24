<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $firstUser = new User();
        $firstUser->name = 'Dima';
        $firstUser->email = 'dimka@gmail.com';
        $firstUser->email_verified_at = now();
        $firstUser->password = '$2y$10$/xUbPd3hA2CWzA4P3KhgLurWRvLa8533QDiH/JRx7OztGhRcnEGxq'; // password
        $firstUser->remember_token = '5zEO3O8EmC7CgdyM94rYx8wsuaOoZn7KOXXNMFd9CEqoIkVqNdYfc6RaAoUV';
        $firstUser->role = 2;
        $firstUser->save();
        $firstId = User::all()->last()->id;
        User::where('id', $firstId)->update(['id' => 1]);
    }
}
