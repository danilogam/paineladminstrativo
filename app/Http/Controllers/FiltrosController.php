<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Categoria;
use App\Slide;
use App\Galeria;
use App\User;
use App\Estado;
use App\Cidade;

class FiltrosController extends Controller
{
	//Listar posts por filtro
    public function postsfiltro(Request $request)
    {
    	$filtrar = $request->all();
    	$posts = Post::where('status', $filtrar['filtro'])->orderBy('id', 'DESC')->paginate(10);

    	if($filtrar['filtro'] == "0") {
	    	$title = "Listando Posts - Publicados";
    	} else {
	    	$title = "Listando Posts - Rascunhos";
    	}

    	return view('cms.posts.index', compact('title', 'posts'));
    }

	//Listar posts por nome
    public function postsbusca(Request $request)
    {
    	$buscar = $request->all();
    	$posts = Post::where('title', 'like', '%'.$buscar['busca'].'%')->paginate(10);
    	
    	$title = "Listando Posts - Resultado por: ".$buscar['busca'];
    	return view('cms.posts.index', compact('title', 'posts'));
    }

	//Listar slides por filtro
    public function slidesfiltro(Request $request)
    {
    	$filtrar = $request->all();
    	$slides = Slide::where('status', $filtrar['filtro'])->orderBy('id', 'DESC')->paginate(10);

    	if($filtrar['filtro'] == "0") {
	    	$title = "Listando slides - Publicados";
    	} else {
	    	$title = "Listando slides - Rascunhos";
    	}

    	return view('cms.slides.index', compact('title', 'slides'));
    }

	//Listar slides por nome
    public function slidesbusca(Request $request)
    {
    	$buscar = $request->all();
    	$slides = Slide::where('title', 'like', '%'.$buscar['busca'].'%')->paginate(10);
    	
    	$title = "Listando slides - Resultado por: ".$buscar['busca'];
    	return view('cms.slides.index', compact('title', 'slides'));
    }

    //Listar usuarios por filtro
    public function usuariosfiltro(Request $request)
    {
        $filtrar = $request->all();
        $usuarios = User::where('status', $filtrar['filtro'])->orderBy('id', 'DESC')->paginate(10);

        if($filtrar['filtro'] == "0") {
            $title = "Listando usuários - Inativos";
        } else {
            $title = "Listando usuarios - Ativos";
        }

        return view('cms.usuarios.index', compact('title', 'usuarios'));
    }

    //Listar usuarios por nome
    public function usuariosbusca(Request $request)
    {
        $buscar = $request->all();
        $usuarios = User::where('name', 'like', '%'.$buscar['busca'].'%')->paginate(10);
        
        $title = "Listando usuários - Resultado por: ".$buscar['busca'];
        return view('cms.usuarios.index', compact('title', 'usuarios'));
    }

	//Listar galerias por nome
    public function galeriasbusca(Request $request)
    {
    	$buscar = $request->all();
    	$galerias = Galeria::where('name', 'like', '%'.$buscar['busca'].'%')->paginate(10);
    	
    	$title = "Listando galerias - Resultado por: ".$buscar['busca'];
    	return view('cms.galerias.index', compact('title', 'galerias'));
    }

	//Listar categorias por nome
    public function categoriasbusca(Request $request)
    {
    	$buscar = $request->all();
    	$categorias = Categoria::where('label', 'like', '%'.$buscar['busca'].'%')->paginate(10);
    	
    	$title = "Listando categorias - Resultado por: ".$buscar['busca'];
    	return view('cms.categorias.index', compact('title', 'categorias'));
    }

    //Listar estados por nome
    public function estadosbusca(Request $request)
    {
        $buscar = $request->all();

        if(!empty($buscar['busca'])){
            $estados = Estado::where('nome', 'like', '%'.$buscar['busca'].'%')->paginate(10);
        }else{
            $estados = Estado::paginate(10);
            $buscar['busca'] = '';
        }
        
        $title = "Listando estados - Resultado por: ".$buscar['busca'];
        return view('cms.estados.index', compact('title', 'estados'));
    }

    //Listar cidades por nome
    public function cidadesbusca(Request $request)
    {
        $buscar = $request->all();

        if(!empty($buscar['busca'])){
            $cidades = Cidade::where('nome', 'like', '%'.$buscar['busca'].'%')->paginate(10);
        }else{
            $cidades = Cidade::paginate(10);
            $buscar['busca'] = '';
        }
        
        $title = "Listando cidades - Resultado por: ".$buscar['busca'];
        return view('cms.cidades.index', compact('title', 'cidades'));
    }

    //Listar cidades por filtro
    public function cidadesfiltro(Request $request)
    {
        $filtrar = $request->all();
        $cidades = Cidade::where('estado_id', $filtrar['filtro'])->orderBy('id', 'DESC')->paginate(10);
        $estados = Estado::all();
        $title = "Listando cidades";

        return view('cms.cidades.index', compact('title', 'cidades', 'estados'));
    }
} 