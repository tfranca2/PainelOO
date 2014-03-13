<?php
require_once( dirname(__FILE__).'/autoload.php' );
protegeArquivo( basename( __FILE__ ) );

class PermissaoDAO extends DAO {
    function __construct() {
        parent::__construct();
        $this->tabela = "tb_permissoes";
    }

    /** 
     * Diz se o usuario tem a permissao para acessar o modulo do sistema.
     * @param Objeto usuario.
     * @param O modulo pretendido.
     * @return Booleano se possui a permissao.
     */
    public function temPermissao( UsuarioDAO $usuario, $modulo ){
        $id = $usuario->camposComValores['int_id'];
        $resultado = $this->selecionar('str_permissao', $this->tabela, "WHERE int_usuario_id = ".$id);
        
        foreach($resultado as $campo => $valor) {
            if( $valor[0] == $modulo )
                return true;
            else 
                continue;
        }
        return false;
    }

    /** 
     * Faz o acesso do usuario à tela solicitada
     * @param a permissao desejada
     * @param a tela que será acessada se a permissão permiitir
     */
    public function acesso( $permissao, $telaSolicitada ){
        if( $permissao!=null && $telaSolicitada!=null ){
            $permissao = strtoupper($permissao);
            $sessao = new Sessao();
            $user = new UsuarioDAO( array( 'int_id' => $sessao->getVar('int_id') ) );
            if( $this->temPermissao( $user , $permissao) != true )
                echo "\t\t\t\t".'<div class="alerta radius5">Você não tem permissão de acessar a tela solicitada!</div>'."\n";
            else
                insereArquivo($telaSolicitada);
        }
    }
}