<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\ParentModel;
use Carbon\Carbon;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $dob = $this->faker->dateTimeBetween('-6 years', '-3 years');
        $ageYears = Carbon::parse($dob)->diffInYears(now());
        $ageMonths = Carbon::parse($dob)->diffInMonths(now()) % 12;

        return [
            'student_id' => 'LHB' . str_pad($this->faker->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
            'full_name' => $this->faker->name(),
            'date_of_birth' => $dob,
            'age_years' => $ageYears,
            'age_months' => $ageMonths,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'place_of_birth' => $this->faker->city(),
            'nationality' => 'Indian',
            'mother_tongue' => $this->faker->randomElement(['English', 'Hindi', 'Kannada', 'Tamil']),
            'blood_group' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            'allergies' => $this->faker->optional()->sentence(),
            'surgeries' => $this->faker->optional()->sentence(),
            'chronic_illness' => $this->faker->optional()->sentence(),
            'immunization_complete' => $this->faker->boolean(),
            'medical_notes' => $this->faker->optional()->paragraph(),
            'parent_id' => ParentModel::inRandomOrder()->first()->id ?? ParentModel::factory()->create()->id,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'admission_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}

