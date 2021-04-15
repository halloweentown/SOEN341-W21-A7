<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ImagePostTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_3()
    {
        $user1 = User::factory()->create();
        Storage::fake('avatars');
        $this->actingAs($user1)
            ->visit('/home')
            ->attach(UploadedFile::fake()->image('avatar.jpg'), 'image')  //Upload image
            ->type('Testing Upload', 'body')  //Add caption
            ->press('Upload')
            ->seePageIs('/home')
            ->see('Testing Upload');  //See if caption is found
        $this->seeInDatabase('posts',['name'=>$user1->name]);  //see if image is stored
    }
    public function test_4()
    {
        $user1 = User::factory()->create();
        $this->actingAs($user1)
            ->visit('/home')
            ->type('Upload Attempt wihout Image and Only Caption', 'body')
            ->press('Upload')
            ->seePageIs('/home')
            ->assertViewMissing('Upload Attempt wihout Image and Only Caption');
            
    }

    public function test_6()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        Storage::fake('avatars');
        $this->actingAs($user1)
            ->visit('/home')
            ->attach(UploadedFile::fake()->image('avatar.jpg'), 'image')
            ->type('Testing Upload', 'body')
            ->press('Upload')
            ->seePageIs('/home')
            ->see('Testing Upload');
        $this->actingAs($user2)
            ->visit('/home')
            ->see('Testing Upload'); //Caption Found
        $this->seeInDatabase('posts',['name'=>$user1->name]);  //Image stored
        
    }
}
