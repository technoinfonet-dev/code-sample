<div id="ajax_call_user_data">
	<div class="header full-width">
		<div class="container">
			<div class="logo">
				<a href="{{route('home')}}" title="{{ trans('lang_data.welcome_to_lifrica') }}">
					<img src="{{\App\Models\Setting::getFrontSiteLogoUrl(SITE_INFO('logo'))}}" alt="{{ trans('lang_data.welcome_to') }} Lifrica" title="{{ trans('lang_data.welcome_to') }} {{ CHANGESITETEXT(trans('lang_data.lifrica_africa')) }}" alt="{{ trans('lang_data.welcome_to') }} {{ trans('lang_data.lifrica_africa') }}">
				</a>
			</div>
			<div class="menu1 cf">
				<ul>
					<li>
						@if(Auth::check())
								<div class="menu cf">
									<ul class="cf front_login_nav">
									@if(\Auth::user()->is_social_login != 1)
										<li><a href="{{route('front.business_register')}}">{{ trans('lang_data.get_registered_as_business') }}</a></li>
									@endif
										<li><a href="{{route('front.get_a_quote')}}">{{ trans('lang_data.get_quotes_cap') }}</a></li>
									</ul>
								</div>
						@elseif(Auth::guard('business')->user())
						<div class="menu cf">
							<ul class="cf business_login_nav">
								<?php
									$user = Auth::guard('business')->user();
								?>
								<li><a href="{{route('front.get_a_quote')}}">{{ trans('lang_data.get_quotes_cap') }}</a></li>
								<li class="bs_dashboard"><a href="{{route('front.business_dashboard')}}">{{ trans('lang_data.form_dashboard') }}</a></li>
								@if($user->is_premium_user == \App\User::CONST_IS_FREE_USER)
								<li><a href="{{route('front.becomepremium')}}">{{ trans('lang_data.become_premium_store') }}</a></li>
								<li>|</li>
								@endif
							</ul>
						</div>
						@else
						<div class="menu cf">
							<ul class="cf without_login_nav">	
								<li><a href="{{route('front.get_a_quote')}}">{{ trans('lang_data.get_quotes_cap') }}</a></li>
								<li><a href="{{route('front.business_register')}}" title="{{ trans('lang_data.list_free_business') }}">{{ trans('lang_data.free_listing_keyword') }}</a>
								</li>
								<li>|</li>				
								<li><a href="{{route('front.login')}}">{{trans('lang_data.menu_login')}}</a></li>
								<li>|</li>
								<li><a href="{{route('front.register')}}">{{trans('lang_data.sign_up')}}</a></li>
							</ul>
						</div>
						@endif
					</li>
					@if(Auth::check())
					<li class="front_auth_icon">
						<a href="javascript:void(0);">
							<span class="img_author">
							@php if(file_exists(USER_UPLOAD_PATH().\Auth::user()->image) && !empty(\Auth::user()->image)) { @endphp
					            <img src="{{USER_UPLOAD_URL().\Auth::user()->image}}" title="{{ \Auth::user()->name }}" alt="{{ \Auth::user()->name }}">
					    	@php }else{ @endphp
					            <img src="{{FRONT_IMAGE_URL().'default_user.png'}}" title="{{ \Auth::user()->name }}" alt="{{ \Auth::user()->name }}">
					    	@php } @endphp
					    	</span>
					    </a>
						<ul class="dropdown_menu">
							<li><a href="{{route('front.account_dashboard')}}">{{ trans('lang_data.form_dashboard') }}</a></li>
							<li><a href="{{route('front.logout')}}">{{ trans('lang_data.logout') }}</a></li>
						</ul>
					</li>
					@elseif(Auth::guard('business')->user())
					<li class="biss_auth_icon">
						<?php $name = FIXLENGTH($user->business_store->bs_name,'10'); ?>
						<a href="javascript:void(0);" data-toggle="dropdown">{{ trans('lang_data.welcome') }} {{$name}} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
				        <ul class="dropdown_menu">
                            <li><a href="{{route('front.business_logout')}}">{{ trans('lang_data.logout') }}</a></li>
	                    </ul>
					</li>
					@endif
					<li class="floatR">
	                	@include('front.layouts.includes.lang_view',['full_view'=>false])
					</li>
                </ul>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<input type="hidden" id="site_url" value="{{ url('/') }}">
	<input type="hidden" id="curr_country" value="{{ GETSEGMENT(1) }}">	
	<input type="hidden" id="env_captcha" value="{{ env('CAPTCHA') }}">	
</div>
