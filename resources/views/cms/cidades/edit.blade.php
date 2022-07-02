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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Cidades</a></li>
                            <li class="breadcrumb-item active">{{$cidade->label}}</li>
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
	                    	<form action="{{route('cidades.update', $cidade->id)}}" method="POST" enctype="multipart/form-data">
	                    		{{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT" />

		                        <div class="form-group row">
		                            <div class="col-md-8"> <!-- <label> do conteúdo -->
										<label for="nome">Nome</label>
	                                	<input class="form-control" type="text" name="nome" value="{{old('nome',$cidade->nome)}}" />
		                            </div>
                                    <div class="col-md-4">  
                                        <label for="estado_id">Estado</label>
                                        <select class="form-control" name="estado_id">
                                            <option value="">--</option>
                                            @if(!empty($estados))
                                                @foreach($estados as $estado)
                                                    <option value="{{$estado->id}}" @if(old('estado_id',$cidade->estado_id) == $estado->id) selected @endif>{{$estado->nome}}</option>
                                                @endforeach
                                            @endif 
                                        </select>
                                    </div>
		                        </div>

		                        <hr>

		                        <div class="form-group row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Salvar alterações</button>
                                        <a href="{{route('cidades.index')}}" class="btn btn-danger btn-lg"><i class="fas fa-window-close"></i> Cancelar</a>
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