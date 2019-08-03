<?php

namespace Tests\Feature;

use App\User;
use Tests\PassportTestCase;

class AuthTest extends PassportTestCase
{
    /** @test */
    public function sign_up_success()
    {
        $this->post('/api/signup', [
                'name' => 'Tester',
                'email' => 'tester@tester.com',
                'password' => 'tester',
                'password_confirmation' => 'tester'
            ])
            ->assertJson([
                "message" => "Signed up successfully"
            ]);
    }

    /** @test */
    public function sign_up_without_email_fail()
    {
        $this->post('/api/signup', [
                'name' => 'Tester',
//                'email' => 'tester@tester.com',
                'password' => 'tester',
                'password_confirmation' => 'tester'
            ])
            ->assertJson([
                "message" => "The given data was invalid."
            ]);
    }

    /** @test */
    public function login_success()
    {
        $user = $this->userAuth();
        $this->assertAuthenticatedAs($user);

        $this
            ->post('/api/login', [
                'email' => $user->email,
                'password' => 'password'
            ])
            ->assertJson([
                "token_type" => "Bearer"
            ])
            ->assertStatus(200);
    }

    /** @test */
    public function login_wrong_password_fail()
    {
        $user = $this->userAuth();
        $this->assertAuthenticatedAs($user);

        $this->post('/api/login', [
                'email' => $user->email,
                'password' => 'password-INVALID',
            ])
            ->assertJson([
                "message" => "Unauthorized"
            ]);
    }

    public function test_logout_success()
    {
        $user = $this->userAuth();
        $this->assertAuthenticatedAs($user);

        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
