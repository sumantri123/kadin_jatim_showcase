<!-- begin #header -->
<div id="header" class="header navbar-default">
	<!-- begin navbar-header -->
	<div class="navbar-header">
		<a href="#" class="navbar-brand">
		<img src="{{asset('frontend/new/images/ico/logo_kadin_2.png')}}" alt="" /> 
		<b>KADIN JATIM ADMIN</b></a>
		<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<!-- end navbar-header -->
	
	<!-- begin header-nav -->
	<ul class="navbar-nav navbar-right">
		<li>
			<form class="navbar-form">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Enter keyword" />
					<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
				</div>
			</form>
		</li>
		<li class="dropdown navbar-user">
			<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
				<img src="{{asset('backend/assets/img/user/user-13.jpg') }}" alt="" /> 
				<span class="d-none d-md-inline">{{ucfirst(strtolower(trans(Session::get('user'))))}}</span> <b class="caret"></b>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a href="/logout" class="dropdown-item">Log Out</a>
			</div>
		</li>
	</ul>
	<!-- end header navigation right -->
</div>
<!-- end #header -->