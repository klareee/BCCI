<?php

namespace Database\Seeders;

use App\Enums\EmploymentStatusEnum;
use App\Models\EmploymentDetail;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class
        ]);


        $user = User::factory()->admin()->create(['email' => 'admin@admin.com']);
        EmploymentDetail::create([
            'user_id' => $user->id,
            'position' => 'Manager',
            'department' => 'Admin',
            'manager_id' => $user->id,
            'employment_status' => EmploymentStatusEnum::REGULAR,
            'date_hired' => now(),
            'date_regularized' => now()
        ]);

    }
}
