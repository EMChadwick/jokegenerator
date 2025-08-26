<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Connectors\APIJokeAccess;
use Illuminate\Support\Facades\Http;

/**
 * Unit test for the ApiJokeAccess class.
 * 
 * This tests that the class returns a collection of Joke models
 * and handles API failures.
 */
class ApiJokeAccessTest extends TestCase
{
    public function test_get_jokes_returns_collection_of_joke_models()
    {
        // Mock the external API response so we aren't dependent on the real one
        Http::fake([
            'official-joke-api.appspot.com/*' => Http::response([
                ['setup' => 'Test Setup 1', 'punchline' => 'Test Punchline 1'],
                ['setup' => 'Test Setup 2', 'punchline' => 'Test Punchline 2'],
                ['setup' => 'Test Setup 3', 'punchline' => 'Test Punchline 3'],
                ['setup' => 'Test Setup 4', 'punchline' => 'Test Punchline 4'],
                ['setup' => 'Test Setup 5', 'punchline' => 'Test Punchline 5'],
            ], 200)
        ]);

        $provider = new APIJokeAccess();
        $jokes = $provider->getJokes(3);

        $this->assertNotEmpty($jokes);
        $this->assertCount(3, $jokes);
    }

    public function test_get_jokes_returns_empty_collection_on_failure()
    {
        Http::fake([
            'official-joke-api.appspot.com/*' => Http::response([], 500)
        ]);

        $provider = new APIJokeAccess();
        $jokes = $provider->getJokes(3);

        $this->assertEmpty($jokes);
    }
}