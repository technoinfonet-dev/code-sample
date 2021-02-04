@section('TabTitle')
    @if(isset($tabTitle))
        {{$tabTitle}} | {{trans('lang_data.lifrica_africa')}}
    @else
        {{ config('app.name') }}
    @endif
@endsection
@extends('front.layouts.master')
@section('stylesheet')
@endsection
@section('content')
<div class="inner_banner career_search full-width">
	{{ Form::open(array('method' =>'GET','id'=> 'search-frm')) }}
	<input type="hidden" name="csrf_token" value="{{csrf_token()}}"> 
	<div class="caption">
		<h2>{{ trans('lang_data.explore_open_positions') }}</h2>
		<div class="floatL">
			<input type="text" placeholder="{{ trans('lang_data.search_role') }}" name="keywords"  value="<?php echo $get_keywords; ?>">
		</div>
		<div class="floatL"><select data-placeholder="Sort by Relevance" class="chosen-select" tabindex="2" name="role_name">
				<option value="">{{ trans('lang_data.all_teams') }}</option>

				@foreach($CareersRoles as $k1 => $v1)
					<option value="<?php echo Crypt::encrypt($v1->id); ?>" <?php if($get_role_name == $v1->id) { echo "selected=selected"; } ?>><?php echo $v1->role_name; ?></option>
				@endforeach
			</select>
		</div>
		<div class="floatL">
			<select data-placeholder="Sort by Relevance" class="chosen-select" tabindex="2" name="location">
				<option value="">{{ trans('lang_data.all_locations') }}</option>
					@foreach($City as $k => $v)
						<option value="<?php echo Crypt::encrypt($v->id); ?>"  <?php if($get_location == $v->id) { echo "selected=selected"; } ?>><?php echo $v->name; ?></option>
					@endforeach
			</select>
		</div>
		<input type="submit" value="{{ trans('lang_data.search') }}">
		<div class="clearfix"></div>
	</div>
	  {!! Form::close() !!}
</div>
<div class="cms_comman career_post full-width">
	<div class="container">
		<div class="row">
			<div class="floatL">
				<table>
					<thead>
						<tr>
							<th>{{ trans('lang_data.form_role') }}</th>
							<th>{{ trans('lang_data.department') }}</th>
							<th>{{ trans('lang_data.form_location') }}</th>
						</tr>
					</thead>
					<tbody>
						@if(count($Career) > 0)
							@foreach($Career as $k2 => $v2)
								<tr>
									<td><a href="{{route('front.career_details',$v2->slug)}}">{{ $v2->title }}</a></td>
									<td>{{ $v2->role_name }}</td>
									<td>{{ $v2->city_name }}, {{ $v2->country_name }}</td>
								</tr>
							@endforeach 
						@else
							<tr>
								<td colspan="3"><center>{{ trans('lang_data.no_vacancy') }}</center></td>
							</tr>
						@endif
					</tbody>
				</table>
				{{ $Career->links() }}
			</div>
			
			<div class="floatR">
				@include('front.modules.sidebar')
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@endsection
@section('javascript')
<script>
$(document).ready(function(){
	var callbacks_list = $('.demo-callbacks ul');
	$('.demo-list input').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
		callbacks_list.prepend('<li><span>#' + this.id + '</span> is ' + event.type.replace('if', '').toLowerCase() + '</li>');
	}).iCheck({
		checkboxClass: 'icheckbox',
		radioClass: 'iradio',
		increaseArea: '20%'
	});

});

$(function() {
	$('.chosen-select').chosen({
		disable_search:true,
	});
});

</script>
@endsection