<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
 use Illuminate\Cookie\CookieJar;

use Auth;
use App\User;


class CookieController extends Controller {
   public function setCookie(Request $request){
      $minutes = 1;
      $response = new Response(time());
     // dd($response);
      $response->withCookie(cookie('name', time(), $minutes));
      return $response;
      $cookie_name = 'pontikis_net_php_cookie';
$cookie_value = 'test_cookie_set_with_php';
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/'); // 86400 = 1 day
   }
   public function getCookie(Request $request){
      $value = $request->cookie('name');
      echo $value;
   }


   public function cookies(Request $request)
   {
   		$minutes = 1;
   		$cookie = Cookie::make('Forsan', 'Success', $minutes);


  return view('cookies')->withcookie($cookie);
   }

   public function index(Request $request)
{
    		 $name = $request->cookie('Forsan');
  dd($name);

 // return view('cookies', ['name'=> $name]);
}

public function cookie(){
$minutes = 1;
  $cookie = Cookie::make('name', 'value', $minutes);
dd($cookie);
 return response('Hello World')->withcookie($cookie);
}

 public function test(CookieJar $cookieJar, Request $request)
 {
     
       $cookie =  $cookieJar->queue(cookie('Test', 'Test', 45000));
        $value = $request->cookie('Test');
        if (Cookie::has('Test')) {
          # code...
          return dd(Cookie::get('Test'));
        }
dd($value);

    

     return $cookie;
 }



}