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

class FollowTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_7()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        Storage::fake('avatars');
        $this->actingAs($user1)
            ->visit('/home')
            ->attach(UploadedFile::fake()->image('avatar.jpg'), 'image')  //Upload the image using faker
            ->type('Testing Upload', 'body')
            ->press('Upload');
        $this->actingAs($user2)
            ->visit('/home')
            ->visit('/follow/1') //Click follow
            ->seePageIs('/home')
            ->visit('/profile/1')  //Visit user page
            ->see('1'); //Update in Followers list on User Page
    }

    public function test_9()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        Storage::fake('avatars');
        $this->actingAs($user1)
            ->visit('/home')
            ->attach(UploadedFile::fake()->image('avatar.jpg'), 'image')
            ->type('Testing Upload', 'body')
            ->press('Upload');
        $this->actingAs($user2)
            ->visit('/home')
            ->visit('/follow/1')
            ->seePageIs('/home')
            ->see('Unfollow'); //Check if Follow has been updated to Unfollow
    }

    public function test_10()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        Storage::fake('avatars');
        $this->actingAs($user1)
            ->visit('/home')
            ->attach(UploadedFile::fake()->image('avatar.jpg'), 'image')
            ->type('Testing Upload', 'body')
            ->press('Upload');
        $this->actingAs($user2)
            ->visit('/home')
            ->see('Follow')
            ->visit('/follow/1')  //Follow that user
            ->seePageIs('/home');
        $this->seeInDatabase('followings',['userFollowed'=>'1']); //Here '1' is the ID of user1
    }
}

