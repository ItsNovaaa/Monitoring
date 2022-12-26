<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap" rel="stylesheet">
	<link href="{{ asset('assets/build/styles/ltr-core.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/build/styles/ltr-vendor.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/images/logo-1.png') }}" rel="shortcut icon" type="image/x-icon">
	@stack('styles')

	<title>Login | Laravel</title>
</head>

<body class="theme-light preload-active" id="fullscreen">
	<!-- BEGIN Preload -->
	<div class="preload">
		<div class="preload-dialog">
			<!-- BEGIN Spinner -->
			<div class="spinner-border text-primary preload-spinner"></div>
			<!-- END Spinner -->
		</div>
	</div>
	<!-- END Preload -->
	<!-- BEGIN Page Holder -->
	<div class="holder">
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper">
			<!-- BEGIN Page Content -->
			@yield('content')
			<!-- END Page Content -->
		</div>
		<!-- END Page Wrapper -->
	</div>
	<!-- END Page Holder -->
	<!-- BEGIN Float Button -->
	<div class="float-btn float-btn-right">
		<button class="btn btn-flat-primary btn-icon" id="theme-toggle" data-toggle="tooltip" data-placement="right" title="Change theme">
			<i class="fa fa-moon"></i>
		</button>
	</div>
	<!-- END Float Button -->
	<script type="text/javascript" src="{{ asset('assets/build/scripts/mandatory.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/build/scripts/core.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/build/scripts/vendor.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/qr/script.min.js') }}"></script>
	<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
	{{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
	@stack('scripts')
</body>

</html>
