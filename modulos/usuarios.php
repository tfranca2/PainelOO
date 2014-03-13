<?php
require_once( dirname( dirname(__FILE__) )."/funcoes.php" );
require_once( dirname( dirname(__FILE__) )."/classes/UsuarioDAO.class.php" );
protegeArquivo(basename(__FILE__));

$sessao = new Sessao();
$usuarioComparativo = new UsuarioDAO();
$permissao = new PermissaoDAO();

switch ($tela) {
    case 'login':
        if(    $sessao->getNvars() > 0 
            && $sessao->getVar('boo_logado') == 1 
           // && $sessao->getVar('num_ip') == $_SERVER['REMOTE_ADDR'] 
          )
            header("location: ".BASEURL."painel.php");
        elseif( isset( $_POST['logar'] ) ){
            $usuario = new UsuarioDAO( array(
                                              "str_login" => $_POST['usuario']
                                            , "str_senha" => $_POST['senha']
                                          )
                                   );
             if( $usuario->doLogin($usuario) )
                 header("location: ".BASEURL."painel.php");
             else 
                 header("location: ".BASEURL."?erro=2");
        }
        
        insereArquivo('modulos/telas/login.php');
    break;
    case 'incluir':
        echo "\t\t\t\t".'<h2>Cadastro de usuários</h2>'."\n";
        if( isset($_POST['cadastrar']) ){
            
            $img = new ImageUploader("images/avatares", 100, 100);
            
            $usuario = new UsuarioDAO(array(
                    'str_nome'=>$_POST['nome'],
                    'str_email'=>$_POST['email'],
                    'str_login'=>$_POST['login'],
                    'str_senha'=>criptografar($_POST['senha']),
                    'boo_ativo'=>(@$_POST['ativo'] == 'on')?'1':'0',
                    'boo_admin'=>(@$_POST['adm'] == 'on')?'1':'0',
                    'img_avatar'=> $img->caminho
            ));
            $duplicado = false;
            if( $usuario->existeRegistro('str_login', $_POST['login']) ){
                echo "\t\t\t\t".'<div class="erro radius5">Nome de ususario já cadastrado!</div>'."\n";
                $duplicado = true;
            }
            if( $usuario->existeRegistro('str_email', $_POST['email']) ){
                echo "\t\t\t\t".'<div class="erro radius5">Email já cadastrado!</div>'."\n";
                $duplicado = true;
            }
            if(!$duplicado && !$img->getErro()){
                if($usuario->inserir($usuario)){
                    echo "\t\t\t\t".'<div class="sucesso radius5">Dados inseridos com sucesso!</div>'."\n";
                    echo "\t\t\t\t".'<form action=""> <ul> <li class="center"> <input onclick="location.href=\'?m=usuarios&t=listar\'" type="button" value="Listar Usuários"/> </li> </ul> </form>'."\n";
                    unset($_POST);
                }
            }else 
                echo "\t\t\t\t".'<div class="alerta radius5">Confira os dados enviados!</div>'."\n";
        }
        $resultado = $usuarioComparativo->selecionar('boo_admin', $usuarioComparativo->tabela, "WHERE int_id=".$sessao->getVar('int_id'));
        $_POST['permissaoAdm'] = $resultado[0]['boo_admin'];
        
        $permissao->acesso('CADASTRAR USUARIO', 'modulos/telas/incluir.php');
    break;
    case 'listar': 
        echo "\t\t\t\t".'<h2>Usuários cadastrados</h2>'."\n";
        if( !empty($_GET['acao']) && !empty($_GET['login']) ){
            if($_GET['acao']=='editar' || $_GET['acao']=='excluir'){
                $resultado = $usuarioComparativo->selecionar("int_id", $usuarioComparativo->tabela, "WHERE str_login='".$_GET['login']."';");
                $sessao->setVar("idResultado", $resultado[0]['int_id']);
                header("location:?m=usuarios&t=".$_GET['acao']);
            }
        }else{
            $permissao->acesso('LISTAR USUARIO', 'modulos/telas/listar.php');
            $sessao->unsetVar("idResultado");
        }
    break;
    case 'editar':
        echo "\t\t\t\t".'<h2>Edição de usuários</h2>'."\n";
        if(isset($_POST['editar'])){
            
            $img = new ImageUploader("images/avatares", 100, 100);
            
            $usuario = new UsuarioDAO(array(
                        'int_id'=>$sessao->getVar("idResultado"),
                        'str_nome'=>$_POST['nome'],
                        'str_email'=>$_POST['email'],
                        'boo_ativo'=>(@$_POST['ativo'] == 'on')?'1':'0',
                        'boo_admin'=>(@$_POST['adm'] == 'on')?'1':'0',
                        'img_avatar'=>$img->caminho
                    ));
                $resultado = $usuarioComparativo->selecionar("str_senha, str_email, img_avatar", $usuarioComparativo->tabela, "WHERE int_id=".$sessao->getVar("idResultado"));
                if(!empty($_POST['senha'])){
                    if(  ($sessao->getVar("boo_admin")) && ( $resultado[0]['str_senha'] != criptografar($_POST['senha']) ) )
                            $usuario->addCampo('str_senha', criptografar($_POST['senha']) );
                    else
                        if( $resultado[0]['str_senha'] == criptografar($_POST['senhaAtual']) && $resultado[0]['str_senha'] != criptografar($_POST['senha']) )
                            $usuario->addCampo('str_senha', criptografar($_POST['senha']) );
                }
                $duplicado = false;
                if($resultado[0]['str_email'] != $_POST['email']){
                    if($usuarioComparativo->existeRegistro('str_email', $_POST['email'])){
                        echo "\t\t\t\t".'<div class="erro radius5">Email já cadastrado!</div>'."\n";
                        $duplicado = true;
                    }
                }
                if(!empty($img->caminho) && file_exists($img->caminho)){
                    if( !strpos($img->caminho, 'default_user.png') ){
                        if(!empty($resultado[0]['img_avatar']) && file_exists($resultado[0]['img_avatar'])){
                            if( !strpos($resultado[0]['img_avatar'], 'default_user.png') ){
                                chmod('images/avatares/', 0777);
                                unlink( 'images/avatares/'.basename($resultado[0]['img_avatar']) );
                            }
                        }
                    }
                }
                if(!$duplicado && !$img->getErro()){
                    if($usuario->editar($usuario)){
                        echo "\t\t\t\t".'<div class="sucesso radius5">Dados alterados com sucesso!</div>'."\n";
                        echo "\t\t\t\t".'<form action=""> <ul> <li class="center"> <input onclick="location.href=\'?m=usuarios&t=listar\'" type="button" value="Listar Usuários"/> </li> </ul> </form>'."\n";
                        $sessao->unsetVar("idResultado");
                        unset($_POST);
                    }else {
                        echo '<div class="alerta radius5">Nenhum dado do usuário foi editado!</div>';
                        echo "\t\t\t\t".'<form action=""> <ul> <li class="center"> <input onclick="location.href=\'?m=usuarios&t=listar\'" type="button" value="Listar Usuários"/> </li> </ul> </form>'."\n";
                    }
                }
        } else {
            $id = $sessao->getVar("idResultado");
            if(!empty($id)){
                if( $usuarioComparativo->existeRegistro('int_id', $id) ){
                    if($sessao->getVar('boo_admin') || $sessao->getVar('int_id') == $id ){
                        $resultado = $usuarioComparativo->selecionar("*", $usuarioComparativo->tabela, "WHERE int_id=".$id);
                        $_POST['id'] = $id;
                        $_POST['nome'] = $resultado[0]['str_nome'];
                        $_POST['email'] = $resultado[0]['str_email'];
                        $_POST['login'] = $resultado[0]['str_login'];
                        $_POST['senha'] = $resultado[0]['str_senha'];
                        $_POST['ativo'] = $resultado[0]['boo_ativo'];
                        $_POST['adm'] = $resultado[0]['boo_admin'];
                        $_POST['avatar'] = (!empty($resultado[0]['img_avatar']) && file_exists($resultado[0]['img_avatar']))?BASEURL.$resultado[0]['img_avatar']:BASEURL.'images/avatares/default_user.png'; 
                        $_POST['permissaoAdm'] = $sessao->getVar('boo_admin');
                        
                        $permissao->acesso('EDITAR USUARIO', 'modulos/telas/editar.php');
                        
                    } else {
                        echo '<div class="erro radius5">Você não tem permissão para alterar este usuário!</div>';
                        echo "\t\t\t\t".'<form action=""> <ul> <li class="center"> <input onclick="location.href=\'?m=usuarios&t=listar\'" type="button" value="Listar Usuários"/> </li> </ul> </form>'."\n";
                    }
                } else {
                    echo '<div class="erro radius5">Usuário não encontrado!</div>';
                    echo "\t\t\t\t".'<form action=""> <ul> <li class="center"> <input onclick="location.href=\'?m=usuarios&t=listar\'" type="button" value="Listar Usuários"/> </li> </ul> </form>'."\n";
                }
            } else {
                echo '<div class="erro radius5">Usuário não identificado!</div>';
                echo "\t\t\t\t".'<form action=""> <ul> <li class="center"> <input onclick="location.href=\'?m=usuarios&t=listar\'" type="button" value="Listar Usuários"/> </li> </ul> </form>'."\n";
            }
        }
    break;
    case 'excluir':
        echo "\t\t\t\t".'<h2>Exclusão de usuário</h2>'."\n";
        if(isset($_POST['excluir'])){
            $usuario = new UsuarioDAO(array(
                    'int_id'=>$sessao->getVar("idResultado"),
            ));
            
            if($usuario->deletar($usuario)){
                if( !strpos($_POST['avatar'], 'default_user.png') ){
                    chmod('images/avatares/', 0777);
                    unlink( 'images/avatares/'.basename($_POST['avatar']) );
                }
                $sessao->unsetVar("idResultado");
                unset($_POST);
                echo "\t\t\t\t".'<div class="sucesso radius5">Registro excluído com sucesso!</div>'."\n";
                echo "\t\t\t\t".'<form action=""> <ul> <li class="center"> <input onclick="location.href=\'?m=usuarios&t=listar\'" type="button" value="Listar Usuários"/> </li> </ul> </form>'."\n";
            }
        } else {
            $id = $sessao->getVar("idResultado");
            if( !empty($id)){
                if( $usuarioComparativo->existeRegistro('int_id', $id) ){
                    if($sessao->getVar('boo_admin') || $sessao->getVar('int_id') == $id ){
                        $resultado = $usuarioComparativo->selecionar("*", $usuarioComparativo->tabela, "WHERE int_id=".$id);
                        $_POST['id'] = $id;
                        $_POST['nome'] = $resultado[0]['str_nome'];
                        $_POST['email'] = $resultado[0]['str_email'];
                        $_POST['login'] = $resultado[0]['str_login'];
                        $_POST['senha'] = $resultado[0]['str_senha'];
                        $_POST['ativo'] = $resultado[0]['boo_ativo'];
                        $_POST['adm'] = $resultado[0]['boo_admin'];
                        $_POST['avatar'] = (!empty($resultado[0]['img_avatar']) && file_exists($resultado[0]['img_avatar']))?BASEURL.$resultado[0]['img_avatar']:BASEURL.'images/avatares/default_user.png';
                        
                        $permissao->acesso('DELETAR USUARIO', 'modulos/telas/excluir.php');
                        
                    } else {
                        echo'<div class="erro radius5">Você não tem permissão para excluir este usuário!</div>';
                        echo "\t\t\t\t".'<form action=""> <ul> <li class="center"> <input onclick="location.href=\'?m=usuarios&t=listar\'" type="button" value="Listar Usuários"/> </li> </ul> </form>'."\n";
                    }
                } else {
                    echo '<div class="erro radius5">Usuário não encontrado!</div>';
                    echo "\t\t\t\t".'<form action=""> <ul> <li class="center"> <input onclick="location.href=\'?m=usuarios&t=listar\'" type="button" value="Listar Usuários"/> </li> </ul> </form>'."\n";
                }
            } else {
                echo '<div class="erro radius5">Usuário não identificado!</div>';
                echo "\t\t\t\t".'<form action=""> <ul> <li class="center"> <input onclick="location.href=\'?m=usuarios&t=listar\'" type="button" value="Listar Usuários"/> </li> </ul> </form>'."\n";
            }
        }
    break;
    default: echo "\t\t\t\t".'<div class="alerta radius5">A tela solicitada não existe.</div>'."\n"; break;
}