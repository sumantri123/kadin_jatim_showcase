@extends('frontendz.layout_home.default')
@push('style')

      <!-- Aditional Style CSS Here -->

@endpush
@section('content')

	<!-- block-wrapper-section
		================================================== -->
	<section class="features-today">
		<div class="container">
			@for ($i = 0; $i < count($kategoriGambar); $i++) 
				<br><div class="title-section">
					<h1><span>Gallery Kegiatan ( {{$kategoriGambar[$i]->gambar_kategori_tanggal}} )</span></h1>
				</div>

				<div class="features-today-box owl-wrapper">
					<div class="owl-carousel" data-num="4">
						@for ($x = 0; $x < count($gambarDetail[$i]); $x++) 
							<div class="item news-post standard-post">
								<div class="my-gallery gallery-with-description" itemscope="">
									<figure>
										<a href="{{asset($gambarDetail[$i][$x]->gambar_path.$gambarDetail[$i][$x]->gambar_name)}}" itemprop="contentUrl" data-size="1600x950">
											<img src="{{asset($gambarDetail[$i][$x]->gambar_path.$gambarDetail[$i][$x]->gambar_name)}}" itemprop="thumbnail" style="height:180px;" alt="Image description">											
										</a>
									  <figcaption itemprop="caption description">												
										<p>{{\Illuminate\Support\Str::words(html_entity_decode(strip_tags($kategoriGambar[$i]->gambar_kategori_keterangan)))}}</p>
									  </figcaption>
									</figure>
									<!--<img src="{{asset($gambarDetail[$i][$x]->gambar_path.$gambarDetail[$i][$x]->gambar_name)}}" alt="">
									<a class="category-post world" href="#">Music</a>-->
								</div>
								<div class="post-content">
									<p>{{\Illuminate\Support\Str::words(html_entity_decode(strip_tags($kategoriGambar[$i]->gambar_kategori_keterangan)), 20)}}</p>									
								</div>
							</div>
						@endfor
					</div>
				</div>
				
			@endfor

			<!-- pagination box -->
			<div class="pagination-box">
				<ul class="pagination-list">
					{{ $kategoriGambar->links() }}		
				</ul>					
			</div>
			<!-- End Pagination box -->

		</div>

		<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
		<!--
		Background of PhotoSwipe.
		It's a separate element, as animating opacity is faster than rgba().
		-->
			<div class="pswp__bg"></div>
			<!-- Slides wrapper with overflow:hidden.-->
			<div class="pswp__scroll-wrap">
				<!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory.-->
				<!-- don't modify these 3 pswp__item elements, data is added later on.-->
				<div class="pswp__container">
					<div class="pswp__item"></div>
					<div class="pswp__item"></div>
					<div class="pswp__item"></div>
				</div>

				<!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed.-->
				<div class="pswp__ui pswp__ui--hidden">
					<div class="pswp__top-bar">
						<!-- Controls are self-explanatory. Order can be changed.-->
						<div class="pswp__counter"></div>

						<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
						<button class="pswp__button pswp__button--share" title="Share"></button>
						<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
						<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
						<!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR-->
						<!-- element will get class pswp__preloader--active when preloader is running-->

						<div class="pswp__preloader">
							<div class="pswp__preloader__icn">
								<div class="pswp__preloader__cut">
									<div class="pswp__preloader__donut"></div>
								</div>
							</div>
						</div>
					</div>

					<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
						<div class="pswp__share-tooltip"></div>
					</div>

					<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
					<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
					<div class="pswp__caption">
						<div class="pswp__caption__center"></div>
					</div>
				</div>
			</div>
		</div>
			
		
	</section>
	<!-- End block-wrapper-section -->

@endsection

@push('scripts')

@endpush
