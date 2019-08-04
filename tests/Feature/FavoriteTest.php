<?php

namespace Tests\Feature;

use App\Favorite;
use App\Http\Controllers\Api\FavoriteController;
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
    public function store_without_auth_fail()
    {
        $this->userAuth();

        $this->post('api/favorite')
            ->assertJsonMissing(['shorturl']);
    }

    /** @test */
    public function delete_success()
    {
        $this->userAuth();

        $favorite = $this->post('api/favorite', [
            'uri' => 'www.google.com/image.gif'
        ]);

        $this->delete('api/favorite/' . $favorite->getData()->id)
            ->assertJson([
                'message' => 'Deleted successfully'
            ]);
    }

    /** @test */
    public function delete_wrong_id_fail()
    {
        $this->userAuth();

        $this->delete('api/favorite/999')
            ->assertJson([
                'message' => 'Does not exist'
            ]);
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
