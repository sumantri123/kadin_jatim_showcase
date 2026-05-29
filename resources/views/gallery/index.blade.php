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
					
					<div class="panel-body">
						<div class="table-responsive">
							<!--<a class="{{$data['btnClass']}} action" data-href="/addBerita" style="color:white;">{{$data['btnAdd']}}</a>-->
							<input type="hidden" class="form-control" id="id" value="{{$data['id']}}" name="id">
							<!--<button type="button" id="tambah" class="{{$data['btnClass']}} action">{{$data['btnAdd']}}</button>-->
							<button type="button" id="tambah_new" class="{{$data['btnClass']}} action">{{$data['btnAdd']}}</button>
							<button type="button" id="btn_back" class="{{$data['btnClassBack']}}" onclick="history.back()">Kembali</button><br><br>							
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
	
	<div id="modal" class="modal fade modal-form" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal_label">Form Tambah / Edit Data</h5>					
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<form class="form-horizontal form-bordered" id="data_form" method="post" enctype="multipart/form-data">
					<div class="modal-body">									
						<div class="panel-body panel-form">						
							@csrf
							<input type="hidden" class="form-control" id="method_field" name="_method" value="POST" />							
							<input type="hidden" class="form-control" id="id_kat" value="{{$data['id']}}" name="id_kat">
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Gambar</label>
								<div class="col-md-10">
									<div id="new_upload">
										<input type="file" class="form-control" name="file" id="file" accept="image/png, image/jpeg"/>
									</div>
									<br>									
								</div>
							</div>																	
						</div>											
					</div>
					<div class="modal-footer">							
						<!--<button type="button" id="btn_simpan" class="{{$data['btnClassSuccess']}}">Simpan</button>-->
						<button type="submit" id="btn_simpan" class="{{$data['btnClassSuccess']}}">Simpan</button>
						<a href="javascript:;" class="{{$data['btnClassBack']}}" data-dismiss="modal">Close</a>							
					</div>					
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@endsection

@push('scripts')
	<script src="{{ asset('additional/js/gambar.js?v=1.13') }}"></script>	
@endpush
	