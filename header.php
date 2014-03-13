<?php 
    require_once("funcoes.php");
    protegeArquivo(basename( __FILE__ ) );
    verificaLogin();
?><!doctype html>
<html>
    <head>
        <title> Painel Administrativo </title>
         <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php 
        loadCss("reset", "screen"); 
        loadCss("style", "screen"); 
        loadCss('jquery.dataTables', "screen");
        loadJs("jquery-1.8.3");
        loadJs("jquery.validate.min");
        loadJs("messages_pt_BR");
        loadJs("jquery.dataTables.min");
        loadJs("geral");
?>
    </head>
    <body class="painel">
        <div id="wrapper">
            <div id="header">
                <h1>Painel de administração</h1>
            </div>
            <div id="wrap-content">
                