<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelFactoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIssueCreation()
    {
        factory(User::class)->create([
            'name' => 'Tester'
        ]);

        $this->assertDatabaseHas('users', ['name' => 'Tester']);
    }
}


