

<p class="centro branco titulo"> ► Turmas ► <br> <?php echo $Escola->getNome($_SESSION['ESCOLA']) ?> </p>
<table cellpadding="2" cellspacing="2">
	<tr>
		<td class='cabecalho_table'><strong>Código</strong></th>
		<td class='cabecalho_table'><strong>Nome</strong></th>                
                <td class='cabecalho_table'><strong>Ano</strong></th>
                <td class='cabecalho_table'><strong>Prof</strong></th>
        </tr>
        
<?php foreach($turmas as $t ){ ?>    
        
        <tr>		
		<td ><a href='<?php echo ROOT_URL.'control/cadastros/turmas/edit_turma.php?t='.$t['TURMA_CDG'] ?>'><?php echo $t['TURMA_CDG']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/turmas/edit_turma.php?t='.$t['TURMA_CDG'] ?>'><?php echo $t['TURMA_NOME']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/turmas/edit_turma.php?t='.$t['TURMA_CDG'] ?>'><?php echo $t['TURMA_ANO']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/turmas/edit_turma.php?t='.$t['TURMA_CDG'] ?>'><?php echo $t['TURMA_PROFESSOR']; ?></a></td>
	</tr>



<?php } ?>
</table>
