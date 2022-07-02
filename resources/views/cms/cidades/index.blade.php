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
                            <li class="breadcrumb-item active">{{$title}}</li>
		                </ol>
		                <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->

            <!-- Filtrar Registro -->
            <div class="row">
                <div class="col-4">
                    <form action="{{route('cidades.busca')}}" method="GET" class="row">
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

                <div class="col-6">
                    <form action="{{route('cidades.filtro')}}" method="GET" class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <select name="filtro" class="form-control">
                                    <option value="">Filtrar por: (estado)</option>
                                    @if(!empty($estados))
                                        @foreach($estados as $estado)
                                            <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endforeach
                                    @endif 
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Filtrar" />
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-2">
                    <a href="{{route('cidades.create')}}" class="btn btn-success">Adicionar Novo</a>
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
			                            <th>ESTADO</th>
			                            <th>AÇÕES</th>
		                            </tr>
	                        	</thead>
							
								<tbody>
                                @if(count($cidades)>0)
    								@foreach($cidades as $cidade)
    	                        	<tr>
    		                            <th scope="row">{{$cidade->id}}</th>
                                        <td>{{$cidade->nome}}</td>
                                        <td>{{$cidade->estado->nome}}</td>
    		                            <td>
                                            <form action="{{route('cidades.destroy', $cidade->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE" />

    										<div class="btn-group" role="group" aria-label="Basic example"
    										>
    											<a href="{{route('cidades.edit', $cidade->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
    											<button class="btn btn-danger"><i class="fas fa-trash"></i> Deletar</button>
    										</div>
                                            </form>
    		                            </div>
    		                        </tr>
    		                        @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">
                                           Não há cidades cadastradas! 
                                        </td>
                                    </tr>
                                @endif
		                        </tbody>
	                        </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

            <div class="row">
                <div class="col-md-12">
                    {{$cidades->appends(Request::except('page'))->links()}}
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
@endsection