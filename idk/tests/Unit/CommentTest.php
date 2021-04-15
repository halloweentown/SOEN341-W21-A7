<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class CommentTest extends TestCase
{
    //use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_5()
    {
        $user1 = User::factory()->create();
        $this->actingAs($user1)
            ->visit('/home')
            ->attach('/Users/rohit/Downloads/spiderverse.jpg', 'image')
            ->type('Testing Upload', 'body')
            ->press('Upload')
            ->type('Commenting Test', 'body')
            ->press('Comment')
            ->see('Commenting Test')
            ->seePageIs('/home');
        $this->seeInDatabase('comments',['text'=>'Commenting Test']);
    }
}
