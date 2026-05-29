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
								<h1><span class="world">Kumpulan Berita</span></h1>
							</div>
							@for ($i = 0; $i < count($berita); $i++)  
								<div class="news-post article-post">
									<ul class="list-posts">
										<li>
											@if ($berita[$i]->berita_path==null || $berita[$i]->berita_path=="" || $berita[$i]->berita_path=="null")		
												<img src="{{asset(Session::get('logo'))}}" style="height:100px;width:150px;"/>
											@else
												<img src="{{asset($berita[$i]->berita_path.$berita[$i]->berita_gambar_name)}}" style="height:100px;width:150px;"/>
											@endif											
											<div class="post-content">
												<h2 style="font-size:17px;max-height:80px;"><a href="/news/{{base64_encode($berita[$i]->berita_id)}}">{{($berita[$i]->berita_judul)}}</a></h2>
												<ul class="post-tags">
													<li><i class="fa fa-calendar"></i>{{date('d-m-Y',strtotime($berita[$i]->berita_tanggal))}}
													<!--<li><i class="fa fa-user"></i>{{($berita[$i]->berita_update_who == null) ? $berita[$i]->berita_create_who : $berita[$i]->berita_update_who}}</li>-->													
													<li><i class="fa fa-eye"></i>{{($berita[$i]->berita_view==null) ? 0:$berita[$i]->berita_view}}</li>
													<li>{{($berita[$i]->berita_sumber == null) ? "" : $berita[$i]->berita_sumber}}</li>
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
								{{ $berita->links() }}		
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
