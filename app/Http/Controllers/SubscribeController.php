<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function create(){
        return view('home');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            
        ]);
        return back();
    }
}
