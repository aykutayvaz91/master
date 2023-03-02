<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function index()
    {
        //return "burası index";
        return view('users.index');
    }
    public function create()
    {
        //return "burası form create";
        return view('users.create');
    }
    //neden users/showqwdqwdqwd  gibi birşeyi show fonksiyonu çagırır
    public function show()
    {
        //return "burası show fonksiyonu";
        //return "show fonksiyonu";
        
        return view('front.welcome.frontwelcome');
    }
}
