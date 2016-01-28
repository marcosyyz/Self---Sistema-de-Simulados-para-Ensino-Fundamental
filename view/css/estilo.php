<?php
  session_start();
  header("Content-type: text/css");

 if(isset($_SESSION['ALUNO_NIVEL'])){
   if($_SESSION['ALUNO_NIVEL'] == 1){
      $fundo_link = '../img/paisagem/Clouds-Sky-White.jpg';
   }elseif ($_SESSION['ALUNO_NIVEL'] == 2) {
      $fundo_link = '../img/paisagem/Flat-Space.jpg';    
   }elseif ($_SESSION['ALUNO_NIVEL'] == 3) {
      $fundo_link = '../img/paisagem/floresta.jpg';    
   }elseif ($_SESSION['ALUNO_NIVEL'] == 4) {
      $fundo_link = '../img/paisagem/folhas-marrons.jpg';    
   }elseif ($_SESSION['ALUNO_NIVEL'] == 5) {
      $fundo_link = '../img/paisagem/folhas-marrons.jpg';    
   } else{
      $fundo_link = '';
   }
 }else{
      $fundo_link = '';
 }
  
  
  $fundo_claro = '#fff';
  $fundo_azul = '#29A9E6';
  
  
?>




#filtro-turma{
width:125px;
}


table {
    background-color:<?php echo $fundo_claro ?>; 
}

#fundo-escuro{
   display:none;
    position:absolute;
    left:0;
    top:0;
    z-index:9000;
    background-color:#000;
}


.botao_azul{
    	padding: 1em 2em;
	outline: none;
	font-weight: 600;
	border: none;
	color: #fff;
	background: #3498db;
}

.botao_azul:hover{
    color: #aff;
}

.botao_vermelho{
    	padding: 1em 2em;
	outline: none;
	font-weight: 600;
	border: none;
	color: #fff;
	background: #c94e50;
}

.botao_vermelho:hover{
    color: #aff;
}

.verde{
    color:#169F84;
}

.vermelho{
    color:#c94e50;
}

.azul{
    color:#29A9E6;
}

.centro{    
text-align:center;    
}

.branco{
    color:#FFF;
}

table tr.fundo-verde td{
     background-color:#9CE2AE; 
}

table tr.fundo-amarelo td{
     background-color:#FCCD1B; 
}

table tr.feminino td {
    background-color: #FFFcFC;
    color:#8F3375; 
}

.texto_left{
    text-align: left;
    padding-left: 10px;
}

.table_header{
    margin-bottom: 20px;
}

.cabecalho_table{
    border-width:1px;
    border-style:solid;
    background-color:navy;
    color:white;
    padding:5px;
} 

#corpo{
    margin: 20px; 
    padding: 0;
}


#moldura-transparente{    
    width: 90%;	           
    margin: auto;
    border: 35px solid rgba(0,0,0,0.3); 
    border-radius: 7px;    
    -moz-border-radius: 7px; 
    -webkit-border-radius: 7px;     
 
}

.moldura-transparente div {
    background-color: rgba(255,255,255,0.7);
     
}

#transparente-div-home {      
    margin: 0 auto;  
    background-color:rgba(72,72,72,0.4);
    padding-left:35px;
    padding-right:35px;
    padding-top:15px;
    padding-bottom:15px;
    width: 90%;			
    margin-top:10px;
    -moz-border-radius: 7px;
    -webkit-border-radius: 7px;
}




#feedback-page{
	text-align:center;
}

#form-main{
	width:100%;
	float:left;
	padding-top:0px;
}

.fundo-claro {
    background:<?php echo $fundo_claro ?>;
}




.botao-atividade{
	float:left;
	width: 100%;
        font-size:24px;
	padding-top:3px;
	padding-bottom:3px;	
        margin-top:8px;
        font-weight:700;
}

.atividade-nao-feita{
	font-family: 'Montserrat', Arial, Helvetica, sans-serif;
	border: #fbfbfb solid 4px;
	cursor:pointer;
	background-color: #14bdd3;
	color:white;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;

       
}

.atividade-nao-feita:hover{
	background-color: #04bd93 ; 
	color: #fff;
}


.atividade-feita{
	font-family: 'Montserrat', Arial, Helvetica, sans-serif;
	border: #fbfbfb solid 4px;
	cursor:pointer;
	background-color: #04bd93 ;
	color:white;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;    
        background:url(../img/joinha-am.png) no-repeat;

        background-size: 25px;
}

.100porcento{       
       background-position: 50px;
       
}

.semjoinha{       
             background-position: -50px;       
}

