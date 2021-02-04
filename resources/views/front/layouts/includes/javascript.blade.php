@if(env('CAPTCHA'))
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endif    
<script src="{{ asset('front/js/plugins.js') }}"></script>
<script>
    $(".extra_div").hide();
    <?php if (\Request::segment(2) != '') { ?>
        $("#login_loader").show();
    <?php  } ?>
  jQuery(window).load(function () {
      jQuery('#login_loader').fadeOut();
  });
  function SHOW_LOADER(){
     $("#login_loader").show();
  }
  function HIDE_LOADER(){
    jQuery('#login_loader').fadeOut();
  }
</script>
<script>

var loadDeferredStyles = function() {
    var addStylesNode = document.getElementById("deferred-styles");
    var replacement = document.createElement("div");
    replacement.innerHTML = addStylesNode.textContent;
    document.body.appendChild(replacement)
    addStylesNode.parentElement.removeChild(addStylesNode);
};
var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
      window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
  if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
  else window.addEventListener('load', loadDeferredStyles);
$(function() {
    $('.chosen-select').chosen({
        disable_search:true,
    });
});
jQuery(document).ready(function($){
    window.prettyPrint && prettyPrint();
    $('.scroll_box').scrollbar();
});

jQuery.validator.addMethod("noHTML", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9,.'@!#$^*?() &{!! regexToAddArabicCharacters() !!}]*$/.test(value);
}, "{{trans('lang_data.some_special_character_and_tags_allowed')}}");

jQuery.validator.addMethod("noHTMLTerm", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9-&,' {!! regexToAddArabicCharacters() !!}]*$/.test(value);
}, "{{trans('lang_data.some_special_character_and_tags_allowed')}}");

jQuery.validator.addMethod("validBsNameAndTerm", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9-&,.!™()'©`*"@:/^ {!! regexToAddArabicCharacters() !!}]*$/.test(value);
}, "{{trans('lang_data.some_special_character_and_tags_allowed')}}");

jQuery.validator.addMethod("universalEmailCheck", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9@._{!! regexToAddArabicCharacters() !!}]*$/.test(value);
}, "{{trans('lang_data.universal_email_check_error_message')}}");

jQuery.validator.addMethod("uniqueUserName", function(value, element) {
    return myValidator(element);
}, function(value, element) {
    var statemen1 = $(element).attr('data-email')+' '+"{{trans('lang_data.email_already_used_for_another_country')}}"+' '+'in'+' '+$(element).attr('data-country');
    var statemen2 = "";
    if($(element).attr('data-store') != "")
    {
        var statemen2 = 'for '+$(element).attr('data-store')+' store';
    }

  return statemen1+' '+statemen2+'.';
});

jQuery.validator.addMethod("emailCheck", function(value, element) {
    return this.optional(element) ||  /^([a-zA-Z0-9\.\_])+\@(([a-zA-Z0-9])+\.)+([a-zA-Z]{2,})+$/i.test(value);
}, "{{ trans('lang_data.please_enter_valid_email_address') }}");
////////////////////////////////
//Inbuild validators override //
////////////////////////////////
$.validator.addMethod( "alphanumeric", function( value, element ) {
    return this.optional( element ) || /^[\w{!! regexToAddArabicCharacters() !!}]+$/i.test( value );
}, "Letters, numbers, and underscores only please" );
////////////////////////////////
//Inbuild validators override //
////////////////////////////////
function myValidator(element) {
    var isSuccess = false;
    $.ajax({ 
        url: "{{ route('check.checkEmailCountry') }}", 
        data: {"email" : $("#email").val(), "type":"country"}, 
        async: false, 
        dataType: "json",
        success: 
            function(msg) { 
                $(element).attr("data-email",$("#email").val());
                $(element).attr("data-country",msg.country);
                $(element).attr("data-store",msg.storename);
                isSuccess = msg.success === "true" ? true : false 
            }
    });
    return isSuccess;
}

function ratingEnable() {
    $('.example-movie').barrating('show', {
        theme: 'bars-movie'
    });
}

