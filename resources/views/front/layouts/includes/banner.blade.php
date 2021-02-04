	<?php $defaultSlider = SITE_INFO('home_page_banner');?>
	@if($CountryBanner != null)
		@php
			$image = "admin/uploads/banner/".$CountryBanner->image;
		@endphp
		@if(file_exists($image))
			<div class="banner full-width" style="background: url({{ asset($image) }}) no-repeat center center;">
		@else
			<div class="banner full-width" style="background: url({{ ADMIN_IMAGE_URL() }}banner_default.jpg) no-repeat center center;">
		@endif
	@elseif(!empty(SITE_INFO('home_page_banner')) && file_exists(SITE_INFO('home_page_banner')))
		<div class="banner full-width" style="background: url({{ asset('admin/uploads/setting/home_page_banner/'.$defaultSlider) }}) no-repeat center center;">
	@else
		<div class="banner full-width" style="background: url({{ ADMIN_IMAGE_URL() }}banner_default.jpg) no-repeat center center;">
	@endif
		<div class="caption">
			<h1> <span>{{ CHANGESCOUNTRYTEXT('Home Page Banner Content') }}</span> {{ trans('lang_data.home_banner_text') }}</h1>
			{{ Form::open(
	          array(
	          'id'                => 'BannersearchForm',
	          'class'             => 'ajaxFormSubmit form-horizontal',
	          'data-redirect_url' => route('home'),
	          'url'               => route('search_term'),
	          'method'            => 'GET'
	          ))
          }}
          	<input type="hidden" name="csrf_token" value="{{csrf_token()}}"> 
			<div class="floatL">
				<input type="text" name="term" class="term" id="autocomplete" placeholder="{{ trans('lang_data.search_term_text') }}">
				<i class="fa fa-search" aria-hidden="true"></i>
			</div>
			<div class="floatL">
				<input type="text" id="autolocation" name="location" placeholder="{{ CHANGESEARCHBARTEXT() }}" value="{{$country->name}}">
				<i class="fa fa-map-marker" aria-hidden="true"></i>
			</div>
			<input type="submit" value="{{ trans('lang_data.search') }}">
			<div class="clearfix"></div>
			 {!! GENERATE_CSRF_TOKEN()!!}
			{{ Form::close() }}
		</div>
	</div>