<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();


        $adminRole = Role::create(['name' => 'admin', 'display_name_en' => 'Administrator', 'description_en' => 'System Administrator', 'display_name' => 'الادارة', 'description' => 'مدير النظام', 'allowed_route' => 'admin']);
        $editorRole = Role::create(['name' => 'editor', 'display_name_en' => 'Supervisor', 'description_en' => 'System Supervisor', 'display_name' => 'المشرف', 'description' => 'مشرف النظام', 'allowed_route' => 'admin']);
        $userRole = Role::create(['name' => 'user', 'display_name_en' => 'User', 'description_en' => 'Normal User', 'display_name' => 'مستخدم', 'description' => 'مستخدم النظام', 'allowed_route' => null]);

        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@bloggi.test',
            'mobile' => '966500000001',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12345678'),
            'status' => 1,
        ]);
        $admin->attachRole($adminRole);


        $editor = User::create([
            'name' => 'Editor',
            'username' => 'editor',
            'email' => 'editor@bloggi.test',
            'mobile' => '966500000002',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12345678'),
            'status' => 1,
        ]);
        $editor->attachRole($editorRole);


        $user1 = User::create(['name' => 'abdulkader saado', 'username' => 'abd', 'email' => 'abd@gmail.com', 'mobile' => '963500000003', 'email_verified_at' => Carbon::now(), 'password' => bcrypt('12345678'), 'status' => 1,]);
        $user1->attachRole($userRole);

        $user2 = User::create(['name' => 'user2', 'username' => 'username2', 'email' => 'mansour@bloggi.test', 'mobile' => '963500000004', 'email_verified_at' => Carbon::now(), 'password' => bcrypt('12345678'), 'status' => 1,]);
        $user2->attachRole($userRole);

        $user3 = User::create(['name' => 'abd sa', 'username' => 'abd_sa', 'email' => 'mais@bloggi.test', 'mobile' => '963500000005', 'email_verified_at' => Carbon::now(), 'password' => bcrypt('12345678'), 'status' => 1,]);
        $user3->attachRole($userRole);

        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'username' => $faker->userName,
                'email' => $faker->email,
                'mobile' => '9665' . random_int(10000000, 99999999),
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('12345678'),
                'status' => 1
            ]);
            $user->attachRole($userRole);
        }
    }
}
