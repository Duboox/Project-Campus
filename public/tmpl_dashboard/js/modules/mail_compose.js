$(document).ready(function(){
    $('.summernote').summernote();

    $('#demo1').tagEditor();
    

    var edit = function() {
        $('.click2edit').summernote({ focus: true });
    };
    var save = function() {
        var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
        $('.click2edit').destroy();
    };

    $('#send').click(function(){

        var email = $('#reply_email').val();
        var subject = $('#subject').val();
        var cc = $('#cc').val();
        var message = $("#reply_message").code();

        $.ajax({
            url: url+'reply',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            dataType: "json",
            data: {
                email:email, subject:subject, cc:cc, message:message
            },

            beforeSend: function(){
               
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            },
        });

        return false;
    });

    $('#draft').click(function(){

        var email = $('#reply_email').val();
        var subject = $('#subject').val();
        var cc = $('#cc').val();
        var message = $("#reply_message").code();

        $.ajax({
            url: url+'reply/draft',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            dataType: "json",
            data: {
                email:email, subject:subject, cc:cc, message:message
            },

            beforeSend: function(){
               
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            },
        });

        return false;
    });

});