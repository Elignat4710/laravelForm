<?php

namespace Database\Factories;

use App\Models\Members;
use Illuminate\Database\Eloquent\Factories\Factory;

class MembersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Members::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstName' => $this->faker->name,
            'lastName' => $this->faker->lastName,
            'birthdate' => now()->toDateString(),
            'reportSubject' => $this->faker->text(50),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'company' => $this->faker->text(49),
            'position' => $this->faker->text(49),
            'aboutMe' => $this->faker->text,
            'countryId' => $this->faker->numberBetween(1, 190),
            'hide' => $this->faker->numberBetween(0, 1),
            'photo' => $this->faker->imageUrl
        ];
    }
}
