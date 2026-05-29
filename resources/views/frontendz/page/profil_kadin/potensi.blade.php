@extends('frontendz.layout_home.default')
@push('style')

      <!-- Aditional Style CSS Here -->

@endpush
@section('content')
<section class="block-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="single-post-box">
					<br><br>
					<div class="title-section">
						<h1><span class="features">Potensi Investasi</span></h1>
					</div>
					<div class="about-more-autor">
						@for ($i = 0; $i < count($potensi); $i++)  
						<div class="autor-box">
							<a href="{{ $potensi[$i]->file_path.$potensi[$i]->file_name.'.'.$potensi[$i]->file_exe }}" target="_blank">
								<img src="{{asset('frontend/assets_4/images/logo_kadin.png')}}" alt="" style="border: 2px solid orange;">
							</a>
							<div class="autor-content">
								<div class="autor-title">
									<h1>KADIN JATIM</h1>		
								</div>
								<a href="{{ $potensi[$i]->file_path.$potensi[$i]->file_name.'.'.$potensi[$i]->file_exe }}" target="_blank">
									{{ucwords(strtolower($potensi[$i]->file_title))}}									
								</a>
								
							</div>							
						</div><hr>
						@endfor 						
					</div>
					<!-- pagination box -->
					<div class="pagination-box">
						<ul class="pagination-list">
							{{ $potensi->links() }}		
						</ul>						
					</div>
				</div>
			</div>
			@include('frontendz.layout_home.parts_home._sidebar')	
		</div>
	</div>
</section>
@endsection

@push('scripts')

@endpush
