@extends('frontendz.layout_home.default')
@push('style')

<style>

</style>

@endpush
@section('content')

<!-- heading-news-section ================================================== -->
<section class="heading-news">
<?php //echo "tes".$ip;?>
	<div class="iso-call heading-news-box">

		<div class="news-post image-post default-size">
			@if ($beritaTerkini[0]->berita_path==null || $beritaTerkini[0]->berita_path=="" || $beritaTerkini[0]->berita_path=="null")
				<img src="{{asset(Session::get('logo'))}}" height="209px" alt="">
			@else
				<img src="{{asset($beritaTerkini[0]->berita_path.$beritaTerkini[0]->berita_gambar_name)}}" height="209px" alt="">
			@endif
			<div class="hover-box">
				<div class="inner-hover">
					<a class="category-post {{$color[0]}}" href="#">{{ ucfirst(strtolower(trans($beritaTerkini[0]->kategori_nama)))}}</a>
					<h2 style="font-size:12px;"><a href="/news/{{base64_encode($beritaTerkini[0]->berita_id)}}">{{ ucfirst(strtolower(trans($beritaTerkini[0]->berita_judul)))}}</a></h2>
					<ul class="post-tags">
						<li><i class="fa fa-calendar"></i><span>{{$beritaTerkini[0]->berita_tanggal}}</span></li>						
						<li><i class="fa fa-eye"></i><span>{{($beritaTerkini[0]->berita_view==null) ? 0:$beritaTerkini[0]->berita_view}}</span></li>
					</ul>
					<p>{{\Illuminate\Support\Str::words(html_entity_decode(strip_tags($beritaTerkini[0]->berita_isi)), 20)}}</p>
				</div>
			</div>
		</div>

		<div class="image-slider snd-size">
			<span class="top-stories">TOP STORIES</span>
			<ul class="bxslider">
				@for ($i = 0; $i < count($beritaPopuler); $i++)
					<li>
						<div class="news-post image-post">
							@if ($beritaPopuler[$i]->berita_path==null || $beritaPopuler[$i]->berita_path=="" || $beritaPopuler[$i]->berita_path=="null")
								<img src="{{asset(Session::get('logo'))}}" alt="" height="418px">
							@else
								<img src="{{asset($beritaPopuler[$i]->berita_path.$beritaPopuler[$i]->berita_gambar_name)}}" height="418px" alt="">
							@endif
							<div class="hover-box">
								<div class="inner-hover">
									<a class="category-post {{$color[rand(0,count($color)-1)]}}" href="#">{{$beritaPopuler[$i]->kategori_nama}}</a>
									<h2 style="font-size:18px;"><a href="/news/{{base64_encode($beritaPopuler[$i]->berita_id)}}">{{$beritaPopuler[$i]->berita_judul}}</a></h2>
									<ul class="post-tags">
										<li><i class="fa fa-calendar"></i>{{$beritaPopuler[$i]->berita_tanggal}}</li>										
										<li><i class="fa fa-eye"></i>{{($beritaPopuler[$i]->berita_view==null) ? 0:$beritaPopuler[$i]->berita_view}}</li>
										
									</ul>
								</div>
							</div>
						</div>
					</li>				
				@endfor
			</ul>
		</div>
		
		@for ($i = 0; $i < count($beritaTerkini); $i++)
			<div class="news-post image-post">
				@if ($beritaTerkini[$i]->berita_path==null || $beritaTerkini[$i]->berita_path=="" || $beritaTerkini[$i]->berita_path=="null")
					<img src="{{asset(Session::get('logo'))}}" height="209px" alt="">
				@else
					<img src="{{asset($beritaTerkini[$i]->berita_path.$beritaTerkini[$i]->berita_gambar_name)}}" height="209px" alt="">
				@endif
				<div class="hover-box">
					<div class="inner-hover">
						<a class="category-post {{$color[rand(0,count($color)-1)]}}" href="#">{{ ucfirst(strtolower(trans($beritaTerkini[$i]->kategori_nama)))}}</a>
						<h2 style="font-size:12px;"><a href="/news/{{base64_encode($beritaTerkini[$i]->berita_id)}}">{{$i.'/'.count($beritaTerkini).'/'.$beritaTerkini[$i]->berita_judul}}</a></h2>
						<ul class="post-tags">
							<li><i class="fa fa-calendar"></i><span>{{$beritaTerkini[$i]->berita_tanggal}}</span></li>						
							<li><i class="fa fa-eye"></i><span>{{($beritaTerkini[$i]->berita_view==null) ? 0:$beritaTerkini[$i]->berita_view}}</span></li>
						</ul>
						<p>{{\Illuminate\Support\Str::words(html_entity_decode(strip_tags($beritaTerkini[$i]->berita_isi)), 20)}}</p>
					</div>
				</div>
			</div>
		@endfor

	</div>

