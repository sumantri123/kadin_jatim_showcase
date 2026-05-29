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
									<h1>{{$rilisDet[0]->rilis_judul}}</h1>
									<ul class="post-tags">
										<li><i class="fa fa-calendar"></i>{{date('F d, Y', strtotime($rilisDet[0]->rilis_tanggal))}}</li>										
										<li><i class="fa fa-eye"></i>{{$rilisDet[0]->rilis_view}}</li>										
									</ul>
								</div>
								
								<div class="post-gallery">																					
									<img src="{{asset(Session::get('logo'))}}" alt="">									
								</div>

								<div class="post-content">
									<p>{!! html_entity_decode($rilisDet[0]->rilis_isi, ENT_QUOTES, 'UTF-8') !!}</p>
								</div>							
								@if (($rilisImage)->isNotEmpty())
									<div class="carousel-box owl-wrapper">
										<div class="title-section">
											<h1><span>Image Rilis</span></h1>
										</div>
										<div class="owl-carousel" data-num="3">
											@for ($i = 0; $i < count($rilisImage); $i++)  
											<div class="item news-post image-post3">											
												<img src="{{asset(Session::get('logo'))}}" style="height:180px"/>											
											</div>																			
											@endfor 
										</div>
									</div>								
								@endif
								
								<!-- carousel box -->
								<div class="carousel-box owl-wrapper">
									<div class="title-section">
										<h1><span>Rilis Lainnya</span></h1>
									</div>
									<div class="owl-carousel" data-num="3">
										@for ($i = 0; $i < count($rilisRandom); $i++)  
										<div class="item news-post image-post3">											
											<img src="{{asset(Session::get('logo'))}}" style="height:180px"/>											
											<div class="hover-box">
												<h2><a href="/rilis/{{base64_encode($rilisRandom[$i]->rilis_id)}}">{{ucfirst(strtolower(trans($rilisRandom[$i]->rilis_judul)))}}</a></h2>
												<ul class="post-tags">
													<li><i class="fa fa-calendar"></i>{{$rilisRandom[$i]->rilis_tanggal}}</li>
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
