<?php

namespace Tests\Http\Controllers;

use App\Models\Year;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        factory(Year::class)->create(
            [
                'label' => '2019',
            ]
        );

    }

    /**
     * @test
     */
    public function it_can_show_dashboard_for_a_year(): void
    {
        $response = $this->get('/dashboard/2019');

        $response->assertSee(2019);
        $response->assertStatus(200);
    }
}
