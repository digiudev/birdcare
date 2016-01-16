<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Birds extends Controller
{

   public function getListUserBirds()
   {
       $user = Auth::user();
       $birds =  DB::table('birds')
           ->where('birds.id_user', $user->id)
           ->join('cages', 'birds.id_cage', '=', 'cages.id')
           ->join('specie', 'birds.id_specie', '=', 'specie.id')
           ->join('generi', 'specie.id_genere', '=', 'generi.id')->get();
       foreach($birds as $bird)
       {
           $bird->rna_padre = $this->getRnaByID($bird->id_padre);
           $bird->rna_madre = $this->getRnaByID($bird->id_madre);

           // Todo: dovrei mettere una impostazione per il formato data
           if($bird->date_born>0) $bird->date_born = date('Y-d-m', $bird->date_born);
           if($bird->date_sale>0) $bird->date_sale = date('Y-d-m', $bird->date_sale);
       }
       return $birds;
   }

    public function getRnaByID($id)
    {
        $bird =  DB::table('birds')->select('number')->where('id', $id)->first();
        if($bird!==null)
            return $bird->number;
        return '';
    }

    public function getjsonListUserBirds(){

        $lists = $this->getListUserBirds();

        $list = [];
        foreach($lists as $bird)
        {
            $new = [];
            $new['DT_RowId'] = "row_".$bird->id;
            $new['number'] = $bird->number;
            $new['sex'] = $bird->sex;
            $new['genere_specie'] = $bird->genere.'<br />'.$bird->specie;
            $new['rna_padre'] = $bird->rna_padre;
            $new['rna_madre'] = $bird->rna_madre;
            $new['cage_name'] = $bird->cage_name;
            $new['date_born'] = $bird->date_born;
            $new['date_sale'] = $bird->date_sale;
            $new['note'] = $bird->note;
            $list['data'][] = $new;
        }
        return json_encode($list);
    }
}