<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Features;

class FeaturesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_features()
    {
        $features = Features::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/features', $features
        );

        $this->assertApiResponse($features);
    }

    /**
     * @test
     */
    public function test_read_features()
    {
        $features = Features::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/features/'.$features->id
        );

        $this->assertApiResponse($features->toArray());
    }

    /**
     * @test
     */
    public function test_update_features()
    {
        $features = Features::factory()->create();
        $editedFeatures = Features::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/features/'.$features->id,
            $editedFeatures
        );

        $this->assertApiResponse($editedFeatures);
    }

    /**
     * @test
     */
    public function test_delete_features()
    {
        $features = Features::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/features/'.$features->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/features/'.$features->id
        );

        $this->response->assertStatus(404);
    }
}
