<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\shoppingCart;

class shoppingCartApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_shopping_cart()
    {
        $shoppingCart = shoppingCart::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/shopping_carts', $shoppingCart
        );

        $this->assertApiResponse($shoppingCart);
    }

    /**
     * @test
     */
    public function test_read_shopping_cart()
    {
        $shoppingCart = shoppingCart::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/shopping_carts/'.$shoppingCart->id
        );

        $this->assertApiResponse($shoppingCart->toArray());
    }

    /**
     * @test
     */
    public function test_update_shopping_cart()
    {
        $shoppingCart = shoppingCart::factory()->create();
        $editedshoppingCart = shoppingCart::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/shopping_carts/'.$shoppingCart->id,
            $editedshoppingCart
        );

        $this->assertApiResponse($editedshoppingCart);
    }

    /**
     * @test
     */
    public function test_delete_shopping_cart()
    {
        $shoppingCart = shoppingCart::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/shopping_carts/'.$shoppingCart->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/shopping_carts/'.$shoppingCart->id
        );

        $this->response->assertStatus(404);
    }
}
