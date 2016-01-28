<form action="<?php echo $action_pesquisa ; ?>"  method="POST">        
<?php include ROOT.'view/inc/pesquisar.php'; ?>

<p class="centro branco titulo"> ► Alunos ► </p>
<table cellpadding="2" cellspacing="2">
	<tr>
		<td class='cabecalho_table'><strong>Código</strong></th>
		<td class='cabecalho_table'><strong>Nome</strong></th>
                <td class='cabecalho_table'><strong>Pontuação</strong></th>
                <td class='cabecalho_table'><strong>Turma</strong></th>
                <td class='cabecalho_table'><strong>Nível</strong></th>		
                <td class='cabecalho_table'><strong>Sexo</strong></th>		
                <td class='cabecalho_table'><strong>RGM</strong></th>		
                <td class='cabecalho_table'><strong>Nasc.</strong></th>	
                <td class='cabecalho_table'><strong>Status</strong></th>	
                <td class='cabecalho_table'><strong>Acesso</strong></th>		                    
        </tr>
        
<?php foreach($alunos as $a ){ ?>            
        <tr>		
		<td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?a='.$a['ALUNO_CDG'] ?>'><?php echo $a['ALUNO_CDG']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?a='.$a['ALUNO_CDG'] ?>'><?php echo $a['ALUNO_LOGIN']; ?></a></td>                		
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?a='.$a['ALUNO_CDG'] ?>'><?php echo $a['ALUNO_PONTOS']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?a='.$a['ALUNO_CDG'] ?>'><?php echo $a['TURMA_NOME']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?a='.$a['ALUNO_CDG'] ?>'><?php echo $a['ALUNO_NIVEL']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?a='.$a['ALUNO_CDG'] ?>'><?php echo $a['ALUNO_SEXO']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?a='.$a['ALUNO_CDG'] ?>'><?php echo $a['ALUNO_RGM']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?a='.$a['ALUNO_CDG'] ?>'><?php echo $a['ALUNO_NASCIMENTO']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?a='.$a['ALUNO_CDG'] ?>'><?php echo $a['ALUNO_STATUS']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?a='.$a['ALUNO_CDG'] ?>'><?php echo $a['ALUNO_ULTIMOLOCAL']; ?></a></td>                                
	</tr>



<?php } ?>
</table>

 <a href="javascript:history.go(-1);">
          <img class='botao_voltar' src='<?php echo ROOT_URL;?>view/img/voltar.png'/>
 </a>


</form>


<script>
    
jQuery.fn.setSelection = function(selectionStart, selectionEnd) {
	if(this.lengh == 0) return this;
	input = this[0];

	if (input.createTextRange) {
		var range = input.createTextRange();
		range.collapse(true);
		range.moveEnd('character', selectionEnd);
		range.moveStart('character', selectionStart);
		range.select();
	} else if (input.setSelectionRange) {
		input.focus();
		input.setSelectionRange(selectionStart, selectionEnd);
	}

	return this;
}

$(document).ready(function(){
    
    $('#pesquisa-box').focus();
        
    $('#pesquisa-box').setSelection($('#pesquisa-box').val().length, $('#pesquisa-box').val().length);
    
});




</script>