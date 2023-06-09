<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Tamam.io';
        $user->email = 'shahzaib.2377@gmail.com';
        $user->password = Hash::make('test123');
        $user->country = 'UAE';
        $user->currency = 'AED';
        $user->webhook_secret = Str::uuid();
        $user->save();
    }
}
