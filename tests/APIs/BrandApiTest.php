<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Brand;

class BrandApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_brand()
    {
        $brand = Brand::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/brands', $brand
        );

        $this->assertApiResponse($brand);
    }

    /**
     * @test
     */
    public function test_read_brand()
    {
        $brand = Brand::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/brands/'.$brand->id
        );

        $this->assertApiResponse($brand->toArray());
    }

    /**
     * @test
     */
    public function test_update_brand()
    {
        $brand = Brand::factory()->create();
        $editedBrand = Brand::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/brands/'.$brand->id,
            $editedBrand
        );

        $this->assertApiResponse($editedBrand);
    }

    /**
     * @test
     */
    public function test_delete_brand()
    {
        $brand = Brand::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/brands/'.$brand->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/brands/'.$brand->id
        );

        $this->response->assertStatus(404);
    }
}
