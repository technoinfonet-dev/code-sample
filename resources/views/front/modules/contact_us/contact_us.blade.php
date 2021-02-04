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
<div class="contact_us full-width">
	<div class="container">
		<div class="title">
			<h1>{{ trans('lang_data.contact_us') }}</h1>
		</div>
		<div class="contact_left">
			<h2>{{ trans('lang_data.contact_form') }}</h2>
			{{ Form::open(
      		array(
      		'id'                => 'AddEditContactUsForm',
      		'class'             => 'ajaxFormSubmit form-horizontal',
      		'data-redirect_url' => route('front.contact_us'),
      		'url'               => route('front.contact_us.store'),
      		'method'            => 'POST'
      		))
      		}}
			<div class="group_form">
				{!! Form::text('name',null,['placeholder' => trans('lang_data.enter_your_name'),'id'=>'name']) !!}
			</div>
			<div class="group_form">
				{!! Form::text('email',null,['placeholder' => trans('lang_data.enter_your_email_address'),'id'=>'email']) !!}
			</div>
			<div class="group_form">
				{!! Form::text('company_name',null,['placeholder' => trans('lang_data.enter_your_company_name'),'id'=>'company_title']) !!}
			</div>
			<div class="group_form">
				{!! Form::text('phone',null,['placeholder' => trans('lang_data.enter_your_phone_number'),'id'=>'phone']) !!}
			</div>
			<div class="group_form">
				{!! Form::textarea('long_description',  null, ['cols'=>"30", 'rows'=>"10", "placeholder" => trans('lang_data.enter_your_message'), "id" => "long_description"]) !!}
			</div>
			<div class="group_form">
				<button type="submit" class="btn" value=""> {{ trans('lang_data.from_submit') }}&nbsp;<i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
			</div>
			{{ Form::close() }}
		</div>
		<div class="contact_address">
			<h2>{{ trans('lang_data.contact_details') }}</h2>
			<ul class="contact">
				@php
					$url = GETSEGMENT(1);
					$FooterDetails = SITE_INFO();
				@endphp
				@if($FooterDetails->address !=NULL)
				<li><strong>{{ trans('lang_data.form_address') }} : </strong><p>
					{{ $FooterDetails->address }}
				</p></li>
				@endif
				@if($FooterDetails->email !=NULL)
				<li><strong>{{ trans('lang_data.form_email') }} : </strong><p>
					<a href="mailto:{{ $FooterDetails->email }}">{{ $FooterDetails->email }}</a>
				</p></li>
				@endif
				@if($FooterDetails->third_address !=NULL)
				<li><strong>{{ trans('lang_data.post_box') }} : </strong><p>{{$FooterDetails->third_address}}</p></li>
				@endif
				@if($FooterDetails->phone !=NULL)
				<li><strong>{{ trans('lang_data.telephone') }} : </strong><p><a href="tel:{{$FooterDetails->phone}}">{{$FooterDetails->phone}}</a></p></li>
				@endif
			</ul>
		</div>
		<div class="contact_right">
			<h2>{{ trans('lang_data.our_location') }}</h2>
			@php
				$counrty = \App\Models\Country::where('sortname',$url)->first();
			@endphp
			<iframe src="https://maps.google.com/maps?width=100%&amp;height=NaN&amp;hl=en&amp;q={{ $counrty->name }}+(Lifrica)&amp;ie=UTF8&amp;t=&amp;z=6&amp;iwloc=B&amp;output=embed" frameborder="0"></iframe>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
@endsection
@section('style_css')
@endsection
@section('validation_js')
<script src="{{ asset('js/common.js') }}"></script>
<script>
$(document).ready(function(){ 
    if($("#AddEditContactUsForm").length>0)
    {
	    $("#AddEditContactUsForm").validate({
	      ignore:'',
	      rules:{
	        'name': { required: true, minlength:3, maxlength:25 },
	        'email': { required: true, email: true},
	        'phone': { required: true },
	        'company_name': { required: true},
	        'long_description': { required: true}
	      },
	      messages:{
	        'name': { required: "{{ trans('lang_data.requ_name') }}" },
			'email': { required: "{{ trans('lang_data.requ_email') }}", email: "{{ trans('lang_data.valid_email')}}"},
			'phone': { required: "{{ trans('lang_data.requ_phone') }}"},
			'company_name': { required: "{{ trans('lang_data.please_enter_company_name') }}" },
			'long_description': { required: "{{ trans('lang_data.requ_message') }}" }
	      },
	      highlight: function(element){
	        $(element).closest('.control-group').addClass("f_error");
	      },
	      unhighlight: function(element) {
	        $(element).closest('.control-group').removeClass("f_error");
	      },
	      errorPlacement: function(error, element) {
	        $(element).closest('div').append(error);
	      }
	    });
  	}
});
</script>
@endsection