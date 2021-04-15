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

class CommentTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_5()
    {
        $user1 = User::factory()->create();
        Storage::fake('avatars');
        $this->actingAs($user1)
            ->visit('/home')
            ->attach(UploadedFile::fake()->image('avatar.jpg'), 'image') //Upload the image using faker
            ->type('Testing Upload', 'body')
            ->press('Upload')
            ->type('Commenting Test', 'body')
            ->press('Comment')
            ->see('Commenting Test')  //Check if comment is found on webpage
            ->seePageIs('/home');
        $this->seeInDatabase('comments',['text'=>'Commenting Test']); //Check if caption is stored in database
    }
}
