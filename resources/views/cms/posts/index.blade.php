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
                            <li class="breadcrumb-item active">{{$title}}</li>
		                </ol>
		                <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->
            
            <!-- Filtrar Registro -->
            <div class="row">
                <div class="col-4">
                    <form action="{{route('posts.filtro')}}" method="GET" class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <select name="filtro" class="form-control">
                                    <option value="">Filtrar por:</option>
                                    <option value="0">Rascunhos</option>
                                    <option value="1">Publicados</option>
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
                    <form action="{{route('posts.busca')}}" method="GET" class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" name="busca" placeholder="Buscar por: (titulo)" class="form-control">
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
                                        <th>TÍTULO DO POST</th>
                                        <th>CATEGORIA</th>
                                        <th>STATUS</th>
                                        <th>ATUALIZAÇÃO</th>
			                            <th>AÇÕES</th>
		                            </tr>
	                        	</thead>
							
								<tbody>
                                @if(count($posts)>0)
    								@foreach($posts as $post)
    	                        	<tr>
    		                            <th scope="row">{{$post->id}}</th>
                                        <td>{{$post->title}}</td>
                                        <td><div class="badge badge-pill badge-secondary">{{$post->categoria->label ?? 'Sem categoria'}}</div></td>
                                        <td>@if($post->status == 1) <span class="badge badge-pill badge-success">Publicado</span> @else <span class="badge badge-pill badge-danger">Rascunho</span> @endif</td>
    		                            <td><div class="badge badge-pill badge-info">{{$post->updated_at ? $post->updated_at->diffForHumans() : 'Não foi atualizado!'}}</div></td>
    		                            <td>
                                            <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE"/>

    										<div class="btn-group" role="group" aria-label="Basic example"
    										>
    											<a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
                                                <button class="btn btn-danger"><i class="fas fa-trash"></i> Deletar</button>
    										</div>
                                            </form>
    		                            </td>
    		                        </tr>
    		                        @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Não há posts cadastrados!</td>
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
                    {{$posts->appends(Request::except('page'))->links()}}
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
@endsection