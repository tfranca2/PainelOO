<?php 
require_once( dirname( dirname( dirname(__FILE__) ) )."/funcoes.php" );
protegeArquivo(basename(__FILE__));
?>

                    <script type="text/javascript">
                        $(document).ready(function(){
                            $("#permissoes").dataTable({
                                "sScrollY": "340px",
                                "bPaginate": false,
                                "aaSorting": [[0, "asc"]],
                                "oLanguage": {
                                    "sProcessing":   "Processando...",
                                    "sLengthMenu":   "Mostrar _MENU_ registros",
                                    "sZeroRecords":  "N�o foram encontrados resultados",
                                    "sInfo":         "Mostrando de _START_ at� _END_ de _TOTAL_ registros",
                                    "sInfoEmpty":    "Mostrando de 0 at� 0 de 0 registros",
                                    "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
                                    "sInfoPostFix":  "",
                                    "sSearch":       "Buscar:",
                                    "sUrl":          "",
                                    "oPaginate": {
                                        "sFirst":    "Primeiro",
                                        "sPrevious": "Anterior",
                                        "sNext":     "Seguinte",
                                        "sLast":     "�ltimo"
                                    }
                                }
                            });
                        });
                    </script>
                    <fieldset>
                        <legend>Cadastrar permissoes dos usu�rios</legend>
                        <form >
                                    <label>Usu�rio
                                        <select name="usuario" >
                                            <option value="" >  </option>
                                        </select>
                                    </label>
                                    <label>M�dulo
                                        <select name="modulo" >
                                            <option value="" >  </option>
                                        </select>
                                    </label>
                                    <label>Permiss�o
                                        <select name="permissao" >
                                            <option></option>
                                            <option value="listar" > Listar </option>
                                            <option value="incluir" > Incluir </option>
                                            <option value="editar" > Editar </option>
                                            <option value="excluir" > Excluir </option>
                                        </select>
                                    </label>
                                    <input type="submit" value="Enviar" />
                        </form>
                    </fieldset>
                    
                    <br />
                    
                    <table class="display" id="permissoes" >
                        <thead>
                            <tr>
                                <th> Usu�rio </th>
                                <th> M�dulo </th>
                                <th> Permiss�o </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                            </tr>
                        </tbody>
                    </table>
