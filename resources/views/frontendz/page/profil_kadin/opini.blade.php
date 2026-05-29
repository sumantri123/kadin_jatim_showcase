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
								<h1><span class="world">Kumpulan Opini</span></h1>
							</div>
							@for ($i = 0; $i < count($opini); $i++)  
								<div class="news-post article-post">
									<ul class="list-posts">
										<li>
											@if ($opini[$i]->opini_path==null || $opini[$i]->opini_path=="" || $opini[$i]->opini_path=="null")		
												<img src="{{asset(Session::get('logo'))}}" style="height:100px;width:150px;"/>
											@else
												<img src="{{asset($opini[$i]->opini_path.$opini[$i]->opini_gambar_name)}}" style="height:100px;width:150px;"/>
											@endif											
											<div class="post-content">
												<h2 style="font-size:17px;max-height:80px;"><a href="/op/{{base64_encode($opini[$i]->opini_id)}}">{{($opini[$i]->opini_judul)}}</a></h2>
												<ul class="post-tags">
													<li><i class="fa fa-calendar"></i>{{date('d-m-Y',strtotime($opini[$i]->opini_tanggal))}}
													<li><i class="fa fa-user"></i>by {{($opini[$i]->opini_update_who == null) ? $opini[$i]->opini_create_who : $opini[$i]->opini_update_who}}</li>												
													<li><i class="fa fa-eye"></i>{{($opini[$i]->opini_view==null) ? 0:$opini[$i]->opini_view}}</li>
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
								{{ $opini->links() }}		
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
