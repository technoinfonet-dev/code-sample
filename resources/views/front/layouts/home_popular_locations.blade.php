@if(count($City) > 0)
<div class="popular_location full-width">
	<div class="container">
		<h2>{{trans('lang_data.popular')}} <span>{{trans('lang_data.form_location')}}</span></h2>
		<div class="row">
			<div class="scroll_box scrollbar-dynamic">
				<ul>
					@foreach($City as $k=>$v)
					@if(!empty($v->name))
						<li><a href="{{route('front.list_popuplar_location',stringToURL($v->name))}}"><i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp; {{ $v->name }}</a></li>
					@endif
					@endforeach
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@endif