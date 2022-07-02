@extends('layouts.cms_app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">{{$title}}</h4>
                        <!-- breadcrumb -->
		                <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Painel</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Posts</a></li>
                            <li class="breadcrumb-item active">{{$post->title}}</li>
		                </ol>
		                <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->
            
            <!-- Verifica e mostra erros dos campos obrigatórios -->
            @include('cms.includes.error_messages')

            <div class="row">
                <!-- Verifica e mostra mensagem de sucesso -->
                @include('cms.includes.alert_messages')
                <div class="col-12">
                    <div class="card m-b-20">
	                    <div class="card-body">
	                    	<form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
	                    		{{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT" />

                                <div class="form-group row">
                                    <div class="col-md-6">  <!-- <status> do post -->
                                        <label for="status">Salvar como</label>
                                        <select name="status" class="form-control">
                                            <option value="1" @if($post->status == 1) selected @endif>Publicado</option>
                                            <option value="0" @if($post->status == 0) selected @endif>Rascunho</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">  <!-- <categoria_id> do post -->
                                        <label for="categoria_id">Categoria</label>
                                        <select name="categoria_id" class="form-control">
                                            <option value="">--</option>
                                            @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}" @if($post->categoria_id == $categoria->id) selected @endif>{{$categoria->label}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

		                        <div class="form-group row">
		                            <div class="col-md-12"> <!-- <title> do conteúdo -->
										<label for="title">Título do post</label>
	                                	<input class="form-control" type="text" name="title" value="{{$post->title}}" />
		                            </div>
		                        </div>

		                        <hr>

                                <div class="form-group row">
                                    <div class="col-md-12">  <!-- <galery> do post -->
                                        <label for="gallery_id">Galeria de imagens</label>
                                        <select name="gallery_id" class="form-control">
                                            <option value="">Nenhuma galeria selecionada</option>
                                            @if(!empty($galerias))
                                                @foreach($galerias as $galeria)
                                                    <option value="{{$galeria->id}}" @if(old('gallery_id',$post->gallery_id)==$galeria->id) selected @endif>{{$galeria->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <div class="col-md-4"> <!-- <image> principal do post -->
                                        <img src="{{$post->image ? $post->image : 'https://via.placeholder.com/350x150'}}" alt="" class="mb-3" width="100%" />
                                    </div>

                                    <div class="col-md-8"> <!-- <image> principal do post -->
                                        <label for="image">Imagem destaque <small class="badge badge-primary">Cabeçalho</small></label>
                                        <input type="file" name="image" class="form-control" />
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <div class="col-md-12"> <!-- <summary> do post -->
                                        <label for="summary">Resumo <small class="badge badge-primary">Resumo que irá aparecer no card</small></label>
                                        <textarea class="form-control" rows="5" name="summary">{{$post->summary}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12"> <!-- <content> do post -->
                                        <label for="content">Conteúdo</label>
                                        <textarea class="editor_texto" name="content">{{$post->content}}</textarea>
                                    </div>
                                </div>

		                        <hr>

		                        <div class="form-group row">
		                            <div class="col-md-6"> <!-- <meta> keywords do post -->
										<label for="keywords">Meta: Keywords</label>
	                                	<input class="form-control" type="text" name="keywords" value="{{$post->keywords}}" />
		                            </div>
		                            <div class="col-md-6"> <!-- <meta> description do post -->
										<label for="description">Meta: Description</label>
	                                	<input class="form-control" type="text" name="description" value="{{$post->description}}" />
		                            </div>
		                        </div>

		                        <hr>

		                        <div class="form-group row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Salvar alterações</button>
                                        <a href="{{route('posts.index')}}" class="btn btn-danger btn-lg"><i class="fas fa-window-close"></i> Cancelar</a>
                                    </div>
		                        </div>
	                        </form>
	                    </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->        
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
@endsection

@section('scripts')
    @include('cms.includes.tinymce')
@endsection