<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Room;
use App\Models\Device;
use App\Models\UserRoom;
use App\Models\UserRoomDevice;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;
use stdClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    public function dashboard(){
         return view('home');
    }

    public function select($lang)
    {
        if (!in_array($lang, ['en', 'ar'])) {
            abort(400);
        }
        FacadesSession::put('lang', $lang);
        App::setLocale(FacadesSession::get('lang', 'en'));
        return Redirect::back();
    }
    public function dark($code)
    {
        if (!in_array($code, ['on', 'off'])) {
            abort(400);
        }
        if($code=='on'){
            FacadesSession::put('darkMode', $code);
        }else{
            FacadesSession::forget('darkMode');
        }

        return Redirect::back();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      return view('index');
    }
}
