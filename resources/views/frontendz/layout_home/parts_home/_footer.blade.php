<!-- footer 
	================================================== -->
<footer>
	<div class="container">
		<div class="footer-widgets-part">
			<div class="row">
				<div class="col-md-3">
					<div class="widget text-widget">
						<h1>About</h1>
						<p>Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis. </p>
						<p>Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. </p>
					</div>
					<div class="widget social-widget">
						<h1>Stay Connected</h1>
						<ul class="social-icons">
							<li><a target="_blank" href="https://www.facebook.com/pages/Kadin%20Jatim/323003607794965/" class="facebook"><i class="fa fa-facebook"></i></a></li>														
							<li><a target="_blank" href="https://www.youtube.com/channel/UCZyificXKh8JJiU_LPOrPKA" class="youtube"><i class="fa fa-youtube"></i></a></li>
							<li><a target="_blank" href="https://instagram.com/kadinjatim?igshid=YmMyMTA2M2Y=" class="instagram"><i class="fa fa-instagram"></i></a></li>							
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="widget posts-widget">
						<h1>Berita</h1>
						<ul class="list-posts">
							@for ($i = 0; $i < count($beritaRandom); $i++)
								<li>
									@if ($beritaRandom[$i]->berita_path==null || $beritaRandom[$i]->berita_path=="" || $beritaRandom[$i]->berita_path=="null")
										<img src="{{asset('frontend/assets_4/images/123.jpg') }}" alt="">
									@else
										<img src="{{asset($beritaRandom[$i]->berita_path.$beritaRandom[$i]->berita_gambar_name)}}" alt="">
									@endif
									<div class="post-content">
										<a href="#">{{ ucfirst(strtolower(trans($beritaRandom[$i]->kategori_nama)))}}</a>
										<h2><a href="/news/{{base64_encode($beritaRandom[$i]->berita_id)}}">{{ ucfirst(strtolower(trans($beritaRandom[$i]->berita_judul)))}}</a></h2>
										<ul class="post-tags">
											<li><i class="fa fa-calendar"></i>{{$beritaRandom[$i]->berita_tanggal}}</li>
										</ul>
									</div>
								</li>							
							@endfor	
						</ul>
					</div>
				</div>
				<div class="col-md-6">				
					<div class="widget categories-widget">
						<h1>Kategori</h1>
						<ul class="category-list">
							@for ($i = 0; $i < count($beritaKategoriTotal); $i++)
							<li>
								<a href="#">{{ ucfirst(strtolower(trans($beritaKategoriTotal[$i]->kategori_nama)))}}<span>{{$beritaKategoriTotal[$i]->total}}</span></a>
							</li>							
							@endfor
						</ul>
					</div>
				</div>				
			</div>
		</div>
		<div class="footer-last-line">
			<div class="row">
				<div class="col-md-12">
					<p>&copy; COPYRIGHT 2022 Simarfian.com</p>
				</div>				
			</div>
		</div>
	</div>
</footer>
<!-- End footer -->