            <div id="wrap">                		
                <!-- Feedback message zone -->
                <div id="message"></div>

                <div id="toolbar">
                    <input type="text" id="filtro-texto" class="filter" name="filter" placeholder="Pesquisar aluno"  />                       
                    
                    
                    <a id="showaddformbutton" class="button green posicao_right"><i class="fa fa-plus"></i>Turma</a>
                  
                </div> 
		<!-- Grid contents -->
		<div id="tablecontent"></div>
		<!-- Paginator control -->
		<div id="paginator"></div>                
                
            </div>
                        


            <script src="<?php echo ROOT_URL ?>t/js/editablegrid-2.1.0-b25.js"></script>   
            <script src="<?php echo ROOT_URL ?>t/js/editablegrid_renderers.js" ></script>
            <script src="<?php echo ROOT_URL ?>t/js/editablegrid_editors.js" ></script>
            <script src="<?php echo ROOT_URL ?>t/js/editablegrid_validators.js" ></script>
            <script src="<?php echo ROOT_URL ?>t/js/editablegrid_utils.js" ></script>
            <script src="<?php echo ROOT_URL ?>t/js/editablegrid_charts.js" ></script>
            
            <!-- EditableGrid test if jQuery UI is present. If present, a datepicker is automatically used for date type -->
            <script src="<?php echo ROOT_URL ?>view/js/jquery-ui.min.js"></script>
            
            <?php include_once ROOT."view/cadastros/turmas/vturma_grid.php"; ?>

            <script type="text/javascript">
	 
         
            
                
            var datagrid = new DatabaseGrid("TURMA");
		  window.onload = function() { 
                // key typed in the filter field
                $("#filtro-texto").keyup(function() {
                    datagrid.editableGrid.filter( $(this).val());
                    // To filter on some columns, you can set an array of column index 
                    //datagrid.editableGrid.filter( $(this).val(), [0,3,5]);
                });
                
                $("#filtro-turma").change(function() {                     
                    window.location = '<?php echo ROOT_URL ?>control/cadastros/alunos/lista_alunos.php?t='+$(this).val()+'&p='+$('#filtro-texto').val();
                });


                $("#showaddformbutton").click( function()  {
                  showAddForm();
                });
                
                $("#cancelbutton").click( function() {
                  showAddForm();
                });

                $("#addbutton").click(function() {
                  datagrid.addRow();
                });

        
			}; 
	    </script>

            <!-- simple form, used to add a new row -->
            <div id="addform">
                <div class="row">
                    <input type="text" id="campo-serie" name="campo-serie" placeholder="Série (Ex. 5)" />
                </div>
                <div class="row">
                    <input type="text" id="campo-letra" name="campo-letra" placeholder="Letra (Ex. A)" />
                </div>
                <div class="row">
                    <input type="text" id="campo-ano" name="campo-ano" placeholder="<?php echo $_SESSION['ANO_DE_CONSULTA'] ?>" />
                </div>
                <div class="row tright">
                  <a id="addbutton" class="button green" ><i class="fa fa-save"></i> Inserir</a>
                  <a id="cancelbutton" class="button delete">Cancelar</a>
                </div>
            </div>        
	</body>

</html>