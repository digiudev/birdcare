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
}