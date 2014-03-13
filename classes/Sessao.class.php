<?php
require_once( dirname(__FILE__).'/autoload.php' );
protegeArquivo( basename( __FILE__ ) );

class Sessao {
    protected $id;
    protected $nvars;

    public function __construct() {
        $this->start();
    }

    /**  */
    private function start() {
        if( !isset( $_SESSION ) ){
            $tempoDeSessao = 30*60;//segundos
            session_start();
            
            if( @$_SESSION["sessiontime"] ) {
                if( $_SESSION["sessiontime"] < (time()-$tempoDeSessao) )
                    session_unset();
            } else 
                session_unset();
            
            $_SESSION["sessiontime"] = time();
            
            $this->id = session_id();
            $this->setNvars();
        }
    }

    /**  */
    private function setNvars() {
        $this->nvars = sizeof($_SESSION);
    }

    /**  */
    public function getNvars() {
        return $this->nvars;
    }

    /**  */
    public function setVar($var, $valor) {
        $_SESSION[$var] = $valor;
        $this->setNvars();
    }

    /**  */
    public function unsetVar($var) {
        unset($_SESSION[$var]);
        $this->setNvars();
    }

    /**  */
    public function getVar($var) {
        if( isset($_SESSION[$var]) )
            return $_SESSION[$var];
        else
            return null;
    }

    /**  */
    public function destroy() {
        session_destroy();
        session_unset();
        $this->setNvars();
    }
}