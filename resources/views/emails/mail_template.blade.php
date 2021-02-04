<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="format-detection" content="telephone=no" />
<meta  name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0," />
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
<title>{{SITE_INFO('name')}}</title>
</head>
<body style="width:100% !important; margin:0 !important; padding:0 !important; -webkit-text-size-adjust:none; -ms-text-size-adjust:none; background-color:#f1f1f1;">
<table cellpadding="0" cellspacing="0" border="0" id="backgroundTable" style="height:auto !important; margin:0; padding:20px 0; width:100% !important; background-color:#f1f1f1; color:#222222;">
	<tr>
		<td>
			<div id="tablewrap" style="width:100% !important; min-width:590px !important; max-width:590px !important; text-align:center !important; margin-top:0 !important; margin-right:auto !important; margin-bottom:0 !important; margin-left:auto !important;">
				<table id="contenttable" width="590" align="center" cellspacing="5" cellpadding="5" border="0" style="background-color:#FFFFFF; text-align:center !important; margin:0 auto !important; border:0; width:590px !important;">
					<tr>
						<td width="100%">
							@if(!isset($no_header_footer) || empty($no_header_footer))
							<table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" width="100%">
								<tr>
									<td width="100%" bgcolor="#f5f7f8" style="text-align:center; padding:5px 0" align="center" valign="top">
										 @if(!empty(SITE_INFO('logo_mail')) && file_exists(SETTING_LOGO_UPLOAD_PATH().SITE_INFO('logo_mail'))) <a href="{{SITE_URL()}}" target="_blank"><img src="{{SETTING_LOGO_UPLOAD_URL().SITE_INFO('logo_mail')}}" width="151" height="62"></a> @else <a href="{{SITE_URL()}}" target="_blank"><img src="{{FRONT_IMAGE_URL()}}logo.jpg" height="40"></a> @endif
									</td>
								</tr>
								<tr>
									<td width="100%" style="font-family:Arial,Helvetica,sans-serif; color:#363636; font-size: 13px; padding:5px 0" align="center" valign="top">
										<strong>{{ trans('lang_data.welcome_to') }} <a href="{{SITE_URL()}}">{{SITE_INFO('name')}}</a></strong>
									</td>
								</tr>
							</table>
							@endif
							{!! $email_body !!}
							@if(!isset($no_header_footer) || empty($no_header_footer))
							<table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="10" width="100%">
								<tr>
									<td width="100%" bgcolor="#ffffff" style="text-align:left;">
										<p style="color:#222222; font-family:Arial, Helvetica, sans-serif; font-size:12px; line-height:14px; margin-top:0; margin-bottom:15px; padding:0; font-weight:normal;">
										{{ trans('lang_data.any_questions_send_mail') }} <a style="color: #259dd9;" href="mailto:{{SITE_INFO('second_email')}}">{{SITE_INFO('second_email')}}</a> {{ trans('lang_data.or_simple_reply_to_this_msg') }}
										</p>
									</td>
								</tr>
								<tr>
									<td width="100%" style="border-top:1px solid #eeeeee; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#333333; line-height:18px;" align="left" valign="top"><strong style="font-size:12px;"> {{ trans('lang_data.regards') }}, </strong><br><span style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000">The {{SITE_INFO('name')}} Team</span></td>
								</tr>
								<tr>
									<td width="100%" style="font-family:Arial,Helvetica,sans-serif; padding:5px; font-size:11px; color:#333333; line-height:16px;" align="left" valign="top">{{ trans('lang_data.all_rights_reserved') }}</td>
								</tr>
								<tr>
									<td width="100%" style="font-family:Arial,Helvetica,sans-serif; padding:0 5px; font-size:11px; color:#333333; line-height:16px;" align="left" valign="top">© {{ trans('lang_data.copyright') }} {{date('Y')}} {{ CHANGESITETEXT(trans('lang_data.lifrica_pvt_ltd')) }}.</td>
								</tr>
							</table>
							@endif
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
</body>
</html>
