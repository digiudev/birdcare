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

    public function getJsonCages(){

        $lists = $this->getListOfCages();

        $list = [];
        foreach($lists as $cage)
        {
            $nomePosizione = $nomeArea = '';
            if($cage->id_position>0) {
                $posizione = app('App\Http\Controllers\Positions')->getPositionByID($cage->id_position);
                if($posizione!==null)
                {
                    $nomePosizione = $posizione->name;
                    $area = app('App\Http\Controllers\Positions')->getAreaByID($posizione->id_area);
                    $nomeArea = $area->name;
                }

            }
            $new = [];
            $new['DT_RowId'] = "row_".$cage->id;
            $new['name'] = $cage->cage_name;
            $new['area_name'] = $nomeArea;
            $new['position_name'] = $nomePosizione;
            $list['data'][] = $new;
        }
        return json_encode($list);
    }
}