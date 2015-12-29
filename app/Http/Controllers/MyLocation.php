<?php


namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyLocation extends Controller
{

    /**
     * Show the profile for the given user.
     */
    public function myLocation()
    {
        if(isset($_POST['lat'], $_POST['lng'])) {
            $lat = $_POST['lat'];
            $lng = $_POST['lng'];

            $url = sprintf("https://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s", $lat, $lng);

            $content = file_get_contents($url); // get json content

            $metadata = json_decode($content, true); //json decoder

            if(count($metadata['results']) > 0) {

                $result = $this->decodeReverse($metadata);
                app('App\Http\Controllers\UserController')->updateUserWithLocation($result);
                // save it in db for further use
                //echo $result['formatted_address'];
                return json_encode(Auth::user()->getAttributes());
            }
            else {
                // no results returned
            }
        }
    }

    private static function decodeReverse($dati)
    {
        $ret = array();
        foreach ($dati['results'] as $result) {
            foreach ($result['address_components'] as $addr)
                foreach ($addr['types'] as $type) {
                    if (($type == 'locality') || ($type == 'administrative_area_level_2') || ($type == 'administrative_area_level_1') || ($type == 'administrative_area_level_3') || ($type == 'postal_code') || ($type == 'country') || ($type == 'postal_town') || ($type == 'route') || ($type == 'street_number')) {
                        $ret[$type] = $addr['long_name'];
                    }
                }
        }
        return $ret;
    }
}