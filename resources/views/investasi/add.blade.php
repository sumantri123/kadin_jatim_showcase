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
                            <input type="hidden" class="form-control" id="id" value="{{($data['act']=='edit') ? encrypt($investasi[0]->investasi_id) : ''}}" name="id">
							<input type="hidden" class="form-control" id="act" value="{{$data['act']}}" name="act">
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Judul Berita</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="investasi_judul" name="investasi_judul" placeholder="Judul Berita" value="{{($data['act']=='edit') ? $investasi[0]->investasi_judul : ''}}"/>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Kategori</label>
								<div class="col-md-10">
									<div class="input-group">
										<select class="form-control selectpicker" id="kategori_id" name="kategori_id" data-size="10" data-live-search="true" data-style="btn-success">
                                            <option value="" {{($data['act']=='edit') ? '':'selected'}}>Pilih Kategori Berita ?</option>
											@foreach($kategori as $kategoriBerita)
												<option value="{{ $kategoriBerita->kategori_id }}" {{($data['act']=='edit') ? ( $investasi[0]->id_kategori == $kategoriBerita->kategori_id ) ? 'selected' : '' : ''}}>{{ ucfirst(trans($kategoriBerita->kategori_nama)) }}</option>
											@endforeach                                
                                        </select>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Tanggal Berita</label>
								<div class="col-md-10">
									<div class="input-group date" id="datepicker-default" data-date-format="dd-mm-yyyy" value="04/1/2022">
										<input type="text" class="form-control" name="investasi_tanggal" id="datepicker" placeholder="Tanggal Berita" value="{{($data['act']=='edit') ? $investasi[0]->investasi_tanggal : ''}}"/>
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div>									
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Isi Berita</label>
								<div class="col-md-10">
									<textarea class="summernote" id="investasi_isi" name="investasi_isi">{{($data['act']=='edit') ? $investasi[0]->investasi_isi : ''}}</textarea>
								</div>
							</div>							
							@if ($data['act']=="edit")
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Publish</label>
								<div class="col-md-10">
									<div class="input-group">
										<select class="form-control selectpicker" id="investasi_publish" name="investasi_publish" data-size="10" data-live-search="true" data-style="btn-success">
                                            <option value="" selected>Apakah di Publish ?</option>
											<option value="y" {{($data['act']=='edit') ? $investasi[0]->investasi_publish == "y"  ? "selected" : "" : ""}}>Publish</option>
											<option value="t" {{($data['act']=='edit') ? $investasi[0]->investasi_publish == "t"  ? "selected" : "" : ""}}>Tidak Publish</option>                                            
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
											@if ($investasi[0]->investasi_path==null || $investasi[0]->investasi_path=="")
												<a href="{{asset('frontend/assets_2/images/123.jpg') }}" data-lightbox="gallery-group-1">
												<img src="{{asset('frontend/assets_2/images/123.jpg') }}" style="width:300px; height:220px;"/></a>
											@else					
												<a href="{{asset($investasi[0]->investasi_path.$investasi[0]->investasi_gambar_name) }}" data-lightbox="gallery-group-1">
												<img src="{{asset($investasi[0]->investasi_path.$investasi[0]->investasi_gambar_name) }}" style="width:300px; height:220px;"/></a>
											@endif
										</div>&emsp;
										<i class="fas fa-times-circle fa-2x" id="delete_image"></i>									
									</div>
									@endif
								</div>
							</div>	
							<div class="form-group row">
								<label class="col-md-2 col-form-label">Audio</label>
								<div class="col-md-10">
									<div id="new_uploadx">
										<input type="file" class="form-control" name="audio_file" id="audio_file" accept="audio/*"/>
									</div>																	
									<br>
									@if ($data['act']=="edit")
									<div class="input-group" id="edit_uploadx">
										<audio controls>
											<source src="{{asset($investasi[0]->investasi_path.$investasi[0]->investasi_audio_name) }}" type="audio/ogg">									  									
										</audio>&emsp;<i class="fas fa-times-circle fa-2x" id="delete_audio"></i>		
									</div>															
									@endif
								<br>
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
	<script src="{{ asset('additional/js/investasi.js?v=1.04') }}"></script>
@endpush
