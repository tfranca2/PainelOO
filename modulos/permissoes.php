<?php
require_once( dirname( dirname(__FILE__) )."/funcoes.php" );
require_once( dirname( dirname(__FILE__) )."/classes/UsuarioDAO.class.php" );
protegeArquivo(basename(__FILE__));

$sessao = new Sessao();
$usuarioComparativo = new UsuarioDAO();


insereArquivo('modulos/telas/permissoes.php');

// switch ($tela) {
//     case '':
        
//     break;
//     default: echo "\t\t\t\t".'<div class="alerta radius5">A tela solicitada não existe.</div>'."\n"; break;
// }