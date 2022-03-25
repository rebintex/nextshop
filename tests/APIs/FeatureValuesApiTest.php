<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\FeatureValues;

class FeatureValuesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_feature_values()
    {
        $featureValues = FeatureValues::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/feature_values', $featureValues
        );

        $this->assertApiResponse($featureValues);
    }

    /**
     * @test
     */
    public function test_read_feature_values()
    {
        $featureValues = FeatureValues::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/feature_values/'.$featureValues->id
        );

        $this->assertApiResponse($featureValues->toArray());
    }

    /**
     * @test
     */
    public function test_update_feature_values()
    {
        $featureValues = FeatureValues::factory()->create();
        $editedFeatureValues = FeatureValues::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/feature_values/'.$featureValues->id,
            $editedFeatureValues
        );

        $this->assertApiResponse($editedFeatureValues);
    }

    /**
     * @test
     */
    public function test_delete_feature_values()
    {
        $featureValues = FeatureValues::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/feature_values/'.$featureValues->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/feature_values/'.$featureValues->id
        );

        $this->response->assertStatus(404);
    }
}
