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
						<br><br>
						<!-- carousel box -->
						<div class="article-box">

							<div class="title-section">
								<h1><span class="world">Kumpulan Rilis</span></h1>
							</div>
							@for ($i = 0; $i < count($rilisAll); $i++)  
								<div class="news-post article-post">
									<ul class="list-posts">
										<li>
											
											<img src="{{asset(Session::get('logo'))}}" style="height:100px;width:150px;"/>											
											<div class="post-content">
												<h2 style="font-size:17px;max-height:80px;"><a href="/rilis/{{base64_encode($rilisAll[$i]->rilis_id)}}">{{($rilisAll[$i]->rilis_judul)}}</a></h2>
												<ul class="post-tags">
													<li><i class="fa fa-calendar"></i>{{date('d-m-Y',strtotime($rilisAll[$i]->rilis_tanggal))}}								
													<li><i class="fa fa-eye"></i>{{($rilisAll[$i]->rilis_view==null) ? 0:$rilisAll[$i]->rilis_view}}</li>													
												</ul>											
											</div>
										</li>
										
									</ul>								
								</div>
							@endfor  
						</div>
						<!-- End carousel box -->
											
						<!-- pagination box -->
						<div class="pagination-box">
							<ul class="pagination-list">
								{{ $rilisAll->links() }}		
							</ul>						
						</div>
						<!-- End Pagination box -->										
					</div>

					@include('frontendz.layout_home.parts_home._sidebar')	
				</div>

			</div>
		</section>
		<!-- End block-wrapper-section -->

@endsection

@push('scripts')

@endpush
