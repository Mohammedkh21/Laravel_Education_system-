<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubscriptionPlan::create([
            'name'=>'free',
            'teachers'=>'3',
            'students'=>'30',
        ]);
        SubscriptionPlan::create([
            'name'=>'paid A',
            'teachers'=>'7',
            'students'=>'70',
        ]);
        SubscriptionPlan::create([
            'name'=>'paid B',
            'teachers'=>'10',
            'students'=>'100',
        ]);
    }
}
