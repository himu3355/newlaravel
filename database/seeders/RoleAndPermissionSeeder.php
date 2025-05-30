<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $role = Role::findByName("Admin");
        // $role->delete();
        Role::create(['name'=>'admin']);
        $user = User::find(1);
        $user->assignRole('admin');
    }
}
