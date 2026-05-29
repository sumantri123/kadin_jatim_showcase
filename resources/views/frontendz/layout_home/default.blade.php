<!doctype html>
<html lang="en" class="no-js">

<head>
	<script>
        var base_url = window.location.origin;
    </script>
	@include('frontendz.layout_home.parts_home._head')
</head>
<body class="boxed">
	<!-- Container -->
	<div id="container">
		@include('frontendz.layout_home.parts_home._header')
		@yield('content')
		@include('frontendz.layout_home.parts_home._footer')
	</div>
		@include('frontendz.layout_home.parts_home._scripts')		

</body>
</html>