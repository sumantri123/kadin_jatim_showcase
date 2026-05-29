@extends('backend.default')
@section('content')

	<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin breadcrumb -->
		<ol class="breadcrumb pull-right">
			<li class="breadcrumb-item"><a href="javascript:;">{{$data['title']}}</a></li>
			<li class="breadcrumb-item"><a href="javascript:;">{{$data['subtitle']}}</a></li>		
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header">{{$data['header']}}</h1>
		<!-- end page-header -->
		
		<!-- begin row -->
		<div class="row">		
			<!-- begin col-10 -->
			<div class="col-lg-12">
				<!-- begin panel -->
				<div class="panel panel-inverse">
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
					<!--<img src="{{asset('frontend/assets_new/images/berita/br_1.jpg')}}" alt="slide 1" class="">-->
					<!-- end panel-heading -->
					<!-- begin alert -->
					<!--<div class="alert alert-warning fade show">
						<button type="button" class="close" data-dismiss="alert">
							<span aria-hidden="true">&times;</span>
						</button>
						The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
					</div>-->
					<!-- end alert -->
					<!-- begin panel-body -->
					
					<div class="panel-body">
						<div class="table-responsive">
							<!--<a class="{{$data['btnClass']}} action" data-href="/addBerita" style="color:white;">{{$data['btnAdd']}}</a>-->
							<button type="button" id="tambah" class="{{$data['btnClass']}} action">{{$data['btnAdd']}}</button><br><br>
							<table id="datatable" class="table table-striped table-bordered">						
							</table>
						</div>
					</div>
					<!-- end panel-body -->
				</div>
				<!-- end panel -->
			</div>
			<!-- end col-10 -->
		</div>
		<!-- end row -->
	</div>
	<!-- end #content -->
	
	<div class="modal fade modal-file" tabindex="-1" id="exampleLargeModal" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">            
				<div class="modal-body">
					<embed src="#" id="lihat_file" frameborder="0" width="100%" height="525px">					
				</div>			
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script src="{{ asset('additional/js/file.js?v=1.13') }}"></script>	
@endpush
	