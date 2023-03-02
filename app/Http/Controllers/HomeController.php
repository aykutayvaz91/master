<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
    public function index() 
    {
        if($this->message == "ok")
        {
            $this->message = "ok";
            $userId = Auth::id();

            $user = User::where("id",$userId)->get(); //::search('Star Trek')->where('user_id', 1)->get();
            //$users = Country::where('name', 'like', '%' . $request->search_value . '%')->get();
            //$this->User()->name;

            return view('home.index')->with('users',$user);
            //return view('home.index')->with('userId', $userId);
        }
        else
            return redirect('/login');
    }
}