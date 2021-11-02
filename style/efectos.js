$(document).ready(function() {  
	$("#menu-lateral").hide();
	
	$('.mostrar').click(function(){
		$('#menu-lateral').show('slow');
	});	

	$('.ocultar').click(function(){
		$('#menu-lateral').hide('slow');
	});	
});