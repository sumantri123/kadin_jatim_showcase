<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		<!-- begin sidebar user -->
		<ul class="nav">
			<li class="nav-profile">
				<a href="javascript:;" data-toggle="nav-profile">
					<div class="cover with-shadow"></div>
					<div class="image">
						<img src="{{asset('backend/assets/img/user/user-13.jpg') }}" alt="" />
					</div>
					<div class="info">
						<b class="caret pull-right"></b>
						{{ucfirst(strtolower(trans(Session::get('user'))))}}
						<small>{{(Session::get('level'))}}</small>
					</div>
				</a>
			</li>			
		</ul>
		<!-- end sidebar user -->
		
		
		
		<!-- begin sidebar nav -->
		<ul class="nav">
			<li class="nav-header">Navigation </li>			
			@foreach(App\Helpers\SiteHelpers::main_menu() as $mm)
				<li class="has-sub active">
					<a href="{{($mm->submenu_link == null) ? null : $mm->submenu_link}}">
						@if ($mm->submenu_link == null)
							<b class="caret"></b>
						@endif	
						<i class="{{$mm->submenu_icon}}"></i>						
						<span>{{$mm->submenu_nama}}</span> 						
					</a>
					@if ($mm->submenu_link == null)
					<ul class="sub-menu">
						@foreach(App\Helpers\SiteHelpers::side_menu($mm->submenu_parent) as $sm)  
							<li class="{{ Request::routeIs($sm->submenu_link_name.'.*') ? 'active' : '' }}"> <a href="{{$sm->submenu_link}}">{{$sm->submenu_nama}}</a></li>
						@endforeach					
					</ul>	
					@endif
				</li>
			@endforeach
												
			<!-- begin sidebar minify button -->
			<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			<!-- end sidebar minify button -->
		</ul>
		<!-- end sidebar nav -->
	</div>
	<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
		