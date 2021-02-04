@section('TabTitle')
    @if(isset($tabTitle))
        {{$tabTitle}} | {{trans('lang_data.lifrica')}}
    @else
        {{ config('app.name') }}
    @endif
@endsection
@extends('admin::layouts.app')
@section('content')
<div class="clearfix"></div>
<div class="container cf">
		<div class="error404"><img src="{{FRONT_IMAGE_URL()}}404_page.jpg" alt=""/></div>
		<div class="backtohome"><a class="btn rounded" href="{{ route('admin.dashboard') }}">{{ trans('lang_data.error_back_to_dashboard') }}</a></div>
</div>
<div class="clearfix"></div>

@stop