</section>
<!-- End heading-news-section -->

<!-- ticker-news-section
	================================================== -->
<section class="ticker-news">

	<div class="container">
		<div class="ticker-news-box">
			<span class="breaking-news">Agenda Hari Ini</span>
			<span class="new-news">New</span>
			<ul id="js-news">				
				@for ($i = 0; $i < count($agendaHariIni); $i++)				
					<li class="news-item"><span class="time-news">{{$agendaHariIni[$i]->agenda_waktu}}</span> {{$agendaHariIni[$i]->agenda_judul}}</li>				
				@endfor
			</ul>
		</div>
	</div>

</section>
<!-- End ticker-news-section -->


<!--<section class="block-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="block-content">
					<div class="article-box">
						<div class="title-section">
							<a onclick="showYoutube()"><h1><span>LIVE STREAMING ON YOUTUBE</span><small> <b>(Klik Disini)</b></small></h1></a>
						</div>

						<div class="news-post article-post">
							<div class="row">
								<div class="col-sm-5">
									<div class="post-gallery">
										<a onclick="showYoutube()">
											<img alt="" src="{{asset('frontend/assets_4/upload/news-posts/kadin_logo.PNG')}}">
										</a>
									</div>
								</div>
								<div class="col-sm-7">
									<div class="post-content">
										<h2><a onclick="showYoutube()">Opening Ceremony B20 S InAGRO Expo 2022</a></h2>										
										<p>Inagro Expo 2022 yang akan digelar pada 11 s/d 14 Agustus 2022 bertempat di Grandcity Surabaya.</p>
										<p>
											Pameran agrobisnis skala internasional yang diinisiasi oleh Kamar Dagang dan Industri (Kadin) Jawa Timur ini, 
											rencananya akan dihadiri oleh perwakilan pengusaha B20 dan sejumlah negara sahabat lainnya. 
											Pameran berskala internasional ini akan menfasilitasi seluruh pelaku industri pertanian, perkebunan dan perikanan mulai hulu hingga hilir. 
											Tidak hanya bisa memamerkan produk yang dihasilkan, 
											pelaku industri agro juga bisa mengikuti berbagai kegiatan yang akan memberikan pengalaman dan pengetahuan tentang teknologi pertanian modern.
										</p>
										<a href="#" class="read-more-button"><i class="fa fa-arrow-circle-right"></i>LIVE STREAMING</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>-->



<!-- features-today-section
	================================================== -->
<section class="features-today">
	<div class="container">

		<div class="title-section">
			<h1><a class="world" href="/kegiatan"><span class="world">Agenda</span></a></h1>
		</div>

		<div class="features-today-box owl-wrapper">
			<div class="owl-carousel" data-num="4">
				@for ($i = 0; $i < count($agenda); $i++)
					<div class="item news-post standard-post">
						<div class="post-gallery">
							@if ($agenda[$i]->agenda_path==null || $agenda[$i]->agenda_path=="" || $agenda[$i]->agenda_path=="null")
								<img src="{{asset(Session::get('logo'))}}" alt="" style="border: 2px solid orange;" height="170px">
								<!--<img src="{{asset('frontend/assets_4/images/123.jpg') }}" alt="" height="200px">-->
							@else
								<img src="{{asset($agenda[$i]->agenda_path.$agenda[$i]->agenda_gambar_name)}}" alt="" height="200px">
							@endif							
							<a class="category-post {{$color[rand(0,count($color)-1)]}}" href="#">{{ucfirst(strtolower(trans($agenda[$i]->instansi)))}}</a>
						</div>
						<div class="post-content">
							<h2><a href="/kegiatan/{{base64_encode($agenda[$i]->agenda_id)}}"><p>{{\Illuminate\Support\Str::words(html_entity_decode(strip_tags($agenda[$i]->agenda_judul)), 10)}}</p></a></h2>
							<ul class="post-tags">
								<li><i class="fa fa-calendar"></i>{{$agenda[$i]->agenda_tanggal}}</li>
								<li><i class="fa fa-clock-o"></i>{{$agenda[$i]->agenda_waktu}}</li>
								<li><a href="#"><i class="fa fa-eye"></i><span>{{$agenda[$i]->agenda_view}}</span></a></li>
							</ul>
						</div>
					</div>
				@endfor  
			</div>
		</div>

	</div>
