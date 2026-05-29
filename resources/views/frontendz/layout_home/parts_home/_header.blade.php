<!-- Header
	================================================== -->
<header class="clearfix">
	<!-- Bootstrap navbar -->
	<nav class="navbar navbar-default navbar-static-top" role="navigation">

		<!-- Top line -->
		<div class="top-line">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<ul class="top-line-list">
							<li>
								<span class="city-weather">Jalan Bukit Darmo Raya, Jl. Raya Graha Famili Tim. No.Kel, Pradahkalikendal, Kec. Dukuhpakis, Kota SBY, Jawa Timur 60226</span>								
							</li>
							<li><span class="time-now">{{Carbon\Carbon::now()}}</span></li>
							<!--<li><a href="#">Log In</a></li>-->
						</ul>
					</div>	
					<div class="col-md-3">
						<ul class="social-icons">
							<li><a target="_blank" class="facebook" href="https://www.facebook.com/pages/Kadin%20Jatim/323003607794965/"><i class="fa fa-facebook"></i></a></li>
							<li><a target="_blank" class="youtube" href="https://www.youtube.com/channel/UCZyificXKh8JJiU_LPOrPKA"><i class="fa fa-youtube"></i></a></li>
							<li><a target="_blank" class="instagram" href="https://instagram.com/kadinjatim?igshid=YmMyMTA2M2Y"><i class="fa fa-instagram"></i></a></li>							
						</ul>
					</div>	
				</div>
			</div>
		</div>
		<!-- End Top line -->

		<!-- Logo & advertisement -->
		<div class="logo-advertisement">
			<div class="container">

				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><img src="{{asset('frontend/assets_4/images/logo_2.png')}}" alt=""></a>
				</div>	
				
				<!--<div class="advertisement">
					<div class="desktop-advert">
						<a href="http://inagroexpo.com/" target="_blank">
							<img src="{{asset('frontend/assets_4/images/header_inagro.png') }}" alt="">
						</a>
					</div>
				</div>-->
			</div>
		</div>
		<!-- End Logo & advertisement -->

		<!-- navbar list container -->
		<div class="nav-list-container">
			<div class="container">
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-left">

						<li class="drop"><a class="home" href="/">Home</a></li>
						
						<li><a class="travel" href="/news">Berita</a>
							<div class="megadropdown">
								<div class="container">
									<div class="inner-megadropdown travel-dropdown">

										<div class="owl-wrapper">
											<h1>Berita Terkini</h1>
											<div class="owl-carousel" data-num="4">
												@for ($i = 0; $i < count($beritaTerkini); $i++)  
													<div class="item news-post standard-post">
														<div class="post-gallery">
															@if ($beritaTerkini[$i]->berita_path==null || $beritaTerkini[$i]->berita_path=="" || $beritaTerkini[$i]->berita_path=="null")		
																<img src="{{asset(Session::get('logo'))}}" height="150px"/>
															@else
																<img src="{{asset($beritaTerkini[$i]->berita_path.$beritaTerkini[$i]->berita_gambar_name)}}" height="150px"/>
															@endif																
														</div>
														<div class="post-content">
															<h2><a href="/news/{{base64_encode($beritaTerkini[$i]->berita_id)}}">{{ucfirst(strtolower(trans($beritaTerkini[$i]->berita_judul)))}}</a></h2>
															<ul class="post-tags">
																<li><i class="fa fa-calendar"></i>{{$beritaTerkini[$i]->berita_tanggal}}</li>																
																<li><i class="fa fa-eye"></i><span>{{$beritaTerkini[$i]->berita_view}}</span></li>
															</ul>
														</div>
													</div>
												@endfor 
											</div>
										</div>

									</div>
								</div>
							</div>
						</li>						
						
						<li class="drop"><a class="fashion" href="/potensi-investasi">Investasi</a>
							<ul class="dropdown fashion-dropdown">								
								<li><a href="/potensi-investasi">Potensi Investasi</a></li>															
							</ul>
						</li>
						
						<li><a class="video" href="/umkms">UMKM</a>
							<div class="megadropdown">
								<div class="container">
									<div class="inner-megadropdown video-dropdown">

										<div class="owl-wrapper">
											<h1>UMKM</h1>
											<div class="owl-carousel" data-num="4">
												@for ($i = 0; $i < count($umkm); $i++)  
													<div class="item news-post standard-post">
														<div class="post-gallery">
															@if ($umkm[$i]->umkm_path==null || $umkm[$i]->umkm_path=="" || $umkm[$i]->umkm_path=="null")		
																<img src="{{asset(Session::get('logo'))}}" height="150px"/>
															@else
																<a href="/umkm/{{base64_encode($umkm[$i]->umkm_id)}}">
																	<img src="{{asset($umkm[$i]->umkm_path.$umkm[$i]->umkm_name.'.'.$umkm[$i]->umkm_exe)}}" height="150px"/>
																</a>
															@endif																
														</div>
														<div class="post-content">
															<!--<h2><a href="/news/{{base64_encode($umkm[$i]->umkm_id)}}">{{strtoupper(trans($umkm[$i]->umkm_nama))}}</a></h2>-->
															<h2><a href="/umkm/{{base64_encode($umkm[$i]->umkm_id)}}">{{strtoupper(trans($umkm[$i]->umkm_nama))}}</a></h2>
															<ul class="post-tags">																
																<li><i class="fa fa-eye"></i><span>{{$umkm[$i]->umkm_alamat}}</span></li>
															</ul>
														</div>
													</div>
												@endfor 
											</div>
										</div>

									</div>
								</div>
							</div>
						</li>

						<li><a class="sport" href="/op">Opini</a>
							<div class="megadropdown">
								<div class="container">
									<div class="inner-megadropdown video-dropdown">
										<div class="owl-wrapper">
											<h1>OPINI</h1>
											<div class="owl-carousel" data-num="4">
												
												@for ($i = 0; $i < count($opiniHeader); $i++)  												
													<div class="item news-post standard-post">
														<div class="post-gallery">															
															@if ($opiniHeader[$i]->opini_path==null || $opiniHeader[$i]->opini_path=="" || $opiniHeader[$i]->opini_path=="null")		
																<img src="{{asset(Session::get('logo'))}}" alt="" style="border: 2px solid orange;" width="120px" height="150px">
															@else
																<img src="{{asset($opiniHeader[$i]->opini_path.$opiniHeader[$i]->opini_gambar_name)}}" height="150px"/>
															@endif																
														</div>
														<div class="post-content">
															<h2><a href="/op/{{base64_encode($opiniHeader[$i]->opini_id)}}">{{ucfirst(strtolower(trans($opiniHeader[$i]->opini_judul)))}}</a></h2>
															<ul class="post-tags">
																<li><i class="fa fa-calendar"></i>{{$opiniHeader[$i]->opini_tanggal}}</li>																
																<li><i class="fa fa-eye"></i><span>{{$opiniHeader[$i]->opini_view}}</span></li>
															</ul>
														</div>
													</div>
												@endfor 
											</div>
										</div>

									</div>
								</div>
							</div>
						</li>
						<li><a class="food" href="/rilisAll">Rilis</a>
							<div class="megadropdown">
								<div class="container">
									<div class="inner-megadropdown video-dropdown">
										<div class="owl-wrapper">
											<h1>RILIS</h1>
											<div class="owl-carousel" data-num="4">
												
												@for ($i = 0; $i < count($rilis); $i++)  												
													<div class="item news-post standard-post">
														<div class="post-gallery">															
															@if ($rilis[$i]->rilis_image_path==null || $rilis[$i]->rilis_image_path=="" || $rilis[$i]->rilis_image_path=="null")		
																<img src="{{asset(Session::get('logo'))}}" alt="" style="border: 2px solid orange;" width="120px" height="150px">
															@else
																<img src="{{asset($rilis[$i]->rilis_image_path.$rilis[$i]->rilis_image_name)}}" height="150px"/>
															@endif	
															<a class="category-post {{$color[rand(0,count($color)-1)]}}" href="#">{{ucfirst(strtolower(trans($rilis[$i]->kategori_nama)))}}</a>
														</div>
														<div class="post-content">
															<h2><a href="/rilis/{{base64_encode($rilis[$i]->rilis_id)}}">{{ucfirst(strtolower(trans($rilis[$i]->rilis_judul)))}}</a></h2>
															<ul class="post-tags">
																<li><i class="fa fa-calendar"></i>{{$rilis[$i]->rilis_tanggal}}</li>																
																<li><i class="fa fa-eye"></i><span>{{$rilis[$i]->rilis_view}}</span></li>
															</ul>
														</div>
													</div>
												@endfor 
											</div>
										</div>

									</div>
								</div>
							</div>
						</li>

						<li class="drop"><a class="features" href="#">Tentang Kami</a>
							<ul class="dropdown features-dropdown">								
								<li><a href="#">Struktur Organisasi</a></li>
								<li><a href="/visi-misi">Visi Misi</a></li>
								<li><a href="/sejarah-singkat">Sejarah Singkat</a></li>
								<li><a href="/arti-logo">Arti Logo</a></li>								
							</ul>
						</li>
						
						<li><a class="tech" href="/kegiatan">Agenda</a>
							<div class="megadropdown">
								<div class="container">
									<div class="inner-megadropdown tech-dropdown">

										<div class="owl-wrapper">
											<h1>Agenda</h1>
											<div class="owl-carousel" data-num="4">
												
												@for ($i = 0; $i < count($agenda); $i++)  
													<div class="item news-post standard-post">
														<div class="post-gallery">
															@if ($agenda[$i]->agenda_path==null || $agenda[$i]->agenda_path=="" || $agenda[$i]->agenda_path=="null")
																<img src="{{asset(Session::get('logo'))}}" alt="" height="150px">
															@else
																<img src="{{asset($agenda[$i]->agenda_path.$agenda[$i]->agenda_gambar_name)}}" alt="" height="150px">
															@endif							
															<a class="category-post {{$color[rand(0,count($color)-1)]}}" href="#">{{ucfirst(strtolower(trans($agenda[$i]->instansi)))}}</a>
														</div>
														<div class="post-content">
															<h2><a href="/kegiatan/{{base64_encode($agenda[$i]->agenda_id)}}">{{\Illuminate\Support\Str::words(html_entity_decode(strip_tags($agenda[$i]->agenda_judul)), 10)}}</a></h2>
															<ul class="post-tags">
																<li><i class="fa fa-calendar"></i>{{$agenda[$i]->agenda_tanggal}}</li>																
																<li><i class="fa fa-clock-o"></i><span>{{$agenda[$i]->agenda_waktu}}</span></li>
															</ul>
														</div>
													</div>
												@endfor 
																								

											</div>
										</div>

									</div>
								</div>
							</div>
						</li>
						
						<li class="drop"><a class="world" href="#">Keanggotaan</a>
							<!--<ul class="dropdown features-dropdown">								
								<li><a href="#">Struktur Organisasi</a></li>
								<li><a href="#">Visi Misi</a></li>
								<li><a href="#">Sejarah Singkat</a></li>
								<li><a href="#">Arti Logo</a></li>								
							</ul>-->
						</li>

					</ul>
					<form class="navbar-form navbar-right" role="search">
						<input type="text" id="search" name="search" placeholder="Search here">
						<button type="submit" id="search-submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<!-- /.navbar-collapse -->
			</div>
		</div>
		<!-- End navbar list container -->

	</nav>
	<!-- End Bootstrap navbar -->

</header>
<!-- End Header -->