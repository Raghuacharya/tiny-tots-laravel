<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParentModel;

class ParentSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 demo parent records
        ParentModel::factory()->count(10)->create();
    }
}
