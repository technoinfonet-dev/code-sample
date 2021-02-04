<div class="inner_banner full-width randbg">
	<div class="caption">
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
			<input type="text" id="autocomplete" value="{{ $term }}" name="term" class="term"  placeholder="{{ trans('lang_data.search_term_text') }}">
			<i class="fa fa-search" aria-hidden="true"></i>
		</div>
		<div class="floatL">
			<input type="text" id="autolocation" name="location" value="{{ $city_name }}" placeholder="{{ CHANGESEARCHBARTEXT(trans('lang_data.search_location_text')) }}">
			<i class="fa fa-map-marker" aria-hidden="true"></i>
		</div>
		<input type="submit" value="{{ trans('lang_data.search') }}">
		<div class="clearfix"></div>
		 {!! GENERATE_CSRF_TOKEN()!!}
		{{ Form::close() }}
	</div>
</div>	
<div class="popular_search full-width">
	<div class="container">
		<h2>{{ trans('lang_data.popular_business_searches') }} {{ $city_name }}</h2>
		<p>{{ trans('lang_data.find_loc') }} {{ $city_name }}, {{ trans('lang_data.browse_searches') }}</p>
		<div class="row">
			<div class="scroll_box scrollbar-dynamic">
				<ul>
				@foreach($MorePopularSearch as $k=>$v)
					@if(!empty($v->title))
						<li><a href="{{route('search_term',[stringToURL($v->title),$city_slug])}}"><i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp; {{ $v->title }}</a></li>
					@endif
				@endforeach
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>