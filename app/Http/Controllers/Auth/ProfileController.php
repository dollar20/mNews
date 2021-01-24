<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use App\Models\Subscriber;

class ProfileController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   // use AuthenticatesUsers;

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	public function index($userName, Request $request){
		$selectUser = User::where('name', '=', $userName)->get()->toarray();
		$countNews = News::where('user_id', '=', $selectUser[0]['id'])->count();
		$countSubscriber = Subscriber::where('userOnWhom','=', $selectUser[0]['id'])->count();
		return view('auth.profile',['selectUser'=>$selectUser,'countNews'=>$countNews,'countSubscriber'=>$countSubscriber]);
	}
}
