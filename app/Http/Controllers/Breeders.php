<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Breeders extends Controller
{

   public function getListBreeders()
   {
       $list = [];
       $breeders = DB::table('settings')->select('id_user')->where('visible', 1)->get();
       foreach($breeders as $user)
       {
            $userController = new UserController();
            $list[] = $userController->getDataProfile($user->id_user);
       }
       return $list;
   }
}