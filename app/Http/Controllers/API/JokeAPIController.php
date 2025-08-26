<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use App\Connectors\JokeAccess;

class JokeAPIController
{
    protected JokeAccess $jokeProvider;

    public function __construct(JokeAccess $jokeProvider)
    {
        $this->jokeProvider = $jokeProvider;
    }
    public function getJokes(): JsonResponse
    {
        // This could be modified to take a query parameter to set the number of jokes, but the spec says 3.
        $jokes = $this->jokeProvider->getJokes(3);
        
        return new JsonResponse($jokes, 200);
    }

}