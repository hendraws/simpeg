<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = ['super-admin','hrd','general-manager','koordinator-dan-spv'];

        foreach ($role as $key => $value) {
        	 Role::updateOrCreate(['name'=> $value],[]);
        }
    }
}
