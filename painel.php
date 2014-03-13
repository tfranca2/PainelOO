<?php 
require_once('header.php'); 

$permissao = new PermissaoDAO();

$sessao = new Sessao();
if( isset($_GET['m']) ) $modulo = $_GET['m'];
if( isset($_GET['t']) ) $tela = $_GET['t']; else $tela = '';
?>
<div id="content">
        
    <?php 
        if( isset($modulo) )
            loadModulo($modulo, $tela);
        else 
            echo '<h2>Bem-vindo!</h2>
            <div id="shell">
                <div id="user">
                    <img name="avatar" src="'.$sessao->getVar('img_avatar').'" />
                </div>
                <span id="lblFoto">'.$sessao->getVar('str_nome').'</span>
            </div>';
    ?>
                </div>
<?php require_once('sidebar.php'); ?>
<?php require_once('footer.php'); ?>