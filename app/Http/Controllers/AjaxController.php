<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getRoles(Request $request){
        $tags=[];
        if ($search=$request->name){
            $tags=Roles::where('name','LIKE',"%$search%")->get();
        }
        return response()->json($tags);
    }
}
