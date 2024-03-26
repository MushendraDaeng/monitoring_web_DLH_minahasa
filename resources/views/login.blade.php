<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<!--<link rel="icon" href="{{ asset('rukada/vertical/assets/images/favicon-32x32.png') }}" type="image/png" /> icon template -->
	<!-- loader-->
	<link href="{{ asset('rukada/vertical/assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('rukada/vertical/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('rukada/vertical/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('rukada/vertical/assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('rukada/vertical/assets/css/icons.css') }}" rel="stylesheet">
	<title>Sistem DLH Kabupaten Minahasa</title>
</head>

<body class="bg-lock-screen">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-lock-screen d-flex align-items-center justify-content-center">
			<div class="card shadow-none">
				<div class="card-body p-md-5 text-center">
					{{-- <h2 class="">{{ date('h:i a') }}</h2> --}}
					{{-- <h5 class="">Tuesday, January 14, 2021</h5> --}}
					<div class="">
						<img src="{{ asset ('../logo.png') }}" height="150" width="120" alt="logo icon">
					</div>
					<p class="mt-2">Administrator</p>
          <form action="{{ route('login.post') }}" method="post">
            @csrf
            <div class="mb-3 mt-3">
              <input name="email" type="email" class="form-control" placeholder="Email" />
            </div>
            <div class="mb-3 mt-3">
              <input name="password" type="password" class="form-control" placeholder="Password" />
            </div>
            <div class="d-grid">
              <button type="submit"  class="btn btn-primary">Login</button>
            </div>
          </form>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>

</html>