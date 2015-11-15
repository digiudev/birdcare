<?php


namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

	/**
	 * Show the profile for the given user.
	 */
	public function showProfile()
	{
		$users = DB::table('prova')->first();
		echo $users->c1;
	}

	public function updateDataProfile()
	{
		echo 'agiunto';
	}
}