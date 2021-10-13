<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Product;

class CatController extends Controller
{
    function addCat( Request $request){
        $cat = new Cat();
        $cat -> name = $request->input('name');
        $cat -> desc = $request->input('desc');
        $cat->save();
        return $cat;
    }
    function ShowAllCat(){
        $cat=Cat::all();
        return $cat;
    }
    function ShowCat($id){
        $cat=Cat::findorFail($id);
        return $cat;
    }
}
