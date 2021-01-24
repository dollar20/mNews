<?php

namespace App\Http\Controllers\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adm.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$rules = $this->rules($request);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('news.create')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $dataCreate = $request->toArray();
        $dataCreate['title'] = $request->get('title');
        $dataCreate['user_id'] = auth()->user()->id;
        $dataCreate['url'] = $request->get('url');
		$dataCreate['description'] = $request->get('description');
		
        $idMenu = News::create($dataCreate)->id;
        
        return redirect()->route('mainpage')->with('success', 'News create!');
    }
    /**
    * Rules for Validation
    */
    public function rules(Request $request)
    {
        $is_new = ($request->get('id')==null|| $request->get('id')==0)?true:false;

        $rules['url'] = $is_new?'required|unique:news|regex:/^[a-z0-9-]+$/':'required|regex:/^[a-z0-9-]+$/';
        $rules["title"] = 'required|max:120|min:3';
		$rules["description"] = 'required|min:3';
        
        return $rules;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
