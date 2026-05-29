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
                            <input type="hidden" class="form-control" id="id" value="{{($data['act']=='edit') ? encrypt($video[0]->video_id) : ''}}" name="id">
							<input type="hidden" class="form-control" id="act" value="{{$data['act']}}" name="act">							
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Deskripsi</label>
								<div class="col-md-10">
									<textarea class="form-control" id="deskripsi" name="deskripsi">{{($data['act']=='edit') ? $video[0]->video_deskripsi : ''}}</textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Link YouTube</label>
								<div class="col-md-10">
									<textarea class="form-control" id="video_link" name="video_link">{{($data['act']=='edit') ? $video[0]->video_link : ''}}</textarea>
								</div>
							</div>
							@if ($data['act']=="edit")
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Publish</label>
								<div class="col-md-10">
									<div class="input-group">
										<select class="form-control selectpicker" id="video_publish" name="video_publish" data-size="10" data-live-search="true" data-style="btn-success">
                                            <option value="" selected>Apakah di Publish ?</option>
											<option value="y" {{($data['act']=='edit') ? $video[0]->video_publish == "y"  ? "selected" : "" : ""}}>Publish</option>
											<option value="t" {{($data['act']=='edit') ? $video[0]->video_publish == "t"  ? "selected" : "" : ""}}>Tidak Publish</option>
                                        </select>
									</div>
								</div>
							</div>
							@endif
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Gambar</label>
								<div class="col-md-10">
									<div id="new_upload">
										<input type="file" class="form-control" name="file" id="file" accept="image/png, image/jpeg"/>
									</div>
									<br>
									@if ($data['act']=="edit")
									<div class="input-group" id="edit_upload">
										<div id="gallery" class="gallery" style="width:300px; height:220px;" />
											@if ($video[0]->video_path==null || $video[0]->video_path=="")
												<a href="{{asset('frontend/assets_2/images/123.jpg') }}" data-lightbox="gallery-group-1">
												<img src="{{asset('frontend/assets_2/images/123.jpg') }}" style="width:300px; height:220px;"/></a>
											@else					
												<a href="{{asset($video[0]->video_path.$video[0]->video_name) }}" data-lightbox="gallery-group-1">
												<img src="{{asset($video[0]->video_path.$video[0]->video_name) }}" style="width:300px; height:220px;"/></a>
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
	<script src="{{ asset('additional/js/video.js') }}"></script>	
@endpush
