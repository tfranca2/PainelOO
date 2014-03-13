<?php
require_once( dirname( dirname( dirname(__FILE__) ) )."/funcoes.php" );
protegeArquivo(basename(__FILE__));
?>                    <script type="text/javascript">
                        $(document).ready(function(){
                            $(".userform").validate({
                                rules:{
                                     nome:{required:true, minlength:3}
                                    ,email:{required:true, email:true}
                                    ,login:{required:true, minlength:5}
                                    <?php 
                                    if(isset($_POST['permissaoAdm']))
                                        if( $_POST['permissaoAdm'] != true )
                                            echo ',senhaAtual:{required:true, rangelength:[4,40]}'."\n\t\t\t\t\t\t\t\t\t"; 
                                    ?>,senha:{rangelength:[4,40]}
                                    ,senhaconf:{equalTo:"#senha"}
                                }
                            });
                        });
                    </script>
                    <form class="userform" method="post" action="" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Informe os dados para alteração</legend>
                            <div id="shell">
                                <div class="inputFile">
                                    <img id="imgAvatar" src="<?php if( !empty($_POST['avatar'])) echo $_POST['avatar'];  ?>" />
                                    <input name="avatar" id="avatar" type="file" onchange="readURL(this);">
                                </div>
                                <span id="lblFoto">Sua foto</span>
                                <script type="text/javascript">
                                    function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                $('#imgAvatar')
                                                    .attr('src', e.target.result)
                                                    .width(150)
                                                    .height(150);
                                            };
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>
                            </div>
                            <ul>
                                <li> 
                                    <label>Nome:</label> 
                                    <input type="text" size="50" name="nome" autofocus="autofocus" value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" /> 
                                </li>
                                <li> 
                                    <label>Email:</label> 
                                    <input type="text" size="50" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" /> 
                                </li>
                                <li> 
                                    <label>Login:</label> 
                                    <input type="text" size="50" name="login" disabled="disabled" value="<?php if(isset($_POST['login'])) echo $_POST['login']; ?>" /> 
                                </li>
                                <li> 
                                    <label>Senha atual:</label> 
                                    <input type="password" size="50" name="senhaAtual" placeholder="Senha atual" /> 
                                </li>
                                <li> 
                                    <label>Nova senha:</label> 
                                    <input type="password" size="50" name="senha" id="senha" placeholder="Nova senha" /> 
                                </li>
                                <li> 
                                    <label>Repita a senha:</label> 
                                    <input type="password" size="50" name="senhaconf" placeholder="Repita a nova senha" /> 
                                </li>
                                <li> 
                                    <label>Ativo:</label>
                                        <input type="checkbox" name="ativo" <?php if(isset($_POST['ativo'])) if($_POST['ativo']==1) echo 'checked="checked"'; ?> /> 
                                </li>
                                <li> 
                                    <label>Administrador:</label> 
                                    <label style="float: none;" > 
                                        <input type="checkbox" name="adm" <?php
                                                 if(isset($_POST['permissaoAdm'])){
                                                     if( $_POST['permissaoAdm'] != true )
                                                         echo 'disabled="disabled"';
                                                 } else echo 'disabled="disabled"';
                                                 if(isset($_POST['adm']))
                                                      if($_POST['adm'] == 1)
                                                         echo 'checked="checked"'; 
                                                 ?> /> 
                                        dar o controle total ao usuário
                                    </label> 
                                </li>
                                <li class="center">
                                    <input type="button" onclick="location.href='?m=usuarios&t=listar'" value="Cancelar" /> 
                                    <input type="submit" name="editar" value="Salvar" /> 
                                </li>
                            </ul>
                        </fieldset>
                    </form>
