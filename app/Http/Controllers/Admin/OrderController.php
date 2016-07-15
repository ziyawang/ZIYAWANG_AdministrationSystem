<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public  function index(){
        return  view("together/order/index");
    }
    public function detail($id){
        $Id=$id;
        return view("together/order/detail");
    }
}
