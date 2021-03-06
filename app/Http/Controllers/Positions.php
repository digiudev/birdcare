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

    public function getListOfPosition()
    {
        $user = Auth::user()->getAttributes();
        return DB::table('positions')->where('id_user', (int)$user['id'])->get();
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

    public function getPositionByID($id)
    {
        return DB::table('positions')->where('id', (int)$id)->first();
    }

    public function editZones()
    {
        // Costruisco i campi richiesti
        $rules = ['id_area' => 'required', 'name' => 'required'];

        // Recupero le infromazioni dell'utente
        $user = Auth::user()->getAttributes();

        //  NEW Area
        if($_POST['action']=='create')
        {
            $dati = $_POST['data'][0];

            // Valido i dati
            $valid = $this->validateData($dati, $rules);
            if($valid!==true) return $valid;

            $id = DB::table('positions')->insertGetId(['name' => $dati['name'], 'id_area'=>$dati['id_area'], 'id_user'=>$user['id']]);

            $area = $this->getAreaByID($dati['id_area']);

            // Se tutto ok inserisco
            $ret['data'][] = ['name' => $dati['name'], 'area_name' => $area->name, 'DT_RowId' =>   "row_".$id];

            return json_encode($ret);
        }

        // Edit Area
        elseif($_POST['action'] == 'edit')
        {
            $ret = [];

            foreach($_POST['data'] as $k=>$dati) {

                // Valido i dati
                $valid = $this->validateData($dati, $rules);
                if($valid!==true) return $valid;

                $id = (int)str_replace('row_', '', $k);

                $area = $this->getAreaByID($dati['id_area']);

                // Se tutto ok modifico
                DB::table('positions')
                    ->where('id', $id)
                    ->update(['name' => $dati['name'], 'id_area' => $dati['id_area']]);

                $row = ['DT_RowId' => "row_".$id, 'name' => $dati['name'], 'area_name' => $area->name];
                $ret['data'][] = $row;
            }

            return json_encode($ret);
        }
        elseif($_POST['action'] == 'remove')
        {
            $ret = [];
            foreach($_POST['data'] as $k=>$dato) {

                DB::table('positions')
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

    public function getJsonAreasForInsert($json = true){

        $lists = $this->getListOfArea();

        $list = [];
        foreach($lists as $area)
        {
            $new = [];
            $new['label'] = $area->name;
            $new['value'] = $area->id;
            $list[] = $new;
        }

        // inserisco ance il record vuoto
        $list[] = ['label'=>'- Seleziona -', 'value' => 0];
        if($json)
            return json_encode($list);
        return $list;
    }

    public function getJsonPositionForInsert($json = true){

        $lists = $this->getListOfPosition();

        $list = [];
        $list['areas'] = $this->getJsonAreasForInsert(false);

        foreach($lists as $position)
        {
            $new = [];
            $new['label'] = $position->name;
            $new['value'] = $position->id;
            $list['positions'][] = $new;
        }

        // inserisco ance il record vuoto
        $list['positions'][] = ['label'=>'- Seleziona -', 'value' => 0];

        if($json)
            return json_encode($list);
        return $list;
    }

    public function getAllDataByPositionID($idPosition)
    {
        $ret = [];

        if($idPosition>0) {
            $posizione = app('App\Http\Controllers\Positions')->getPositionByID((int)$idPosition);
            if($posizione!==null)
            {
                $ret['position']['id'] = $posizione->id;
                $ret['position']['name'] = $posizione->name;
                $area = app('App\Http\Controllers\Positions')->getAreaByID($posizione->id_area);
                $ret['area']['id'] = $area->id;
                $ret['area']['name'] = $area->name;
            }
        }

        if(sizeof($ret)==0) {
            $ret['position']['id'] = 0;
            $ret['position']['name'] = '';
            $ret['area']['id'] = 0;
            $ret['area']['name'] = '';
        }
        return $ret;
    }
}