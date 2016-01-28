<?php

include_once('../../../config.php');
include(ROOT."model/atividade.php");
include(ROOT."view/vhead.php");



if(isset($_SESSION['ALUNO_CDG'])):
  require_once ROOT.'control/login/verificar_autenticacao_aluno.php';    
endif; 


if (isset($_GET['q']))
  $questao_atual = ($_GET['q']);
else
  echo "ERRO 01 - QUESTAO NAO CARREGADA";  
  


$ativ = new Atividade(isset($_SESSION['ATIVIDADE_ATUAL']) ? $_SESSION['ATIVIDADE_ATUAL'] : -1,$_SESSION['ALUNO_TURMA']);
$ativ->carregar_Questao($questao_atual,TIPO_DIGITAR);
 

?>

</head>



 <title>SELF</title> 
 <body  data-speed="10" class="bg-Parallax">      
<!--      <div id="corpo">
         <div id="moldura-transparente"><div>-->
 <div id="transparente-div-home">
     
          <?php
          if(isset($_SESSION['ERROS'])){
            for($i = 1; $i <= (3 - $_SESSION['ERROS']); $i++){  
                echo "<img  class='vidas' src='".ROOT_URL."view/img/coracao_32x32.png' > ";
            }    
          }          
         ?>
     
     
     <div id="borda_barra">    
         <div id="barra">          
         </div>
     </div>     
     
     </p>
 
 <form  id="form-quiz"  name="form-questoes" method="post" action="<?php echo ROOT_URL;?>control/quiz/digitar/avancar_questao.php"> 
         
     <div    id="animated-example" class="box-questao animated bounceInRight" >
         
       <?php             
          if(isset($_SESSION['USUARIO_CDG']))
              echo "<a class='align-right texto-pequeno' href='"
                        .ROOT_URL."control/quiz/desistir.php'>Sair</a>";
          if(isset($ativ->questao_Fields['QUESTAODIGITAR_SOM'])){                   
              echo "<audio id='som_dica'     > ";
              echo "<source src='".ROOT_URL."view/sons/atividades/".
                      $ativ->questao_Fields['QUESTAODIGITAR_SOM']."' type='audio/mp3' /> ";
              echo "</audio> ";
              echo "<div onclick='tocar_dica()' class='questao_som'>";
              echo "<img id='img_dica' src='../img/megafone.png'/>";
              echo "</div>";

          }
          
       ?>
       <div class="imagem_ou_texto">   
       <?php	
          //texto e imagem dinamico
          if(isset($ativ->questao_Fields['QUESTAODIGITAR_IMAGEM']))
            echo "<img class='questao_imagem ".$ativ->css_posicao_imagem('QUESTAODIGITAR_IMAGEM_POS')."' src='".ROOT_URL."view/img/atividades/".$ativ->questao_Fields['QUESTAODIGITAR_IMAGEM']."'  />";
          if(isset($ativ->questao_Fields['QUESTAODIGITAR_TEXTO']))
            echo "<div class='questao_texto'><b>".nl2br($ativ->questao_Fields['QUESTAODIGITAR_TEXTO'])."</b></div><br></p>";
        ?>
       </div>
         
       <?php	  
          // questao
          if(isset($ativ->questao_Fields['QUESTAODIGITAR_PERGUNTA']))
            echo "<div class='posicao_central invisivel clearfix'><b>".$ativ->converter_Lacunas($ativ->questao_Fields['QUESTAODIGITAR_PERGUNTA'])."</b></div>";
                  
     
       ?>                                
       
           
     <!-- botoes e campos hiddens -->
     <div id='botoes_quiz'>
         <input type="hidden" name="resposta_correta" value="<?=$ativ->questao_Fields['QUESTAODIGITAR_LACUNA1']?>">
                        
         <div class="submit">
            <input type="submit" value="Responder" id="button-green"/>
             <div class="ease"></div>
         </div>
         
         <input type="hidden" name="questao_atual" value="<?php echo $questao_atual?>">
         
         
     </div>
     
          
     <!--<div id='desistir'><a class="align-right texto-pequeno" 
     href="<?php echo ROOT_URL.'control/quiz/desistir.php' ?>"> Desistir</a></div>-->

         
  </div><!-- /box-questao -->
	
  
  
  
  
  
  <!---  ############# debug ##############------->
 <!-- <br><br><br><br><br>
	<?php /*
	  if (isset($_SESSION['ACERTOS'])) 
			$acertos = $_SESSION['ACERTOS'];
		else
			$acertos = 0 ;
		
    if (isset($_SESSION['ERROS']))	
			echo 'Erros: '.$_SESSION['ERROS'].'<br>';
		else
			echo 'Erros: 0<br>';		
			
		echo 'Acertos: '.$acertos.'<br>';		
		echo 'Questao: '.$questao_atual.'<br>';
		echo 'Atividade : '.$_SESSION['ATIVIDADE_ATUAL'].'<br>';
		
		echo 'CDG_QUESTOES_ACERTADAS : ';
		if (isset($_SESSION['CDG_QUESTOES_ACERTADAS']))
		  print_r($_SESSION['CDG_QUESTOES_ACERTADAS']).'<br>';
		else
		  echo "0<br>";
			
		echo 'Ainda restam '.( $_SESSION['QTD_QUESTOES'] - $acertos).'  Questoes <br><br>';
		
		echo 'Total Questoes : '.$_SESSION['QTD_QUESTOES'].'<br>';

	*/	
	?>
	-->
