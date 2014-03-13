<?php
require_once( dirname( dirname( dirname(__FILE__) ) )."/funcoes.php" );
protegeArquivo(basename(__FILE__));
?>                    <form class="userform" method="post" action="" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Comfirme os dados para exclusão</legend>
                            <div id="shell">
                                <div class="inputFile disabled">
                                    <img id="imgAvatar" src="<?php if( !empty($_POST['avatar'])) echo $_POST['avatar'];  ?>" />
                                    <input type="hidden" name="avatar" value="<?php if( !empty($_POST['avatar'])) echo $_POST['avatar'];  ?>" />
                                </div>
                                <span id="lblFoto">Sua foto</span>
                            </div>
                            <ul>
                                <li> 
                                    <label>Nome:</label> 
                                    <input type="text" size="50" name="nome" disabled="disabled" value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" /> 
                                </li>
                                <li> 
                                    <label>Email:</label> 
                                    <input type="text" size="50" name="email" disabled="disabled" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" /> 
                                </li>
                                <li> 
                                    <label>Login:</label> 
                                    <input type="text" size="50" name="login" disabled="disabled" value="<?php if(isset($_POST['login'])) echo $_POST['login']; ?>" /> 
                                </li>
                                <li> 
                                    <label>Ativo:</label>
                                        <input type="checkbox" name="ativo" disabled="disabled" <?php if(isset($_POST['ativo'])) if($_POST['ativo']==1) echo 'checked="checked"'; ?> /> 
                                </li>
                                <li> 
                                    <label>Administrador:</label> 
                                    <label style="float: none;" > 
                                        <input type="checkbox" name="adm" disabled="disabled" <?php if(isset($_POST['adm'])) if($_POST['adm'] == 1) echo 'checked="checked"'; ?> /> 
                                    </label> 
                                </li>
                                <li class="center">
                                    <input type="button" onclick="location.href='?m=usuarios&t=listar'" value="Cancelar" /> 
                                    <input type="submit" name="excluir" value="Excluir" /> 
                                </li>
                            </ul>
                        </fieldset>
                    </form>