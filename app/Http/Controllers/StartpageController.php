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
        $userRepos = auth()->user()->projectsWhereUpdatedIsLatest()->paginate(5);

        return view('startpage', [
            'items' => $userItems,
            'repos' => $userRepos,
        ]);
    }

    public function refresh()
    {
        $user = auth()->user();

        UserRepos::dispatch($user->username, $user->id);
    }
}
