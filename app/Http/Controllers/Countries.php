<?php


namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

class Countries extends Controller
{

    /**
     * Show the profile for the given user.
     */
    public function getCountries()
    {
        $countries = DB::table('countries');
        echo $countries;
    }

    public function getCountriesForSelect()
    {
        $countries = DB::table('countries')->select('id', 'nome')->get();
        $rets = [];
        foreach($countries as $country)
        {
            $rets[$country->id] = $country->nome;
        }
        return $rets;
    }

    public function updateDataProfile()
    {
        echo 'agiunto';
    }
}