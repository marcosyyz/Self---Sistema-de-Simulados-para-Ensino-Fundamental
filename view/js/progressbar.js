function progressbar(objeto,posicao,total){
  
  this.total_exercicios = total;
  this.exercicio_atual = posicao;
  this.objeto = objeto;
  
  this.posicao_por_cento =  100 * this.exercicio_atual / this.total_exercicios;
  this.avanco_por_cento =  100 * 1 / this.total_exercicios;
  
//  alert(((document.getElementById("barra").clientWidth) * this.exercicio_atual / this.total_exercicios) + "%");
 
  //inserir texto de posicao inicial 
  $( this.objeto ).html("<span class='andamento'>"+this.exercicio_atual+"/"+this.total_exercicios+"</span>");
  
  //configurar posicao inicial
  if(this.posicao_atual  != 0)
	$( this.objeto ).css("width",this.posicao_por_cento+"%");
  else
    $( this.objeto ).css("width","1px");	
	
		
	/*	20 = 100
		4  = x
		
		100 * 4 / 20
		100 * exercicio_atual / total_exercicios
         */
  
	
  this.avancar = function () {	 
    this.exercicio_atual += 1;
    $( "#barra").html("<span class='andamento'>"+this.exercicio_atual+"/"+this.total_exercicios+"</span>");
	$( "#barra" ).animate({		
		width:"+="+this.avanco_por_cento+"%"		
	 }, 500, function() {
	 });
	
  };  
}

progress = new progressbar('#barra',1,3);