.refazer{
	font-family: 'Montserrat', Arial, Helvetica, sans-serif;
	border: #fbfbfb solid 4px;
	cursor:pointer;
	background-color: #04bd93 ;
	color:white;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
     
       background:#F1BF00;

}

.refazer-nivel-2{
	font-family: 'Montserrat', Arial, Helvetica, sans-serif;
	border: #fbfbfb solid 4px;
	cursor:pointer;
	background-color: #04bd93 ;
	color:white;	
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
  
       background:#F4BF44;

}


.desativado{
	
	font-family: 'Montserrat', Arial, Helvetica, sans-serif;
	border: #888 solid 4px;	
	color:#888;
        background: transparent;               
}




#button-green{
        float:left;
	width: 100%;
	font-family: 'Montserrat', Arial, Helvetica, sans-serif;
	border: #fbfbfb solid 4px;
	cursor:pointer;
	background-color: #04bd93;
	color:white;
	font-size:24px;
	padding-top:22px;
	padding-bottom:22px;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
       margin-top:-4px;
       font-weight:700;
}

#button-green:hover{
	background-color: rgba(0,0,0,0);
	color: #04bd93;
}



#button-gray{
	font-family: 'Montserrat', Arial, Helvetica, sans-serif;	
	border: #fbfbfb solid 4px;
	cursor:pointer;
	background-color: #D1D3D4;
	color:white;
	font-size:24px;
	padding-top:22px;
	padding-bottom:22px;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
  margin-top:-4px;
  font-weight:700;
}

#button-gray:hover{
	background-color: rgba(0,0,0,0);
	color: #D1D3D4;
}



#atividades{    
    padding-left: 10px;
    padding-right: 10px;
    clear:both;   
    margin:auto;
    width:70%;
    text-align:left;
}

.botao_voltar{
    width: 100px;
    left:48%;
    
    position: relative;
}

.titulo{
    font-size: 32px;
    font-weight: bold;
    
}

.texto-verde{
    color:#169F84;
}



/*********************************************************************************/
/******************        HEADER        ****************************************/
/*********************************************************************************/


#cabecalho_menor{
   height:80px;
   padding-top:15px;
}

#cabecalho_maior{
   height:160px;
   padding-top:15px;
}

#menu-rank {
        top:-20px;
	position: relative;
	margin-left: 30px;
        float:left;
}

#menu-rank a {
	display: block;
	width: 140px;
}

#menu-rank ul {
	list-style-type: none;
	padding-top: 0px;
}

#menu-rank li {
	float: left;
	position: relative;
	padding: 0px 0;
	text-align: center;
}

#menu-rank ul.sub-menu {
	display: none;
	position: absolute;
	top: 50px;
	left: -10px;
	padding: 10px;
	z-index: 90;
        background-color:<?php echo $fundo_claro ?>;
}

#menu-rank ul.sub-menu li {
	text-align: left;
}

#menu-rank li:hover ul.sub-menu {
	display: block;
	border: 1px solid #ececec;
}







#menu {
	position: relative;
	margin-left: 30px;
        float:left;
}

#menu a {
	display: block;
	width: 140px;
}

#menu ul {
	list-style-type: none;
	padding-top: 0px;
}

#menu li {
	float: left;
	position: relative;
	padding: 3px 0;
	text-align: center;
}

#menu ul.sub-menu {
	display: none;
	position: absolute;
	top: 18px;
	left: -10px;
	padding: 10px;
	z-index: 90;
        background-color:<?php echo $fundo_claro ?>;
}

#menu ul.sub-menu li {
	text-align: left;
}

#menu li:hover ul.sub-menu {
	display: block;
	border: 1px solid #ececec;
}

.sair{
    top:-20px;
    position: relative;
    margin-right:20px;
}

/*********************************************************************************/
/******************        LOGIN          ****************************************/
/*********************************************************************************/


#transparente-div-login {
	background-color:rgba(72,72,72,0.4);
	padding-left:35px;
	padding-right:35px;
	padding-top:35px;
	padding-bottom:50px;
	width: 450px;
	float: left;
	left: 50%;
	position: absolute;
        margin-top:180px;
	margin-left: -260px;
       -moz-border-radius: 7px;
       -webkit-border-radius: 7px;
}

.feedback-input {
	color:#3c3c3c;
	font-family: Helvetica, Arial, sans-serif;
  font-weight:500;
	font-size: 18px;
	border-radius: 0;
	line-height: 22px;
	background-color: #fbfbfb;
	padding: 13px 13px 13px 54px;
	margin-bottom: 10px;
	width:100%;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-ms-box-sizing: border-box;
	box-sizing: border-box;
  border: 3px solid rgba(0,0,0,0);
}

