<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OrderProduct;

class OrderProductApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_order_product()
    {
        $orderProduct = OrderProduct::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/order_products', $orderProduct
        );

        $this->assertApiResponse($orderProduct);
    }

    /**
     * @test
     */
    public function test_read_order_product()
    {
        $orderProduct = OrderProduct::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/order_products/'.$orderProduct->id
        );

        $this->assertApiResponse($orderProduct->toArray());
    }

    /**
     * @test
     */
    public function test_update_order_product()
    {
        $orderProduct = OrderProduct::factory()->create();
        $editedOrderProduct = OrderProduct::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/order_products/'.$orderProduct->id,
            $editedOrderProduct
        );

        $this->assertApiResponse($editedOrderProduct);
    }

    /**
     * @test
     */
    public function test_delete_order_product()
    {
        $orderProduct = OrderProduct::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/order_products/'.$orderProduct->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/order_products/'.$orderProduct->id
        );

        $this->response->assertStatus(404);
    }
}
