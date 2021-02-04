
	@php
		$user = \Auth::guard('business')->user();
	@endphp
	@if(isset($user->id) && !empty($user->id))
	<input type="hidden" value="{{ $user->business_store->bs_name }}" id="receiver_name" class="receiver_name">
	<div class="user_chat_box">
	    <div class="chat_box">
	        <div class="chat_head">
	        	{{ trans('lang_data.chat_box') }} &nbsp;
	            <span class="chat_icon02">
	                <i class="fa fa-commenting" aria-hidden="true"></i>
	            </span>
	            <span class="text pull-right"><i class="chat_change_class fa fa-plus-square"></i></span>  
	        </div>            
	        <div class="chat_body" style="display:none">
	        	<div class="chat_search">
	        		<form autocomplete="off" action="javascript:void(0)">
			        	<input type="text" name="search_business_user" class="search_business_user" value="" placeholder="{{ trans('lang_data.search_business_users') }}">
			        </form>
	        	</div>
	        	<div class="chat_people">
	        		
	        	</div>
	        </div>
	    </div>
	</div>
	<div class="user_chat_box user_chat_box2"></div>
	@endif
	<div class="footer full-width">
		<div class="container">
			<p>{!! CHANGESCOUNTRYTEXT('Home Page Footer Content') !!}</p>
			<hr>
			<div class="divtable accordion-xs">
			@php
				$url = GETSEGMENT(1);
				$footerQuickLink = GETQUICKLINKS();
			@endphp
			@if(count($footerQuickLink) > 0)
			<div class="tr">
				<div class="td firstname accordion-xs-toggle"><h2>{{ trans('lang_data.quick_links') }}</h2></div>
				<div class="accordion-xs-collapse">
					<div class="inner">
						<div class="td">
							<ul>
								@foreach($footerQuickLink as $a)
								<li><a href="{{route('front.get_cms_page',$a->url)}}"><i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp; {{$a->title}}</a></li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
			@endif
			@php

			$SocialMedia = \App\Models\Social::whereHas('country', function($sql) use ($url){
								$sql->where('sortname',$url);
							})->select('title','link_title','URL','image')->where('status',\App\Models\Social::STATUS_ACTIVE)->orderBy('display_order',"ASC")->get();

			@endphp

				@if(count($SocialMedia) > 0)
				<div class="tr">
					<div class="td firstname accordion-xs-toggle"><h2>{{ trans('lang_data.follow_us_on') }}</h2></div>
					<div class="accordion-xs-collapse">
						<div class="inner">
							<div class="td">
								<ul>
									@foreach($SocialMedia as $k=>$v)
									<li><a href="{{ $v->URL }}" target="_blank"><i class="{{ $v->title }}" aria-hidden="true"></i> &nbsp;{{ $v->link_title }}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
				@endif
				<div class="tr">
					<div class="td firstname accordion-xs-toggle"><h2>{{ trans('lang_data.contact_us') }}</h2></div>
					<div class="accordion-xs-collapse">
						<div class="inner">
							<div class="td">
								<ul class="contact">
									@php
										$FooterDetails = \Config::get("constantSite");
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
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="copyright full-width">
		<div class="container">
			<div class="floatL">
				<p>{{ trans('lang_data.copyright') }} © {{ date('Y') }} @if($FooterDetails->name !=NULL) {{ $FooterDetails->name }} @else {{ trans('lang_data.lifrica_africa') }}  @endif. {{ trans('lang_data.all_rights_reserved_keyword') }} </p>
			</div>
			<div class="floatR">
				<p>{{trans('lang_data.powered_by')}} <a href="https://www.technoinfonet.com/" target="_blank" rel="nofollow"><img src="{{asset('front/images/techno_logo.svg')}}" title="{{ trans('lang_data.techno_info') }}" alt="{{ trans('lang_data.techno_info') }}" height="44"></a></p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>