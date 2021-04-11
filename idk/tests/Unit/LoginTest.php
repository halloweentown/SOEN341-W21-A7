<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUserLoginSuccess()
    {
        //$response = $this->get('/login');
        //$response->assertSuccessful();
       // $response->assertViewIs('auth.login');
        
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/Login');
        $response->assertRedirect('/home');

    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'hellotest'),
        ]);

        $response = $this->post('/Login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_incorrect_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'hellotest'),
        ]);

        $response = $this->post('/Login', [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

}