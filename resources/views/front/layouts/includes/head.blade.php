<head>
    @yield('base_url_meta')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
@if(SITE_INFO('web_master'))
<meta name="google-site-verification" content="{{ SITE_INFO('web_master') }}">
@endif
<title>@yield('TabTitle')</title>
@if(isset($meta_description) && !empty($meta_description))
<meta name="description" content="{{ $meta_description }}">
@endif
@if(isset($meta_keyword) && !empty($meta_keyword))
<meta name="keywords" content="{{ $meta_keyword }}">
@endif
<link  rel="shortcut icon" href="{{\App\Models\Setting::getFrontFaviconImageUrl(SITE_INFO('favicon'))}}" type="image/png">
<meta name="robots" content="noindex,nofollow">
<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<link rel="canonical" href="<?php echo $actual_link; ?>" />
<link rel="apple-touch-icon" sizes="128x128" href="{{ asset('front/images/appicon.png') }}">

<noscript id="deferred-styles">
{!! Html::style(FRONT_CSS_URL().'font-awesome.css') !!}
{!! Html::style(ADMIN_LIB_URL().'datatables1.10.12/jquery.dataTables.min.css') !!}
</noscript>
{!! Html::style(FRONT_CSS_URL().'style.css?time='.time()) !!}
@if(env('MULTILINGUAL')==true)
{!! Html::style(FRONT_CSS_URL().'additional.css?time='.time()) !!}
@endif
@if(getDefaultLanguage()=='ar')
    {!! Html::style(FRONT_CSS_URL().'ar.css?time='.time()) !!}
@endif
{!! Html::style(FRONT_CSS_URL().'responsive.dataTables.min.css') !!}

@if(SITE_INFO('google_analytics'))
{!!SITE_INFO('google_analytics')!!}
@endif
<script>
     <?php
         $bs =\Auth::guard('business')->user();

        if (isset($bs) && empty($bs->first_name) && empty($bs->last_name) && \Request::route()->getName() != 'front.business_account_setting') {

            ?>
            window.location.href = "{{route('front.business_account_setting')}}";


    <?php } ?>
</script>
</head> 