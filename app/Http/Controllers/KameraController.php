<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class KameraController extends Controller
{
    //
    public function index()
    {
        $filename = "index";
        return view('Kamera',compact('filename'));
    }

    /**
     */
    public function show()
    {
        //Request $request;http://admin:Admin123@192.168.1.64/doc/page/preview.asp
        /*＄client = new \GuzzleHttp\Client();
        ＄url = "http://example.com/api/posts";
    
        ＄data['name'] = "LaravelCode";
        ＄request = ＄client->post(＄url,  ['body'=>＄data]);
        ＄response = ＄request->send();
    
        dd(＄response); 
        $login = 'admin';
$password = '441e3!';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
$data = curl_exec($ch);

if ($data === false) {
    echo 'ERROR: ' . curl_error($ch);
}
else {
    header('Content-type: image/jpeg');
    echo $data; 
}        $response = $client->get($url, [
            'auth' => [
                'admin', 
                'Admin123'
            ],
        ]);

curl_close($ch);
        */

        $ldate = date('y-m-d-H-i-s');
        $client = new Client([
            'auth' => ['admin', 'Admin123'],
        ]); 
        $url = "http://192.168.1.64/ISAPI/Streaming/channels/1/picture"; //401 unauthorize authdan sonra 200 admin Admin123 admin:Admin123@
 
        $response = $client->request('GET', $url,[
            'sink' => public_path('/images/'.$ldate.'.jpg'),////storage_path('/app/public/images/'.$ldate.'.jpg');
          ]);
 
        //$bodyContent = $response->getBody();
        $filename = $ldate.'.jpg';
        $full_location = public_path('/images/'.$ldate.'.jpg');//storage_path('/app/public/images/'.$ldate.'.jpg');
         return view('Kamera',compact('filename'));
         //return response($body->getContents());
        /*
        $base64 = base64_encode($body);
        $mime = "image/jpeg";
        $img = ('data:' . $mime . ';base64,' . $base64);
        dd($response);
        $bodyContent = "<img src=$img alt='ok'>";
        */
 

        /*
        protected function getDefaultImage()
{
   $content = Storage::get(‘public/default.png’);
   $mime = Storage::mimeType(‘public/default.png’);
   $response = Response::make($content, 200);
   $response->header(“Content-Type”, $mime);
   return $response;
}
        */
        
    }
}
