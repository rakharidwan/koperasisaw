<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


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
        DB::table('users')->delete();
        $user = [[
            'name' => 'Admin',
            'email' => 'admin@koperasisaw.com',
            'role' => 'Admin',
            'status_akun' => 'terdaftar',
            'password' => Hash::make('12345678'),
        ],
        [
            'name' => 'Rakha Ridwan Virgiandi',
            'email' => '0912376124612481@koperasisaw.com',
            'role' => 'Karyawan',
            'status_akun' => 'terdaftar',
            'password' => Hash::make('123456789'),
        ],
        [
            'name' => 'Eren Yeager',
            'email' => '0012321412412412@koperasisaw.com',
            'role' => 'Karyawan',
            'status_akun' => 'terdaftar',
            'password' => Hash::make('123456789'),
        ],[
            'name' => 'Mikasa Ackerman',
            'email' => '0029587103994857@koperasisaw.com',
            'role' => 'Karyawan',
            'status_akun' => 'terdaftar',
            'password' => Hash::make('123456789'),
        ],[
            'name' => 'Armin Arlert',
            'email' => '0013924211241241@koperasisaw.com',
            'role' => 'Karyawan',
            'status_akun' => 'terdaftar',
            'password' => Hash::make('123456789'),
        ],[
            'name' => 'Levi Ackerman',
            'email' => '0031231939131414@koperasisaw.com',
            'role' => 'Karyawan',
            'status_akun' => 'terdaftar',
            'password' => Hash::make('123456789'),
        ],[
            'name' => 'Erwin Smith',
            'email' => '0043693423532235@koperasisaw.com',
            'role' => 'Karyawan',
            'status_akun' => 'terdaftar',
            'password' => Hash::make('123456789'),
        ],[
            'name' => 'Rainer Braun',
            'email' => '0019548339432843@koperasisaw.com',
            'role' => 'Karyawan',
            'status_akun' => 'terdaftar',
            'password' => Hash::make('123456789'),
        ],[
            'name' => 'Annie Leonhart',
            'email' => '0023325040502135@koperasisaw.com',
            'role' => 'Karyawan',
            'status_akun' => 'terdaftar',
            'password' => Hash::make('123456789'),
        ],[
            'name' => 'Zeke Yeager',
            'email' => '0021731371387930@koperasisaw.com',
            'role' => 'Karyawan',
            'status_akun' => 'terdaftar',
            'password' => Hash::make('123456789'),
        ],[
            'name' => 'Bertholdt Hoover',
            'email' => '0021841391248212@koperasisaw.com',
            'role' => 'Karyawan',
            'status_akun' => 'terdaftar',
            'password' => Hash::make('123456789'),
        ],[
            'name' => 'Connie Springer',
            'email' => '0023242332943243@koperasisaw.com',
            'role' => 'Karyawan',
            'status_akun' => 'terdaftar',
            'password' => Hash::make('123456789'),
        ],[
            'name' => 'Jean Kristein',
            'email' => '0042840021033802@koperasisaw.com',
            'role' => 'Karyawan',
            'status_akun' => 'terdaftar',
            'password' => Hash::make('123456789'),
        ],];

        User::insert($user);
    }
}
