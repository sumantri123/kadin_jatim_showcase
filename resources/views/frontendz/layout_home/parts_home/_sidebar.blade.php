<div class="col-sm-4">
	<!-- sidebar -->
	<div class="sidebar">
		
		<div class="widget features-slide-widget">			
			<div class="image-post-slider">
				<ul class="bxslider">
					<!--<li>
						<div class="news-post image-post2">
							<div class="post-gallery">
								<a href="http://inagroexpo.com/" target="_blank">
									<img src="{{asset('frontend/assets_4/images/poster/inapro_1.jpeg') }}" alt="" height="450px">
								</a>
							</div>
						</div>
					</li>	
					<li>
						<div class="news-post image-post2">
							<div class="post-gallery">
								<a href="http://inagroexpo.com/" target="_blank">
									<img src="{{asset('frontend/assets_4/images/poster/inapro_2.jpeg') }}" alt="" height="450px">
								</a>
							</div>
						</div>
					</li>-->
					<li>
						<div class="news-post image-post2">
							<div class="post-gallery">
								<a href="https://halalfestival.id/" target="_blank">
									<img src="{{asset('frontend/assets_4/images/poster/jatimhalal_fest.JPG') }}" alt="" height="450px">
								</a>
							</div>
						</div>
					</li>	
				</ul>
			</div>
		</div>
		
		<div class="widget tab-posts-widget">

			<ul class="nav nav-tabs" id="myTab">
				<li class="active">
					<a href="#option1" data-toggle="tab">Terpopuler</a>
				</li>
				<li>
					<a href="#option2" data-toggle="tab">Terkini</a>
				</li>
				<!--<li>
					<a href="#option3" data-toggle="tab">Top Reviews</a>
				</li>-->
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="option1">
					<ul class="list-posts">
						@for ($i = 0; $i < count($beritaPopuler); $i++)  
						<li>
							@if ($beritaPopuler[$i]->berita_path==null || $beritaPopuler[$i]->berita_path=="" || $beritaPopuler[$i]->berita_path=="null")		
								<img src="{{asset(Session::get('logo'))}}" style="height:65px"/>
							@else
								<img src="{{asset($beritaPopuler[$i]->berita_path.$beritaPopuler[$i]->berita_gambar_name)}}" style="height:65px"/>
							@endif	
							<div class="post-content">
								<h2><a href="/news/{{base64_encode($beritaPopuler[$i]->berita_id)}}">{{ucfirst(strtolower(trans($beritaPopuler[$i]->berita_judul)))}}</a></h2>
								<ul class="post-tags">
									<li><i class="fa fa-calendar"></i>{{$beritaPopuler[$i]->berita_tanggal}}</li>
									<li><i class="fa fa-eye"></i>{{($beritaPopuler[$i]->berita_view==null) ? 0:$beritaPopuler[$i]->berita_view}}</li>
								</ul>
							</div>
						</li>
						@endfor  
					</ul>
				</div>
				<div class="tab-pane" id="option2">
					<ul class="list-posts">

						@for ($i = 0; $i < count($beritaTerkini); $i++)  
						<li>
							@if ($beritaTerkini[$i]->berita_path==null || $beritaTerkini[$i]->berita_path=="" || $beritaTerkini[$i]->berita_path=="null")		
								<img src="{{asset(Session::get('logo'))}}" style="height:65px"/>
							@else
								<img src="{{asset($beritaTerkini[$i]->berita_path.$beritaTerkini[$i]->berita_gambar_name)}}" style="height:65px"/>
							@endif	
							<div class="post-content">
								<h2><a href="/news/{{base64_encode($beritaTerkini[$i]->berita_id)}}">{{ucfirst(strtolower(trans($beritaTerkini[$i]->berita_judul)))}}</a></h2>
								<ul class="post-tags">
									<li><i class="fa fa-calendar"></i>{{$beritaTerkini[$i]->berita_tanggal}}</li>
									<li><i class="fa fa-eye"></i>{{($beritaTerkini[$i]->berita_view==null) ? 0:$beritaTerkini[$i]->berita_view}}</li>
								</ul>
							</div>
						</li>
						@endfor 
					</ul>										
				</div>
				
			</div>
		</div>
		
		<div class="widget social-widget">
			<div class="title-section">
				<h1><span>Dokumen</span></h1>
			</div>
			<ul class="social-share">
				@for ($i = 0; $i < count($file); $i++) 
				<li>					
					<!--<a href="#" onclick="openFile( '{{ $file[$i]->file_path.$file[$i]->file_name.'.'.$file[$i]->file_exe }}' )" class="{{($i%2)?'facebook':'google'}}"><i class="fa fa-file"></i></a>-->
					<a href="{{ $file[$i]->file_path.$file[$i]->file_name.'.'.$file[$i]->file_exe }}" target="_blank" class="{{($i%2)?'facebook':'google'}}"><i class="fa fa-download"></i></a>
					<span class="number">{{ucfirst(strtolower(trans($file[$i]->file_title)))}}</span>					
				</li>	
				@endfor
			</ul>
		</div>
		
		<div class="widget features-slide-widget">
			<div class="title-section">
				<h1><span>Sponsor</span></h1>
			</div>
			<div class="image-post-slider">
				<ul class="bxslider">
					@for ($i = 0; $i < count($iklan); $i++)  
					<li>
						<div class="news-post image-post2">
							<div class="post-gallery">
								@if ($iklan[$i]->iklan_path==null || $iklan[$i]->iklan_path=="" || $iklan[$i]->iklan_path=="null")
									<img src="{{asset(Session::get('logo'))}}" alt="" height="220px">
								@else
									<img src="{{asset($iklan[$i]->iklan_path.$iklan[$i]->iklan_name)}}" alt="" height="220px">
								@endif																					
								<div class="hover-box">
									<div class="inner-hover">
										<h2><a href="#">{{ucfirst(strtolower(trans($iklan[$i]->iklan_judul)))}}</a></h2>
										<ul class="post-tags">
											<li><i class="fa fa-calendar"></i>{{$iklan[$i]->iklan_tanggal_awal}}</li>
											<li><i class="fa fa-calendar"></i>{{$iklan[$i]->iklan_tanggal_akhir}}</li>														
										</ul>
									</div>
								</div>
							</div>
						</div>
					</li>	
					@endfor  
				</ul>
			</div>
		</div>

	</div>
	<!-- End sidebar -->
</div>

