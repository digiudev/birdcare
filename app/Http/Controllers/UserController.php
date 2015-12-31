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
use Illuminate\Support\Facades\Auth;
use App\Library\DiGiuDevForm;


class UserController extends Controller
{

	protected $idUser = null;
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
	 * @return Response
	 */
	public function editProfile()
	{
		$user = Auth::user();

		$blnGeo = true;
		// se non ho le informazioni sulla geo
		if($user->id_country!='' && $user->id_country>0)
			$blnGeo = false;

		return [
			'getLocation' => $blnGeo,
			'user' => $user,
			'validator' => $this->getValidatorJS(),
			'countries' => app('App\Http\Controllers\Countries')->getCountriesForSelect()
		];

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
			$data['address'] = Input::get('address');
            DB::table('users')->where('id', Input::get('id'))->update($data);

            // Reindirizzo l'utente nel form
			return Redirect::to('admin/userprofile');

		}
	}

	public function updateUserWithLocation($location){

		$datiUtente = Auth::user();
		if(sizeof($location)>0)
		{
			if($datiUtente->getAttribute('zip')=='' && $location['postal_code']!='')
				$datiUtente->setAttribute('zip', $location['postal_code']);
			if($datiUtente->getAttribute('city')=='' && $location['administrative_area_level_3']!='')
				$datiUtente->setAttribute('city', $location['administrative_area_level_3']);
			if($datiUtente->getAttribute('city')=='' && $location['locality']!='')
				$datiUtente->setAttribute('city', $location['locality']);
			if($datiUtente->getAttribute('province')=='' && $location['administrative_area_level_2']!='')
				$datiUtente->setAttribute('province', $location['administrative_area_level_2']);
			if($datiUtente->getAttribute('province')=='' && $location['administrative_area_level_1']!='')
				$datiUtente->setAttribute('province', $location['administrative_area_level_1']);
			if($datiUtente->getAttribute('address')=='' && $location['route']!='')
				$datiUtente->setAttribute('address', $location['route']. ' '. $location['street_number']);
			if($datiUtente->getAttribute('id_country')=='')
				$datiUtente->setAttribute('id_country', app('App\Http\Controllers\Countries')->getCountriesByName($location['country'])->id);
		}
	}

	/**
	 * Show the edit form for blog post
	 * We create a JsValidator instance based on shared validation rules
	 * @return Response
	 */
	public function editSettings()
	{
		$user = Auth::user();
		$this->idUser = (int)$user->id;
		$settings = $this->getSettings();
		if($settings === null)
			$this->createDefaultSetting();

		return [
			'settings' => $settings,
			'user' => $user
		];
	}

	public function createDefaultSetting($idUser = '')
	{
		if($idUser!='')
			$this->idUser = $idUser;

		return DB::table('settings')->insert([
			'id_user' => $this->idUser,
			'localization' => 0,
			'visible' => 0
		]);
	}

	public function getSettings()
	{
		return DB::table('settings')->where('id_user', $this->idUser)->first();
	}

	public function updateDataSettings()
	{

			// Aggiorno i dati del DB
			$data = [];
			$data['localization'] = DiGiuDevForm::getValSwitch('localization');
			$data['visible'] = DiGiuDevForm::getValSwitch('visible');
			DB::table('settings')->where('id_user', Input::get('id_user'))->update($data);

			// Reindirizzo l'utente nel form
			return Redirect::to('admin/settings');
	}

}