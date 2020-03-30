<!doctype html>
<html class="no-js" lang="" dir="{{Helper::getTextDirection()}}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="UTF-8">
	<title>@yield('title')</title>

	<meta name="description" content="@yield('description')">
	<meta name="keywords" content="@yield('keywords')">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Meta OG -->
	@php $logo = !empty($setting[0]['logo']) ? Helper::getHeaderLogo($setting[0]['logo']) : '/images/logo.png'; @endphp
	@if (!empty($logo) || Schema::hasTable('site_managements'))
	<meta property="og:image" content="{{{ asset($logo) }}}">
	@endif

	<meta property="og:title" content="@yield('title')" />
	<meta property="og:url" content="@yield('url')" />
	<meta property="og:type" content="Freelance" />
	<meta property="og:site_name" content="@yield('site_name')" />
	<!-- End Meta OG -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="icon" href="{{{ asset(Helper::getSiteFavicon()) }}}" type="image/x-icon">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/normalize-min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/scrollbar-min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/fontawesome/fontawesome-all.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/themify-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('css/jquery-ui-min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/linearicons.css') }}" rel="stylesheet">
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
	<link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
	<link href="{{ asset('css/rtl.css') }}" rel="stylesheet">
	<link href="{{ asset('css/color.css') }}" rel="stylesheet">
	@php echo \App\Typo::setSiteStyling(); @endphp
	<link href="{{ asset('css/transitions.css') }}" rel="stylesheet">
	@stack('stylesheets')
	<script type="text/javascript">
		var APP_URL = {!! json_encode(url('/'))!!}
		var readmore_trans = {!! json_encode(trans('lang.read_more'))!!}
		var less_trans = {!! json_encode(trans('lang.less'))!!}
		var Map_key = {!! json_encode(Helper:: getGoogleMapApiKey()) !!}
		var APP_DIRECTION = {!! json_encode(Helper:: getTextDirection()) !!}
	</script>
	@if (Auth::user())
	<script type="text/javascript">
		var USERID = {!! json_encode(Auth:: user() -> id) !!}
		window.Laravel = {!! json_encode([
			'csrfToken'=> csrf_token(),
			'user'=> [
				'authenticated' => auth() -> check(),
				'id' => auth() -> check() ? auth() -> user() -> id : null,
				'name' => auth() -> check() ? auth() -> user() -> first_name : null,
				'image' => !empty(auth() -> user() -> profile -> avater) ? asset('uploads/users/'.auth() -> user() -> id.'/'.auth() -> user() -> profile -> avater) : asset('images/user-login.png'),
				'image_name' => !empty(auth() -> user() -> profile -> avater) ? auth() -> user() -> profile -> avater : '',
			]
		])
		!!};
	</script>
	@endif
	<script>
		window.trans = <? php
		$lang_files = File:: files(resource_path(). '/lang/'.App:: getLocale());
		$trans = [];
		foreach($lang_files as $f) {
			$filename = pathinfo($f)['filename'];
			$trans[$filename] = trans($filename);
		}
		echo json_encode($trans);
		?>;
	</script>
</head>

<body class="wt-login {{Helper::getBodyLangClass()}} {{Helper::getTextDirection()}}">
	{{ \App::setLocale(env('APP_LANG')) }}
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<!-- Preloader Start -->
	<div class="preloader-outer">
		<div class="preloader-holder">
			<div class="loader"></div>
		</div>
	</div>
	<!-- Wrapper Start -->
	<div id="wt-wrapper" class="wt-wrapper wt-haslayout">
		<!-- Content Wrapper Start -->
		<div class="wt-contentwrapper">
			<!-- Header Start -->
			@yield('header')
			<!--Header End-->
			<!--Main Start-->
			@yield('main')
			<!--Main End-->
			<!--Footer Start-->
			@yield('footer')
			<!--Footer End-->
		</div>
		<!--Content Wrapper End-->
	</div>
	<!--Wrapper End-->
	<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
	@yield('bootstrap_script')
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/vendor/jquery-library.js') }}"></script>
	<script src="{{ asset('js/scrollbar.min.js') }}"></script>
	<script src="{{ asset('js/jquery-ui-min.js') }}"></script>

	@stack('scripts')
	<script>
		jQuery(window).load(function () {
			jQuery(".preloader-outer").delay(500).fadeOut();
			jQuery(".pins").delay(500).fadeOut("slow");
		});

	</script>

</body>

</html>