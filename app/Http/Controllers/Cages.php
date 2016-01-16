<?php


namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class Cages extends Controller
{

    /**
     * Show the profile for the given user.
     */
    public function getListOfCages()
    {
        $user = Auth::user()->getAttributes();
        return DB::table('cages')->where('id_user', (int)$user['id'])->get();
    }

    public function editCages()
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

            $dataInsert = [
                'cage_name' => $dati['name'],
                'id_user' => $user['id'],
                'id_position' => (int)$dati['id_position']
            ];
            $id = DB::table('cages')->insertGetId($dataInsert);

            $posizione = app('App\Http\Controllers\Positions')->getAllDataByPositionID($dati['id_position']);
            // Se tutto ok inserisco
            $ret['data'][] = [
                'name' => $dati['name'],
                'area_name' => $posizione['area']['name'],
                'position_name' => $posizione['position']['name'],
                'DT_RowId' =>   "row_".$id
            ];

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
                DB::table('cages')
                    ->where('id', $id)
                    ->update([
                        'cage_name' => $area['name'],
                        'id_position' => $area['id_position'],
                    ]);

                $posizione = app('App\Http\Controllers\Positions')->getAllDataByPositionID($area['id_position']);
                $ret['data'][] = [
                    'name' => $area['name'],
                    'area_name' => $posizione['area']['name'],
                    'position_name' => $posizione['position']['name'],
                    'DT_RowId' =>   "row_".$id
                ];
            }

            return json_encode($ret);
        }
        elseif($_POST['action'] == 'remove')
        {
            $ret = [];
            foreach($_POST['data'] as $k=>$area) {

                DB::table('cages')
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

    public function getJsonCages(){

        $lists = $this->getListOfCages();

        $list = [];
        foreach($lists as $cage)
        {
            $posizione = app('App\Http\Controllers\Positions')->getAllDataByPositionID($cage->id_position);
            $new = [];
            $new['DT_RowId'] = "row_".$cage->id;
            $new['name'] = $cage->cage_name;
            $new['id_area'] = $posizione['area']['id'];
            $new['area_name'] = $posizione['area']['name'];
            $new['id_position'] = $posizione['position']['id'];
            $new['position_name'] = $posizione['position']['name'];
            $list['data'][] = $new;
        }
        return json_encode($list);
    }
}