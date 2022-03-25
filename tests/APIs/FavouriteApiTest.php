<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Favourite;

class FavouriteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_favourite()
    {
        $favourite = Favourite::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/favourites', $favourite
        );

        $this->assertApiResponse($favourite);
    }

    /**
     * @test
     */
    public function test_read_favourite()
    {
        $favourite = Favourite::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/favourites/'.$favourite->id
        );

        $this->assertApiResponse($favourite->toArray());
    }

    /**
     * @test
     */
    public function test_update_favourite()
    {
        $favourite = Favourite::factory()->create();
        $editedFavourite = Favourite::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/favourites/'.$favourite->id,
            $editedFavourite
        );

        $this->assertApiResponse($editedFavourite);
    }

    /**
     * @test
     */
    public function test_delete_favourite()
    {
        $favourite = Favourite::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/favourites/'.$favourite->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/favourites/'.$favourite->id
        );

        $this->response->assertStatus(404);
    }
}
