<?php

namespace App\Connectors;

use Illuminate\Support\Facades\Http;
use App\Models\Joke;
use Illuminate\Support\Collection;

class APIJokeAccess implements JokeAccess
{
    
    public function getJokes($amount):Collection {
        // Hardcoded the URL here, but can always put this in .env or in secrets if it were a larger project
        $response = Http::get('https://official-joke-api.appspot.com/jokes/programming/ten');

        // Handle failed joke fetching
        if ($response->failed()) {
        return collect();
        }

        $jokes = $response->json();
        //Here, we always
        $randomJokes = collect($jokes)->random($amount);
        // The returned data contains IDs, so if we wanted to persist these, we'd want to remove them.
        $jokeData = $randomJokes->map(function ($joke) {
            return [
                'setup'     => $joke['setup'],
                'punchline' => $joke['punchline'],
            ];
        });

        $jokeModels = Joke::hydrate($jokeData->toArray());
        return $jokeModels;
    }

}
