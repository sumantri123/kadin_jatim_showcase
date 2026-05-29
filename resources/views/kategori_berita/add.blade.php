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
					<!-- begin panel-body -->
					<form class="form-horizontal form-bordered" id="data_form" method="post" enctype="multipart/form-data">
						<div class="panel-body panel-form">						
							@csrf
							<input type="hidden" class="form-control" id="method_field" name="_method" value="{{($data['act']=='edit') ? 'PUT' : 'POST'}}" />
                            <input type="hidden" class="form-control" id="id" value="{{($data['act']=='edit') ? encrypt($kategori[0]->kategori_id) : ''}}" name="id">
							<input type="hidden" class="form-control" id="act" value="{{$data['act']}}" name="act">
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Kategori Berita</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="sektor_nama" name="sektor_nama" placeholder="Kategori Berita" value="{{($data['act']=='edit') ? $kategori[0]->kategori_nama : ''}}"/>
								</div>
							</div>											
							@if ($data['act']=="edit")
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Kategori Status</label>
								<div class="col-md-10">
									<div class="input-group">
										<select class="form-control selectpicker" id="sektor_status" name="sektor_status" data-size="10" data-live-search="true" data-style="btn-success">
                                            <option value="" selected>Pilih Status ?</option>
											<option value="y" {{($data['act']=='edit') ? $kategori[0]->kategori_status == "y"  ? "selected" : "" : ""}}>Aktif</option>
											<option value="t" {{($data['act']=='edit') ? $kategori[0]->kategori_status == "t"  ? "selected" : "" : ""}}>Tidak Aktif</option>                                            
                                        </select>
									</div>
								</div>
							</div>
							@endif
						</div>
						<!-- end panel-body -->
						<div class="panel-footer">
							@if ($data['act']=="add")
								<button type="submit" id="btn_simpan" class="{{$data['btnClassSuccess']}}">Simpan</button>
							@else
								<button type="submit" id="btn_update" class="{{$data['btnClassSuccess']}}">Update</button>
							@endif
							<button type="button" id="btn_back" class="{{$data['btnClassBack']}}" onclick="history.back()">Kembali</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
@endsection

@push('scripts')
	<script src="{{ asset('additional/js/kategori_berita.js') }}"></script>	
@endpush
