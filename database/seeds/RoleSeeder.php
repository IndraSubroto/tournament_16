<?php

use App\Model\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'isAdmin'
        ]);
        Role::create([
            'name' => 'Promotor',
            'slug' => 'isPromotor'
        ]);
        Role::create([
            'name' => 'Member',
            'slug' => 'isMember'
        ]);
    }
}
