<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstadosRequest;
use Illuminate\Http\Request;
use App\Estado; 
use Session;

class EstadosController extends Controller
{
    public function index(Request $request)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        } 
        
        $estados = Estado::orderBy('id', 'DESC')->paginate(15);
        $title = "Listando Estados";

        return view('cms.estados.index', compact('title', 'estados')); 
    }

    public function create(Request $request)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
        
        $title = "Novo estado";

        return view('cms.estados.create', compact('title'));
    } 

    public function store(EstadosRequest $request)
    {
        $new = $request->all();
        Estado::create($new);

        Session::flash('message', 'Adicionado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('estados.index');
    } 
    
    public function edit(Request $request, $id)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
        
        $estado = Estado::findOrFail($id);
        $title = "Editando: ".$estado->label; 

        return view('cms.estados.edit', compact('title', 'estado'));
    }

    public function update(EstadosRequest $request, $id)
    {   
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $estado = Estado::findOrFail($id);
        $up = $request->all();
        $estado->update($up);

        Session::flash('message', 'Editado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('estados.edit', $id);
    }

    public function destroy(Request $request, $id)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
        
        $estado = Estado::findOrFail($id);

        if($estado->cidades()->count() > 0){
            Session::flash('message', 'Estado possui cidades vinculadas, por favor resolva estes conflitos!');
            Session::flash('class', 'warning');
            return redirect()->route('estados.index');
        }

        $estado->delete();

        Session::flash('message', 'Removido com sucesso!');
        Session::flash('class', 'danger');
        return redirect()->route('estados.index');
    }
}