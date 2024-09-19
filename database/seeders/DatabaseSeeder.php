<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vaccine;
use App\Models\Worker;
use Database\Factories\WorkerFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Vaccine::factory(2)->create();

        $vaccine = Vaccine::factory()->create([
            'name' =>  'Pfizer'
        ]);

        Worker::factory(4)->create();

        $worker1 = Worker::factory()->create([
            'fullname' => 'João da Silva'
        ]);

        $worker2 = Worker::factory()->create([
            'fullname' => 'Maria Aparecida'
        ]);

        $applied_at = date('Y-m-d H:i:s');

        DB::table('worker_vaccines')->insert([
            [
                'vaccine_id' => $vaccine->id,
                'worker_id' => $worker1->id,
                'applied_at' => $applied_at
            ],
            [
                'vaccine_id' => $vaccine->id,
                'worker_id' => $worker2->id,
                'applied_at' => $applied_at
            ],
            [
                'vaccine_id' => $vaccine->id,
                'worker_id' => $worker2->id,
                'applied_at' => $applied_at
            ],

        ]);
    }
}
