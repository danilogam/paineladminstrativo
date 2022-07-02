<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoriasRequest;
use Illuminate\Support\Facades\Session;

use App\Categoria;

class CategoriasController extends Controller
{
    public function index(Request $request)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1','2','3','5'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
        
        $categorias = Categoria::orderBy('id', 'DESC')->paginate(5);
        $title = "Listando Categorias";

        return view('cms.categorias.index', compact('title', 'categorias'));
    }

    public function create(Request $request)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1','2','3','5'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
        
        $title = "Nova categoria";

        return view('cms.categorias.create', compact('title'));
    }

    public function store(CategoriasRequest $request)
    {
        $new = $request->all();
        Categoria::create($new);

        Session::flash('message', 'Adicionado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('categorias.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1','2','3','5'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
        
        $categoria = Categoria::findOrFail($id);
        $title = "Editando: ".$categoria->label;

        return view('cms.categorias.edit', compact('title', 'categoria'));
    }

    public function update(CategoriasRequest $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $up = $request->all();
        $categoria->update($up);

        Session::flash('message', 'Editado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('categorias.edit', $id);
    }

    public function destroy(Request $request, $id)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1','2','3','5'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
        
        $categoria = Categoria::findOrFail($id);

        $categoria->delete();

        Session::flash('message', 'Removido com sucesso!');
        Session::flash('class', 'danger');
        return redirect()->route('categorias.index');
    }
}
