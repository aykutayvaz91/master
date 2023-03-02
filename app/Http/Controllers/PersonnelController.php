<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\DB;

class PersonnelController extends Controller
{
    public function index()
    {
        $personels = DB::connection('mysql2')->table("personnel")->select()->get();
        return view('personel.index', ['personels' => $personels]);
        /*
        try{
            $personels = DB::connection('mysql2')->select("select * from gks.PERSONNEL");
            return view('personel.index', ['personels' => $personels]);
        }
        catch(\Exception $e)
        {
            $error = $e->getMessage();
            return view('personel.index',['error' => $error]);
        }*/
       
    }
}
