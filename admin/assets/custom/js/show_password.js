//show current password
$(document).ready(function() {
    $("#show_hide_password1 a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password1 input').attr("type") == "text"){
            $('#show_hide_password1 input').attr('type', 'password');
            $('#show_hide_password1 i').addClass( "fa-eye-slash" );
            $('#show_hide_password1 i').removeClass( "fa-eye" );
        }else if($('#show_hide_password1 input').attr("type") == "password"){
            $('#show_hide_password1 input').attr('type', 'text');
            $('#show_hide_password1 i').removeClass( "fa-eye-slash" );
            $('#show_hide_password1 i').addClass( "fa-eye" );
        }
    });
});

//show new password & confirm password
$(document).ready(function() {
    $("#show_hide_password2 a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password2 input').attr("type") == "text"){
            $('#show_hide_password2 input').attr('type', 'password');
            $('#show_hide_password2 i').addClass( "fa-eye-slash" );
            $('#show_hide_password2 i').removeClass( "fa-eye" );
        }else if($('#show_hide_password2 input').attr("type") == "password"){
            $('#show_hide_password2 input').attr('type', 'text');
            $('#show_hide_password2 i').removeClass( "fa-eye-slash" );
            $('#show_hide_password2 i').addClass( "fa-eye" );
        }
    });
});


