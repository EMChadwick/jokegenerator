<?php

namespace App\Connectors;

use App\Models\Joke;
use Illuminate\Support\Collection;

class DBJokeAccess implements JokeAccess
{
    // Currently totally unused since we don't persist any joke models
    public function getJokes($amount): Collection {
        $jokes = Joke::inRandomOrder()
             ->limit($amount)
             ->get();

        return $jokes;
    }

}
