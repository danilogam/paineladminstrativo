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
                            <li class="breadcrumb-item active">{{$galeria->name}}</li>
                        </ol>
                        <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->

            <div class="row">
            	<!-- Verifica e mostra mensagem de sucesso -->
                @include('cms.includes.alert_messages')
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <div class="m-b-30">
                                <form action="{{route('file.up', $galeria->id)}}" class="dropzone" method="POST" enctype="multipart/form-data">
                                	{{ csrf_field() }}
                                	<input type="hidden" name="galeria_id" value="{{$galeria->id}}" />

                                    <div class="fallback">
                                    	<div class="dz-message needsclick" data-dz-message><span>Your Custom Message</span></div>
                                        <input name="file" type="file" multiple="multiple">
                                    </div>
                                </form>
                            </div>

                            <div class="text-right m-t-15">
                                <a href="{{route('files.all', $galeria->id)}}" class="btn btn-info"><i class="fas fa-sync-alt"></i> Atualizar imagens</a>
                                <a href="{{route('galerias.index')}}" class="btn btn-danger"><i class="fas fa-window-close"></i> Cancelar</a>
                            </div>

                            <hr>
							
							<div class="row">
								@if(count($files)>0)
		                            @foreach($files as $file)
		                            <div class="col-md-2 text-center">
		                            	<img src="{{$file->file}}" alt="" width="100%" class="mb-2" />
		                            	<form action="{{route('file.del', $file->id)}}" method="POST">
		                            		{{ csrf_field() }}
		                            		<button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Remover</button>
		                            	</form>
		                            </div>
		                            @endforeach
	                            @else

		                            <div class="col-md-12"><p>Não há imagens cadastradas nesta galeria!</p></div>
	                            @endif
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->        
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
@endsection

@section('css')
<!-- Dropzone css -->
<link href="{{URL::asset('assets/cms/plugins/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('scripts')
<!-- Dropzone js -->
<script src="{{ URL::asset('assets/cms/plugins/dropzone/dist/dropzone.js')}}"></script>
<script>
var dropzone = new Dropzone('.dropzone', {
    dictDefaultMessage: 'Selecione as imagens para upload',
    dictFileTooBig: 'Arquivo muito gande. Máx: 500kb.',
    dictFallbackText: 'Houve um erro ao subir a imagem, tente novamente.',
    error: function(file, response, errors) {
        $(file.previewElement).find('.dz-error-message').text(response.errors.file).show().css('opacity', '1');
        $(file.previewElement).find('.dz-error-mark').show().css('opacity', '1');
    }
});
</script>
@endsection