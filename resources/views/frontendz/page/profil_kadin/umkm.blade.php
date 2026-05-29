@extends('frontendz.layout_home.default')
@push('style')


@endpush
@section('content')
	
	<section class="block-wrapper">
		<div class="container">

			<!-- block content -->
			<div class="block-content non-sidebar">

				<!-- grid box -->
				<div class="grid-box">
					<div class="title-section">
						<h1><span class="world">{{$data['subtitle']}}</span></h1>
					</div>
				</div>
				<!-- End grid box -->
				<ul class="autor-list">
					
					@for ($i = 0; $i < count($umkmAll); $i++)  					
						<li>
							<div class="autor-box">
								@if ($umkmAll[$i]->umkm_path==null || $umkmAll[$i]->umkm_path=="")													
									<img src="{{asset(Session::get('logo'))}}" alt="">
								@else										
									<img class="card-img-top rounded-top rounded-bottom" height="80px" width="80px" src="{{asset($umkmAll[$i]->umkm_path.$umkmAll[$i]->umkm_name.'.'.$umkmAll[$i]->umkm_exe)}}" alt="">
								@endif									

								<div class="autor-content">

									<div class="autor-title">
										<h1><span><a href="/umkm/{{base64_encode($umkmAll[$i]->umkm_id)}}">{{$umkmAll[$i]->umkm_nama}}</a></span><a href="#">{{$umkmProduck[$i]}} Produck</a></h1>
										<!--<ul class="autor-social">
											<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
											<li><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>
											<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
											<li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li>
											<li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
											<li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
											<li><a href="#" class="dribble"><i class="fa fa-dribbble"></i></a></li>
										</ul>-->
									</div>

									<p>{{$umkmAll[$i]->umkm_keterangan}}</p>

								</div>

							</div>

							<div class="autor-last-line">
								<ul class="autor-tags">																		
									<li><a href="#"><i class="fa fa-calendar"></i>&nbsp;{{$umkmAll[$i]->umkm_tgl_bergabung}}</a></li>
									<li><a href="#"><i class="fa fa-eye"></i>&nbsp;{{$umkmAll[$i]->umkm_view}}</a></li>
									<li><a href="#"><i class="fa fa-map-marker"></i>&nbsp;{{$umkmAll[$i]->umkm_alamat}}</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>&nbsp;{{$umkmAll[$i]->umkm_email}}</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>&nbsp;{{$umkmAll[$i]->umkm_no_hp}}</a></li>
									<li><a href="/umkm/{{base64_encode($umkmAll[$i]->umkm_id)}}"><i class="fa fa-bullseye"></i>&nbsp;Lihat Detail</a></li>
								</ul>								
							</div>

						</li>
					@endfor 
				</ul>
				
				<!-- pagination box -->
				<div class="pagination-box">
					<ul class="pagination-list">
						{{ $umkmAll->links() }}		
					</ul>					
				</div>
				<!-- End Pagination box -->
			</div>
			<!-- End block content -->
		</div>
	</section>	

@endsection

@push('scripts')

@endpush
