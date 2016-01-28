<form action="<?php echo $action_pesquisa ; ?>"  method="POST">    
<?php include ROOT.'view/inc/pesquisar.php'; ?>

<p class="centro branco titulo"> ► Bloquear acesso de turmas ao Sistema ► </p>
<table cellpadding="2" cellspacing="2">
	<tr>
		<td class='cabecalho_table'><strong>Código</strong></th>
		<td class='cabecalho_table'><strong>Série</strong></th>
                <td class='cabecalho_table'><strong>Ano</strong></th>
                <td class='cabecalho_table'><strong>Profº</strong></th>		
                    <td class='cabecalho_table'><strong>Status</strong></th>		
        </tr>
        
<?php foreach($turmas as $turma ){ ?>    
        
        <tr <?php echo ($turma['TURMA_ATIVO'] == 0 ? ' class="fundo-amarelo vermelho" ' : ' class="fundo-verde " ')  ?> >
		<td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?t='.$turma['TURMA_CDG'] ?>'><?php echo $turma['TURMA_CDG']; ?></a></td>
		<td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?t='.$turma['TURMA_CDG'] ?>'><?php echo $turma['TURMA_NOME']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?t='.$turma['TURMA_CDG'] ?>'><?php echo $turma['TURMA_ANO']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/alunos/lista_alunos.php?t='.$turma['TURMA_CDG'] ?>'><?php echo $turma['TURMA_PROFESSOR']; ?></a></td>                
                <td ><a href='<?php echo ROOT_URL.'control/admin/tools.php?t='.$turma['TURMA_CDG']
                                                .'&b='.($turma['TURMA_ATIVO'] == 0 ? '1' : '0' ) ?>'>
                        <?php echo ($turma['TURMA_ATIVO'] == 0 ? 'Desbloquear' : 'Bloquear' ) ?>
                    </a></td>
	</tr>



<?php } ?>
</table>


<a class="botao_azul"  href="<?php echo ROOT_URL; ?>control/admin/tools.php?b=0"> Bloquear Todos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<br><br><br>
<a class="botao_azul"  href="<?php echo ROOT_URL; ?>control/admin/tools.php?b=1"> Desbloquear Todos</a>
<br><br>    

<a href="javascript:history.go(-1);">
          <img class='botao_voltar' src='<?php echo ROOT_URL;?>view/img/voltar.png'/>
 </a>   

</form>
