var ctrlMode = false; // if true the ctrl key is down
var altMode = false; // if true the ctrl key is down
    ///this works
$(document).keydown(function(e){
    if(altMode && ctrlMode){
        if(e.which == 80){
           window.location = 'index.php?p=1';
        }
        if(e.which == 65){
           window.location = 'index.php';
        }
    }

    if(e.altKey){ altMode = true; };
    if(e.ctrlKey){ ctrlMode = true; };       
});
    
    
        
$(document).keyup(function(e){
    ctrlMode = false;
    altMode = false;
});
    
    



$(document).ready(function(){			
    $('#name').select();	
});

$(document).ready(function(){			
    $('input:text[name="nome_prof"]').select();			 			 
});


$('#button-blue').click(function(event) {			
            event.preventDefault();
            $('#transparente-div-login').removeClass("zoom-in-ativo");				
            $('#transparente-div-login').addClass("zoom-out-ativo");				
        setTimeout( function () { 
              $('#form-login').submit();
              }, 500);


});