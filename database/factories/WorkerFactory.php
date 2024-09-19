<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $faker = Faker\Factory::create('fr_FR');
        return [
            'fullname' => fake()->firstName() .' ' . fake()->lastName(),
            'cpf' => fake('pt_BR')->cpf(false),
            'birthdate' => date('Y-m-d',fake()->dateTimeBetween(null, strtotime('now -18 year'))->getTimestamp()),
            'has_comorbidity' => fake()->boolean,

        ];
    }
}
