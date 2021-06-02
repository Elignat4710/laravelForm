<?php

namespace Tests\Unit\Http\Controllers\Form;

use App\Http\Controllers\Form\MemberProfileController;
use App\Models\Members;
use Tests\TestCase;

class MemberProfileControllerTest extends TestCase
{
    protected $members;
    protected $controller;
    
    public function setUp() : void
    {
        parent::setUp();

        $this->members = Members::factory()->count(3)->create([
            'hide' => 0
        ]);
        $this->controller = new MemberProfileController();
    }
    
    public function testCountProfilesNumber()
    {
        $countProfiles = $this->controller->countProfiles()->original['count'];

        $this->assertEquals($countProfiles, 3);
    }

    public function testGetAllProfilesText()
    {
        $response = $this->controller->getAllProfiles()->getData();
        $this->expectOutputString('OK');
        echo $response->msg;
    }

    /** @test */
    public function qwe()
    {
        $this->markTestIncomplete();
    }
}
