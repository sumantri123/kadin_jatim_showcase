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
								<h1>{{$data['subtitle']}}</h1>								
							</div>
							
							<div class="post-gallery">
								@if ($profilKadin[0]->profil_path==null || $profilKadin[0]->profil_path=="" || $profilKadin[0]->profil_path=="null")													
									<img src="{{asset(Session::get('logo'))}}" alt="">
								@else										
									<img class="card-img-top rounded-top rounded-bottom" src="{{asset($profilKadin[0]->profil_path.$profilKadin[0]->profil_logo_name)}}" alt="">
								@endif																			
							</div>

							<div class="post-content">
								<p>{!! html_entity_decode($profilKadin[0]->arti_logo, ENT_QUOTES, 'UTF-8') !!}</p>
							</div>							
															
							<!-- carousel box -->
							<div class="carousel-box owl-wrapper">
								<div class="title-section">
									<h1><span>Berita Lainnya</span></h1>
								</div>
								<div class="owl-carousel" data-num="3">
									@for ($i = 0; $i < count($beritaTerkini); $i++)  
									<div class="item news-post image-post3">
										@if ($beritaTerkini[$i]->berita_path==null || $beritaTerkini[$i]->berita_path=="" || $beritaTerkini[$i]->berita_path=="null")		
											<img src="{{asset(Session::get('logo'))}}" style="height:180px"/>
										@else
											<img src="{{asset($beritaTerkini[$i]->berita_path.$beritaTerkini[$i]->berita_gambar_name)}}" style="height:180px"/>
										@endif	
										<div class="hover-box">
											<h2><a href="/news/{{\Crypt::encrypt($beritaTerkini[$i]->berita_id)}}">{{ucfirst(strtolower(trans($beritaTerkini[$i]->berita_judul)))}}</a></h2>
											<ul class="post-tags">
												<li><i class="fa fa-calendar"></i>{{$beritaTerkini[$i]->berita_tanggal}}</li>
											</ul>
										</div>
									</div>																			
									@endfor 
								</div>
							</div>
							<!-- End carousel box -->

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
