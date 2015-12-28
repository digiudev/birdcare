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

    public function updateDataProfile()
    {
        echo 'agiunto';
    }

   /* public static function reverseGeocode($lat, $lon)
    {
        $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" . $lat . "," . $lon . "&sensor=true&language=it";
        $ip = self::getIp();
        $page = Mod_Request::get()->getUrl($url,DEBUG_PROXY);
        $json = json_decode($page, true);
        if ($json['status'] == 'OVER_QUERY_LIMIT')
            return self::LIMIT_IP;

        if ($json['status'] == 'ZERO_RESULTS')
            return self::ZERO_RESULTS;

        return self::decodeReverse($json);
    }
    public function reverseGeo($lat, $lon, $from = '')
    {

        // Mi faccio dare i dati di google riguardo al reverse geocode
        $data = Geo::reverseGeocode($lat, $lon);
        if ($data == Geo::LIMIT_IP)
            return $data;

        // se non mi torna nessun risultato riprovo approssimando le coordinate
        if ($data == Geo::ZERO_RESULTS)
        {
            $latR = round($lat, 2);
            $lonR = round($lon, 2);
            $data = Geo::reverseGeocode($latR, $lonR);
            if ($data == Geo::LIMIT_IP)
                return $data;
            if ($data == Geo::ZERO_RESULTS)
                return $data;
        }
        // Li interpreto
        $tipo = $this->getNazCategory($data['country']);
        if ($tipo == self::NAZ_UNKNOWN)
        {
            /* if($data['country'] == 'Mali' || $data['country']=='Haiti' || $data['country']=='Nuova Zelanda' || $data['country'] == 'Pakistan')
                    return $tipo;*/
        /*    if ($data['country'] == 'Mali')
                return $tipo;
            Util::printr($lat, 'lat');
            Util::printr($lon, 'lon');
            Util::printr($data['country'], 'nazione');
            Util::printr($data, 'data');
            mail('andrea.digiuliantonio@soloaffittivacanze.it', 'Nazione sconosciuta - '.$data['country'], 'Da aggiungere alla lista delle geo');
            mail('sporchiamarco@gmail.com', 'Nazione sconosciuta - '.$data['country'], 'Da aggiungere alla lista delle geo');
            return $tipo;
        }

        $ret = $this->getDataGeoByTypeCountry($data,$tipo);
        $ret['lat'] = $lat;
        $ret['lon'] = $lon;
        $ret['from'] = $from;
        $ret = $this->findMatch($ret);
        return $ret;

    }*/

    private static function decodeReverse($dati)
    {
        $ret = array();
        foreach ($dati['results'] as $result) {
            foreach ($result['address_components'] as $addr)
                foreach ($addr['types'] as $type) {
                    if (($type == 'locality') || ($type == 'administrative_area_level_2') || ($type == 'administrative_area_level_1') || ($type == 'administrative_area_level_3') || ($type == 'postal_code') || ($type == 'country') || ($type == 'postal_town')) {
                        $ret[$type] = $addr['long_name'];
                    }
                }
        }
        return $ret;
    }
}