<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParentModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Father Details
            'father_name' => $this->faker->name('male'),
            'father_occupation' => $this->faker->jobTitle(),
            'father_place_of_work' => $this->faker->company(),
            'father_office_address' => $this->faker->address(),
            'father_email' => $this->faker->unique()->safeEmail(),
            'father_contact_no' => $this->faker->phoneNumber(),
            'father_photo' => null, // Can be set to dummy file if needed

            // Mother Details
            'mother_name' => $this->faker->name('female'),
            'mother_occupation' => $this->faker->jobTitle(),
            'mother_place_of_work' => $this->faker->company(),
            'mother_office_address' => $this->faker->address(),
            'mother_email' => $this->faker->unique()->safeEmail(),
            'mother_contact_no' => $this->faker->phoneNumber(),
            'mother_photo' => null,

            // Residential
            'residential_address' => $this->faker->address(),
            'residential_contact' => $this->faker->phoneNumber(),

            // Guardian (optional)
            'guardian_name' => $this->faker->optional()->name(),
            'guardian_relationship' => $this->faker->optional()->randomElement(['Uncle', 'Aunt', 'Grandparent']),
            'guardian_contact' => $this->faker->optional()->phoneNumber(),

            // Emergency
            'emergency_contact_name' => $this->faker->name(),
            'emergency_contact_relationship' => $this->faker->randomElement(['Relative', 'Neighbor', 'Friend']),
            'emergency_contact_phone' => $this->faker->phoneNumber(),
            'emergency_contact_address' => $this->faker->address(),
        ];
    }
}

