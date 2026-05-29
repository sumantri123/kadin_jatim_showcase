@extends('frontendz.layout_home.default')
@push('style')

      <!-- Aditional Style CSS Here -->

@endpush
@section('content')

<!-- block-wrapper-section
			================================================== -->
		<section class="block-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-sm-8">

						<!-- block content -->
						<div class="block-content">

							<!-- single-post box -->
							<div class="single-post-box">

								<div class="title-post">
									<h1>{{$umkmDet[0]->umkm_nama}}</h1>
									<ul class="post-tags">
										<li><i class="fa fa-calendar"></i>Tanggal Bergabung : {{date('F d, Y', strtotime($umkmDet[0]->umkm_tgl_bergabung))}}</li>
										<li><i class="fa fa-map-marker"></i>Alamat : {{ ($umkmDet[0]->umkm_alamat) }}</li>
										<li><i class="fa fa-phone"></i>Telp : {{ ($umkmDet[0]->umkm_no_hp) }}</li>
									</ul>
								</div>
								
								<div class="post-gallery">
									@if ($umkmDet[0]->umkm_path==null || $umkmDet[0]->umkm_path=="")													
										<img src="{{asset(Session::get('logo'))}}" alt="">
									@else										
										<img class="card-img-top rounded-top rounded-bottom" src="{{asset($umkmDet[0]->umkm_path.$umkmDet[0]->umkm_name.'.'.$umkmDet[0]->umkm_exe)}}" alt="">
									@endif																			
								</div>
								
								<div class="post-content">
									<blockquote>
										<p>{{$umkmDet[0]->umkm_keterangan}}</p>
									</blockquote>	
								</div>
																
								<hr>
								@if (($umkmImage)->isNotEmpty())
									<div class="carousel-box owl-wrapper">
										<div class="title-section">
											<h1><span>PRODUCK UMKM </span></h1>
										</div>
										<div class="owl-carousel" data-num="3">
											@for ($i = 0; $i < count($umkmImage); $i++)  
											<div class="item news-post image-post3">
												<img class="card-img-top rounded-top rounded-bottom" src="{{asset($umkmImage[$i]->umkm_image_path.$umkmImage[$i]->umkm_image_name)}}" height="170px">											
											</div>																			
											@endfor 
										</div>
									</div>	
								@else
									<div class="info">
									  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
										<h4>Produck Belum Tersedia</h4>										
									</div>
								@endif																
								<br>
								<div class="center-button">
									<a href="/umkms"><i class="fa fa-refresh"></i> LIHAT SEMUA UMKM</a>
								</div>
							</div>
							<!-- End single-post box -->

						</div>
						<!-- End block content -->

					</div>

					@include('frontendz.layout_home.parts_home._sidebar')	
				</div>

			</div>
		</section>
		<!-- End block-wrapper-section -->

@endsection

@push('scripts')

@endpush
