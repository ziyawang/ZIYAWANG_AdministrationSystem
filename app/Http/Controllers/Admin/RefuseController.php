<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RefuseController extends Controller
{
    public function index(){
        return view("together/refuse/index");
    }
    
    public function detail(){
        return view("together/refuse/index");
    }
}
