<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Models\Country;

class CountryController extends Controller
{
    public function getAllCountries()
    {
        return response()->json(Country::all());
    }
}