</section>
<!-- End features-today-section -->

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
							<h1><a class="world" href="/news"><span class="world">Berita Terkini</span></a></h1>
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
												<li><i class="fa fa-clock-o"></i>{{$berita[$i]->berita_tanggal}}</li>
												<!--<li><i class="fa fa-user"></i>{{($berita[$i]->berita_update_who == null) ? $berita[$i]->berita_create_who : $berita[$i]->berita_update_who}}</li>-->
												<li><i class="fa fa-eye"></i>{{($berita[$i]->berita_view==null) ? 0:$berita[$i]->berita_view}}</li>
												<li>{{($berita[$i]->berita_sumber == null) ? "" : $berita[$i]->berita_sumber}}</li>
											</ul>											
										</div>
									</li>
									
								</ul>								
							</div>
						@endfor  
						
						<div class="center-button">
							<a href="/news"><i class="fa fa-refresh"></i> Lihat Selengkapnya</a>
						</div>
					</div>
					<!-- End carousel box -->					
					<!-- pagination box -->
					<div class="pagination-box">
						<ul class="pagination-list">
							{{ $berita->links() }}		
						</ul>						
					</div><br><br>
					<!-- End Pagination box -->										
					<!-- grid box -->
					<div class="grid-box">
						<div class="row">

							<div class="col-md-6">
								<div class="title-section">
									<h1><a class="world" href="/umkms"><span class="world">UMKM </span></a></h1>
								</div>								
								<div class="image-post-slider">
									<ul class="bxslider">
										@for ($i = 0; $i < count($umkm); $i++)  
											<li>
												<div class="news-post image-post2">
													<div class="post-gallery">
														@if ($umkm[$i]->umkm_path==null || $umkm[$i]->umkm_path=="")													
															<img src="{{asset(Session::get('logo'))}}" alt="" height="270px">
														@else										
															<img src="{{asset($umkm[$i]->umkm_path.$umkm[$i]->umkm_name.'.'.$umkm[$i]->umkm_exe)}}" alt="" height="270px">
														@endif																												
													</div>
													<div class="hover-box">
														<div class="inner-hover">
															<h2><a class="category-post {{$color[rand(0,count($color)-1)]}}" href="/umkm/{{base64_encode($umkm[$i]->umkm_id)}}">{{ucfirst(strtolower(trans($umkm[$i]->umkm_nama)))}}</a></h2>															
														</div>
													</div>
												</div>
											</li>	
										@endfor
									</ul>
								</div><br><br>
								<div class="center-button">
									<a href="/umkms"><i class="fa fa-refresh"></i> Lihat Selengkapnya</a>
								</div>
							</div>

							<div class="col-md-6">
								<div class="title-section">
									<h1><a class="world" href="/rilisAll"><span class="world">RILIS</span></a></h1>
								</div>

								<div class="owl-wrapper">
									<ul class="list-posts">										
										@for ($i = 1; $i <= count($rilis)/3; $i++)  										
										<li>
											@if ($rilis[$i]->rilis_image_path==null || $rilis[$i]->rilis_image_path=="" || $rilis[$i]->rilis_image_path=="null")		
												<img src="{{asset(Session::get('logo'))}}" alt="" style="border: 2px solid orange;" width="50px" height="80px">
											@else
												<img src="{{asset($rilis[$i]->rilis_image_path.$rilis[$i]->rilis_image_name)}}" height="80px"/>
											@endif												
											<div class="post-content">												
												<h2><a href="/rilis/{{base64_encode($rilis[$i]->rilis_id)}}">{{ucfirst(strtolower(trans($rilis[$i]->rilis_judul)))}}</a></h2>
												<ul class="post-tags">
													<li><i class="fa fa-calendar"></i>{{$rilis[$i]->rilis_tanggal}}</li>																
													<li><i class="fa fa-eye"></i><span>{{$rilis[$i]->rilis_view}}</span></li>
												</ul>
											</div>
										</li>
										@endfor										
									</ul>
								</div>
								<div class="center-button">
									<a href="/rilisAll"><i class="fa fa-refresh"></i> Lihat Selengkapnya</a>
								</div>
							</div>

						</div>
					</div>
					<!-- End grid box -->
							
							
					<!-- grid box -->
					<div class="grid-box">

						<div class="title-section">
							<h1><a class="world" href="/op"><span class="world">Opini</span></a></h1>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="news-post image-post2">
									<div class="post-gallery">												
										@if ($opini[0]->opini_path==null || $opini[0]->opini_path=="" || $opini[0]->opini_path=="null")		
											<img src="{{asset(Session::get('logo'))}}" height="285px"/>
										@else
											<img src="{{asset($opini[0]->opini_path.$opini[0]->opini_gambar_name)}}" height="285px"/>
										@endif											
										<div class="hover-box">
											<div class="inner-hover">
												<a class="category-post tech" href="#">Tech</a>
												<h2><a href="/op/{{base64_encode($opini[0]->opini_id)}}">{{ucfirst(strtolower(trans($opini[0]->opini_judul)))}}</a></h2>
												<ul class="post-tags">
													<li><i class="fa fa-calendar"></i>{{$opini[0]->opini_tanggal}}</li>
													<li><i class="fa fa-user"></i>{{($opini[0]->opini_update_who == null) ? $opini[0]->opini_create_who : $opini[0]->opini_update_who}}</li>
													<li><i class="fa fa-eye"></i>{{($opini[0]->opini_view==null) ? 0:$opini[0]->opini_view}}</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<ul class="list-posts">
									@for ($i = 1; $i < count($opini); $i++)  
									<li>
										@if ($opini[$i]->opini_path==null || $opini[$i]->opini_path=="" || $opini[$i]->opini_path=="null")		
											<img src="{{asset(Session::get('logo'))}}"/>
										@else
											<img src="{{asset($opini[$i]->opini_path.$opini[$i]->opini_gambar_name)}}"/>
										@endif											
										<div class="post-content">
											<a href="#">{{($opini[$i]->opini_update_who == null) ? $opini[$i]->opini_create_who : $opini[$i]->opini_update_who}}</a>
											<h2><a href="/op/{{base64_encode($opini[$i]->opini_id)}}">{{ucfirst(strtolower(trans($opini[$i]->opini_judul)))}}</a></h2>
											<ul class="post-tags">
												<li><i class="fa fa-calendar"></i>{{$opini[0]->opini_tanggal}}</li>
												<li><i class="fa fa-eye"></i>{{($opini[0]->opini_view==null) ? 0:$opini[0]->opini_view}}</li>
											</ul>
										</div>
									</li>
									@endfor
								</ul>
							</div>
						</div>								
						<div class="center-button">
							<a href="/op"><i class="fa fa-refresh"></i> Lihat Selengkapnya</a>
						</div>
						

					</div>
					<!-- End grid box -->


			</div>

			
			@include('frontendz.layout_home.parts_home._sidebar')	
			

		</div>

	</div>
