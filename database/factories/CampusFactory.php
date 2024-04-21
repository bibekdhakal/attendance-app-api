<?php

namespace Database\Factories;

use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campus>
 */
class CampusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $universityIds = University::pluck('university_id')->toArray();
        $randomUniversityId = $universityIds[array_rand($universityIds)];
        return [
            'campus_id' => (string) \Str::uuid(),
            'campus_name' => $this->faker->address,
            'university_id' => $randomUniversityId,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude
        ];
    }
}
