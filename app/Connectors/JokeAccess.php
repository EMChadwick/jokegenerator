<?php

namespace App\Connectors;
use Illuminate\Support\Collection;

interface JokeAccess 
{
    
    public function getJokes($amount):Collection;

}
