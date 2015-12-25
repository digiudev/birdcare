<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;


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

        // Costruisco i campi richiesti
		$rules = array(
			'name'             => 'required',
			'email'            => 'required|email',
            'RNA'              => 'required',
            'idCountry'          => 'required'
        );

		// Inizializzo il validator con tutti i campi del form e le regole
		$validator = Validator::make(Input::all(), $rules);

		// Se il validator fallisce
		if ($validator->fails()) {

			// Reindirizzo l'utente nel form e a video mostro gli errori
			return Redirect::to('admin/userprofile')
				->withErrors($validator);

		}
        // Se il validator va a buon fine
        else {

			// Aggiorno i dati del DB
            $data = [];
            $data['name'] = Input::get('name');
            $data['email'] = Input::get('email');
            $data['idCountry'] = Input::get('idCountry');
            $data['province'] = Input::get('province');
            $data['city'] = Input::get('city');
            $data['cap'] = Input::get('cap');
            $data['telefono'] = Input::get('telefono');
            $data['RNA'] = Input::get('RNA');
            $data['nome_allevamento'] = Input::get('nome_allevamento');
            $data['geolocalizzazione'] = Input::get('geolocalizzazione');
            $data['visibile'] = Input::get('visibile');
            DB::table('users')->where('id', Input::get('id'))->update($data);

            // Reindirizzo l'utente nel form
			return Redirect::to('admin/userprofile');

		}
	}
}