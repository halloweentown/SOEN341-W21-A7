<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Filesystem\Filesystem;
use FILE;

class ImagePostTest extends TestCase
{
    //use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_3()
    {
        $user1 = User::factory()->create();
        $this->actingAs($user1)
            ->visit('/home')
            ->attach('/Users/rohit/Downloads/spiderverse.jpg', 'image')
            ->type('Testing Upload', 'body')
            ->press('Upload')
            ->seePageIs('/home')
            ->see('Testing Upload');
            //->see('/Users/rohit/Downloads/spiderverse.jpg');
        //CHECK FOR IMAGE
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
        $this->actingAs($user1)
            ->visit('/home')
            ->attach('/Users/rohit/Downloads/spiderverse.jpg', 'image')
            ->type('Testing Upload', 'body')
            ->press('Upload')
            ->seePageIs('/home')
            ->see('Testing Upload');
        $this->actingAs($user2)
            ->visit('/home')
            ->see('Testing Upload');
            //->see('/Users/rohit/Downloads/spiderverse.jpg');
        //CHECK FOR IMAGE FROM USER2
    }
}
