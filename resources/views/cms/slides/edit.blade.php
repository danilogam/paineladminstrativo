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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Slides</a></li>
                            <li class="breadcrumb-item active">{{$slide->title}}</li>
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
	                    	<form action="{{route('slides.update', $slide->id)}}" method="POST" enctype="multipart/form-data">
	                    		{{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT" />

                                <div class="form-group row">
                                    <div class="col-md-2">  <!-- <status> do slide -->
                                        <label for="status">Publicar</label>
                                        <select name="status" class="form-control">
                                            <option value="0" @if($slide->status == 0) selected @endif>Sim</option>
                                            <option value="1" @if($slide->status == 1) selected @endif>Não</option>
                                        </select>
                                    </div>

                                    <div class="col-md-10"> <!-- <title> do slide -->
                                        <label for="title">Título do slide</label>
                                        <input class="form-control" type="text" name="title" value="{{$slide->title}}" />
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <div class="col-md-4"> <!-- <image> do slide -->
                                        <img src="{{$slide->image ? $slide->image : 'https://via.placeholder.com/350x150'}}" alt="" class="mb-3" width="100%" />
                                    </div>
                                    <div class="col-md-8"> <!-- <image> do slide -->
                                        <label for="image">Imagem</label>
                                        <input type="file" name="image" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12"> <!-- <summary> do slide -->
                                        <label for="summary">Resumo <small class="badge badge-primary">opcional</small></label>
                                        <textarea class="form-control" rows="5" name="summary">{{$slide->summary}}</textarea>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <div class="col-md-4"> <!-- <button> do slide -->
                                        <label for="button">Texto do botão</label>
                                        <input class="form-control" type="text" name="button" value="{{$slide->button}}" />
                                    </div>
                                    <div class="col-md-4"> <!-- <url> do slide -->
                                        <label for="url">Link</label>
                                        <input class="form-control" type="text" name="url" value="{{$slide->url}}" />
                                    </div>
                                    <div class="col-md-4">  <!-- <target> do slide -->
                                        <label for="target">Abrir</label>
                                        <select name="target" class="form-control">
                                            <option value="0" @if($slide->target == 0) selected @endif>Mesma aba</option>
                                            <option value="1" @if($slide->target == 1) selected @endif>Nova aba</option>
                                        </select>
                                    </div>
                                </div>

		                        <hr>

		                        <div class="form-group row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Salvar alterações</button>
                                        <a href="{{route('slides.index')}}" class="btn btn-danger btn-lg"><i class="fas fa-window-close"></i> Cancelar</a>
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