<?php

namespace Tests\Feature;

use App\Shorturl;
use Tests\PassportTestCase;

class ShorturlTest extends PassportTestCase
{
    /** @test */
    public function store_success()
    {
        $this->userAuth();

        $this->post('/api/shorturl', [
                'uri' => 'https://www.google.com',
            ])
            ->assertJsonStructure(["uri_code"]);
    }

    /** @test */
    public function store_without_uri_fail()
    {
        $this->userAuth();

        $this->post('/api/shorturl')
            ->assertJsonStructure(["errors"]);
    }

    /** @test */
    public function redirect_success()
    {
        $this->shorturl = factory(Shorturl::class)->create();

        $this->get('/r/'.$this->shorturl->code)
            ->assertStatus(302);
    }

    /** @test */
    public function redirect_fail()
    {
        $code = 'invalid_code';

        $this->get('/r/'.$code)
            ->assertJson([
                'message' => 'Invalid code'
            ]);
    }
}
