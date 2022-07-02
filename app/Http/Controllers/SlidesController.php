<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SlidesRequest;
use Illuminate\Support\Facades\Session;

use App\Slide;

class SlidesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1','2','3','4'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $slides = Slide::orderBy('id', 'DESC')->paginate(10);
        $title = "Listando Slides";

        return view('cms.slides.index', compact('title', 'slides'));
    }

    public function create(Request $request)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1','2','3','4'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $title = "Novo slide";

        return view('cms.slides.create', compact('title'));
    }

    public function store(SlidesRequest $request)
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

        Slide::create($new);

        Session::flash('message', 'Adicionado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('slides.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1','2','3','4'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $slide = Slide::findOrFail($id);
        $title = "Editando: ".$slide->title;

        return view('cms.slides.edit', compact('title', 'slide'));
    }

    public function update(Request $request, $id)
    {
        $slide = Slide::findOrFail($id);
        $up = $request->all();
        $file_path = 'uploads/slides/';

        if ($request->hasFile('imagem')){
            //REMOVER IMAGEM ANTIGA SE HOUVER
            if (!empty($slide->imagem) && file_exists($file_path.$slide->getOriginal('imagem'))){
                unlink( $file_path.$slide->getOriginal('imagem') ); 
            }

            $file = $request->file('imagem');
            $file_name = time().'-'.str_replace(' ','',$file->getClientOriginalName());

            $file->move($file_path, $file_name);
            $up['imagem'] = $file_name;
        }

        $slide->update($up);

        Session::flash('message', 'Editado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('slides.edit', $id);
    }

    public function destroy(Request $request, $id)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1','2','3','4'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $slide = Slide::findOrFail($id);

        $file_path = 'uploads/slides/';

        //REMOVER IMAGEM ANTIGA SE HOUVER
        if (!empty($slide->imagem) && file_exists($file_path.$slide->getOriginal('imagem'))){
            unlink( $file_path.$slide->getOriginal('imagem') ); 
        } 
        
        $slide->delete();

        Session::flash('message', 'Removido com sucesso!');
        Session::flash('class', 'danger');
        return redirect()->route('slides.index');
    }
}
