<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Connectors\JokeAccess;
use App\Http\Controllers\Controller;

class JokePageController extends Controller
{
    protected JokeAccess $jokeProvider;

    public function __construct(JokeAccess $jokeProvider)
    {
        $this->jokeProvider = $jokeProvider;
    }

    public function __invoke()
    {
        $jokes = $this->jokeProvider->getJokes(3);

        return Inertia::render('Jokes', [
            'jokes' => $jokes
        ]);
    }
}