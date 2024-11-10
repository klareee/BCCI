<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(RoleEnum::cases() as $role)
        {
            Role::factory()->create([
                'name' => $role,
                'created_by' => 1,
                        'updated_by' => 1
            ]);
        }
    }
}
