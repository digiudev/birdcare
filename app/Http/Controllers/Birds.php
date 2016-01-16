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
           ->where('id_user', $user->id)->get();
       foreach($birds as $bird)
       {
           $bird->rna_padre = $this->getRnaByID($bird->id_padre);
           $bird->rna_madre = $this->getRnaByID($bird->id_madre);;
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
}