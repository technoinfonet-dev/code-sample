<!DOCTYPE html>
<html xml:lang="{{getDefaultLanguage()}}" lang="{{getDefaultLanguage()}}" dir="{{ (getDefaultLanguage()=='ar'?'rtl':'ltr') }}">
	<!-- start head section -->
	@include('front.layouts.includes.head')
	@yield('stylesheet')
	<!-- end head section -->
	<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	$currentURL = "";
	if (strpos($actual_link, 'account/my_job') !== false || strpos($actual_link, 'account/messages') !== false) {
		$currentURL = "front_account";
	}
	if (strpos($actual_link, 'business_account/my_job') !== false) {
		$currentURL = "business_account";
	} 
    //if(\Request::getName())
    ?>
<body class="loading {{ $currentURL }}">
<div class="wrapper">
	<div id="message"></div>
	<!-- start header section -->
	@include('front.layouts.includes.header')

	@if(\Request::route()->getName() == 'home' || \Request::route()->getName() == 'landing_page') 
		@include('front.layouts.includes.banner')
	@endif
	<!-- end header section -->
	<!-- start content section -->
	@include('flash::message')
	<div id="login_loader"></div>
	@yield('content')
	<!-- end content section -->
	<!-- start footer section-->
	@include('front.layouts.includes.footer')
	<!-- end footer section-->
	</div>

	<!-- start javascript files -->
	@include('front.layouts.includes.javascript')
	
	<!-- end javascript files -->
	<!-- start css files -->
	
	<!-- end css files -->
	<!-- start javascript files -->
	@yield('validation_js')
	<!-- end javascript files -->
</body>
</html>