</section>
<!-- End block-wrapper-section -->

<!-- feature-video-section 
	================================================== -->
<section class="feature-video">
	<div class="container">
		<div class="title-section white">
			<h1><a class="world" href="/album"><span class="world">Gallery</span></a></h1>
		</div>

		<div class="features-video-box owl-wrapper">
			<div class="owl-carousel" data-num="4">
				
				@for ($i = 0; $i < count($image); $i++)  
					<div class="item news-post standard-post">
						<div class="my-gallery gallery-with-description" itemscope="">
							<figure>
								<a href="{{asset($image[$i]->gambar_path.$image[$i]->gambar_name)}}" itemprop="contentUrl" data-size="1600x950">
									<img src="{{asset($image[$i]->gambar_path.$image[$i]->gambar_name)}}" itemprop="thumbnail" style="height:180px;" alt="Image description">											
								</a>
							  <figcaption itemprop="caption description">												
								<p>{{\Illuminate\Support\Str::words(html_entity_decode(strip_tags($image[$i]->gambar_kategori_keterangan)))}}</p>
							  </figcaption>
							</figure>
						</div>
						<div class="hover-box">
							<p><a href="/album">{{\Illuminate\Support\Str::words(html_entity_decode(strip_tags($image[$i]->gambar_kategori_keterangan)), 20)}}</a></p>							
						</div>
						
					</div>													
				@endfor  
			</div>
		</div>
	</div>
</section>
<!-- End feature-video-section -->

<!-- features-today-section
	================================================== -->
