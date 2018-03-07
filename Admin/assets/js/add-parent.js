$(document).ready(function(){

	$(window).on('load', $("#pform").hide());

	$(window).on('load', $('#searchp').hide());

	$('#newp').on('click', showForm);

	

	$('#existp').on('click', showSearch);



	
	
    
});

function showForm(){

$('#pform').slideDown();


};

function hideForm(){

	$('#pform').hide();
};

function showSearch(){

	$('#searchp').slideDown();
};

function hideSearch(){

	$('#searchp').hide();
};