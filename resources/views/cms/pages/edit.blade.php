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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Páginas</a></li>
                            <li class="breadcrumb-item active">{{$page->name}}</li>
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
	                    	<form action="{{route('pages.update', $page->id)}}" method="POST" enctype="multipart/form-data">
	                    		{{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT" />
		                        <div class="form-group row">
		                            <div class="col-md-4"> <!-- <title> da página -->
										<label for="name">Nome da página</label>
	                                	<input class="form-control" type="text" name="name" value="{{$page->name}}" />
		                            </div>
		                            <div class="col-md-8"> <!-- <title> do conteúdo -->
										<label for="title">Título da página</label>
	                                	<input class="form-control" type="text" name="title" value="{{$page->title}}" />
		                            </div>
		                        </div>


                                <hr>

                                <div class="form-group row">
                                    <div class="col-md-12"> <!-- <content> da página -->
                                        <label for="content">Conteúdo</label>
                                        <textarea class="editor_texto" name="content">{{$page->content}}</textarea>
                                    </div>
                                </div>


                                <!-- CONTEUDO DINÂMICO DE ACORDO COM A PAGINA -->

                                
		                        <hr>

                                <div class="form-group row">
                                    <div class="col-md-12">  <!-- <galery> da página -->
                                        <label for="gallery_id">Galeria de imagens</label>
                                        <select name="gallery_id" class="form-control">
                                            <option value="">Nenhuma galeria selecionada</option>
                                            <option value="">Galeria #1</option>
                                            <option value="">Galeria #2</option>
                                            <option value="">Galeria #3</option>
                                            <option value="">Galeria #4</option>
                                            <option value="">Galeria #5</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <div class="col-md-6"> <!-- <image> principal da página -->
                                        <img src="{{$page->imghead ? $page->imghead : 'https://via.placeholder.com/350x150'}}" alt="" class="mb-3" width="100%" />
                                        <label for="imghead">Imagem destaque <small class="badge badge-primary">Cabeçalho</small></label>
                                        <input type="file" name="imghead" class="form-control" />
                                    </div>
                                    <div class="col-md-6"> <!-- <image> fixo do conteúdo da página -->
                                        <img src="{{$page->imgfix ? $page->imgfix : 'https://via.placeholder.com/350x150'}}" alt="" class="mb-3" width="100%" />
                                        <label for="imgfix">Imagem conteúdo <small class="badge badge-primary">Fixo</small></label>
                                        <input type="file" name="imgfix" class="form-control" />
                                    </div>
                                </div>


                                <!-- FIM CONTEUDO DINÂMICO DE ACORDO COM A PAGINA -->


		                        <hr>

		                        <div class="form-group row">
		                            <div class="col-md-6"> <!-- <meta> keywords da página -->
										<label for="keywords">Meta: Keywords</label>
	                                	<input class="form-control" type="text" name="keywords" value="{{$page->keywords}}" />
		                            </div>
		                            <div class="col-md-6"> <!-- <meta> description da página -->
										<label for="description">Meta: Description</label>
	                                	<input class="form-control" type="text" name="description" value="{{$page->description}}" />
		                            </div>
		                        </div>

		                        <hr>

		                        <div class="form-group row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Salvar alterações</button>
                                        <a href="{{route('pages.index')}}" class="btn btn-danger btn-lg"><i class="fas fa-window-close"></i> Cancelar</a>
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