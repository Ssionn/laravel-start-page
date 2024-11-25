<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartpageController extends Controller
{
    public function index()
    {
        $userItems = auth()->user()->items;

        return view('startpage', [
            'items' => $userItems,
        ]);
    }
}
