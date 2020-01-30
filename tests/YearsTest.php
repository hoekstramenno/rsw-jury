<?php

namespace Tests;

use App\Models\Year;
use Illuminate\Foundation\Testing\RefreshDatabase;

class YearsTest extends ApiTestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_get_a_year(): void
    {
        factory(Year::class, 2)->create();

        $response = $this->json('GET', $this->apiUrl . 'years');
        $response->assertStatus(200);

        $response = json_decode($response->content(), false);

        static::assertEquals(count($response->data), 2);
    }

    /**
     * @test
     */
    public function it_cannot_validate_if_a_string_is_given(): void
    {
        $response = $this->json(
            'POST', $this->apiUrl . 'years', [
            'data' => [
                'type'       => 'years',
                'attributes' => [
                    'label' => 'This is a string',
                ],
            ],
        ]);

        $response = json_decode($response->content(), true);

        static::assertArrayHasKey('errors', $response);
    }

    /**
     * @test
     */
    public function it_can_create_a_year_with_validated_values(): void
    {
        $response = $this->json(
            'POST', $this->apiUrl . 'years', [
            'data' => [
                'type'       => 'years',
                'attributes' => [
                    'label' => '2020',
                ],
            ],
        ]
        );

        $response->assertStatus(201)
            ->assertJsonFragment(['label' => '2020']);
    }

    /**
     * @test
     */
    public function it_can_update_a_year(): void
    {
        factory(Year::class)->create(['label' => '1996']);

        $response = $this->json(
            'PATCH', $this->apiUrl . 'years/1996', [
            'data' => [
                'type'       => 'years',
                'id'         => '1996',
                'attributes' => [
                    'label' => '2020',
                ],
            ],
        ]
        );

        $response->assertStatus(200)
            ->assertJsonFragment(['label' => '2020']);
    }
}