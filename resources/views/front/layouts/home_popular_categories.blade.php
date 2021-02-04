@if(count($MorePopularSearch) > 0)
<div class="top_cat_box full-width">
	<div class="container">
		<h2>{{ trans('lang_data.most_popular') }} <span>{{ trans('lang_data.categories') }}</span></h2>
		<div class="row">
			<div class="item_categary">
				<?php 
				$total_count = count($MorePopularSearch);
                $countryName = stringToURL(countryDetails('name'));
				?>
				@foreach($MorePopularSearch->take(GET_CATGEORY_SHOW_COUNT()) as $k=>$v)
				<div class="item_box">
					<div class="inner_box">
						<a href="{{route('search_term',[stringToURL($v->title),$countryName])}}"></a>
						@php
							$image_path = 'admin/uploads/category/'.$v->image;
						@endphp
						@if(!empty($v->image) && file_exists($image_path))
							<img src="{{ asset('admin/uploads/category/'.$v->image) }}" width="64" height="64" title="{{ $v->title }}" alt="{{ $v->title }}">
						@else 
							<img src="{{ asset('front/images/user_icon.jpg') }}" width="64" height="64" title="{{ trans('lang_data.form_no_image') }}" alt="{{ trans('lang_data.form_no_image') }}">
						@endif
						<h3>{{ $v->title }}</h3>
					</div>
				</div>
				@endforeach
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@endif