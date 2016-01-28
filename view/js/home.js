$(document).ready(function(){

//efeito parallax 
$('body.bg-Parallax').each(function(){
	var $obj = $(this);
 
	$(window).scroll(function() {
		var yPos = -($(window).scrollTop() / ($obj.data('speed') * 4)); 
 
		var bgpos = '50% '+ yPos + 'px';
 
		$obj.css('background-position', bgpos );
 
	}); 
});

//para tela de login
$('#nome_login').focus();


});



 




