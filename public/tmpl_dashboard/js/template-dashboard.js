$(document).ready(function() {
	// Logout
	$('.logout').click(function(){
	    $('#logout-form').submit();
	    return false;
	});
	
	// pop-up
	$("a[rel='pop-up']").click(function () {
      	window.open(this.href, 'Popup', 'height = 600 , width = 1200, left = 100');
      	return false;
	 });
	 
	 $('.select2-search').select2();



	 $('#file-input-certificate').change(function() {
		console.log('changedddd');
	  $('#form-certificate').submit();
	});

	$('#button-certificate').click(function(){
		
		
		$('#file-input-certificate').click();
	});
});