.feedback-input:focus{
	background: #fff;
	box-shadow: 0;
	border: 3px solid #3498db;
	color: #3498db;
	outline: none;
  padding: 13px 13px 13px 54px;
}

.focused{
	color:#30aed6;
	border:#30aed6 solid 3px;
}






/* Icons ---------------------------------- */
#name{
	background-image: url(http://rexkirby.com/kirbyandson/images/name.svg);
	background-size: 30px 30px;
	background-position: 11px 8px;
	background-repeat: no-repeat;
}

#name:focus{
	background-image: url(http://rexkirby.com/kirbyandson/images/name.svg);
	background-size: 30px 30px;
	background-position: 8px 5px;
  background-position: 11px 8px;
	background-repeat: no-repeat;
}

#senha{
	background-image: url(http://cdn.flaticon.com/png/256/17305.png);
	background-size: 35px 35px;
	background-position: 11px 8px;
	background-repeat: no-repeat;
}

#senha:focus{
	background-image: url(http://cdn.flaticon.com/png/256/17305.png);
	background-size: 30px 30px;
  background-position: 11px 8px;
	background-repeat: no-repeat;
}

#comment{

	background-image: url(http://rexkirby.com/kirbyandson/images/comment.svg);
	background-size: 30px 30px;
	background-position: 11px 8px;
	background-repeat: no-repeat;
}

textarea {
    width: 100%;
    height: 150px;
    line-height: 150%;
    resize:vertical;
}



#button-blue{        
	font-family: 'Montserrat', Arial, Helvetica, sans-serif;
	float:left;
	width: 100%;
	border: #fbfbfb solid 4px;
	cursor:pointer;
	background-color: #3498db;
	color:white;
	font-size:24px;
	padding-top:22px;
	padding-bottom:22px;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
  margin-top:-4px;
  font-weight:700;
}

#button-blue:hover{
	background-color: rgba(0,0,0,0);
	color: #0493bd;
}
	
.submit:hover {
	color: #3498db;
}
	
.ease {
	width: 0px;	
        height: 81px;
	background-color: #fbfbfb;
	-webkit-transition: .3s ease;
	-moz-transition: .3s ease;
	-o-transition: .3s ease;
	-ms-transition: .3s ease;
	transition: .3s ease;
}

.ease_maior {
	width: 0px;	
        height: 120px;
	background-color: #fbfbfb;
	-webkit-transition: .3s ease;
	-moz-transition: .3s ease;
	-o-transition: .3s ease;
	-ms-transition: .3s ease;
	transition: .3s ease;
}

.submit:hover .ease_maior{
  width:100%;  
  background-color:white;
}

.submit:hover .ease{
  width:100%;  
  background-color:white;
}

@media only screen and (max-width: 580px) {
	#transparente-div{
		left: 3%;
		margin-right: 3%;
		width: 88%;
		margin-left: 0;
		padding-left: 3%;
		padding-right: 3%;
	}
}


/*********************************************************************************/
/******************        QUIZ           ****************************************/
/*********************************************************************************/


#negativo{
 display:none;
    position:absolute;    
    z-index:9900;        
}

.vidas{
    clear:both;
    float:right;      
    margin-bottom: 10px;
      
}

#borda_barra{
    margin:auto;
    width:90%;
    height:40px;    
    background-color:#0072b5;
	border-radius: 3px 3px 3px 3px;     
}

#barra{    
    background-color:#30aed6;
    width:0%;
    height:40px;
}

.andamento_vazio{
    margin-left:10px;
    font-size:36px;
    color: #30aed6;
}

.andamento{
    margin-left:10px;
    font-size:36px;
    color: #0072b5;
}


.fundo-claro{
 // background-color: #eee;
 
}

.box-centro{
  background-color: #eee;
  margin: 0 auto;
  width: 50%;
  padding: 20px;
  margin-top: 20px;  
  border-radius: 3px 3px 3px 3px;     
}


.box-questao{
  background-color: #eee;
  margin: 0 auto;
  width: 90%;
  padding: 15px;
  font-size: 35px;  
  border-radius: 3px 3px 3px 3px;       
}

.posicao_central{      
   display: block;
   margin:auto;
   text-align: center;
}

.posicao_left{   
   float:left;   
   margin-right: 20px;
}

.posicao_right{   
   float:right;  
   margin-left: 20px;
}


