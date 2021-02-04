@if(count($MorePopularSearch) > 0)
<div class="popular_search full-width">
	<div class="container">
		<h2>{{trans('lang_data.popular')}} <span>{{trans('lang_data.searches')}}</span></h2>
		<div class="row">
			<div class="scroll_box scrollbar-dynamic">
				<ul>
				@php 
                $i=1; 
                $countryName = stringToURL(countryDetails('name'));
                @endphp
				@foreach($MorePopularSearch as $k=>$v)
					@if($i > GET_CATGEORY_SHOW_COUNT())
					@if(!empty($v->title))
						<li><a href="{{route('search_term',[stringToURL($v->title),$countryName])}}">
						@php
							$image_path = 'admin/uploads/category/'.$v->image;
						@endphp
						@if(!empty($v->image) && file_exists($image_path))
							<img src="{{ asset('admin/uploads/category/'.$v->image) }}" width="24" height="24" title="{{ $v->title }}" alt="{{ $v->title }}">
						@else 
							<img src="{{ asset('front/images/user_icon.jpg') }}" width="24" height="24" title="{{ trans('lang_data.form_no_image') }}" alt="{{ trans('lang_data.form_no_image') }}">
						@endif
						{{ $v->title }}</a></li>
					@endif
					@endif
					@php $i++ @endphp
				@endforeach
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@endif