<?php

namespace App\Http\Controllers\web;

use App\Models\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatController extends Controller
{
    public function show($id){
                            //for 1 category
                            $data['cat'] = Cat::findOrFail($id);
                            //for all categories for aside
                            $data['allCats'] = Cat::select('id','name')->active()->get();

                            //bring skills  $data['cat']  and show in page with pagenation
                            $data['skills'] =  $data['cat']->skills()->active()->paginate(6);
                            return view('web.cats.show')->with($data);
    }
}
