@extends('frontendz.layout_home.default')
@push('style')

      <!-- Aditional Style CSS Here -->

@endpush
@section('content')

	<!-- block-wrapper-section
		================================================== -->
	<section class="block-wrapper">
		<div class="container">

			<!-- block content -->
			<div class="block-content non-sidebar">

				<!-- grid box -->
				<div class="grid-box">
					<div class="title-section">
						<h1><span class="world">{{$data['subtitle']}}</span></h1>
					</div>

					<div class="row">
						@for ($i = 0; $i < count($kategoriGambar); $i++)  
						<div class="col-md-4">
							<div class="image-post-slider">
								<ul class="bxslider">
									@for ($x = 0; $x < count($gambarDetail[$i]); $x++) 
										<li>
											<div class="news-post image-post2" style="border: thick double #32a1ce; height:290px">
												<div class="post-gallery">													
													<img src="{{asset($gambarDetail[$i][$x]->gambar_path.$gambarDetail[$i][$x]->gambar_name)}}" height="200px">													
												</div>
												<div class="post-title text-center" >													
													<p>{{\Illuminate\Support\Str::words(html_entity_decode(strip_tags($kategoriGambar[$i]->gambar_kategori_keterangan)), 20)}}</p>
												</div>
											</div>
										</li>									
									@endfor
								</ul>
							</div>
						</div>
						@endfor 
					</div>

				</div>
				<!-- End grid box -->

				<!-- pagination box -->
				<div class="pagination-box">
					<ul class="pagination-list">
						{{ $kategoriGambar->links() }}		
					</ul>					
				</div>
				<!-- End Pagination box -->

			</div>
			<!-- End block content -->
		</div>
	</section>
	<!-- End block-wrapper-section -->

@endsection

@push('scripts')

@endpush
