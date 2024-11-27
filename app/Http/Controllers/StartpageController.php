<?php

namespace App\Http\Controllers;

use App\Jobs\UserRepos;
use Illuminate\Http\Request;
use Ssionn\GithubForgeLaravel\Facades\GithubForge;

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
