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
                            <input type="hidden" class="form-control" id="id" value="{{($data['act']=='edit') ? encrypt($profilKadin[0]->id) : ''}}" name="id">
							<input type="hidden" class="form-control" id="act" value="{{$data['act']}}" name="act">
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Alamat</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="{{($data['act']=='edit') ? $profilKadin[0]->alamat : ''}}"/>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Visi</label>
								<div class="col-md-10">
									<textarea class="summernote" id="visi" name="visi">{{($data['act']=='edit') ? $profilKadin[0]->visi : ''}}</textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Misi</label>
								<div class="col-md-10">
									<textarea class="summernote" id="misi" name="misi">{{($data['act']=='edit') ? $profilKadin[0]->misi : ''}}</textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Sejarah Singkat</label>
								<div class="col-md-10">
									<textarea class="summernote" id="sejarah_singkat" name="sejarah_singkat">{{($data['act']=='edit') ? $profilKadin[0]->sejarah_singkat : ''}}</textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Arti Logo</label>
								<div class="col-md-10">
									<textarea class="summernote" id="arti_logo" name="arti_logo">{{($data['act']=='edit') ? $profilKadin[0]->arti_logo : ''}}</textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Logo</label>
								<div class="col-md-10">
									<div id="new_uploadx">
										<input type="file" class="form-control" name="file" id="file" accept="image/png, image/jpeg"/>
									</div>
									<br>
									@if ($data['act']=="edit")
									<div class="input-group" id="edit_uploadx">
										<div id="gallery" class="gallery" style="width:300px; height:220px;" />
											@if ($profilKadin[0]->profil_path==null || $profilKadin[0]->profil_path=="")
												<a href="{{asset('frontend/assets_2/images/123.jpg') }}" data-lightbox="gallery-group-1">
												<img src="{{asset('frontend/assets_2/images/123.jpg') }}" style="width:300px; height:220px;"/></a>
											@else					
												<a href="{{asset($profilKadin[0]->profil_path.$profilKadin[0]->profil_logo_name) }}" data-lightbox="gallery-group-1">
												<img src="{{asset($profilKadin[0]->profil_path.$profilKadin[0]->profil_logo_name) }}" style="width:300px; height:220px;"/></a>
											@endif
										</div>&emsp;
										<i class="fas fa-times-circle fa-2x" id="delete_image"></i>									
									</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Logo Header</label>
								<div class="col-md-10">
									<div id="new_uploady">
										<input type="file" class="form-control" name="filex" id="filex" accept="image/png, image/jpeg"/>
									</div>
									<br>
									@if ($data['act']=="edit")
									<div class="input-group" id="edit_uploady">
										<div id="gallery" class="gallery" style="width:300px; height:220px;" />
											@if ($profilKadin[0]->profil_path==null || $profilKadin[0]->profil_path=="")												
												<a href="{{asset('frontend/assets_2/images/123.jpg') }}" data-lightbox="gallery-group-1">
												<img src="{{asset('frontend/assets_2/images/123.jpg') }}" style="width:300px; height:220px;"/></a>
											@else																	
												<a href="{{asset($profilKadin[0]->profil_path.$profilKadin[0]->profil_header_name) }}" data-lightbox="gallery-group-1">
												<img src="{{asset($profilKadin[0]->profil_path.$profilKadin[0]->profil_header_name) }}" style="width:300px; height:220px;"/></a>
											@endif
										</div>&emsp;
										<i class="fas fa-times-circle fa-2x" id="delete_image"></i>									
									</div>
									@endif
								</div>
							</div>							
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
	<script src="{{ asset('additional/js/profil_kadin.js') }}"></script>
@endpush
