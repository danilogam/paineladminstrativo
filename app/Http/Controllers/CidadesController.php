<?php

namespace App\Http\Controllers;

use App\Http\Requests\CidadesRequest;
use Illuminate\Http\Request;
use App\Cidade;
use App\Estado;
use Session;

class CidadesController extends Controller
{
    public function index(Request $request)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        } 
        
        $cidades = Cidade::orderBy('id', 'DESC')->paginate(25);
        $title = "Listando Cidades";
        $estados = Estado::all();

        return view('cms.cidades.index', compact('title', 'cidades', 'estados')); 
    }

    public function create(Request $request)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
        
        $title = "Nova cidade";
        $estados = Estado::all();

        return view('cms.cidades.create', compact('title','estados'));
    } 

    public function store(CidadesRequest $request)
    {
        $new = $request->all();
        Cidade::create($new);

        Session::flash('message', 'Adicionado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('cidades.index');
    } 
    
    public function edit(Request $request, $id)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
        
        $cidade = Cidade::findOrFail($id);
        $title = "Editando: ".$cidade->label; 
        $estados = Estado::all();

        return view('cms.cidades.edit', compact('title', 'cidade', 'estados'));
    }

    public function update(CidadesRequest $request, $id)
    {   
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $cidade = Cidade::findOrFail($id);
        $up = $request->all();
        $cidade->update($up);

        Session::flash('message', 'Editado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('cidades.edit', $id);
    }

    public function destroy(Request $request, $id)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
        
        $cidade = Cidade::findOrFail($id); 

        $cidade->delete();

        Session::flash('message', 'Removido com sucesso!');
        Session::flash('class', 'danger');
        return redirect()->route('cidades.index');
    }
}