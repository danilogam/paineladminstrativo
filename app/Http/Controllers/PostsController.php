<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostsRequest;
use Illuminate\Support\Facades\Session;

use App\Post;
use App\Categoria;
use App\User;
use App\Galeria;
use Illuminate\Support\Facades\Route;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1','2','3','5'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $posts = Post::orderBy('id', 'DESC')->paginate(10);
        $title = "Listando Posts";

        return view('cms.posts.index', compact('title', 'posts'));
    }

    public function create(Request $request)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1','2','3','5'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $categorias = Categoria::all();
        $title = "Novo post";
        $galerias = Galeria::all();

        return view('cms.posts.create', compact('title', 'categorias', 'galerias'));
    }

    public function store(PostsRequest $request)
    {
        $new = $request->all();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_name = time().'-'.$file->getClientOriginalName();
            $file_path = 'uploads/';

            $file->move($file_path, $file_name);

            if($new['image'] != "") {
                $new['image'] = $file_name;
            }
        }

        Post::create($new);

        Session::flash('message', 'Adicionado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('posts.index');
    }

    public function edit(Request $request, $id)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1','2','3','5'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
         
        $categorias = Categoria::all(); 
        $post = Post::findOrFail($id);
        $title = "Editando: ".$post->title;
        $galerias = Galeria::all();

        return view('cms.posts.edit', compact('title', 'categorias', 'post', 'galerias'));
    }

    public function update(PostsRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $up = $request->all();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_name = time().'-'.$file->getClientOriginalName();
            $file_path = 'uploads/';

            $file->move($file_path, $file_name);

            if($up['image'] != "") {
                $up['image'] = $file_name;
            }
        }

        $post->update($up);

        Session::flash('message', 'Editado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('posts.edit', $id);
    }

    public function destroy(Request $request, $id)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1','2','3','5'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $post = Post::findOrFail($id);

        $post->delete();

        Session::flash('message', 'Removido com sucesso!');
        Session::flash('class', 'danger');
        return redirect()->route('posts.index');
    }
}