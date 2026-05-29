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
			<li class="nav-header">Navigation</li>
			<li class="has-sub active"><a href="calendar.html"><i class="fa fa-th-large"></i> <span>Dashboard</span></a></li>						
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fa fa-gem"></i>
					<span>Master</span> 
				</a>
				<ul class="sub-menu">					
					<li><a href="/level">Level User</a></li>
					<li><a href="/profil_kadin">Profil Kadin</a></li>
					<li><a href="/user">User</a></li>
				</ul>
			</li>			
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fa fa-list-ol"></i>
					<span>Proses</span> 
				</a>
				<ul class="sub-menu">					
					<li ><a href="/event">Agenda</a></li>
					<li ><a href="/banner">Banner</a></li>					
					<li ><a href="/berita">Berita</a></li>					
					<li ><a href="/gallery">Gambar</a></li>
					<li ><a href="/iklan">Iklan</a></li>
					<li ><a href="/video">Video</a></li>					
				</ul>
			</li>
			<!--<li class="has-sub">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fa fa-align-left"></i> 
					<span>Report</span>
				</a>
				<ul class="sub-menu">
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret"></b>
							Menu 1.1
						</a>
						<ul class="sub-menu">
							<li class="has-sub">
								<a href="javascript:;">
									<b class="caret"></b>
									Menu 2.1
								</a>
								<ul class="sub-menu">
									<li><a href="javascript:;">Menu 3.1</a></li>
									<li><a href="javascript:;">Menu 3.2</a></li>
								</ul>
							</li>
							<li><a href="javascript:;">Menu 2.2</a></li>
							<li><a href="javascript:;">Menu 2.3</a></li>
						</ul>
					</li>
					<li><a href="javascript:;">Menu 1.2</a></li>
					<li><a href="javascript:;">Menu 1.3</a></li>
				</ul>
			</li>-->
			<li class="has-sub">
				<a href="javascript:;">
					<b class="caret"></b>
					<i class="fa fa-cogs"></i>
					<span>Setting</span>
				</a>
				<ul class="sub-menu">
					<li><a href="page_blank.html">Blank Page</a></li>					
				</ul>
			</li>						
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
		