function ratingDisable() {
    $('select').barrating('destroy');
}

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\!+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}

jQuery(document).ready(function() {

    $('.rating-enable').click(function(event) {
        event.preventDefault();
        ratingEnable();
        $(this).addClass('deactivated');
        $('.rating-disable').removeClass('deactivated');
    });

    $('.rating-disable').click(function(event) {
        event.preventDefault();
        ratingDisable();
        $(this).addClass('deactivated');
        $('.rating-enable').removeClass('deactivated');
    });

    //Menu Responsiv
    $('.menu > ul > li:has( > ul)').addClass('menu-dropdown-icon');
    $('.menu > ul > li > ul:not(:has(ul))').addClass('normal-sub');
    $(".menu > ul").before("<a href=\"#\" class=\"menu-mobile\"><i class=\"fa fa-bars\"></i></a>");
    $(".menu > ul > li").hover(function (e) {
        if ($(window).width() > 1190) {
            $(this).children("ul").stop(true, false).fadeToggle(150);
            e.preventDefault();
        }
    });
    $(".menu > ul > li").click(function () {
        if ($(window).width() <= 1190) {
            $(this).children("ul").fadeToggle(150);
        }
    });
    $(".menu-mobile").click(function (e) {
        $(".menu > ul").toggleClass('show-on-mobile');
        e.preventDefault();
    });

    // flash message time out
    setTimeout(function() {
    $('.alert-success').fadeOut('slow');
    },4000); // <-- time in milliseconds

    @php
        $user = \Auth::guard('business')->user();
    @endphp
    @if(isset($user->id) && !empty($user->id))
        $(document).on('click', '.chat_head', function(event) {
            $('.chat_body').slideToggle('slow');
            $('.chat_change_class').toggleClass('fa-minus-square');
        });
        /*$(document).on('click', '.msg_head', function(event) {
            // $('.msg_wrap').slideToggle('slow');
            $(this).next().slideToggle('slow');
        });*/
        
        /*$('.close').click(function(){
            $('.msg_box').hide();
        });*/
        
        $('.user').click(function(){

            $('.msg_wrap').show();
            $('.msg_box').show();
        });

        getBusinessStore("");

        $(document).on('click', '.chat_list_user', function(event) {
            event.preventDefault();
            var user_id = $(this).attr("chatsendto");
            if($('.user_box_'+user_id).length>0)
            {
                $('.user_box_'+user_id).find('textarea').focus();
                return false;
            }
            // if($(this).html().length>30)
            // {
            //     var show_str = $(this).html().substring(0,27)+'...'
            // }
            // else
            // {
                var show_str = $(this).html()
            // }
            $('.user_chat_box2').append('<div class="msg_box user_box_'+user_id+'" data-user-id="'+$("#logged").attr('loggedin')+'"><div title="'+show_str+'" class="msg_head">'+ $(this).html() +'<div class="close_chat">x</div></div><div class="msg_wrap"><div class="msg_body"><div class="msg_push" sendto="'+user_id+'"></div></div><div class="msg_footer"><div class="attach_wrapper"><textarea class="msg_input"></textarea></div></div></div></div>');
            $('.user_box_'+user_id).find('textarea').focus();
            $.ajax({
                url: "{{ route('getChat') }}",
                type:"POST",
                data: {chat_for: user_id,"_token":"{{csrf_token()}}"},
                success:function(data){
                    $('.user_box_'+user_id+' .msg_body').append(data);
                    $('.user_box_'+user_id+' .msg_body').scrollTop($('.user_box_'+user_id+' .msg_body')[0].scrollHeight);
                },
                error:function(e){
                }
            });        
        });

        $(document).on('click', '.close_chat', function(event) {
            $(this).parents('.msg_box').remove();
        });
    
        var sock = new SockJS('https://nodejs.lifrica.com');

        sock.onopen = function()    {   console.log('open');    };
        sock.onclose = function()   {   console.log('close');   };
        sock.onerror = function(e)  {   console.error(e);       };

        sock.onmessage = function(e) {
            var content = JSON.parse(e.data);
            if(content.load_user)
            {
                
            }
            else
            {
                var msg_push = $('div[sendto="' + content.sender_id + '"]');
                if($('.chat_list_user_'+content.sender_id).attr("data-user-id")==content.receiver_id)
                {
                    if($('.user_box_'+content.sender_id).length>0)
                    {
                        if($('.user_box_'+content.sender_id).attr("data-user-id")!=content.sender_id)
                        {
                            $('.user_box_'+content.sender_id).find('.msg_body').append('<div class="msg_a">'+content.receiver_name+': '+ content.chat +'</div>');
                        }
                    }
                    else
                    {
                        $('.chat_list_user_'+content.sender_id).trigger("click");
                    }
                }
            }
        };

        // Store message in database
        $(document.body).on('keypress', ".msg_input", function(e){
            if(e.keyCode === 10 || e.keyCode == 13 && e.ctrlKey){
                $(this).val($(this).val()+' \n');
            }
            else if (e.keyCode === 10 || e.keyCode == 13) {//if (e.keyCode == 13) {

                if($.trim($(this).val())!='')
                {
                    $(this).val($.trim($(this).val()));
                    var msg_body = $(this).closest('.msg_footer').siblings('.msg_body');
                    msg_body.find('.alert').remove();
                    var msg_push = msg_body.children('.msg_push');
                    var receiver_id = msg_push.attr('sendto');
                    var chat_message = $(this).val().replace(/\n/g, "<br />");  
                    e.preventDefault();
                    var send = new FormData();
                    send.append("_token", "{{csrf_token()}}");
                    send.append("chat", chat_message);
                    send.append("receiver_id", receiver_id);
                    $(this).val('');
                    $.ajax({
                        url: "{{ route('sendChat') }}",
                        type:"POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data:send,
                        success:function(data_msgs){
                            if(data_msgs != ''){
                                $(msg_body).append('<div class="msg_b">You: '+ data_msgs +'</div>');
                                msg_body.scrollTop(msg_body[0].scrollHeight);
                            }
                            var loggedin_user = $('#logged').attr('loggedin');
                            var receiver_name = $("#receiver_name").val();
                            var send = {chat: data_msgs, receiver_id: receiver_id, sender_id: loggedin_user,receiver_name:receiver_name};
                            sock.send(JSON.stringify(send));
                        },
                        error:function(e){
                            //console.error(e);
                            msg_body.scrollTop(msg_body[0].scrollHeight);
                        }
                    });    
                }
            }
        }); 

        $(document).on('keyup', '.search_business_user', function(event) {
            getBusinessStore($(this).val());                
        });
    @endif
    if($("#dp_start").length>0)
    {
        $('#dp_start').datepicker({
            maxDate: new Date(),
            changeYear:true,
            changeMonth:true,
            dateFormat: "dd-mm-yy",
            onClose: function (selectedDate) {
                $("#dp_end").datepicker("option", "minDate", selectedDate);
            }
        });
    }
    if($("#dp_end").length>0)
    {
        $('#dp_end').datepicker({
            maxDate: new Date(),
            changeYear:true,
            changeMonth:true,
            dateFormat: "dd-mm-yy"
        });
        $("#dp_end").datepicker("option", "minDate", $('#dp_start').val());
    }
    /********* OwlCarousel *********/
        
    $(window).resize(function(){
        if ($(window).width() < 768) {
            $(".item_categary").addClass('owl-carousel owl-theme');
            jQuery('.item_categary').owlCarousel({
                items: 2,
                lazyLoad: true,
                loop: false,
                margin: 10,
                responsiveClass: true,
                dots:false,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 2,
                    },
                    1000: {
                        items: 2,
                        dots:false,
                        loop: false
                    }
                }
            });
        }
        else {
            if($(".owl-carousel").length > 0){
                var owl = $('.owl-carousel');
                  owl.trigger('destroy.owl.carousel');
                  owl.addClass('off');
                $(".item_categary").removeClass('owl-carousel owl-theme');
            }
        }
    });
});

