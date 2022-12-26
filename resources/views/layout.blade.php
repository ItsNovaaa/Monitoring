<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap" rel="stylesheet">
	<link href="{{ asset('assets/build/styles/ltr-core.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/build/styles/ltr-vendor.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/images/logo-1.png') }}" rel="shortcut icon" type="image/x-icon">
	<link href="{{ asset('assets/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/bootstrap-datetimepicker/css/datetimepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/apexcharts-bundle/dist/apexcharts.css') }}" rel="stylesheet" />
	{{-- <link href="{{ asset('assets/build/styles/style.css') }}" rel="stylesheet"> --}}
	<link href="{{ asset('css/custome.css') }}" rel="stylesheet">
	@stack('styles')
	<title>@yield('title', 'Title') | {{ config('app.name') }} </title>
</head>

<body class="theme-light preload-active">
	<!-- BEGIN Preload -->
	<div class="preload">
		<div class="preload-message">
			<!-- BEGIN Spinner -->
			<div class="spinner-border text-primary"></div>
			<!-- END Spinner -->
			<span class="preload-text">Please wait...</span>
		</div>
	</div>
	<!-- END Preload -->
	<!-- BEGIN Page Holder -->
	<div class="holder">
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper">
			<!-- BEGIN Header -->
			@include('layouts.header')
			<!-- END Header -->
			<!-- BEGIN Page Content -->
			@include('layouts.container')
			<!-- END Page Content -->
			<!-- BEGIN Footer -->
			@include('layouts.footer')
			<!-- END Footer -->
		</div>
		<!-- END Page Wrapper -->
	</div>
	<!-- END Page Holder -->
	<!-- BEGIN Scroll To Top -->
	<div class="scrolltop">
		<button class="btn btn-info btn-icon btn-lg">
			<i class="fa fa-angle-up"></i>
		</button>
	</div>
	<!-- END Scroll To Top -->
	<!-- BEGIN Sidemenu -->
	<div class="sidemenu sidemenu-wide sidemenu-left" id="sidemenu-navigation">
		<div class="sidemenu-header">
			<h3 class="sidemenu-title">Navigation</h3>
			<div class="sidemenu-addon">
				<button class="btn btn-label-danger btn-icon" data-dismiss="sidemenu">
					<i class="fa fa-times"></i>
				</button>
			</div>
		</div>
		<div class="sidemenu-body px-0" data-simplebar="data-simplebar">
			<!-- BEGIN Menu -->
			<div class="menu">
				<div class="menu-item">
					<a href="{{ route('dashboard') }}" data-menu-path="{{ route('dashboard') }}" class="menu-item-link">
						<div class="menu-item-icon">
							<i class="fa fa-home"></i>
						</div>
						<span class="menu-item-text">Home</span>
					</a>
					@if (auth()->user()->role == 'admin')
						<a href="{{ route('perusahaan') }}" data-menu-path="" class="menu-item-link">
							<div class="menu-item-icon">
								<i class="fa fa-book"></i>
							</div>
							<span class="menu-item-text">Perusahaan</span>
						</a>
						<a href="{{ route('kendaraan') }}" data-menu-path="" class="menu-item-link">
							<div class="menu-item-icon">
								<i class="fa fa-book"></i>
							</div>
							<span class="menu-item-text">Kendaraan</span>
						</a>
						<a href="{{ route('monitoring') }}" data-menu-path="" class="menu-item-link">
							<div class="menu-item-icon">
								<i class="fa fa-book"></i>
							</div>
							<span class="menu-item-text">Monitoring Kendaraan</span>
						</a>
					@endif
					<a href="{{ route('request-kendaraan') }}" data-menu-path="" class="menu-item-link">
						<div class="menu-item-icon">
							<i class="fa fa-book"></i>
						</div>
						<span class="menu-item-text">Request Kendaraan</span>
					</a>
					<a href="{{ route('log-activity') }}" data-menu-path="" class="menu-item-link">
						<div class="menu-item-icon">
							<i class="fa fa-book"></i>
						</div>
						<span class="menu-item-text">Log User</span>
					</a>
				</div>
			</div>
			<!-- END Menu -->
		</div>
		<button class="btn btn-label-danger m-2" onclick="document.location.href='{{ route('logout') }}'">Log out</button>
	</div>
	<!-- END Sidemenu -->
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
	<script type="text/javascript" src="{{ asset('assets/app/home.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/build/bootbox5/bootbox.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/jquery-number/jquery.number.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/build.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/locale.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/localization.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/apps.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/apexcharts-bundle/dist/apexcharts.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js" integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{ asset('assets/qr/script.min.js') }}"></script>
	<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
	@stack('scripts')
</body>

</html>
