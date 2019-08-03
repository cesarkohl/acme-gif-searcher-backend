<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
//    use RefreshDatabase;
//    use DatabaseTransactions;
    use DatabaseMigrations;

    public function testLoginFormDisplayed()
    {
        $user = factory(User::class)->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $response->assertJson([
            "token_type" => "Bearer"
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function it_gets_the_unit()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        //create password grant client
        $this->artisan('passport:client', ['--password' =>true, '--no-interaction' => true, '--name'=>'test client']);

        // fetch client for id and secret
        $client = \DB::table('oauth_clients')->where('password_client', 1)->first();
        print_r($client); exit;

        $this->json('GET', '/api/logout/')
            ->assertOk();
//            ->seeJsonContains(['id' =>  '!BA']);
    }

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
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $this->post('/api/login', [
                'email' => $user->email,
                'password' => 'password',
            ])
            ->assertJson([
                "token_type" => "Bearer"
            ]);
    }

    /** @test */
    public function login_wrong_password_fail()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $this->post('/api/login', [
                'email' => $user->email,
                'password' => 'password-INVALID',
            ])
            ->assertJson([
                "message" => "Unauthorized"
            ]);
    }

    public function test_logout()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_account()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    ////

    public function test_user_can_login_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $this->artisan('config:cache');

//        $this->actingAs($user)
//            ->post('/api/login', [
//                'email' => $user->email,
//                'password' => $password,
//            ])
//            ->assertJson([
//                "token_type" => "Bearer"
//            ]);
//
//        $this->assertAuthenticatedAs($user);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);
        $this->assertAuthenticatedAs($user);
    }

    public function testExample2()
    {
        $this->assertTrue(true);
    }

    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
