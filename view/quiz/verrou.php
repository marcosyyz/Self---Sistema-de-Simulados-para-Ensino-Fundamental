<?php

function mostrar_animacao_de_erro($p_tipo_proxima_questao,$p_proxima_questao){
     ?>
        </head>
        <body class="bg-Parallax">
        
        <div id="fundo-escuro"></div>
        <div id="negativo" > </div>
        </body>
        </html>
        <script>
        
            var alturaTela = $(document).height();
            var larguraTela = $(window).width();
                //colocando o fundo preto
            $('#fundo-escuro').css({'width':larguraTela,'height':alturaTela});
          //  $('#fundo-escuro').fadeIn(200); 
            $('#fundo-escuro').fadeTo(200,0.8, function(){
                    $("#negativo").html("<img src='<?php echo ROOT_URL; ?>view/img/negativo.gif'>");
            });


            $('#negativo').css({'top':($(window).height() / 3) ,
                                'left':($(window).width() /2) - ( $('#negativo').width() / 2 )});
            $('#negativo').show();



            $('#fundo-escuro, #negativo').click(function(){            
                <?php avancar($p_tipo_proxima_questao,$p_proxima_questao);  ?>
            });        
        </script>
    <?php
    
}
