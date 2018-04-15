$(document).ready(function(){

	$('#newp').click(function(){
		$('#pform').slideDown();
		$('#searchp').slideUp();
	});
	$('#existp').click(function(){
		$('#searchp').slideDown();
		$('#pform').slideUp();
	});

});