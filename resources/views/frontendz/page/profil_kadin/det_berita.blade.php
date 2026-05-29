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
									<h1>{{$berita[0]->berita_judul}}</h1>
									<ul class="post-tags">
										<li><i class="fa fa-calendar"></i>{{date('F d, Y', strtotime($berita[0]->berita_tanggal))}}</li>
										<!--<li><i class="fa fa-user"></i><a href="#">{{($berita[0]->berita_update_who == "")? ucwords(trans($berita[0]->berita_create_who)) : ucwords(trans($berita[0]->berita_update_who))}}</a></li>-->
										<li><i class="fa fa-eye"></i>{{$berita[0]->berita_view}}</li>
										<li>{{($berita[0]->berita_sumber == null) ? "" : $berita[0]->berita_sumber}}</li>
									</ul>
								</div>
								
								<div class="post-gallery">
									@if ($berita[0]->berita_path==null || $berita[0]->berita_path=="")													
										<img src="{{asset(Session::get('logo'))}}" alt="">
									@else										
										<img class="card-img-top rounded-top rounded-bottom" src="{{asset($berita[0]->berita_path.$berita[0]->berita_gambar_name)}}" alt="">
									@endif																			
								</div>

								<div class="post-content">
									<p>{!! html_entity_decode($berita[0]->berita_isi, ENT_QUOTES, 'UTF-8') !!}</p>
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
												<h2><a href="/news/{{base64_encode($beritaTerkini[$i]->berita_id)}}">{{ucfirst(strtolower(trans($beritaTerkini[$i]->berita_judul)))}}</a></h2>
												<ul class="post-tags">
													<li><i class="fa fa-calendar"></i>{{$beritaTerkini[$i]->berita_tanggal}}</li>
												</ul>
											</div>
										</div>																			
										@endfor 
									</div>
								</div>
								<!-- End carousel box -->

								<!-- contact form box -->
								<!--<div class="contact-form-box">
									<div class="title-section">
										<h1><span>Leave a Comment</span> <span class="email-not-published">Your email address will not be published.</span></h1>
									</div>
									<form id="comment-form">
										<div class="row">
											<div class="col-md-4">
												<label for="name">Name*</label>
												<input id="name" name="name" type="text">
											</div>
											<div class="col-md-4">
												<label for="mail">E-mail*</label>
												<input id="mail" name="mail" type="text">
											</div>
											<div class="col-md-4">
												<label for="website">Website</label>
												<input id="website" name="website" type="text">
											</div>
										</div>
										<label for="comment">Comment*</label>
										<textarea id="comment" name="comment"></textarea>
										<button type="submit" id="submit-contact">
											<i class="fa fa-comment"></i> Post Comment
										</button>
									</form>
								</div>-->
								<!-- End contact form box -->

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
