<?php
namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Countries;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Library\Util;

class Birds extends Controller
{

   public function getListUserBirds()
   {
       $user = Auth::user();
       $birds =  DB::table('birds')
           ->select('birds.id as id_bird', 'birds.*', 'cages.*', 'specie.*', 'generi.*')
           ->where('birds.id_user', $user->id)
           ->leftJoin('cages', 'birds.id_cage', '=', 'cages.id')
           ->leftJoin('specie', 'birds.id_specie', '=', 'specie.id')
           ->leftJoin('generi', 'specie.id_genere', '=', 'generi.id')->get();
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

    public function getIDByRNA($rna)
    {
        $bird =  DB::table('birds')->select('id')->where('number', $rna)->first();
        if($bird!==null)
            return $bird->id;
        return '';
    }

    public function getjsonListUserBirds(){

        $lists = $this->getListUserBirds();

        $list = [];
        foreach($lists as $bird)
        {
            $new = [];
            $new['DT_RowId'] = "row_".$bird->id_bird;
            $new['DT_RowAttr'] = ["data-sex" => $bird->sex, "data-id" => $bird->id_bird];
            $new['number'] = $bird->number;
            $new['sex'] = $bird->sex;
            $new['genere_specie'] = $bird->genere.'<br />'.$bird->specie;
            $new['rna_padre'] =  $bird->rna_padre;
            $new['rna_madre'] =  $bird->rna_madre;
            $parents = [];
            if($bird->rna_padre!='')
                $parents[] = Lang::get('birds.col_padre').':'.$new['rna_padre'];
            if($bird->rna_madre!='')
                $parents[] = Lang::get('birds.col_madre').':'. $new['rna_madre'];
            $new['rna_padre_madre'] = implode('<br />', $parents);
            $new['cage_name'] = $bird->cage_name;
            $new['date_born'] = $bird->date_born;
            $new['date_sale'] = $bird->date_sale;
            $new['note'] = $bird->note;
            $new['image'] = "<img class='img-list-birds' src='/uploads/no-thumb.png' />";
            if($bird->image!='')
                $new['image'] = "<img class='img-list-birds' src='/uploads/" . $bird->id_user . '/birds/' . $bird->image."' />";
            $new['fields_name'] = [
                'col_padre' => Lang::get('birds.col_padre'),
                'col_madre' => Lang::get('birds.col_madre'),
                'col_date_born' => Lang::get('birds.col_date_born'),
                'col_date_sale' => Lang::get('birds.col_date_sale'),
                'col_note' => Lang::get('birds.col_note'),
            ];
            $list['data'][] = $new;
        }
        return json_encode($list);
    }

    /**
     * Show the edit form for blog post
     * We create a JsValidator instance based on shared validation rules
     * @return Response
     */
    public function getBird($id = null)
    {
        if($id === null)
            return ['bird' => null];

        $bird = $this->getBirdByID($id);
        if($bird->id_specie>0)
        {
            $specie = $this->getSpecie($bird->id_specie);
            $bird->id_specie = $specie->specie;
        }
        if($bird->id_padre>0)
            $bird->id_padre = $this->getRnaByID($bird->id_padre);
        if($bird->id_madre>0)
            $bird->id_madre = $this->getRnaByID($bird->id_madre);
        if($bird->date_born>0)
            $bird->date_born = date('d/m/Y', $bird->date_born);
        else
            $bird->date_born = '';
        if($bird->date_sale>0)
            $bird->date_sale = date('d/m/Y', $bird->date_sale);
        else
            $bird->date_sale = '';

        return $bird;
    }


    public function getParent($idBird){
        if($idBird === null)
            return null;
        if($idBird>0)
            return $this->getRnaByID($idBird);
        return null;
    }

    public function getSpecie($id)
    {
        return DB::table('specie')->where('id', $id)->first();
    }

    public function editBird($id)
    {
        if($id === null)
            return ['bird' => null];
        $bird = $this->getBirdByID($id);

        // Todo: qui faccio il validator php e js

        // se va tutto bene aggiorno
        return [
            'bird' => $bird
        ];

    }

    public function getBirdByID($id){
        return DB::table('birds')->where('id', (int)$id)->first();
    }

    public function updateBird()
    {
        // Costruisco i campi richiesti
        $rules = array(
            'number'             => 'required',
            'sex'            => 'required'
        );

        // Inizializzo il validator con tutti i campi del form e le regole
        $validator = Validator::make(Input::all(), $rules);

        // Se il validator fallisce
        if ($validator->fails()) {

            // Reindirizzo l'utente nel form e a video mostro gli errori
            return Redirect::to('admin/editbird')
                ->withErrors($validator);

        }
        // Se il validator va a buon fine
        else {

            $user = Auth::user()->getAttributes();
            // Aggiorno i dati del DB
            $idSpecie = 0;
            if(Input::get('id_specie')!='')
            {
                $specie = $this->getSpecieByName(Input::get('id_specie'));
                $idSpecie = $specie->id;
            }
            $data = [];
            $data['number'] = Input::get('number');
            $data['sex'] = Input::get('sex');
            $data['id_user'] = (int)$user['id'];
            $data['id_specie'] = (int)$idSpecie;
            $data['id_padre'] = (int)$this->getIDByRNA(Input::get('id_padre'));
            $data['id_madre'] = (int)$this->getIDByRNA(Input::get('id_madre'));
            $data['id_cage'] = (int)Input::get('id_cage');
            $data['date_born'] = Util::toTimestamp(Input::get('date_born'));
            $data['date_sale'] = Util::toTimestamp(Input::get('date_sale'));
            $data['note'] = Input::get('note');
            $img = '';
            $id = 0;
            // open an image file
            if(isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
                $img = Image::make($_FILES['image']['tmp_name']);

               // $img->resize(320, 240);
            }
            if(Input::get('id')>0) {
                $id = Input::get('id');
                DB::table('birds')->where('id', Input::get('id'))->update($data);
            }
            else {
                $id = DB::table('birds')->insertGetId($data);
            }

            if(is_object($img))
            {

                // Salvo l'immagine
                $img->save('uploads/'.$user['id'].'/birds/'.$id.'-main.jpg');

                // Aggiorno il record del db con l'immagine
                DB::table('birds')->where('id', $id)->update(['image' => $id.'-main.jpg']);

            }
            // Reindirizzo l'utente nel form
            return Redirect::to('admin/listbirds');

        }
    }

    public function getSpecieByName($name){
        return DB::table('specie')->where('specie', $name)->first();
    }

    public function selectSpecie(){
        $specie =  DB::table('generi')->get();
        $dato = [-1 => '- Seleziona -'];
        foreach($specie as $sp)
            $dato[$sp->id] = $sp->genere;

        return $dato;
    }

    public function selectGeneriByGenere($idGenere)
    {
        return DB::table('specie')->where('id_genere='.(int)$idGenere)->get();
    }

    public function selectCages()
    {
        $user = Auth::user()->getAttributes();
        $gabbie =  DB::table('cages')->where('id_user', (int)$user['id'])->get();
        $dato = [-1 => '- Seleziona -'];
        foreach($gabbie as $gb)
            $dato[$gb->id] = $gb->cage_name;

        return $dato;
    }

    public function getValidatorJS(){

        $validator = JsValidator::make([
            'number' => 'required',
            'sex'=> 'required'
        ],
            [
                'number' => 'validation.number',
                'sex'=> 'validation.sex'
            ],
            [
                'number' => trans('birds.form_number'),
                'sex'=> trans('birds.form_sex')
            ],
            '#form-bird');
        return $validator;
    }

    public function getListRNAByUser(){
        $birds = $this->getUserBirdsAutoCompleter($_GET['sex']);
        $ret = [];
        foreach($birds as $bird)
            $ret[$bird->id] = $bird->number;
        return $ret;
    }

    public function getUserBirds(){
        return DB::table('birds')->where('id_user',(int)Auth::user()->id)->get();
    }

    public function getUserBirdsAutoCompleter($sex = ''){

        $query = DB::table('birds')->where('id_user',(int)Auth::user()->id)
            ->where('number', 'LIKE',  '%'.$_GET['term'].'%');

        if($sex!='')
            $query->where('sex', $sex);

        return $query->get();
    }

    public function getListJSONSpecie(){

        $specie = DB::table('specie')
            ->leftJoin('generi', 'specie.id_genere', '=', 'generi.id')
            ->where('specie.specie', 'LIKE',  '%'.$_GET['term'].'%')->get();
        $ret  =[];
        foreach($specie as $sp)
        {
            $dato = [];
            $dato['label'] = $sp->specie;
            $dato['category'] = $sp->genere;
            $ret[] = $dato;
        }
        return json_encode($ret);
    }

    public function deleteBirds(){
        if(isset($_POST['birds']) && sizeof($_POST['birds']>0)) {
            DB::select(DB::raw("DELETE FROM birds WHERE id IN (".implode(',', $_POST['birds']).')'));
        }

        return json_encode(['ret' => 'success']);
    }

}