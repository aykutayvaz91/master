<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Summary of HomeController
 */
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

            //$searchResultQuery = User::whereNotNull('gks_id')->select('gks_id')->get();
            
            $searchResultQuery = User::where('gks_id','!=',0)->orWhereNull('gks_id')->select('gks_id')->get();

            return view('home.index')->with('users',$user)->with('searchResultQuery',$searchResultQuery);
            //return view('home.index')->with('userId', $userId);
        }
        else
            return redirect('/login');
    }

    /**
     * Summary of performsync
     * @param Request $request
     * @return mixed
     */
    public function performsync(Request $request)
    {
        try
        {
            $gks_id = (int)$request->gks_id;
            $fullname= $request->fullname;
            $registernumber = $request->registernumber;
            $department = $request->department;
            $position = $request->position;
            $userId = Auth::id();
            $user = User::Where('id', $userId)->first();

            if($user->gks_id == 0)
            {
                $date_time_sync = new \DateTime();
                $date_time_sync->format('Y-m-d H:i:s');    // MySQL datetime format
               // $date_time_sync =  $date_time_sync->getTimestamp();
                $user->gks_id = $gks_id;
                $user->fullname = $fullname;
                $user->registernumber = $registernumber;
                $user->department = $department;
                $user->position = $position;
                $user->synced_time = $date_time_sync;
                $user->save();

                $result = "Kullanıcı başarıyla eşleştirildi.";
                return response()->json([
                    'success' => true,
                    'message' => "Veritabanına kaydedildi",
                    'result' => $result
                ], 200);
            }
            else
            {
                $result = "Bu kullanıcı daha önce eşleştirilmiş.";
                return response()->json([
                    'success' => false,
                    'message' => "Veritabanına kaydedilemedi",
                    'result' => $result
                ], 200);
            }
            //$user->registernumber = $registernumber;
            //$user->fullname = $fullname;
            //$user->department = $department;
            //$user->position = $position;
                        
            
          
          /*  return response()->json([
                'success' => true,
                'message' => $date_time_sync,
                'result' => $result,
                'fullname' => $user->fullname
            
            ], 200);
*/
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