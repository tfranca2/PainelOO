<?php require_once("funcoes.php"); ?>
<!doctype html>
<html>
    <head>
        <title> Painel Administrativo </title>
         <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php 
        loadCss("reset", "screen"); 
        loadCss("style", "screen"); 
        loadJs("jquery-1.8.3", true);
        loadJs("jquery.validate.min", false);
        loadJs("messages_pt_BR", false);
        loadJs("geral", true);
?>
    </head>
    <body>
        <?php loadModulo("usuarios", "login"); ?>
    </body>
</html>