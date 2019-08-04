<?php

namespace Tests\Feature;

use Tests\PassportTestCase;

class FavoriteTest extends PassportTestCase
{
    /** @test */
    public function store_success()
    {
        $this->userAuth();

        $this->post('api/favorite', [
                'uri' => 'www.google.com/image.gif'
            ])
            ->assertJsonStructure(['shorturl']);
    }

    /** @test */
    public function store_without_uri_fail()
    {
        $this->userAuth();

        $this->post('api/favorite')
            ->assertJsonMissing(['shorturl']);
    }

    /** @test */
    public function get_by_user_id_success()
    {
        $this->userAuth();

        $this->get('/api/favorite/getByUserId')
            ->assertStatus(200);
    }

    /** @test */
    public function get_by_user_id_not_authenticated_fail()
    {
        $this->get('/api/favorite/getByUserId')
            ->assertStatus(500);
    }
}
