<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GaleriasRequest;
use App\Http\Requests\FilesRequest;
use Illuminate\Support\Facades\Session;

use App\Galeria;
use App\File;

class GaleriasController extends Controller
{
    public function index()
    {
        $galerias = Galeria::orderBy('id', 'DESC')->paginate(10);
        $title = "Listando Galerias";

        return view('cms.galerias.index', compact('title', 'galerias'));
    }

    public function create()
    {
        $title = "Nova galeria";

        return view('cms.galerias.create', compact('title'));
    }

    public function store(GaleriasRequest $request)
    {
        $new = $request->all();
        Galeria::create($new);

        Session::flash('message', 'Adicionado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('galerias.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $galeria = Galeria::findOrFail($id);
        $title = "Editando: ".$galeria->title;

        return view('cms.galerias.edit', compact('title', 'galeria'));
    }

    public function update(GaleriasRequest $request, $id)
    {
        $galeria = Galeria::findOrFail($id);
        $up = $request->all();
        $galeria->update($up);

        Session::flash('message', 'Editado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('galerias.edit', $id);
    }

    public function destroy($id)
    {
        $galeria = Galeria::findOrFail($id);
        $galeria->delete();

        Session::flash('message', 'Removido com sucesso!');
        Session::flash('class', 'danger');
        return redirect()->route('galerias.index');
    }

    /* CRUD para imagens das galerias */
    public function filesall($id) {
        $galeria = Galeria::findOrFail($id);
        $files = File::where('galeria_id', $galeria->id)->get();

        $title = "Adicionando imagens em: ".$galeria->name;
        return view('cms.galerias.files', compact('galeria', 'files', 'title'));
    }

    public function fileup(FilesRequest $request, $id) {
        $new = $request->all();

        $file = $request->file('file');
        $file_name = time().'-'.$file->getClientOriginalName();
        $file_path = 'uploads/';

        $file->move($file_path, $file_name);

        $new['file'] = $file_name;

        $create = File::create($new);

        if($create) {} else {
            return Response::json();
        }
    }

    public function filedel($id) {
        $file = File::findOrFail($id);
        $file->delete();

        Session::flash('message', 'Removido com sucesso!');
        Session::flash('class', 'danger');
        return back();
    }
}