.questao_imagem{
    color: #0072b5;
    margin-bottom: 20px; 
    max-width: 918px;
}

.questao_texto{
    font-size: 25px;
    color: #0072b5;    
}

.questao_pergunta{
    clear:both;
    position:relative;
    color: #0072b5;    
    padding-bottom: 10px;   
}

.questao_som{
    cursor:pointer;
    //position:relative;
    float:left;
    
}

#img_dica{
margin : 10px 10px 10px 10px;
}

#alternativas{
       clear: both;       
  // background-color: #ad0 !important;  
}

#botoes_quiz{    
    padding-top:   20px;
     clear: both;      
}

#desistir{
    clear: both;    
//    background-color: #0d0 !important;
    margin-bottom: 10px;
}



.respostas{
    float:left;
    clear: both;
}   

.lacuna{
    display: none;
}


label {
  position: absolute;
  margin-top:   10px;
  border: 1px solid #D1D3D4; 
}


/* style label */
input.radio:empty ~ label {
        clear: both;
	position: relative;
	float: left;
	line-height: 30px;
	text-indent: 3em;
	margin-top: 2px;        
        padding-right: 25px;
	cursor: pointer;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
        border-radius: 3px 0 0 3px;       
}


/* hide input */
input.radio:empty {
	margin-left: -9999px;
        
}


input.radio:empty ~ label:before {
	position: absolute;
        //float:right;
	display: block;
	top: -0.5px;	
	left: -0.5px;
	content: '';
	width: 2.5em;
        height: 30px;
	background: #D1D3D4;
	border-radius: 3px 0 0 3px;
        float:left;        
}

label{
    color:#169F84;
}

/* toggle hover */
input.radio:hover:not(:checked) ~ label:before {
	content:'\2714';
	text-indent: .9em;
	color: #C2C2C2;
        
}

input.radio:hover:not(:checked) ~ label {
	color: #0Cc2cE;
        
}

/* toggle on */
input.radio:checked ~ label:before {
	content:'\2714';
	text-indent: .9em;
	color: #9CE2AE;
	background-color: #0Cc2cE; //#4DCB6D;
        
}

input.radio:checked ~ label {
	color: #0Cc2cE;//azulzinho
}

/* radio focus */
input.radio:focus ~ label:before {
	box-shadow: 0 0 0 3px #999;
} 

/*********************************************************************************/
/******************        FIM           ****************************************/
/*********************************************************************************/

.resultados{
    font-size:20px;
    margin-bottom:10px; 
     
}

/*********************************************************************************/
/******************        HOME           ****************************************/
/*********************************************************************************/


.box-pesquisa{
    top:-8px;  
    position:relative;
}

.cabecalho{
    height:60px    
}

.align-right{    
float:right;
}

.texto-pequeno{
  font-size: 20px;
}


.invisivel{
  display:none;
}

.boas-vindas{
  font-size:250%;
  font-family: 'Coming Soon', cursive;
  position:relative;
  padding-top: 10px;
  padding-left: 10px;
  float:left;  
}

.moeda{
    top: 10;
    padding-right:10px;
    font-size:250%;
    color:#cd0;
    font-weight: 900;
    text-shadow: 0 0 2px #000; /* horizontal-offset vertical-offset 'blur' colour */
    -moz-text-shadow: 0 0 2px #000;
    -webkit-text-shadow: 0 0 2px #000;
}

.texto-menu{
     margin-bottom: 10px;
}

.rank_icon{
padding-top:10px;
}

.moeda img{
padding-top:5px;
}

.turma-atual{
    text-decoration: underline;
    font-weight: bold;
    color: #FE9900;
}

  
  
 /** formata elementos que tem backgrounds parallax **/
.bg-Parallax {	
	margin: 0 auto;
	width: 100%;
	max-width: 1920px;
	position: relative;
	min-height: 100%;
 
	background-position: 50% 0;
	background-repeat: repeat;
	background-attachment: fixed;

       <?php if($fundo_link == ''){ ?>       
           background-color:<?php echo $fundo_azul.';'; 
        }else{ ?>
           background-image: url(  <?php echo $fundo_link.');';
       }  ?>
} 

.clearfix:after {
   content: " "; /* Older browser do not support empty content */
   visibility: hidden;
   display: block;
   height: 0;
   clear: both;
   position:absolute;
}

.final_flash{
 position: relative; 
 margin: auto;
width:534px;
height:400px;
}




/*********************************************************************************/
/******************        HISTORICO      ****************************************/
/*********************************************************************************/


.trofeu-ouro{
    width: 30; 
    height: 30; 
}
