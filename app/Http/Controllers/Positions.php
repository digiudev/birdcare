<?php


namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class Positions extends Controller
{

    /**
     * Show the profile for the given user.
     */
    public function getListOfArea()
    {
        $user = Auth::user()->getAttributes();
        return DB::table('areas')->where('id_user', (int)$user['id'])->get();
    }

    public function editAreas()
    {
        // Costruisco i campi richiesti
        $rules = ['name' => 'required'];

        // Recupero le infromazioni dell'utente
        $user = Auth::user()->getAttributes();

        //  NEW Area
        if($_POST['action']=='create')
        {
            $dati = $_POST['data'][0];

            // Valido i dati
            $valid = $this->validateData($dati, $rules);
            if($valid!==true) return $valid;

            $id = DB::table('areas')->insertGetId(['name' => $dati['name'], 'id_user'=>$user['id']]);
            // Se tutto ok inserisco
            $ret['data'][] = ['name' => $dati['name'], 'DT_RowId' =>   "row_".$id];

            return json_encode($ret);
        }

        // Edit Area
        elseif($_POST['action'] == 'edit')
        {
            $ret = [];

            foreach($_POST['data'] as $k=>$area) {

                // Valido i dati
                $valid = $this->validateData($area, $rules);
                if($valid!==true) return $valid;

                $id = (int)str_replace('row_', '', $k);

                // Se tutto ok modifico
                DB::table('areas')
                    ->where('id', $id)
                    ->update(['name' => $area['name']]);

                $row = ['DT_RowId' => "row_".$id, 'name' => $area['name']];
                $ret['data'][] = $row;
            }

            return json_encode($ret);
        }
        elseif($_POST['action'] == 'remove')
        {
            $ret = [];
            foreach($_POST['data'] as $k=>$area) {

                DB::table('areas')
                    ->where('id', (int)str_replace('row_', '', $k))
                    ->delete();

                $ret['data'] = [];
            }

            return json_encode($ret);
        }
    }

    public function validateData($input, $rules)
    {
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {

            $ret = [];
            $ret['data'] = [];
            foreach($validator->getMessageBag()->getMessages() as $field=>$message)
                $ret['fieldErrors'][] = ['name'=>$field, 'status' => $message];

            return json_encode($ret);
        }
        return true;
    }
    public function getJsonAreas(){

        $lists = $this->getListOfArea();
        $list = [];
        foreach($lists as $area)
        {
            $new = [];
            $new['DT_RowId'] = "row_".$area->id;
            $new['name'] = $area->name;
            $list['data'][] = $new;
        }
        return json_encode($list);
    }

    /**
     * Show the profile for the given user.
     */
    public function getListOfZones()
    {
        $user = Auth::user()->getAttributes();
        $zones =  DB::table('positions')
                        ->join('areas', 'positions.id_area', '=', 'areas.id')
                        ->select('positions.*', 'areas.name as area_name')
            ->where('positions.id_user', (int)$user['id'])
                        ->get();
        return $zones;
    }
    public function getAreaByID($id)
    {
        return DB::table('areas')->where('id', (int)$id)->first();
    }

    public function editZones()
    {
        // Costruisco i campi richiesti
        $rules = ['name' => 'required'];

        // Recupero le infromazioni dell'utente
        $user = Auth::user()->getAttributes();

        //  NEW Area
        if($_POST['action']=='create')
        {
            $dati = $_POST['data'][0];

            // Valido i dati
            $valid = $this->validateData($dati, $rules);
            if($valid!==true) return $valid;

            $id = DB::table('areas')->insertGetId(['name' => $dati['name'], 'id_user'=>$user['id']]);
            // Se tutto ok inserisco
            $ret['data'][] = ['name' => $dati['name'], 'DT_RowId' =>   "row_".$id];

            return json_encode($ret);
        }

        // Edit Area
        elseif($_POST['action'] == 'edit')
        {
            $ret = [];

            foreach($_POST['data'] as $k=>$area) {

                // Valido i dati
                $valid = $this->validateData($area, $rules);
                if($valid!==true) return $valid;

                $id = (int)str_replace('row_', '', $k);

                // Se tutto ok modifico
                DB::table('areas')
                    ->where('id', $id)
                    ->update(['name' => $area['name']]);

                $row = ['DT_RowId' => "row_".$id, 'name' => $area['name']];
                $ret['data'][] = $row;
            }

            return json_encode($ret);
        }
        elseif($_POST['action'] == 'remove')
        {
            $ret = [];
            foreach($_POST['data'] as $k=>$area) {

                DB::table('areas')
                    ->where('id', (int)str_replace('row_', '', $k))
                    ->delete();

                $ret['data'] = [];
            }

            return json_encode($ret);
        }
    }

    public function getJsonZones(){

        $lists = $this->getListOfZones();

        $list = [];
        foreach($lists as $zona)
        {
            $new = [];
            $new['DT_RowId'] = "row_".$zona->id;
            $new['area_name'] = $zona->area_name;
            $new['name'] = $zona->name;
            $list['data'][] = $new;
        }
        return json_encode($list);
    }
}