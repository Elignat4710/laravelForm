<?php

namespace Tests\Feature\Http\Controllers\Form;

use App\Http\Controllers\Form\MemberProfileController;
use App\Models\Members;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class MemberProfileControllerTest extends TestCase
{
    use WithFaker;
    
    protected $controller;
    
    public function setUp() : void
    {
        parent::setUp();

        $this->controller = new MemberProfileController;
    }

    public function testFirstFormSubmit()
    {
        $data = [
            'firstName' => 'test',
            'lastName' => 'test',
            'birthdate' => '2021-01-01',
            'reportSubject' => 'test',
            'phone' => '123123123',
            'email' => 'test@test.gmail.com',
            'countryId' => '1'
        ];
        
        $response = $this->post('/api/first', $data);

        $response->assertStatus(201);

        return $response->getData();
    }
    
    /**
     * @dataProvider dataProvider
     */
    public function testFirstFormDupl($data)
    {
        $this->post('/api/first', $data);

        $response = $this->post('/api/first', $data);

        $response->assertRedirect();
    }

    /**
     *  @depends testFirstFormSubmit
     */
    public function testSecondFormSubmit($data)
    {
        $array = (array) $data;
        
        $array['company'] = 'test';
        $array['position'] = 'test';
        $array['aboutMe'] = 'test';

        $id = $array['id'];

        $response = $this->post("/api/second/$id", $array);
        $response->assertStatus(201);
    }

    /**
     * @dataProvider dataProvider
     * @test
     */
    public function firstFormException($data)
    {
        $data['birthdate'] = 'test';
        $response = $this->post(route('api.first'), $data);

        $response->assertStatus(404);
    }

    /**
     * @dataProvider dataProvider
     * @test
     */
    public function secondFormUploadWithPhoto($firstData, $secondData)
    {
        $member = Members::create($firstData);
        
        $response = $this->post(route('api.second', $member->id), $secondData);

        $updatedMember = Members::find($member->id);

        $response->assertCreated();
        $response->assertCookieExpired('id');
        $this->assertNotEmpty($updatedMember->photo);
    }

    /**
     * @dataProvider dataProvider
     * @test
     */
    public function secondFormException($firstData, $secondData)
    {
        $member = Members::create($firstData);

        $secondData['company'] = $this->faker->regexify('[A-Za-z0-9]{60}');

        $response = $this->post(route('api.second', $member->id), $secondData);

        $response->assertNotFound();
        $this->assertDatabaseMissing('members', [
            'company' => $secondData['company']
        ]);
    }
    
    public function dataProvider()
    {
        return [
            [
                [
                    'firstName' => 'test',
                    'lastName' => 'test',
                    'birthdate' => '2021-01-01',
                    'reportSubject' => 'test',
                    'phone' => '123123123',
                    'email' => 'test@test.gmail.com',
                    'countryId' => '1'
                ],
                [
                    'company' => 'test',
                    'position' => 'test',
                    'aboutMe' => 'test',
                    'photo' => UploadedFile::fake()->image('avatar.jpg')
                ]
            ],
        ];
    }
}
