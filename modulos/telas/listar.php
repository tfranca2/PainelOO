<?php
require_once( dirname( dirname( dirname(__FILE__) ) )."/funcoes.php" );
protegeArquivo(basename(__FILE__));
?>

                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#listausers").dataTable({
                                "sScrollY": "340px",
                                "bPaginate": false,
                                "aaSorting": [[0, "asc"]],
                                "oLanguage": {
                                    "sProcessing":   "Processando...",
                                    "sLengthMenu":   "Mostrar _MENU_ registros",
                                    "sZeroRecords":  "Não foram encontrados resultados",
                                    "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                                    "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                                    "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
                                    "sInfoPostFix":  "",
                                    "sSearch":       "Buscar:",
                                    "sUrl":          "",
                                    "oPaginate": {
                                        "sFirst":    "Primeiro",
                                        "sPrevious": "Anterior",
                                        "sNext":     "Seguinte",
                                        "sLast":     "Último"
                                    }
                                }
                            });
                        });
                    </script>
                    <table class="display" id="listausers" >
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Login</th>
                                <th>Estado</th>
                                <th>Cadastro</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
<?php                       
                            $user = new UsuarioDAO();
                            $resultado = $user->selecionar("int_id, str_nome, str_email, str_login, boo_ativo, boo_admin, time_datacad", $user->tabela, '');
                            foreach($resultado as $contato){
                                echo "\t\t\t\t\t\t\t<tr>\n";
                                echo "\t\t\t\t\t\t\t\t<td> ".$contato['str_nome']." </td>\n";
                                echo "\t\t\t\t\t\t\t\t<td> ".$contato['str_email']." </td>\n";
                                echo "\t\t\t\t\t\t\t\t<td> ".$contato['str_login']." </td>\n";
                                echo "\t\t\t\t\t\t\t\t".'<td class="center"> '; 
                                    echo ($contato['boo_ativo'])?"Ativo":"Inativo"; 
                                    echo ($contato['boo_admin'])?"/Admin":" "; 
                                echo " </td>\n";
                                echo "\t\t\t\t\t\t\t\t".'<td class="center"> '.date("d/m/Y", strtotime($contato['time_datacad']))." </td>\n";
                                echo "\t\t\t\t\t\t\t\t".'<td class="center"> <a href="?m=usuarios&amp;t=listar&amp;acao=editar&amp;login='.$contato['str_login'].'"><img src="images/edit.png" title="Editar"></a> <a href="?m=usuarios&amp;t=listar&amp;acao=excluir&amp;login='.$contato['str_login'].'"><img src="images/delete.png" title="Excluir"></a> </td>'."\n";
                                echo "\t\t\t\t\t\t\t</tr>\n";
                            }
?>                          
                        </tbody>
                    </table>
