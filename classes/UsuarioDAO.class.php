<?php
    require_once( dirname(__FILE__).'/autoload.php' );
    protegeArquivo( basename( __FILE__ ) );

    class UsuarioDAO extends DAO {
        function __construct($campos = array() ) {
            parent::__construct();
            $this->tabela = "tb_usuarios";
            if( sizeof( $campos ) <= 0 ) {
                $this->camposComValores = array( 
                                                  "int_id" => 0
                                                , "str_nome" => NULL
                                                , "str_email" => NULL
                                                , "str_login" => NULL
                                                , "str_senha" => NULL
                                                , "boo_ativo" => NULL
                                                , "boo_admin" => NULL
                                                , "time_datacad" => NULL
                                                , "img_avatar" => NULL
                                              );
            } else {
                $this->camposComValores = $campos;
            }
        }

        /**
         * Executa logIn no sistema.
         * @param objeto com os dados de login.
         * @return booleano com o resultado do login.
         */
        public function doLogin($objeto){
            if( isset( $objeto->camposComValores['str_login'] ) && isset( $objeto->camposComValores['str_senha'] ) ){
                $resultado = $this->selecionar("*" , $this->tabela, "WHERE str_login = '".$objeto->camposComValores['str_login']."' AND boo_ativo = 1" );
                $sessao = new Sessao();
                
                if($resultado){
                    if( $resultado[0]["str_senha"] == criptografar( $objeto->camposComValores['str_senha'] ) ){
                        $sessao->setVar('int_id', $resultado[0]['int_id']);
                        $sessao->setVar('str_nome', $resultado[0]['str_nome']);
                        $sessao->setVar('str_email', $resultado[0]['str_email']);
                        $sessao->setVar('str_login', $resultado[0]['str_login']);
                        $sessao->setVar('str_senha', $resultado[0]['str_senha']);
                        $sessao->setVar('boo_ativo', $resultado[0]['boo_ativo']);
                        $sessao->setVar('boo_admin', $resultado[0]['boo_admin']);
                        $sessao->setVar('time_datacad', $resultado[0]['time_datacad']);
                        $sessao->setVar('boo_logado', true);
                        $sessao->setVar('num_ip', $_SERVER['REMOTE_ADDR']); // inet_ntop(); // pesquisar depois
                        $sessao->setVar('img_avatar', (!empty($resultado[0]['img_avatar']) && file_exists($resultado[0]['img_avatar'])) ? BASEURL.$resultado[0]['img_avatar'] : BASEURL.'images/avatares/default_user.png' );
                        return true;
                    }else{
                        $sessao->destroy();
                        return false;
                    }
                }
            }
        }

        /**
         * Executa logOff do sistema.
         */
        public function doLogout(){
            $sessao = new Sessao();
            $sessao->destroy();
            header("location: ".BASEURL."?erro=1");
        }
    }