jQuery(document).ready(function() {
    
    if($("#get_best_stores").length>0)
    {
        var is_user_login = $("#form_is_login_user").val();
        var is_front_user = $("#form_is_front_user").val();
        
        if($("#id").length>0)
        {
            var id = $("#id").val();
        }
        else
        {
            var id = "";
        }

        jQuery.validator.addMethod("mobile_number", function (value, element) {
            return this.optional(element) || /^\(?\(?(\(?[+]?\d{0,3}\)?[\s-]?)?\(?\d{0,10}\)?[\s-]?\d{0,10}[\s-]?\d{0,10}\)?$/i.test(value);
        });

        jQuery.validator.addMethod("special_and_html_tag", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9 {!! regexToAddArabicCharacters() !!}]*$/.test(value);
        }, "{{ trans('lang_data.some_special_character_and_tags_allowed') }}");

        if(is_front_user != "0") {
            $("#get_best_stores").validate({
                ignore:'',
                invalidHandler: function(e, validator){
                    if(validator.errorList.length)
                    {
                        $("#"+$(validator.errorList[0].element).closest(".tab-pane").attr('id')+"_li a").trigger("click");
                    }
                },
                rules:{
                    'form_first_name': {required :true,special_and_html_tag:true},
                    'form_last_name': {required :true,special_and_html_tag:true},
                    'form_mobile' : { required:true, mobile_number:true, minlength:8, maxlength:18},
                    'email' : { required:true, email:true },
                    'city_id': { required:true }
                },
                messages:{
                    'form_first_name': {required :"{{ trans('lang_data.please_enter_first_name') }}"},
                    'form_last_name': {required :"{{ trans('lang_data.please_enter_last_name') }}"},
                    'form_mobile': {required: "{{ trans('lang_data.please_enter_mobile_number') }}",minlength:"{{ trans('lang_data.min_8_digits') }}",maxlength:"{{ trans('lang_data.max_18_digits') }}", mobile_number: "{{ trans('lang_data.phone_field_format') }}"},
                    'email': {required: "{{ trans('lang_data.please_enter_email_address') }}", email: "{{ trans('lang_data.please_enter_valid_email_address') }}"},
                    'city_id' : {required:"{{ trans('lang_data.requ_city_name') }}"}
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
        } else {
            $("#get_best_stores").validate({
                ignore:'',
                invalidHandler: function(e, validator){
                    if(validator.errorList.length)
                    {
                        $("#"+$(validator.errorList[0].element).closest(".tab-pane").attr('id')+"_li a").trigger("click");
                    }
                },
                rules:{
                    'form_first_name': {required :true,noHTML:true},
                    'form_last_name': {required :true,noHTML:true},
                    'form_mobile' : { required:true, mobile_number:true, minlength:8, maxlength:18},
                    'email' : { required:true, email:true ,remote:'{{ route("check.business_user_email_job_post") }}' },
                    'location': { required:true }
                },
                messages:{
                    'form_first_name': {required :"{{ trans('lang_data.please_enter_first_name') }}"},
                    'form_last_name': {required :"{{ trans('lang_data.please_enter_last_name') }}"},
                    'form_mobile' :{ required: "{{ trans('lang_data.please_enter_mobile_number') }}",minlength:"{{ trans('lang_data.min_8_digits') }}",maxlength:"{{ trans('lang_data.max_18_digits') }}", mobile_number: "{{ trans('lang_data.phone_field_format') }}"},
                    'email': {required: "{{ trans('lang_data.please_enter_email_address') }}", email: "{{ trans('lang_data.please_enter_valid_email_address') }}",remote: "{{ trans('lang_data.already_reg_email') }}"},
                    'location' : {required:"{{ trans('lang_data.please_select_location') }}"}
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
    }
    
    setInterval(MessageFormFrontListing, 100);

    setInterval(business_intrested_job_complete_ratting, 100);

    jQuery.validator.addMethod("noHTMLMessage", function(value, element) {
         return this.optional(element) || /^[a-zA-Z0-9-,.'"/:;@!#$^*?()&\n* {!! regexToAddArabicCharacters() !!}]*$/.test($.trim(value));
    }, "{{trans('lang_data.some_special_character_and_tags_allowed')}}");

    jQuery.validator.addMethod("noHTMLAllowed", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9,.\-@!#$^*?',(.)&\n* {!! regexToAddArabicCharacters() !!}]*$/.test($.trim(value));
    }, "{{trans('lang_data.some_special_character_and_tags_allowed')}}");

    function MessageFormFrontListing() {
        if($("#MessageFormFrontListing").length>0) {
            
            
            $("#MessageFormFrontListing").validate({
                ignore:'',
                rules:{
                    'to_sp_id': {required :true,min:0},
                    'to_message' : { required:true,noHTMLMessage:true},
                    
                },
                messages:{
                    'to_sp_id': {required:"{{ trans('lang_data.please_select_service_provider') }}", min :"{{ trans('lang_data.please_select_service_provider') }}"},
                    'to_message': {required: "{{ trans('lang_data.valid_enter_your_message') }}"},
                },
                highlight: function(element){
                    $(element).closest('.form_group').addClass("error");
                },
                unhighlight: function(element) {
                    $(element).closest('.form_group').removeClass("error");

                },
                errorPlacement: function(error, element) {
                    $(element).closest('div').append(error);
                }
            });
        }

      $(document).on('click', '.mfp-close',function(event)
      {
        $("div.error label.error").empty();
      });
    }

    function business_intrested_job_complete_ratting() {
        if($("#business_intrested_job_complete_ratting").length>0) {
            $("#business_intrested_job_complete_ratting").validate({
                ignore:'',
                rules:{
                    'title': { required:true,noHTMLAllowed:true,maxlength:50},
                    'reviews': { required:true,noHTMLAllowed:true,maxlength:1000},
                },
                messages:{
                    'title': {required :"{{ trans('lang_data.valid_enter_your_title') }}",},
                    'reviews': {required :"{{ trans('lang_data.valid_enter_your_review') }}",},
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

        $(document).on('click', '.mfp-close',function(event)
        {
            $("div.error label.error").empty();
        });
    }
   
    if($("#BannersearchForm").length>0)
    {
        if($("#id").length>0)
        {
            var id = $("#id").val();
        }
        else
        {
            var id = "";
        }
        $("#BannersearchForm").validate({
            ignore:'',
            invalidHandler: function(e, validator){
                if(validator.errorList.length)
                {
                    $("#"+$(validator.errorList[0].element).closest(".tab-pane").attr('id')+"_li a").trigger("click");
                }
            },
            rules:{
                'term': {required :true, minlength:1,validBsNameAndTerm:true },
                'location' : { required:true, minlength:1 }
            },
            messages:{
                'term': {required :"{{ trans('lang_data.please_enter_term') }}"},
                'location': {required: "{{ trans('lang_data.requ_location') }}"},
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

    if($("#get_quote_form").length>0)
    {
        if($("#id").length>0)
        {
            var id = $("#id").val();
        }
        else
        {
            var id = "";
        }

        $("#get_quote_form").validate({
            ignore:'',
            invalidHandler: function(e, validator){
                if(validator.errorList.length)
                {
                    $("#"+$(validator.errorList[0].element).closest(".tab-pane").attr('id')+"_li a").trigger("click");
                }
            },
            rules:{
                'term': {required :true, minlength:1, noHTMLTerm : true },
                'location' : { required:true, minlength:1, noHTML : true }
            },
            messages:{
                'term': {required :"{{ trans('lang_data.please_enter_term') }}"},
                'location': {required: "{{ trans('lang_data.requ_location') }}"},
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

    if($("#get_quote_form_not_found").length>0)
    {
        if($("#id").length>0)
        {
            var id = $("#id").val();
        }
        else
        {
            var id = "";
        }
        
        $("#get_quote_form_not_found").validate({
            ignore:'',
            invalidHandler: function(e, validator){
                if(validator.errorList.length)
                {
                    $("#"+$(validator.errorList[0].element).closest(".tab-pane").attr('id')+"_li a").trigger("click");
                }
            },
            rules:{
                'term': {required :true, minlength:1, noHTMLTerm: true },
                'location' : { required:true, minlength:1, noHTML: true }
            },
            messages:{
                'term': {required :"{{ trans('lang_data.please_enter_term') }}"},
                'location': {required: "{{ trans('lang_data.requ_location') }}"},
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

    if ($(window).width() < 431) {
        $(".mainListingDiv .item_content").each(function(){
            $(this).insertBefore($(this).closest(".item_box").find(".reating_list"));
        });
    };
});

$('a.toggle_cat').on('click', function(e) {
    $('.sub_cat_box').slideToggle().toggleClass("active");
    e.preventDefault();
});

$(document).ready( function() {
    $('li.call_funct').click(function(e){
        e.stopPropagation();
        $this = $(this).parent().find('span.sub_cat_box');
        if ($this.hasClass('active')){
            $(this).parent().find('span.sub_cat_box').show();
            $(this).removeClass('active');
        } else {
            $(this).parent().find('span.sub_cat_box').show();
        $(this).addClass('active');
        }
    });
    
    $('.radio > .button').click( function() {
        $('.radio').find('.button.active').removeClass('active');
        $(this).addClass('active');
    });

    function closeMenu(){
        $('span.sub_cat_box').fadeOut(200);
        $('li.call_funct').removeClass('active');
    }

    $(document.body).click( function(e) {
        closeMenu();
    });

    $("span.sub_cat_box").click( function(e) {
        e.stopPropagation();
    });
});

function getCountbasedOnId(id,count) {
    var matchess = $("#"+id).val();
    var lens = matchess.length;
    return final_count_remains = count - lens;
}

function getCountbasedOnClass(Class,count) {
    var matchess = $("."+Class).val();
    var lens = matchess.length;
    return final_count_remains = count - lens;
}

// $('.caption').hide().delay(1500).fadeIn('slow');
 
/********* Footer Accordion For Mobile *********/
$(function() {
    var isXS = false,
        $accordionXSCollapse = $('.accordion-xs-collapse');
    var timer;
    $(window).resize(function() {
        if (timer) {
            clearTimeout(timer);
        }
        timer = setTimeout(function() {
            isXS = Modernizr.mq('only screen and (max-width: 900px)');
            if (isXS) {
                $accordionXSCollapse.addClass('collapse');
            } else {
                $accordionXSCollapse.removeClass('collapse');
            }
        }, 100);
    }).trigger('resize');
    $accordionXSCollapse.each(function() {
        $(this).collapse({
            toggle: false
        });
    });
    $(document).on('click', '.accordion-xs-toggle', function(e) {
        e.preventDefault();
        var $thisToggle = $(this),
            $targetRow = $thisToggle.parent('.tr'),
            $targetCollapse = $targetRow.find('.accordion-xs-collapse');
        if (isXS && $targetCollapse.length) {
            var $siblingRow = $targetRow.siblings('.tr'),
                $siblingToggle = $siblingRow.find('.accordion-xs-toggle'),
                $siblingCollapse = $siblingRow.find('.accordion-xs-collapse');
            $targetCollapse.collapse('toggle');
            $siblingCollapse.collapse('hide');
            $thisToggle.toggleClass('collapsed');
            $siblingToggle.removeClass('collapsed');
        }
    });
});
</script>
<script>

    // Custom autocomplete instance.
    $.widget( "app.autocomplete", $.ui.autocomplete, {
        
        // Which class get's applied to matched text in the menu items.
        options: {
            highlightClass: "ui-state-highlight"
        },
        
        _renderItem: function( ul, item ) {

            // Replace the matched text with a custom span. This
            // span uses the class found in the "highlightClass" option.
            var re = new RegExp( "(" + this.term + ")", "gi" ),
                cls = this.options.highlightClass,
                template = "<span class='" + cls + "'>$1</span>",
                label = item.label.replace( re, template ),
                $li = $( "<li/>" ).appendTo( ul );
            
            // Create and return the custom menu item content.
            $( "<a/>" ).attr( "href", "javascript:void(0)" )
                       .html( label )
                       .appendTo( $li );
            
            return $li;
            
        }
        
    });

    $("#autocomplete").autocomplete({
         source: function(request, response) {
            $.ajax({
                type: "POST",
                url: "{{ route('search_term_ajax') }}",
                dataType: "json",
                data: {
                    term : request.term,
                    "_token":"{{csrf_token()}}"
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        highlightClass: "bold-text",
        minLength: 1,
    });

    $("#autolocation").autocomplete({
        source: function(request, response) {
            $.ajax({
                type: "POST",
                url: "{{ route('search_location_ajax') }}",
                dataType: "json",
                data: {
                    location : request.term,
                    "_token":"{{csrf_token()}}"
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 1,
    });


    setInterval(get_location, 1000);

    function get_location(){
        $("#autolocationprofile").autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('search_location_ajax_quoute') }}",
                    dataType: "json",
                    data: {
                        location : request.term,
                        "_token":"{{csrf_token()}}"
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 1,
        });
    }

    setInterval(get_location_postjob, 1000);

    function get_location_postjob(){
        var countryid = $("#autolocationprofile_postjob").attr('data-countryid');
        $("#autolocationprofile_postjob").autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('search_location_ajax_postjob') }}",
                    dataType: "json",
                    data: {
                        location : request.term,
                        countryid : countryid,
                        "_token":"{{csrf_token()}}"
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 1,
        });
    }


    $("#autocomplete_quote").autocomplete({
        source: function(request, response) {
            $.ajax({
                type: "POST",
                url: "{{ route('search_term_ajax_quoute') }}",
                dataType: "json",
                data: {
                    term : request.term,
                    "_token":"{{csrf_token()}}"
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 1,
    });


    $("#autolocation_quote").autocomplete({
        source: function(request, response) {
            $.ajax({
                type: "POST",
                url: "{{ route('search_location_ajax_quoute') }}",
                dataType: "json",
                data: {
                    location : request.term,
                    "_token":"{{csrf_token()}}"
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 1,
    });


    setInterval(get_autolocation_quote_all_db, 1000);
        
    function get_autolocation_quote_all_db(){
        $("#autolocation_quote_all_db").autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('search_all_location_ajax') }}",
                    dataType: "json",
                    data: {
                        location : request.term,
                        "_token":"{{csrf_token()}}"
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 1,
        });
    }

    $("#autocomplete_quote_not_found").autocomplete({
        source: function(request, response) {
            $.ajax({
                type: "POST",
                url: "{{ route('search_term_ajax_quoute') }}",
                dataType: "json",
                data: {
                    term : request.term,
                    "_token":"{{csrf_token()}}"
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 1,
    });

    setInterval(autolocation_quote_all_db_not_found, 1000);
        function autolocation_quote_all_db_not_found(){
        $("#autolocation_quote_all_db_not_found").autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('search_all_location_ajax') }}",
                    dataType: "json",
                    data: {
                        location : request.term,
                        "_token":"{{csrf_token()}}"
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 1,
        });
    }

    
    function getBusinessStore(term) {
        $.ajax({
            type: "POST",
            url: "{{ route('getBusinessStore') }}",
            data: {"_token":"{{csrf_token()}}",'term':term},
            success: function(data) {
                // console.log(data);
                $(".chat_people").html(data);
            }
        });
    }
    /**
     * Change the default language
     * @author Hirak
     */
    function changeDefaultLanguage(lang)
    {
        $.ajax({
            url:"{{ route('changeDefaultLanguage') }}",
            data:{"lang":lang},
            success:function(){
                location.reload();
            }
        })
    }
    /**
     * Chosen select box destory and rest as per size
     * @author Bhargav Upadhyay
     */
    function changeChosen(classname,size)
    {
        if ($(window).width() < size) {
            $('.'+classname).chosen('destroy')
        }
        else
        {
            $("."+classname).chosen();
        }
    }
</script>




