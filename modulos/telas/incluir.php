<?php 
require_once( dirname( dirname( dirname(__FILE__) ) )."/funcoes.php" );
protegeArquivo(basename(__FILE__));
?>                    <script type="text/javascript">
                        $(document).ready(function(){
                            $(".userform").validate({
                                rules:{
                                    nome:{required:true, minlength:3},
                                    email:{required:true, email:true},
                                    login:{required:true, minlength:4},
                                    senha:{required:true, rangelength:[4,10]},
                                    senhaconf:{required:true, equalTo:"#senha"}
                                }
                            });
                        });
                    </script>
                    <form class="userform" method="post" action="" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Informe os dados para cadastro</legend>
                            <div id="shell">
                                 <div class="inputFile">
                                    <img id="imgAvatar" src="images/avatares/default_user.png" />
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
                                    <input type="text" size="50" name="nome" autofocus="autofocus" /> 
                                </li>
                                <li> 
                                    <label>Email:</label> 
                                    <input type="text" size="50" name="email" /> 
                                </li>
                                <li> 
                                    <label>Login:</label> 
                                    <input type="text" size="50" name="login" /> 
                                </li>
                                <li> 
                                    <label>Senha:</label> 
                                    <input type="password" size="50" name="senha" id="senha" /> 
                                </li>
                                <li> 
                                    <label>Repita a senha:</label> 
                                    <input type="password" size="50" name="senhaconf" /> 
                                </li>
                                <li> 
                                    <label>Ativo:</label>
                                        <input type="checkbox" name="ativo" checked="checked" /> 
                                </li>
                                <li> 
                                    <label>Administrador:</label> 
                                    <label style="float: none;" > <input type="checkbox" name="adm" <?php if(isset($_POST['permissaoAdm'])) if( $_POST['permissaoAdm'] != true ) echo 'disabled="disabled"'; ?> /> dar o controle total ao usuário </label> 
                                </li>
                                <li class="center"> 
                                    <input type="button" onclick="location.href='?m=usuarios&t=listar'" value="Cancelar" /> 
                                    <input type="submit" name="cadastrar" value="Salvar" /> 
                                </li>
                            </ul>
                        </fieldset>
                    </form>
