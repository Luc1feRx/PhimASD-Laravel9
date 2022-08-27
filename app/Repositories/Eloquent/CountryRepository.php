<?php

namespace App\Repositories\Eloquent;

use App\Models\Country;
use App\Repositories\CountryInterface;

class CountryRepository extends BaseRepository implements CountryInterface{
    public function getModel(){
        return Country::class;
    }

    public function getCountries(){
        
    }

}