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


<div class="clearfix"></div>
<div class="container cf center">
		<div class="error404"><img src="{{FRONT_IMAGE_URL()}}404_page.jpg" alt=""/></div>
		<div class="backtohome"><a class="btn rounded" href="{{SITE_URL()}}">{{ trans('lang_data.error_back_to_home') }}</a></div>
</div>
<div class="clearfix"></div>

@endsection
