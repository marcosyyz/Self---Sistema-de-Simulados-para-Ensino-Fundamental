

<p class="centro branco titulo"> ► Usuários ► <br> <?php echo $Escola->getNome($_SESSION['ESCOLA']) ?> </p>
<table cellpadding="2" cellspacing="2">
	<tr>
		<td class='cabecalho_table'><strong>Código</strong></th>
		<td class='cabecalho_table'><strong>Nome</strong></th>                
                <td class='cabecalho_table'><strong>Login</strong></th>
                <td class='cabecalho_table'><strong>Cargo</strong></th>
        </tr>
        
<?php foreach($usuarios as $t ){ ?>    
        
        <tr>		
		<td ><a href='<?php echo ROOT_URL.'control/cadastros/usuarios/edit_usuario.php?u='.$t['USUARIO_CDG'] ?>'><?php echo $t['USUARIO_CDG']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/usuarios/edit_usuario.php?u='.$t['USUARIO_CDG'] ?>'><?php echo $t['USUARIO_NOME']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/usuarios/edit_usuario.php?u='.$t['USUARIO_CDG'] ?>'><?php echo $t['USUARIO_LOGIN']; ?></a></td>
                <td ><a href='<?php echo ROOT_URL.'control/cadastros/usuarios/edit_usuario.php?u='.$t['USUARIO_CDG'] ?>'><?php echo $t['USUARIO_CARGO']; ?></a></td>
	</tr>



<?php } ?>
</table>
