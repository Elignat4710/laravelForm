<?php

namespace Tests\Feature\Http\Controllers\Form;

use App\Http\Controllers\Form\CountryController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryControllerTest extends TestCase
{
    protected $controller;
    
    public function setUp() : void
    {
        parent::setUp();

        $this->controller = new CountryController;
    }
    
    /** @test */
    public function getAllCountries()
    {
        $response = $this->json('GET', route('api.countries'));
        $response->assertJsonCount(193);
    }
}
