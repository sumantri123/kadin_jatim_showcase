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
									<h1>{{$opini[0]->opini_judul}}</h1>
									<ul class="post-tags">
										<li><i class="fa fa-calendar"></i>{{date('F d, Y', strtotime($opini[0]->opini_tanggal))}}</li>
										<li><i class="fa fa-user"></i>by <a href="#">{{($opini[0]->opini_update_who == "")? ucwords(trans($opini[0]->opini_create_who)) : ucwords(trans($opini[0]->opini_update_who))}}</a></li>										
										<li><i class="fa fa-eye"></i>{{$opini[0]->opini_view}}</li>
									</ul>
								</div>
								
								<div class="post-gallery">
									@if ($opini[0]->opini_path==null || $opini[0]->opini_path=="")													
										<img src="{{asset(Session::get('logo'))}}" alt="">
									@else										
										<img class="card-img-top rounded-top rounded-bottom" src="{{asset($opini[0]->opini_path.$opini[0]->opini_gambar_name)}}" alt="">
									@endif																			
								</div>

								<div class="post-content">
									<p>{!! html_entity_decode($opini[0]->opini_isi, ENT_QUOTES, 'UTF-8') !!}</p>
								</div>																															

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