</form>
</div>

</body>

<script>
	//fazer aparecer 
    $(document).ready(function(event) {	
		$('.box-questao').show();
		$('.box-questao').addClass('fade-in-right');                                
                
                $('.invisivel').addClass("animated bounceInRight");
                                
                $('.invisivel').show();
                
                setTimeout(function(){$('#resposta1').focus();}, 1000);
                
	});	

	


	//fazer sumir
    $('#button-green').click(function(event) {                       
                        resposta = document.getElementById("resposta1").value;  
                        //cancelando o submit
                        event.preventDefault();
                        
                        if (( resposta == null) || (resposta == '')){
                              alert("Digite uma resposta...");
                              exit;
                        }
                        
                        // efeito css para fade out left
                        $('.box-questao').removeClass("bounceInRight");				
			$('.box-questao').addClass("bounceOutLeft");				
                        
			
                     //enviando submit   
		    setTimeout( function () { 
			  $('#form-quiz').submit();
			  }, 300);		 
		});
	  
	    
    


function progressbar(objeto,acertos,total,acertou_anterior){
        
  this.total_exercicios = total;   
  // SE ACERTOU ANTERIOR
    //se o exercicio atual é o primeiro, posicao na barra deve ser zero 
    //se o exercicio atual é o segundo , tambem , (no final do carregamento ira avançar a barra)
    //se o exercicio atual é o terceiro, posicao na barra deve ser 1, e no final do carregamento da page avança a barra 
 // SE NAO
    //se o exercicio atual é o primeiro, posicao na barra deve ser zero 
    //se o exercicio atual é o segundo , fica na posicao 1 e nao avança
    //se o exercicio atual é o terceiro, posicao na barra deve ser 2, e nao avança

  this.acertos  = acertos;
  this.exercicio_atual = acertos+1;
  
  if (acertos in [0,1]){      
    this.posicao_na_barra = 0;          
  }else{
    this.posicao_na_barra = acertos-1;    
  }
  
  if(acertou_anterior == 0)
      this.posicao_na_barra = acertos;//sera 1 se estiver na segunda questao 

  this.objeto = objeto;
  
  this.posicao_por_cento =  100 * this.posicao_na_barra / this.total_exercicios;
  this.avanco_por_cento =  100 * 1 / this.total_exercicios;
  
//  alert(((document.getElementById("barra").clientWidth) * this.exercicio_atual / this.total_exercicios) + "%");
 
  //inserir texto de posicao inicial 
  if (this.posicao_na_barra > 0 )
    classandamento = 'andamento';
  else
    classandamento = 'andamento_vazio';

  $( this.objeto ).append("<span class='"+classandamento+"' >"+this.acertos+"/"+this.total_exercicios+"</span>");
  
  //configurar posicao inicial
  if(this.exercicio_atual  != 0)
	$( this.objeto ).css("width",this.posicao_por_cento+"%");
  else
    $( this.objeto ).css("width","0px");	
	
		
	/*	20 = 100
		4  = x
		
		100 * 4 / 20
		100 * exercicio_atual / total_exercicios
         */
  
	
  this.avancar = function () {	 
    this.exercicio_atual += 1;
     $( "#barra").html("<span class='andamento'>"+this.acertos+"/"+this.total_exercicios+"</span>");
	$( "#barra" ).animate({		
		width:"+="+this.avanco_por_cento+"%"		
	 }, 500, function() {
	 });
	
  };  
}

 
<?php if(isset($_SESSION['ACERTOU_ANTERIOR'])){ ?>
   progress = new progressbar('#barra',<?php echo ($_SESSION['ACERTOS']);?>,<?php echo $_SESSION['QTD_QUESTOES'];?>,<?php echo $_SESSION['ACERTOU_ANTERIOR']; ?>);
<?php } ?>

 if((<?php echo $_SESSION['ACERTOS']; ?> > 0)  //){
        && (<?php echo $_SESSION['ACERTOU_ANTERIOR']; ?> == 1 )){    
    progress.avancar();
 }
 
 function tocar_dica(){
    setTimeout(function() {
        aud = document.getElementById("som_dica"); 
        aud.play(); 
    }, 100); 
}

$(document).ready(function(){
    setTimeout(function() {
      tocar_dica();
    }, 2000); 
});


$(document).ready(function(){
    $(".questao_som").mouseover(function(){
        $("#img_dica").width(220);
        $("#img_dica").css("margin", "0");
    });
    $(".questao_som").mouseout(function(){
        $("#img_dica").width(200);
        $("#img_dica").css("margin", "10px 10px 10px 10px");
    });
});


$("#img_dica").click(function(){            
    $("#img_dica").width(230);
    $("#img_dica").css("margin", "-5px -5px -5px -5px");
    setTimeout(function() { 
        $("#img_dica").width(220);
        $("#img_dica").css("margin", "0");
    }, 200);
});

</script>

</html>




