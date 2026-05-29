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
								<h1><span class="world">Kumpulan Agenda</span></h1>
							</div>
							
							@for ($i = 0; $i < count($agenda); $i++)  
								<div class="news-post article-post">
									<ul class="list-posts">
										<li>
											@if ($agenda[$i]->agenda_path==null || $agenda[$i]->agenda_path=="" || $agenda[$i]->agenda_path=="null")		
												<img src="{{asset(Session::get('logo'))}}" style="height:100px;width:150px;"/>
											@else
												<img src="{{asset($agenda[$i]->agenda_path.$agenda[$i]->agenda_gambar_name)}}" style="height:100px;width:150px;"/>
											@endif											
											<div class="post-content">
												<h2 style="font-size:17px;max-height:80px;"><a href="/kegiatan/{{base64_encode($agenda[$i]->agenda_id)}}">{{($agenda[$i]->agenda_judul)}}</a></h2>
												<ul class="post-tags">
													<li><i class="fa fa-calendar"></i>{{date('d-m-Y',strtotime($agenda[$i]->agenda_tanggal))}}&emsp;<i class="fa fa-clock-o"></i>{{$agenda[$i]->agenda_waktu}}</li>
													<li><i class="fa fa-user"></i>{{($agenda[$i]->agenda_update_who == null) ? $agenda[$i]->agenda_create_who : $agenda[$i]->agenda_update_who}}</li>												
													<li><i class="fa fa-eye"></i>{{($agenda[$i]->agenda_view==null) ? 0:$agenda[$i]->agenda_view}}</li>
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
								{{ $agenda->links() }}		
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
