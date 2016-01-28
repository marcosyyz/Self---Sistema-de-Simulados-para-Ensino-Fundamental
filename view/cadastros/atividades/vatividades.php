<form action="<?php echo $action_pesquisa ; ?>"  method="POST">      
<?php include ROOT.'view/inc/pesquisar.php'; ?>

<p class="centro branco titulo"> ► lista de Atividades ► </p>
<table cellpadding="2" cellspacing="2">
	<tr>
		<td class='cabecalho_table'><strong>Código</strong></th>
		<td class='cabecalho_table'><strong>Nome</strong></th>
                <td class='cabecalho_table'><strong>Série</strong></th>
                <td class='cabecalho_table'><strong>Ordem</strong></th>		
                <td class='cabecalho_table'><strong>Nível</strong></th>
                <td class='cabecalho_table'><strong>Detalhes</strong></th>
                <td class='cabecalho_table'><strong>Qtd Questoes</strong></th>
        </tr>
        
<?php foreach($atividades as $atividade ){ ?>    
        
        <tr>		
		<td ><a href='<?php echo ROOT_URL.'control/cadastros/atividades/edit_atividade.php?a='.$atividade['ATIVIDADE_CDG'] ?>'><?php echo $atividade['ATIVIDADE_CDG']; ?></a></td>
		<td ><a href='<?php echo ROOT_URL.'control/cadastros/atividades/edit_atividade.php?a='.$atividade['ATIVIDADE_CDG'] ?>'><?php echo $atividade['ATIVIDADE_NOME']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/atividades/edit_atividade.php?a='.$atividade['ATIVIDADE_CDG'] ?>'><?php echo $atividade['ATIVIDADE_SERIE']; ?></a></td>                
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/atividades/edit_atividade.php?a='.$atividade['ATIVIDADE_CDG'] ?>'><?php echo $atividade['ATIVIDADE_ORDEM']; ?></a></td>
                
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/atividades/edit_atividade.php?a='.$atividade['ATIVIDADE_CDG'] ?>'><?php echo $atividade['ATIVIDADE_NIVEL']; ?></a></td>                
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/atividades/edit_atividade.php?a='.$atividade['ATIVIDADE_CDG'] ?>'><?php echo $atividade['ATIVIDADE_DESC']; ?></a></td>
<td ><a href='<?php echo ROOT_URL.'control/cadastros/atividades/edit_atividade.php?a='.$atividade['ATIVIDADE_CDG'] ?>'><?php echo $atividade['QTD_QUESTOES']; ?></a></td>                
	</tr>



<?php } ?>
</table>
</form>