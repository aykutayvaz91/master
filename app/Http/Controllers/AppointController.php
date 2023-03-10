<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointController extends Controller
{
    public function index()
    {
        return View('home.appoint');
    }

    public function list()
    {
        //return View('home.appoint');
        return "Rapor";
    }
    public function me()
    {
        //return View('home.appoint');
        return View('home.myappointments');
    }
 
    public function save(Request $request)
    {
        try
        {
            $userId = Auth::id();
            $user = User::Where('id', $userId)->first();
            $meal_date = $request->meal_date;
            $meal_time = $request->meal_time;
            $exist = Meal::where(
                'user_id',"=",$user->id)->where(
                'meal_date',"=",$meal_date)->where(
                'meal_time',"=",$meal_time)->first();
            if($exist == null)
            {
                $m = new Meal();
                $m->user_id = $user->id;
                $m->meal_date = $meal_date;
                $m->meal_time = $meal_time;
                $m->check_meal = true;
                $m->save();
                
                $result = "Seçilen tarihte yemek randevusu başarıyla oluşturuldu..";
                return response()->json([
                    'success' => true,
                    'message' => "Veritabanına kaydedildi",
                    'result' => $result
                ], 200);
            }
            else
            {
                $result = "Seçilen tarihte daha önce yemek randevusu oluşturulmuş.";
                return response()->json([
                    'success' => false,
                    'message' => "Veritabanına kaydedilemedi",
                    'result' => $result
                ], 200);
            }

        }
        catch(\Exception $e)
        {
            $result = "Hata ! Veritabanına kaydedilemedi";
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'result' => $result
            ], 200);
        }

    
    }
}
