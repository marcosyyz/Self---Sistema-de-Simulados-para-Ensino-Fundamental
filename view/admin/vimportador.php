  
<div  class="centro fundo-claro">
 <form action="<?php echo ROOT_URL ?>/control/admin/importar.php" method="post" enctype="multipart/form-data">
     
     <br><br><br>
     IMPORTAÇÃO DE ALUNOS VIA ARQUIVO CSV <br><br>
     Os campos RA, LOGIN e NOME são Obrigatórios, os demais campos podem estar em branco caso você não a informação<br>
     Sequencia das colunas para o arquivo csv separados por ; (ponto e virgula)    :
     
     <br><br>
     
     
     <span class="verde">RA</span>(texto);
     <span class="verde">RGM</span> (numeros);
     <span class="verde">LOGIN </span>(texto);
     <span class="verde">NOME</span> (texto);
     <span class="verde">DATA DE NASCIMENTO</span> (dd/mm/aaaa);
     <span class="verde">SEXO </span>(M ou F) 
                                                      
   <hr>
     Selecione o arquivo csv para importação dos alunos.<br><br>
     <input type="file" name="file" id="file"><br>
   <hr>
   
   <br> Selecione a turma dos novos alunos: <br>
   <br> Ano Atual: <?php echo $_SESSION['ANO_DE_CONSULTA'] ?><br><br>
   
   <select style="width: 175px" name="filtro-turma" id="filtro-turma"  class="filter" > 
        <?php
          echo '<option   value="-1">Deixar alunos sem turmas</option>';
          foreach ($todasturmas as $t) {
             echo '<option '.($turma_filtro == $t['TURMA_CDG'] ? 'selected' : '').' value="'.$t['TURMA_CDG'].'">'.$t['TURMA_NOME'].'</option>';
          }
        ?>
   </select>
   <br>
   <div id="radios">
       <input type="radio" name="tipo-update" value="2" checked="checked"> Atualizar as turmas de todos os alunos desta planilha <br>
       <input type="radio" name="tipo-update" value="1">   Atualizar as turmas apenas dos alunos novos <br>
       <br>
   </div>
    <input type="submit" name="submit" value="Importar">
    <br><br><br>    
</form>
    </div>

</div> <!-- fundo transparente-->
 </body> 
 </html>
 
 <script>
   $( document ).ready(function() {
    $('#radios').hide();
    });
  
    
   $('select').change(function (){     
     if($('select').val() == '-1'){
       $('#radios').hide();
     }else{
       $('#radios').show();
     }
     
   });
   
   
 </script>



