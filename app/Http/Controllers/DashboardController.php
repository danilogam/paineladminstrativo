<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use App\Page;

class DashboardController extends Controller
{
    public function index()
    {
    	$pages = Page::all();
    	$posts = Post::limit(5)->orderBy('id', 'desc')->get();
    	$usuarios = User::all();
        $title = 'Dashboard';
        return view('cms.dashboard', compact('title', 'pages', 'posts', 'usuarios'));
    }
}
