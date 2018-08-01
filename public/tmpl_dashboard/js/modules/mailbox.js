$(document).ready(function() {
	$('#refresh-message').click(function(){
		location.reload();
});

/*=============================================
=           Seleccionar mensajes              =
=============================================*/

$('.i-checks').iCheck({
  checkboxClass: 'icheckbox_square-green',
  radioClass: 'iradio_square-green',
});

$('input').iCheck({checkboxClass: 'icheckbox_square-green', radioClass: 'iradio_square-green'});

$('#check-all').on('ifChecked', function(event) {
    $('.check').iCheck('check');
});

$('#check-all').on('ifUnchecked', function(event) {
  $('.check').iCheck('uncheck');
});

// Removed the checked state from "All" if any checkbox is unchecked
$('#check-all').on('ifChanged', function(event){
     if(!this.changed) {
         this.changed=true;
         $('#check-all').iCheck('check');
     } else {
         this.changed=false;
         $('#check-all').iCheck('uncheck');
     }
     $('#check-all').iCheck('update');
  });
});

/*=============================================
=              Borrar mensajes                =
=============================================*/

$('#move-to-trash').click(function(){
    var checkedArray = [];

    $("input[name='message[]']:checked").each(function(){
        checkedArray.push($(this).val());
    });

    $.each( checkedArray, function(key, value) {
      $('#message_'+value).remove();
    });

    var request = {};
      request.route = 'move_to_trash';
      request.method = 'PUT';
      request.data = checkedArray;

    ajax.sendAjax(request);
});