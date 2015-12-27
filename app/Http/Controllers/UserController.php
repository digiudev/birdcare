<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Countries;
use Illuminate\Support\Facades\Route;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;


class UserController extends Controller
{

	protected $validationRules = [
		'name'             => 'required',
		'email'            => 'required|email',
		'RNA'              => 'required',
		'id_country'          => 'required'
	];
	/**
	 * Show the profile for the given user.
	 */
	public function showProfile()
	{
		$users = DB::table('prova')->first();
		echo $users->c1;
	}

	/**
	 * Show the edit form for blog post
	 * We create a JsValidator instance based on shared validation rules
	 * @param  string  $post_id
	 * @return Response
	 */
	public function edit($post_id)
	{
		$validator = JsValidator::make($this->validationRules);
		$post = Post::find($post_id);

		return view('sb-admin.userprofile')->with([
			'validator' => $validator,
			'post' => $post
		]);

    }

    public function getValidatorJS(){

        $validator = JsValidator::make([
            'name' => 'required',
            'email'=> 'required|email',
            'RNA'  => 'required',
            'id_country' => 'required'
        ],
            [
                'name' => 'validation.name',
                'email'=> 'validation.email',
                'RNA'  => 'validation.rna',
                'id_country' => 'validation.country'
            ],
            [
                'name' => 'Username',
                'email'=> 'email',
                'RNA' => 'RNA',
                'id_country' => 'Country'
            ],
            '#form-user-profile');
        return $validator;
    }
	public function updateDataProfile()
	{

        // Costruisco i campi richiesti
		$rules = array(
			'name'             => 'required',
			'email'            => 'required|email',
            'RNA'              => 'required',
            'id_country'          => 'required'
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
            $data['id_country'] = Input::get('id_country');
            $data['province'] = Input::get('province');
            $data['city'] = Input::get('city');
            $data['zip'] = Input::get('zip');
            $data['phone'] = Input::get('phone');
            $data['RNA'] = Input::get('RNA');
            $data['breeding_name'] = Input::get('breeding_name');
            $data['geolocalization'] = Input::get('geolocalization');
            $data['visible'] = Input::get('visible');
            DB::table('users')->where('id', Input::get('id'))->update($data);

            // Reindirizzo l'utente nel form
			return Redirect::to('admin/userprofile');

		}
	}
}