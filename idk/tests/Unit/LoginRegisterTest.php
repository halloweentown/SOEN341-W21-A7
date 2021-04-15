<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class LoginRegisterTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_1()
    {
        Storage::fake('avatars');
        $this->visit('/register')
            ->type('User 1', 'name')  //Input the required information to create user
            ->type('test1@test.com', 'email')
            ->type('testtest', 'password')
            ->type('testtest', 'password_confirmation')
            ->attach(UploadedFile::fake()->image('avatar.jpg'), 'image')  //Upload profile photo
            ->press('Register')
            ->seePageIs('/home');
    }

    public function test_2()
    {
        $user1 = User::factory()->create(['email'=>'test@test.com','password'=>'testtest']);
        $this->visit('/login')  
            ->type($user1->email, 'email')  //Input credentials
            ->type($user1->password, 'password')
            ->press('Login')
            ->seePageIs('/login');
    }
}
