<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<!--<link rel="icon" href="{{ asset ('../rukada/vertical/assets/images/favicon-32x32.png') }}" type="image/png" /> Icon template -->
	<!--plugins-->
	<link rel="stylesheet" href="{{ asset('../rukada/vertical/assets/plugins/notifications/css/lobibox.min.css') }}" />

	{{-- mapbox --}}
	<link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
	<script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>

	<link href="{{asset ('../rukada/vertical/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
	<link href="{{ asset ('../rukada/vertical/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset ('../rukada/vertical/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
	<link href="{{ asset ('../rukada/vertical/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset ('../rukada/vertical/assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset ('../rukada/vertical/assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset ('../rukada/vertical/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset ('../rukada/vertical/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset ('../rukada/vertical/assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset ('../rukada/vertical/assets/css/icons.css') }}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset ('../rukada/vertical/assets/css/dark-theme.css') }}" />
	<link rel="stylesheet" href="{{ asset ('../rukada/vertical/assets/css/semi-dark.css') }}" />
	<link rel="stylesheet" href="{{ asset ('../rukada/vertical/assets/css/header-colors.css') }}" />

	<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
	<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">

	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<title>Sistem DLH Minahasa</title>
	<style>
		.modal-body table
		{
			table-layout: fixed;
		}

		.modal-body table td
		{
			word-wrap:break-word
		}
	</style>
</head>