<section class="features-today">
	<div class="container">
		
		<div class="row">
			@for ($i = 0; $i < count($kategori); $i++) 
			<div class="col-md-4">
				<div class="title-section world">
					<h1><a class="world" href="/sektor/{{base64_encode($kategori[$i]->kategori_id)}}"><span class="world">{{$kategori[$i]->kategori_nama}}</span></a></h1>
				</div>
				<ul class="list-posts">					
					@for ($x = 0; $x < count($beritaKategori[$i]); $x++) 
					<li>
						@if ($beritaKategori[$i][$x]->berita_path==null || $beritaKategori[$i][$x]->berita_path=="" || $beritaKategori[$i][$x]->berita_path=="null")							
							<img src="{{asset(Session::get('logo'))}}"/></a>
						@else
							<img src="{{asset($beritaKategori[$i][$x]->berita_path.$beritaKategori[$i][$x]->berita_gambar_name)}}" height="70px" >
						@endif						
						<div class="post-content">
							<h2><a href="/news/{{base64_encode($beritaKategori[$i][$x]->berita_id)}}">{{$beritaKategori[$i][$x]->berita_judul}}</a></h2>
							<ul class="post-tags">
								<li><i class="fa fa-calendar"></i>{{$beritaKategori[$i][$x]->berita_tanggal}}</li>
							</ul>
						</div>
					</li>					
					@endfor					
				</ul>
			</div>			
			@endfor
		</div>
		
	</div>
</section>
<!-- End features-today-section -->
<!-- feature-video-section 
	================================================== -->
<section class="feature-video">
	<div class="container">
		<div class="title-section white">
			<h1><a class="world" href="/op"><span class="world">Video</span></a></h1>
		</div>

		<div class="features-video-box owl-wrapper">
			<div class="owl-carousel" data-num="4">
				
				@for ($i = 0; $i < count($video); $i++)					
					<div class="item news-post video-post">
						@if ($video[$i]->video_path==null || $video[$i]->video_path=="" || $video[$i]->video_path=="null")
							<img src="{{asset('frontend/assets_4/images/123.jpg') }}" alt="" height="175px">
						@else
							<img src="{{asset($video[$i]->video_path.$video[$i]->video_name)}}" alt="" height="175px">
						@endif	
						<a href="{{$video[$i]->video_link}}" class="video-link"><i class="fa fa-play-circle-o text-danger"></i></a>											
						<div class="hover-box">
							<h2><a href="{{$video[$i]->video_link}}">{{ucfirst(strtolower(trans($video[$i]->video_deskripsi)))}}</a></h2>							
							<ul class="post-tags">
								<!--<li><i class="fa fa-clock-o"></i>27 may 2013</li>-->
							</ul>
						</div>
					</div>							
				@endfor
			</div>
		</div>
	</div>
</section>
<!-- End feature-video-section -->
  
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

<!-- Modal -->
<!--<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">

	  <div class="modal-content">        
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal" onclick="closeModal()">&times;</button>
			<div align="center">
				<img class="img-fluid" style="height:auto;max-width: 100%;" src="{{asset('frontend/assets_4/images/flyer/indonesia_week.jpeg')}}">
			</div>			
			
		</div>       
	  </div>
	  
	</div>
</div>-->

<div class="modal fade" id="myModalYoutube" role="dialog">
	<div class="modal-dialog modal-lg">

	
	  <div class="modal-content">        
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal" onclick="closeModalx()">&times;</button>
			<div class="embed-responsive embed-responsive-16by9">
				<!--<iframe id="cartoonVideo" class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/k0zAlxywT8k" allow="autoplay *;" allowfullscreen></iframe>-->
				<iframe id="cartoonVideo" class="embed-responsive-item" width="560" height="315" src="{{asset('frontend/assets_4/video/play.mp4')}}" allow="autoplay *;" allowfullscreen></iframe>
			</div>
			
		</div>       
	  </div>
	  
	</div>
</div>

<script type="text/javascript" src="{{asset('frontend/assets_4/js/jquery.min.js')}}"></script>
<script>
	$( document ).ready(function() {
		showYoutube();
		// untuk pop up image / video saat load web pertama kali
		/* var videoSrc = $("#myModal iframe").attr("src");
		
		$('#myModal').on('shown.bs.modal', function () { // on opening the modal
			
		  $("#myModal iframe").attr("src", videoSrc + "?autoplay=1");
		  
		}).modal('show'); */
		
	});	
	
	function closeModal(){
						
		$("#myModal iframe").attr("src", null);
		$('#myModal').modal('hide');	
	}
	
	function showYoutube(){
		
		var videoSrcx = $("#myModalYoutube iframe").attr("src");
		
		$('#myModalYoutube').on('shown.bs.modal', function () { // on opening the modal
			
		  $("#myModalYoutube iframe").attr("src", videoSrcx + "?autoplay=1");
		  
		}).modal('show');
	}
		
	function closeModalx(){
		
		var videoSrcx = $("#myModalYoutube iframe").attr("src");	
		$("#myModalYoutube iframe").attr("src", null);
		$('#myModalYoutube').modal('hide');
		
			
		//$("#myModalYoutube iframe").attr("src", videoSrcx);
	}
</script>

@endsection

@push('scripts')
	
@endpush
