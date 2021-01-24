<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use App\Models\Subscriber;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$allNews = News::all()->sortByDesc('created_at');
        return view('main_page',['allNews'=>$allNews]);
    }
	public function getnews($news_url, Request $request)
    {
		$data = News::where('url', '=', $news_url)->get()->toarray();

        $dataNews = News::find($data[0]['id']);

        $user = User::find($dataNews->user_id);
        
        return view('view_news',['dataNews'=>$dataNews,'user'=>$user]);
    }
    public function subscribe(Request $request){
        $onwhon = $request->get('onwhon');
        $who = $request->get('who');

        $dataCreate['userWho'] = $who;
		$dataCreate['userOnWhom'] = $onwhon;
		
        Subscriber::create($dataCreate);

        $return['data'] = 'success';
        
        return response()->json($return);
    }
}
