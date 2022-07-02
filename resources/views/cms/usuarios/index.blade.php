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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Usuários</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
		                </ol>
		                <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->

            <!-- Filtrar Registro -->
            <div class="row">
                <div class="col-4">
                    <form action="{{route('usuarios.filtro')}}" method="GET" class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <select name="filtro" class="form-control">
                                    <option value="">Filtrar por: (status)</option>
                                    <option value="1">Ativos</option>
                                    <option value="0">Inativos</option>
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

                <div class="col-4">
                    <form action="{{route('usuarios.busca')}}" method="GET" class="row">
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
                                        <th>TIPO</th>
                                        <th>STATUS</th>
                                        <th>CRIADO EM</th>
			                            <th>AÇÕES</th>
		                            </tr>
	                        	</thead>
							
								<tbody>
                                @if(count($usuarios)>0)
    								@foreach($usuarios as $usuario)
    	                        	<tr>
    		                            <th scope="row">{{$usuario->id}}</th>
                                        <td>{{$usuario->name}}</td>
                                        <td><div class="badge badge-pill badge-secondary">{{$usuario->role->label}}</div></td>
                                        <td>@if($usuario->status == 1)
                                                <div class="badge badge-pill badge-success">Ativo</div>
                                            @else
                                                <div class="badge badge-pill badge-danger">Inativo</div>
                                            @endif  
                                        </td>
    		                            <td><div class="badge badge-pill badge-info">{{$usuario->created_at ? $usuario->created_at->diffForHumans() : 'Não foi atualizado!'}}</div></td>
    		                            <td>
                                            <form action="{{route('usuarios.destroy', $usuario->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE"/>

    										<div class="btn-group" role="group" aria-label="Basic example"
    										>
                                                @if($auth->role_id == 1) <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
    											<a href="{{route('usuarios.edit', $usuario->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
                                                <button class="btn btn-danger"><i class="fas fa-trash"></i> Deletar</button>
                                                @elseif($auth->role_id == 2 && $usuario->role_id != 1)
                                                <a href="{{route('usuarios.edit', $usuario->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
                                                @if($auth->id != $usuario->id)<button class="btn btn-danger"><i class="fas fa-trash"></i> Deletar</button> @endif
                                                @endif
    										</div>
                                            </form>
    		                            </td>
    		                        </tr>
    		                        @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Não há usuários cadastrados!</td>
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
                    {{$usuarios->appends(Request::except('page'))->links()}}
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
@endsection