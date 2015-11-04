<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
	protected $redirectPath = '/admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProviderFB()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProviderTW()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProviderG()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallbackFB()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('auth/facebook');
        }

        $authUser = $this->findOrCreateUser($user, 'facebook');

        Auth::login($authUser, true);

        return redirect()->route('admin');
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallbackTW()
    {
        try {
            $user = Socialite::driver('twitter')->user();
        } catch (Exception $e) {
            return redirect('auth/twitter');
        }

        $authUser = $this->findOrCreateUser($user, 'twitter');

        Auth::login($authUser, true);

        return redirect()->route('admin');
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallbackG()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('auth/google');
        }

        $authUser = $this->findOrCreateUser($user, 'google');

        Auth::login($authUser, true);

        return redirect()->route('admin');
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($socialUser, $socialName)
    {
        if($socialName== 'facebook')
            $authUser = User::where('facebook_id', $socialUser->id)->first();
        if($socialName== 'twitter')
            $authUser = User::where('twitter_id', $socialUser->id)->first();
        if($socialName== 'google')
            $authUser = User::where('google_id', $socialUser->id)->first();

        if ($authUser){
            return $authUser;
        }

        if($socialName== 'facebook') {
            return User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'facebook_id' => $socialUser->id,
                'avatar' => $socialUser->avatar
            ]);
        }

        // Non abbiamo il nome utente dell'utente
        elseif($socialName== 'twitter')
        {
            return User::create([
                'name' => $socialUser->name,
                'handle' => $socialUser->nickname,
                'twitter_id' => $socialUser->id,
                'avatar' => $socialUser->avatar_original
            ]);
        }

        elseif($socialName== 'google') {
            return User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'google_id' => $socialUser->id,
                'avatar' => $socialUser->avatar
            ]);
        }
    }
}
