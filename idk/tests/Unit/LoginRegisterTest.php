<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class LoginRegisterTest extends TestCase
{
    //use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_1()
    {
        $this->visit('/register')
            ->type('User 1', 'name')
            ->type('test1@test.com', 'email')
            ->type('testtest', 'password')
            ->type('testtest', 'password_confirmation')
            ->attach('/Users/rohit/Downloads/222467.jpg', 'avatar')
            ->press('Register')
            ->seePageIs('/home');
    }

    public function test_2()
    {
        $this->visit('/login')
            ->type('test@test.com', 'email')
            ->type('hellohello', 'password')
            ->press('Login')
            ->seePageIs('/login');
    }
}
