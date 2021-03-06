<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Address;

class AddressApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_address()
    {
        $address = Address::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/addresses', $address
        );

        $this->assertApiResponse($address);
    }

    /**
     * @test
     */
    public function test_read_address()
    {
        $address = Address::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/addresses/'.$address->id
        );

        $this->assertApiResponse($address->toArray());
    }

    /**
     * @test
     */
    public function test_update_address()
    {
        $address = Address::factory()->create();
        $editedAddress = Address::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/addresses/'.$address->id,
            $editedAddress
        );

        $this->assertApiResponse($editedAddress);
    }

    /**
     * @test
     */
    public function test_delete_address()
    {
        $address = Address::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/addresses/'.$address->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/addresses/'.$address->id
        );

        $this->response->assertStatus(404);
    }
}
