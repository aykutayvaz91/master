<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function __construct() {

        $this->message = "ok";
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            //die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }


    }

    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        if($this->message == "ok")
        {
            $credentials = $request->getCredentials();

            if(!Auth::validate($credentials)):
                return redirect()->to('login')
                    ->withErrors(trans('auth.failed'));
            endif;

            $user = Auth::getProvider()->retrieveByCredentials($credentials);

            Auth::login($user);
            return $this->authenticated($request, $user);
        }
        else
        {
            return redirect()->to('login')
                    ->withErrors(trans($this->message));
        }
            
     
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user) 
    {
        return redirect()->intended();
    }
}