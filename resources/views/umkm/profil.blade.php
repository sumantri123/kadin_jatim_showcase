@extends('backend.default')
@section('content')

	<!-- begin #content -->
	<div id="content" class="content content-full-width">
		<!-- begin profile -->
		<div class="profile">
			<div class="profile-header">
				<!-- BEGIN profile-header-cover -->
				<div class="profile-header-cover"></div>
				<!-- END profile-header-cover -->
				<!-- BEGIN profile-header-content -->
				<div class="profile-header-content">
					<!-- BEGIN profile-header-img -->
					<div class="profile-header-img">
						<img src="{{asset($profil[0]->umkm_path.$profil[0]->umkm_name.'.'.$profil[0]->umkm_exe)}}" alt="">
					</div>
					<!-- END profile-header-img -->
					<!-- BEGIN profile-header-info -->
					<div class="profile-header-info">
						<h4 class="m-t-10 m-b-5">{{$profil[0]->umkm_nama}}</h4>
						<p class="m-b-10">{{$profil[0]->umkm_alamat}}</p>						
						<a href="#" class="btn btn-xs btn-yellow">{{$profil[0]->umkm_email}}</a>
					</div>
					<!-- END profile-header-info -->
				</div>
				<!-- END profile-header-content -->
				<!-- BEGIN profile-header-tab -->
				<ul class="profile-header-tab nav nav-tabs">					
					<li class="nav-item"><a href="#profile-about" class="nav-link active" data-toggle="tab">PROFIL</a></li>
					
				</ul>
				<!-- END profile-header-tab -->
			</div>
		</div>
		<!-- end profile -->
		<!-- begin profile-content -->
		<div class="profile-content">
			<!-- begin tab-content -->
			<div class="tab-content p-0">				
				<!-- begin #profile-about tab -->
				<div class="tab-pane fade show active" id="profile-about">
					<!-- begin table -->
					<div class="table-responsive">
						<table class="table table-profile">
							<thead>
								<tr>
									<th></th>
									<th>
										<h4>{{$profil[0]->umkm_nama}}</h4>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr class="highlight">
									<td class="field">Alamat</td>
									<td>{{$profil[0]->umkm_nama}}</td>
								</tr>
								<tr class="divider">
									<td colspan="2"></td>
								</tr>
								<tr>
									<td class="field">No Hp</td>
									<td><i class="fa fa-mobile fa-lg m-r-5"></i> {{$profil[0]->umkm_no_hp}}</td>
								</tr>
								<tr>
									<td class="field">Email</td>
									<td>{{$profil[0]->umkm_email}}</td>
								</tr>
								<tr>
									<td class="field">Tanggal Bergabung</td>
									<td>{{$profil[0]->umkm_tgl_bergabung}}</td>
								</tr>
								<tr>
									<td class="field">Status</td>
									<td>{{($profil[0]->umkm_publish == 'y') ? "Aktif":"Tidak Aktif" }}</td>
								</tr>
								<tr class="divider">
									<td colspan="2"></td>
								</tr>
								<tr class="highlight">
									<td class="field">Keterangan</td>
									<td>{{$profil[0]->umkm_keterangan}}</td>
								</tr>								
							</tbody>
						</table>
					</div>
					<!-- end table -->
				</div>
				<!-- end #profile-about tab -->				
			</div>
			<!-- end tab-content -->
		</div>
		<!-- end profile-content -->
	</div>
	<!-- end #content -->

@endsection

@push('scripts')
	<!--<script src="{{ asset('additional/js/profil.js') }}"></script>	-->
@endpush
	