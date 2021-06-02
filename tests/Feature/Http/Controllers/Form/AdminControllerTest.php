<?php

namespace Tests\Feature\Http\Controller\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Members;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    protected $controller;
    protected $admin;

    public function setUp() : void
    {
        parent::setUp();

        $this->controller = new AdminController;
        $this->admin = User::firstWhere('email', 'admin@admin.com');
        Members::factory()->count(100)->create();
    }
    
    /** @test */
    public function deletePhotoAMember()
    {
        $randomMember = Members::inRandomOrder()->first();

        $this->actingAs($this->admin)
            ->get(route('deletePhoto', $randomMember->id));
        
        $updatedMember = Members::firstWhere('id', $randomMember->id);
        
        $this->assertEmpty($updatedMember->photo);
    }
    
    /** @test */
    public function editPageCheckExistMember()
    {
        $randomMember = Members::inRandomOrder()->first();

        $response = $this->actingAs($this->admin)
            ->get(route('edit', $randomMember->id));
        
        $this->assertEquals($response['member']->id, $randomMember->id);
    }
    
    /** @test */
    public function canByViewMainPage()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('homePageAdmin'));

        $response->assertStatus(200);
    }

    /** @test */
    public function canByViewListMembers()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('listMembers'));
        
        $response->assertStatus(200);
    }

    /** @test */
    public function canByViewCountRegisterProfilesMainPage()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('homePageAdmin'));
        $response->assertSee('Main Page');
    }

    /** @test */
    public function checkProfileCountForHomePageAdmin()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('homePageAdmin'));
        $this->assertEquals($response['profiles_count'], 100);
    }

    /** @test */
    public function checkProfilesCountForListMembers()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('listMembers'));
        $this->assertEquals(count($response['profiles']), 100);
    }

    /** @test */
    public function deleteMembers()
    {
        $randomMember = Members::inRandomOrder()->first();
        
        $this->actingAs($this->admin)
            ->delete(route('destroy', $randomMember->id));
        
        $this->assertDatabaseMissing('members', [
            'id' => $randomMember->id
        ]);
    }

    /**
     * @test
     */
    public function deletePhotoWhenFieldEmpty()
    {
        $member = Members::inRandomOrder()->first();
        $member->photo = null;
        $member->save();

        $response = $this->actingAs($this->admin)
            ->get(route('deletePhoto', $member->id));

        $response->assertSessionHasErrors();
    }

    /** @test */
    public function changeHideField_1()
    {
        $id = Members::where('hide', 0)->inRandomOrder()->first()->id;
        $this->actingAs($this->admin)
            ->patch(route('changeHideField', $id));
        $updatedMember = Members::firstWhere('id', $id);

        $this->assertEquals($updatedMember->hide, 1);
    }

    /** @test */
    public function changeHideField_0()
    {
        $id = Members::where('hide', 1)->inRandomOrder()->first()->id;
        $this->actingAs($this->admin)
            ->patch(route('changeHideField', $id));
        $updatedMember = Members::firstWhere('id', $id);

        $this->assertEquals($updatedMember->hide, 0);
    }

    /**
     * @dataProvider dataprovider
     * @test
     */
    public function trueUpdate($data)
    {
        $member = Members::inRandomOrder()->first();
        
        $this->actingAs($this->admin)
            ->put(route('update', $member->id), $data);

        $this->assertDatabaseHas('members', [
            'firstName' => 'test',
            'lastName' => 'test'
        ]);
    }

    /**
     * @dataProvider dataProvider
     * @test
     */
    public function updateWithPhoto($data)
    {
        $data['photo'] = UploadedFile::fake()->image('avatar.jpg');
        
        $member = Members::inRandomOrder()->first();

        $response = $this->actingAs($this->admin)
            ->put(route('update', $member->id), $data);

        $updatedMember = Members::firstWhere('id', $member->id);

        $this->assertNotEmpty($updatedMember->photo);
        $response->assertRedirect();
    }

    public function dataProvider()
    {
        return [
            [
                [
                    'birthdate' => '2020-01-01',
                    'reportSubject' => 'test',
                    'countryId' => '1',
                    'email' => 'test@test.com',
                    'phone' => '123123123',
                    'firstName' => 'test',
                    'lastName' => 'test'
                ]
            ]
        ];
    }
}
