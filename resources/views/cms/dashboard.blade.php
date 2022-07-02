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
		                    <li class="breadcrumb-item active">
		                        Bem-vindo <strong>{{$auth->name}}</strong>!
		                    </li>
		                </ol>
		                <!-- breadcrumb -->
		            </div>
		        </div>
		    </div>
		    <!-- end row -->

		    <div class="row">
		    	@if($auth->role->id != 5) <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
		        <div class="col-md-4">
		            <div class="card m-b-20">
		                <div class="card-body">
		                    <h4 class="mt-0 header-title mb-3">Páginas</h4>
		                    <hr>
		                    <div class="inbox-wid">
		                    	@foreach($pages as $page)
		                        <a href="{{route('pages.edit', $page->id)}}" class="text-dark">
		                            <div class="inbox-item">
		                                <h6 class="inbox-item-author mt-0 mb-1">{{$page->name}}</h6>
		                                <p class="inbox-item-text text-muted mb-0"><small> {{$page->updated_at ? 'Atualizado há '.$page->updated_at->diffForHumans() : 'Não foi atualizado!'}}</small></p>
		                            </div>
		                        </a>
		                        @endforeach
		                    </div>  
		                </div>
		            </div>
		        </div>
		        @endif
				
				@if($auth->role->id != 4) <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
		    	@if(count($posts)>0)
		        <div class="col-md-8">
		            <div class="card m-b-20">
		                <div class="card-body">
		                    <h4 class="mt-0 header-title mb-3">Últimas postagens</h4>
		                    <hr>
		                    <div class="inbox-wid">
		                    	@foreach($posts as $post)
		                        <a href="{{route('posts.edit', $post->id)}}" class="text-dark">
		                            <div class="inbox-item">
		                                <h6 class="inbox-item-author mt-0 mb-1">{{$post->title}}</h6>
		                                <p class="inbox-item-text text-muted mb-0"><small>Criado há {{$post->created_at ? $post->updated_at->diffForHumans() : 'Não foi atualizado!'}}</small></p>
		                            </div>
		                        </a>
		                        @endforeach
		                        <div class="text-center">
			                        <a href="{{route('posts.index')}}" class="btn btn-primary mt-3">Ver mais postagens</a>
			                    </div>
		                    </div>  
		                </div>
		            </div>
		        </div>
		        @endif
		        @endif
		    </div>
		    <!-- end row -->
			
			@if($auth->role->id == 1 || $auth->role->id == 2) <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
			<!-- listagem de usuários -->
			@if(count($usuarios)>0)
		    <div class="row">
		        <div class="col-xl-12">
		            <div class="card m-b-20">
		                <div class="card-body">
		                    <h4 class="mt-0 m-b-30 header-title">Usuários</h4>

		                    <div class="table-responsive">
			                        <table class="table table-vertical">
			                        	<thead>
										<tr>
				                            <th>USUÁRIO</th>
	                                        <th>TIPO</th>
	                                        <th>CRIADO EM</th>
	                                        @if($auth->role->id != 3) <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
				                            <th>AÇÃO</th>
				                            @endif
			                            </tr>
		                        	</thead>
		                            <tbody>
	                            	@foreach($usuarios as $usuario)
		                            <tr>
		                                <td>
		                                    <img src="{{$usuario->image ? $usuario->image : 'https://via.placeholder.com/50x50'}}" alt="user-image" class="thumb-sm rounded-circle mr-2"/>
		                                    {{$usuario->name}}
		                                </td>
		                                <td><div class="badge badge-pill badge-secondary">{{$usuario->role->label}}</div></td>
		                                <td><div class="badge badge-pill badge-info">{{$usuario->created_at ? $usuario->created_at->diffForHumans() : 'Não foi atualizado!'}}</div>
		                                </td>
		                                @if($auth->role->id != 3) <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
		                                <td>
		                                    <form action="{{route('usuarios.destroy', $usuario->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE"/>

    										<div class="btn-group" role="group" aria-label="Basic example"
    										>
    											<a href="{{route('usuarios.edit', $usuario->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
    										</div>
                                            </form>
		                                </td>
		                                @endif
		                            </tr>
		                            @endforeach
		                            </tbody>
		                        </table>
		                    </div>
		                </div>
		            </div>
		        </div>
			</div>
			@endif
			@endif
			<!-- end row -->
		</div> <!-- container-fluid -->
	</div>
</div>

@endsection

@section('script')
<!--Morris Chart-->
<script src="{{ URL::asset('assets/cms/pages/dashboard.js')}}"></script>
@endsection