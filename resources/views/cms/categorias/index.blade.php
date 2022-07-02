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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Categorias</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
		                </ol>
		                <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->

            <!-- Filtrar Registro -->
            <div class="row">
                <div class="col-6">
                    <form action="{{route('categorias.busca')}}" method="GET" class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" name="busca" placeholder="Buscar por:" class="form-control">
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
                                @if(count($categorias)>0)
    								@foreach($categorias as $categoria)
    	                        	<tr>
    		                            <th scope="row">{{$categoria->id}}</th>
                                        <td>{{$categoria->label}}</td>
    		                            <td><div class="badge badge-pill badge-info">{{$categoria->updated_at ? $categoria->updated_at->diffForHumans() : 'Não foi atualizado!'}}</div></td>
    		                            <td>
                                            <form action="{{route('categorias.destroy', $categoria->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE" />

    										<div class="btn-group" role="group" aria-label="Basic example"
    										>
    											<a href="{{route('categorias.edit', $categoria->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
    											<button class="btn btn-danger"><i class="fas fa-trash"></i> Deletar</button>
    										</div>
                                            </form>
    		                            </div>
    		                        </tr>
    		                        @endforeach
                                @else
                                    <tr>
                                        <td>
                                           Não há categorias cadastradas! 
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
                    {{$categorias->appends(Request::except('page'))->links()}}
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
@endsection