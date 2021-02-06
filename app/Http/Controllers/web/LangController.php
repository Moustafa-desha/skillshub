<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function set ($lang, Request $request)
    {
                        //array of langs in our site to cheick lang for users
                        $sitelangs = ['en','ar'];

                        //we cheick what lang user used if it lang not in our site then mak default value en
                        if(! in_array($lang , $sitelangs)) {
                            $lang='en';
                        }
                        //we take lang from user and put it in session to change lang
                        $request->session()->put('lang', $lang);
                        
                        Return back();

    }
}
