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
								<h1><span class="world">{{$sektor[0]->kategori_nama}}</span></h1>
							</div>
							@for ($i = 0; $i < count($sektor); $i++)  
								<div class="news-post article-post">
									<ul class="list-posts">
										<li>
											@if ($sektor[$i]->berita_path==null || $sektor[$i]->berita_path=="" || $sektor[$i]->berita_path=="null")		
												<img src="{{asset(Session::get('logo'))}}" style="height:100px;width:150px;"/>
											@else
												<img src="{{asset($sektor[$i]->berita_path.$sektor[$i]->berita_gambar_name)}}" style="height:100px;width:150px;"/>
											@endif											
											<div class="post-content">
												<h2 style="font-size:17px;max-height:80px;"><a href="/news/{{base64_encode($sektor[$i]->berita_id)}}">{{($sektor[$i]->berita_judul)}}</a></h2>
												<ul class="post-tags">
													<li><i class="fa fa-calendar"></i>{{date('d-m-Y',strtotime($sektor[$i]->berita_tanggal))}}
													<li><i class="fa fa-user"></i>by {{($sektor[$i]->berita_update_who == null) ? $sektor[$i]->berita_create_who : $sektor[$i]->berita_update_who}}</li>												
													<li><i class="fa fa-eye"></i>{{($sektor[$i]->berita_view==null) ? 0:$sektor[$i]->berita_view}}</li>
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
								{{ $sektor->links() }}		
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
