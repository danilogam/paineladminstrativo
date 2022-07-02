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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Galerias</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                        <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->
            
            <!-- Filtrar Registro -->
            <div class="row">
                <div class="col-6">
                    <form action="{{route('galerias.busca')}}" method="GET" class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" name="busca" placeholder="Buscar por: (nome)" class="form-control">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Buscar" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
            	<!-- Verifica e mostra mensagem de sucesso -->
                @include('cms.includes.alert_messages')
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOME</th>
                                        <th>ATUALIZAÇÃO</th>
                                        <th>AÇÕES</th>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                @if(count($galerias)>0)
	                                @foreach($galerias as $galeria)
	                                <tr>
	                                    <th scope="row">{{$galeria->id}}</th>
	                                    <td>{{$galeria->name}}</td>
	                                    <td><div class="badge badge-pill badge-info">{{$galeria->updated_at ? $galeria->updated_at->diffForHumans() : 'Não foi atualizado!'}}</div></td>
	                                    <td>
	                                        <form action="{{route('galerias.destroy', $galeria->id)}}" method="POST">
	                                        {{ csrf_field() }}
	                                        <input type="hidden" name="_method" value="DELETE" />

	                                        <div class="btn-group" role="group" aria-label="Basic example"
	                                        >
	                                        	<a href="{{route('files.all', $galeria->id)}}" class="btn btn-warning"><i class="fas fa-images"></i> Imagens</a>
	                                            <a href="{{route('galerias.edit', $galeria->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
	                                            <button class="btn btn-danger"><i class="fas fa-trash"></i> Deletar</button>
	                                        </div>
	                                        </form>
	                                    </div>
	                                </tr>
	                                @endforeach
                                @else
                                	<tr><td colspan="4">Não há galerias cadastradas!</td></tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->        
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
@endsection