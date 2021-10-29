<?php

namespace Tests\Unit;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * setup and create user instances
     */
    protected function setUp(): void
    {
        parent::setUp();
        $users = User::factory()->count(10)->create();

    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_list()
    {
        $response = $this->get('/api/v1/users');
        $response->assertStatus(200);
        $response->assertJson(fn(AssertableJson $json) => $json->has('data')
            ->count('data', 10)
            ->where('error', '')
        );
    }


    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_correct_create()
    {
        $user = User::factory()->make();
        $response = $this->post('/api/v1/users',
            $user->toArray()
        );
        $response->assertStatus(200);
        $response->assertJson(
            fn(AssertableJson $json) =>
                $json->has('data')
            ->where('error', '')
        );
    }


    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_incorrect_create()
    {
        $response = $this->post('/api/v1/users',
            []
        );
        $response->assertStatus(422);
        $response->assertJson(
            fn(AssertableJson $json) =>
            $json->has('error')
                ->where('data', '')
        );
    }


    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_incorrect_age()
    {
        $user = User::factory()->incorrectAge();
        $response = $this->post('/api/v1/users',
            $user
        );
        $response->assertStatus(422);
        $response->assertJson(
            fn(AssertableJson $json) =>
            $json->has('error')
                ->where('data', '')
        );
    }


    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_incorrect_point()
    {
        $user = User::factory()->incorrectPoint();
        $response = $this->post('/api/v1/users',
            $user
        );
        $response->assertStatus(422);
        $response->assertJson(
            fn(AssertableJson $json) =>
            $json->has('error')
                ->where('data', '')
        );
    }

}
