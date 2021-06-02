<?php

namespace Tests\Feature\Models;

use App\Models\Country;
use App\Models\Members;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountriesTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        Members::factory()->count(3)->create([
            'countryId' => 1
        ]);
    }
    
    /** @test */
    public function countRecords()
    {
        $allRecord = Country::count();

        $this->assertNotEmpty($allRecord);
        $this->assertEquals($allRecord, 193);
    }

    /** @test */
    public function relationMembers()
    {
        $this->assertEquals(count(Country::firstWhere('id', 1)->members), 3);
    }
}
