@extends('backend.default')
@section('content')
	
	<div id="content" class="content">
		<!-- begin breadcrumb -->
		<ol class="breadcrumb pull-right">
			<li class="breadcrumb-item"><a href="javascript:;">{{$data['title']}}</a></li>
			<li class="breadcrumb-item"><a href="javascript:;">{{$data['subtitle']}}</a></li>		
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header">{{$data['subtitle']}}</h1>		
		<!-- begin row -->
		<div class="row">
			<!-- begin col-6 -->
			<div class="col-lg-12">
				<!-- begin panel -->
				<div id="transContent" class="panel panel-inverse" data-sortable-id="form-plugins-4">
					<!-- begin panel-heading -->
					<div class="panel-heading">
						<div class="panel-heading-btn">
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
						</div>
						<h4 class="panel-title">{{$data['subtitle']}}</h4>
					</div>
					<!-- end panel-heading -->
					
					<div class="panel-body">
						<form class="form-horizontal form-bordered" id="data_form" method="post" enctype="multipart/form-data">
						@csrf
							<div class="note note-yellow m-b-15">
								<div class="note-icon f-s-20">
									<i class="fa fa-images fa-2x"></i>
								</div>
								<div class="note-content">
									<h4 class="m-t-5 m-b-5 p-b-2">Upload Notes</h4>
									<ul class="m-b-5 p-l-25">
										<li>Maksimum Gambar Yang Bisa Upload <strong>5 MB</strong></li>
										<li>Image yang diperbolehkan hanya berextension (<strong>JPG, PNG</strong>)</li>										
									</ul>
								</div>
							</div>
							<div class="row fileupload-buttonbar">
								<div class="col-md-7">
									<input type="hidden" class="form-control" id="id_umkm" value="{{$data['idUmkm']}}" name="id_umkm">
									<span class="btn btn-primary fileinput-button m-r-3">										
										<input type="file" name="file" id="file" accept="image/png, image/jpeg">
									</span>
									<button type="submit" id="btnUpload" class="btn btn-primary start m-r-3">
										<i class="fa fa-upload"></i>
										<span>Upload</span>
									</button>	
									<button type="button" id="btnKembali" class="btn btn-secondary start m-r-3" onclick="history.back()">
										<i class="fa fa-arrow-alt-circle-left"></i>
										<span>Kembali</span>
									</button>										
								</div>								
							</div><br><br>							
						</form>
						<div class="table-responsive">
							<table id="datatable" class="table table-striped table-bordered">						
							</table>					
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection

@push('scripts')
	<script src="{{ asset('additional/js/upload_umkm.js?v=1.08') }}"></script>

@endpush
