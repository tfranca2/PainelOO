<?php 
    require_once("funcoes.php");
    protegeArquivo(basename( __FILE__ ) );
?>
            <div id="sidebar">
                <ul id="accordion">
                    <li><a href="<?php echo BASEURL."painel.php"; ?>">In�cio</a></li>
                    
                    <li class="separador"> </li>
                    
                    <li><a class="item" href="#">Usu�rios ...</a>
                        <ul>
                            <li><a href="?m=usuarios&amp;t=incluir">Novo Usu�rio</a></li>
                            <li><a href="?m=usuarios&amp;t=listar">Exibir Usu�rios</a></li>
                        </ul>
                    </li>
                    <li><a class="item" href="#">Permiss�es ...</a>
                        <ul>
                            <li><a href="?m=permissoes&amp;t=incluir">Cadastrar Permiss�es</a></li>
                            <li><a href="?m=permissoes&amp;t=listar">Permiss�es dos Usu�rios</a></li>
                        </ul>
                    </li>
                    
                    <li class="separador"> </li>
                    
                    <li><a href="?m=caixa">Caixa</a></li>
                    <li><a href="?m=venda">Venda</a></li>
                    <li><a class="item" href="#">Agenda ...</a>
                        <ul>
                            <li><a href="?m=agendamentos&amp;t=incluir">Agendar Tarefa</a></li>
                            <li><a href="?m=agendamentos&amp;t=listar">Ver Agendados</a></li>
                        </ul>
                    </li>
                    <li><a class="item" href="#">Cadastar ...</a>
                        <ul>
                            <li><a href="?m=cadastro&amp;t=clientes">Clientes</a></li>
                            <li><a href="?m=cadastro&amp;t=produtos">Produtos</a></li>
                            <li><a href="?m=cadastro&amp;t=funcionarios">Funcion�rios</a></li>
                        </ul>
                    </li>
                    <li><a href="?m=producao">Produ��o</a></li>
                    <li><a href="?m=estoque">Estoque</a></li>
                    <li><a href="?m=relatorios">Relat�rios</a></li>
                    
                    <li class="separador"> </li>
                    
                    <li><a href="?logoff=true">Sair</a></li>
                </ul>
            </div>
