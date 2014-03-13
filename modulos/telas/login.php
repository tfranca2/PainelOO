<?php 
require_once( dirname( dirname( dirname(__FILE__) ) )."/funcoes.php" );
protegeArquivo(basename(__FILE__));
?>
<script type="text/javascript">
            $(document).ready(function(){
                $(".userform").validate({
                    rules:{
                        usuario:{required:true, minlength:4},
                        senha:{required:true, rangelength:[4,10]}
                    }
                });
            });
        </script>
        <div id="loginform">
            <form class="userform" method="post" action="">
                <fieldset>
                    <legend>Acesso restrito, identifique-se</legend>
                    <ul>
                        <li>
                            <label for="usuario">Usuario:</label>
                            <input type="text" size="35" name="usuario" autofocus="autofocus" />
                        </li>
                        <li>
                            <label for="senha">Senha:</label>
                            <input type="password" size="35" name="senha" />
                        </li>
                        <li class="center">
                            <input type="submit" name="logar" value="login" />
                        </li>
                    </ul>
                    <?php $erro = @$_GET['erro'];
                            switch ($erro) {
                                case '1': echo '<div class="sucesso">Você fez logoff do sistema.</div>';
                                break;
                                case '2': echo '<div class="erro">Dados incorretos ou usuário inválido.</div>';
                                break;
                                case '3': echo '<div class="erro">Faça login antes de acessar a página solicitada.</div>';
                                break;
                            } 
                    ?>
                </fieldset>
            </form>
        </div>