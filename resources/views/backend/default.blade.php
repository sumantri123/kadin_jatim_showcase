<!doctype html>

<html lang="en">

<head>
	@include('backend.parts._head')
</head>

<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
		<!-- begin #header -->
		@include('backend.parts._topnav')	
		<!-- end #header -->
		<!-- begin #sidebar -->
		@include('backend.parts._sidebar')		
		<!-- end #sidebar -->
		
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content isiContent">
				@yield('content')
			</div>
		</div>		
		
		@include('backend.parts._theme')				
	</div>
	<!--end wrapper-->			

	@include('backend.parts._scripts')
</body>

</html>
