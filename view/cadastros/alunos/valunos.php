<form action="<?php echo $action_pesquisa ; ?>"  method="POST">    
            <div id="wrap">                		
                <!-- Feedback message zone -->
                <div id="message"></div>

                <div id="toolbar">
                    <input type="text" id="filter" name="filter" placeholder="Filter :type any text here"  />   
                    <a id="showaddformbutton" class="button green"><i class="fa fa-plus"></i> Add new row</a>
                </div>
		<!-- Grid contents -->
		<div id="tablecontent"></div>
		<!-- Paginator control -->
		<div id="paginator"></div>
            </div>  

<p class="centro branco titulo"> ► Selecione a Turma ► </p>
<table cellpadding="2" cellspacing="2">
	<tr>
		<td class='cabecalho_table'><strong>Código</strong></th>
		<td class='cabecalho_table'><strong>Série</strong></th>
                <td class='cabecalho_table'><strong>Ano</strong></th>
                <td class='cabecalho_table'><strong>Profº</strong></th>		
        </tr>
        
<?php foreach($turmas as $turma ){ ?>            
        <tr>		
		<td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?t='.$turma['TURMA_CDG'] ?>'><?php echo $turma['TURMA_CDG']; ?></a></td>
		<td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?t='.$turma['TURMA_CDG'] ?>'><?php echo $turma['TURMA_NOME']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?t='.$turma['TURMA_CDG'] ?>'><?php echo $turma['TURMA_ANO']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?t='.$turma['TURMA_CDG'] ?>'><?php echo $turma['TURMA_PROFESSOR']; ?></a></td>                
	</tr>
<?php } ?>
</table>

 <a href="javascript:history.go(-1);">
          <img class='botao_voltar' src='<?php echo ROOT_URL;?>view/img/voltar.png'/>
 </a>   

</form>
