<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserPageTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_8()
    {
        $user1 = User::factory()->create();
        Storage::fake('avatars');
        $image = UploadedFile::fake()->image('avatar.jpg');
        $this->actingAs($user1)
            ->visit('/home')
            ->attach($image, 'image')
            ->type('Testing Upload1', 'body')
            ->press('Upload')
            ->visit('/profile/1') //Visit the User Page
            ->see('Followers')  //Check is Followers  are seen
            ->see('Following');  //Check if Following is seen
            $this->seeInDatabase('posts',['name'=>$user1->name]); // Check If image is Stored
        
    }
}
