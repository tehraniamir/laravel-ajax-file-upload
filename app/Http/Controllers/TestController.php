<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function index()
    {
        return view('ajax-up');
    }

    public function store(Request $request)
    {
        if ($request->ajax()){
            $v = Validator::make($request->all(), [
                'title'=>'required|string|max:120',
                'body'=>'required|string|max:250',
                'file'=>'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);
            if($v->passes()){
                $file = $request->file('file');
                $file_name = time()."-".$file->getClientOriginalName();
                $file->move(public_path('/uploads/article/'), $file_name);
                Article::create([
                    'title'=>$request->title,
                    'body'=>$request->body,
                    'pic'=>$file_name
                ]);
                return response()->json(['success'=>1]);
            }else{
                return response()->json(['errors'=>$v->errors()]);
            }
        }
    }
}
