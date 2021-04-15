<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class FollowTest extends TestCase
{
    //use RefreshDatabase;
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
        $this->actingAs($user1)
            ->visit('/home')
            ->attach('/Users/rohit/Downloads/spiderverse.jpg', 'image')
            ->type('Testing Upload', 'body')
            ->press('Upload')
            ->seePageIs('/home')
            ->see('Testing Upload');
            //->see('/Users/rohit/Downloads/spiderverse.jpg');
        //CHECK FOR IMAGE
        $this->actingAs($user2)
            ->visit('/home')
            ->visit('/follow/1')
            ->seePageIs('/home')
            ->visit('/profile/1')
            ->see('1'); //Update in Followers list
    }

    public function test_9()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $this->actingAs($user1)
            ->visit('/home')
            ->attach('/Users/rohit/Downloads/spiderverse.jpg', 'image')
            ->type('Testing Upload', 'body')
            ->press('Upload')
            ->seePageIs('/home');
        $this->actingAs($user2)
            ->visit('/home')
            ->visit('/follow/1')
            ->seePageIs('/home')
            ->see('Unfollow'); //Check if Follow is now Unfollow
        $this->seeInDatabase('followings',['userFollowing'=>'2','userFollowed'=>'1']); //Here '1' and '2' are the user IDs
    }

    public function test_10()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $this->actingAs($user1)
            ->visit('/home')
            ->attach('/Users/rohit/Downloads/spiderverse.jpg', 'image')
            ->type('Testing Upload', 'body')
            ->press('Upload')
            ->seePageIs('/home');
        $this->actingAs($user2)
            ->visit('/home')
            ->see('Follow')
            ->visit('/follow/1')  //Follow that user
            ->seePageIs('/home');
        $this->seeInDatabase('followings',['userFollowed'=>'1']); //Here '1' is the ID of user1
    }
}

