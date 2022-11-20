<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ApiTest extends TestCase
{

    /**
     * Test Get All Countries
     *
     * @return void
     */
    public function test_get_all_countries()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson('/api/countries');

        $response->assertStatus(200);
    }

    /**
     * Test Create Country
     *
     * @return void
     */
    public function test_create_country()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/countries', ['countryCode' => 'BY', 'phoneCode' => '375']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'countryCode' => 'BY',
                    'phoneCode' => '375',
                    'cities' => array()
                ]
            ]);
    }

    /**
     * Test Create Duplicate Country
     *
     * @return void
     */
    public function test_create_duplicate_country()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/countries', ['countryCode' => 'BY', 'phoneCode' => '375']);

        $response
            ->assertStatus(422)
            ->assertJson(['message' => 'The country code has already been taken.']);
    }

    /**
     * Test Create Country Witn Invalid Country Code
     *
     * @return void
     */
    public function test_create_country_with_invalid_country_code()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/countries', ['countryCode' => 'ZZ', 'phoneCode' => '375']);

        $response
            ->assertStatus(422)
            ->assertJson(['message' => 'Invalid country code']);
    }

    /**
     * Test Get Country By ID
     *
     * @return void
     */
    public function test_get_country_by_id()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson('/api/countries/BY');

        $response->assertStatus(200);
    }

    /**
     * Test Get Nonexistent Country
     *
     * @return void
     */
    public function test_get_nonexistent_country()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson('/api/countries/ZZ');

        $response
            ->assertStatus(404)
            ->assertJson(['message' => 'Record not found.']);
    }

    /**
     * Test Change Country
     *
     * @return void
     */
    public function test_change_country()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->patchJson('/api/countries/BY', ['phoneCode' => '376']);

        $response->assertStatus(200);
    }

    /**
     * Test Change Country With Invalid Phone Code
     *
     * @return void
     */
    public function test_change_country_witn_invalid_phone_code()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->patchJson('/api/countries/BY', ['phoneCode' => 'zzz']);

        $response
            ->assertStatus(422)
            ->assertJson(['message' => 'The phone code must be a number.']);
    }

    /**
     * Test Create City By Country
     *
     * @return void
     */
    public function test_create_city_by_country()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/countries/BY/cities', ['id' => '1', 'name' => 'Minsk']);
                
        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'Minsk'
                ]
            ]);
    }

    /**
     * Test Create City By Country Without Name
     *
     * @return void
     */
    public function test_create_city_by_country_without_name()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->postJson('/api/countries/BY/cities', []);
                
        $response
            ->assertStatus(422)
            ->assertJson(['message' => 'The name field is required.']);
    }

    /**
     * Test Get City By ID
     *
     * @return void
     */
    public function test_get_city_by_id()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson('/api/cities/1');

        $response->assertStatus(200);
    }

    /**
     * Test Change City
     *
     * @return void
     */
    public function test_change_city()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->patchJson('/api/cities/1', ['name' => 'Brest']);

        $response->assertStatus(200);
    }

    /**
     * Test Delete City
     *
     * @return void
     */
    public function test_delete_city()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->deleteJson('/api/cities/1');

        $response->assertStatus(200);
    }


    /**
     * Test Delete Country
     *
     * @return void
     */
    public function test_delete_country()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->deleteJson('/api/countries/BY');

        $response->assertStatus(200);
    }
}
