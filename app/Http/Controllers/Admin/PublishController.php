<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PublishController extends Controller
{
    public  function index(){
        return view("members/publish/index");
    }

    public function  detail(){

    }
}
