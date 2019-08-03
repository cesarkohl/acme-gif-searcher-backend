<?php

namespace Tests\Feature;

use Tests\PassportTestCase;

class SearchTest extends PassportTestCase
{
    /** @test */
    public function index_success()
    {
        $this->userAuth();

        $this->get('/api/search?keyword=test')
            ->assertJsonMissing([
                "message" => "The given data was invalid."
            ]);
    }

    /** @test */
    public function index_without_keyword_fail()
    {
        $this->userAuth();

        $this->get('/api/search')
            ->assertJson([
                "message" => "The given data was invalid."
            ]);
    }

    /** @test */
    public function get_by_user_id_success()
    {
        $this->userAuth();

        $this->get('/api/search/getByUserId')
            ->assertStatus(200);
    }

    /** @test */
    public function get_by_user_id_not_authenticated_fail()
    {
        $this->get('/api/search/getByUserId')
            ->assertStatus(500);
    }
}
