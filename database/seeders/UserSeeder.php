<?php


namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = new User();
        $admin->name = 'Webmaster';
        $admin->email = 'webmaster@example.ru';
        $admin->email_verified_at = date('U');
        $admin->password = Hash::make('webmaster');

        $admin->save();
    }
}
