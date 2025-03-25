<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class maincontroller extends Controller
{
    public function products()
    {
        return view('products');
    }

    public function customers()
    {
        return view('customers');
    }
}
