<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    /*public function index(){
        return view('user.show',[
            'drinks' => \App\Models\Drink::all()
        ]);
    }

    public function indexUser(){
        return view('user.show', [
           'drinks' => auth()->user()->drinks()->get()
        ]);
    }*/
}
