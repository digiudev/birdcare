<?php


namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user()->getAttributes();
        if($_POST['action']=='create')
        {
            $dati = $_POST['data'][0];

            $ret['data'][] = ['name' => $dati['name'], 'DT_RowId' =>   "row_".DB::table('areas')->count()];
            DB::table('areas')->insert(['name' => $dati['name'], 'id_user'=>$user['id']]);
            return json_encode($ret);
        }
        elseif($_POST['action'] == 'edit')
        {
            $areas = $ret = [];
            foreach($_POST['data'] as $k=>$area) {
                $dato = [];
                $dato['id'] = (int)str_replace('row_', '', $k);
                $dato['name'] = $area['name'];
                $areas[] = $dato;
            }

            foreach($areas as $area) {
                DB::table('areas')
                    ->where('id', $area['id'])
                    ->update(['name' => $area['name']]);

                $row = ['DT_RowId' => "row_".$area['id'], 'name' => $area['name']];
                $ret['data'][] = $row;
            }
            return json_encode($ret);
        }
        elseif($_POST['action'] == 'remove')
        {
            $areas = $ret = [];
            foreach($_POST['data'] as $k=>$area) {
                $dato = [];
                $dato['id'] = (int)str_replace('row_', '', $k);
                $areas[] = $dato;
            }
            foreach($areas as $area) {
                DB::table('areas')
                    ->where('id', $area['id'])
                    ->delete();

                $ret['data'] = [];
            }

            return json_encode($ret);
        }
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
}