<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome';
        return view("welcome")->with('title', $title);
    }
    
    public function login(){
        $title = 'About us';
        return view("pages.about ")->with('title', $title);
    }
    public function services(){
        $data = array(
            "title" => "Services",
            "services" => ["Web Design", "Programming", "UI,UX"]
        );
        return ($data);
    }
    
    
}
