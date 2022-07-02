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
                            <li class="breadcrumb-item active">{{$title}}</li>
		                </ol>
		                <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->
            
            <!-- Filtrar Registro -->
            <div class="row">
                <div class="col-4">
                    <form action="{{route('slides.filtro')}}" method="GET" class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <select name="filtro" class="form-control">
                                    <option value="">Filtrar por:</option>
                                    <option value="1">Não publicados</option>
                                    <option value="0">Publicados</option>
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
                    <form action="{{route('slides.busca')}}" method="GET" class="row">
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
                                        <th>TÍTULO DO SLIDE</th>
                                        <th>STATUS</th>
                                        <th>CRIADO</th>
			                            <th>AÇÕES</th>
		                            </tr>
	                        	</thead>
							
								<tbody>
                                @if(count($slides)>0)
    								@foreach($slides as $slide)
    	                        	<tr>
    		                            <th scope="row">{{$slide->id}}</th>
                                        <td>{{$slide->title}}</td>
                                        <td>@if($slide->status == 0) <span class="badge badge-pill badge-success">Ativo</span> @else <span class="badge badge-pill badge-danger">Inativo</span> @endif</td>
    		                            <td><div class="badge badge-pill badge-info">{{$slide->created_at->diffForHumans()}}</div></td>
    		                            <td>
                                            <form action="{{route('slides.destroy', $slide->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE"/>

    										<div class="btn-group" role="group" aria-label="Basic example"
    										>
    											<a href="{{route('slides.edit', $slide->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
                                                <button class="btn btn-danger"><i class="fas fa-trash"></i> Deletar</button>
    										</div>
                                            </form>
    		                            </td>
    		                        </tr>
    		                        @endforeach
                                @else
                                    <tr>
                                        <td>Não há slides cadastrados!</td>
                                    </tr>
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