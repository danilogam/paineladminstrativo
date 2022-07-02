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
                            <li class="breadcrumb-item active">{{$title}}</li>
		                </ol>
		                <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                        	<table class="table table-striped mb-0">
	                        	<thead>
									<tr>
			                            <th>ID</th>
                                        <th>NOME DA PÁGINA</th>
                                        <th>TÍTULO PRINCIPAL</th>
			                            <th>ATUALIZAÇÃO</th>
			                            <th>AÇÕES</th>
		                            </tr>
	                        	</thead>
							
								<tbody>
								@foreach($pages as $page)
	                        	<tr>
		                            <th scope="row">{{$page->id}}</th>
                                    <td>{{$page->name}}</td>
                                    <td>{{$page->title}}</td>
		                            <td><div class="badge badge-pill badge-info">{{$page->updated_at ? $page->updated_at->diffForHumans() : 'Não foi atualizado!'}}</div></td>
		                            <td>
                                        <form action="{{route('pages.edit', $page->id)}}" method="POST">
                                        {{ csrf_field() }}
										<div class="btn-group" role="group" aria-label="Basic example"
										>
											<a href="{{route('pages.edit', $page->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
										</div>
                                        </form>
		                            </div>
		                        </tr>
		                        @endforeach
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