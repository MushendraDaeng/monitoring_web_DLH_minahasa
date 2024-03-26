<!doctype html>
<html lang="en" class="semi-dark">

@include('partials.head')

<body >
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		@include('partials.sidebar')
		<!--end sidebar wrapper -->
		<!--start header -->
		@include('partials.header')
		<!--end header -->
		
		<!--start page wrapper -->
		@yield('content')
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © 2021. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->
	{{-- <!--start switcher-->
	@include('partials.switcher')
	<!--end switcher--> --}}

	<!-- SCRIPT JS -->
	
	@include('partials.script')
	<!--END SCRIPT JS -->

</body>

</html>