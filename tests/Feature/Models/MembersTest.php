<?php

namespace Tests\Feature\Models;

use App\Models\Country;
use App\Models\Members;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MembersTest extends TestCase
{
    use WithFaker;

    protected $member;

    public function setUp() : void
    {
        parent::setUp();

        $this->member = array(
            'firstName' => $this->faker->name,
            'lastName' => $this->faker->lastName,
            'birthdate' => now()->toDateString(),
            'reportSubject' => $this->faker->text(100),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'company' => $this->faker->text(50),
            'position' => $this->faker->text(50),
            'aboutMe' => $this->faker->text,
            'countryId' => $this->faker->numberBetween(1, 190),
            'hide' => 0,
            'photo' => $this->faker->imageUrl
        );
    }
    
    /** @test */
    public function createMember()
    {
        $model = new Members();
        $model->fill($this->member);
        $model->save();

        $this->assertDatabaseCount('members', 1);
        $this->assertDatabaseHas('members', [
            'firstName' => $this->member['firstName'],
            'lastName' => $this->member['lastName']
        ]);

        return $model;
    }

    /**
     * @depends createMember
     */
    public function relationCountry($member)
    {
        $this->assertNotEmpty($member->country->name);
    }
}
