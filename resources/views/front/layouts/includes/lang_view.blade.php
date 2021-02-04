@if(env('MULTILINGUAL'))
    {!! (isset($full_view) && $full_view == true ? '<ul class="login_dropdown">':'<ul class="front_lang_dd">') !!}
    @if($full_view == false && !isset($liClass))
        <li>|</li>
    @endif        
    <li class="{{ (isset($liClass)?$liClass:NULL) }}">
        <a href="javascript:void(0);" class="{{ (isset($aClass)?$aClass:NULL) }}" data-toggle="dropdown">
            {{ getLangArr(true) }}
        </a>
        <ul class="{{ (isset($ulClass)?$ulClass:NULL) }} dropdown_menu">
            @foreach(getLangArr() as $lk=>$l)
                <li><a href="javascript:void(0)" onClick="changeDefaultLanguage('{{$lk}}')">{{ $l }}</a></li>
            @endforeach
        </ul>
    </li>
    {!! (isset($full_view) && $full_view == true ?' </ul>':'</ul>') !!}
@endif