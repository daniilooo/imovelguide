<?php

namespace util;

class Alertas{    

    public static function salvarMensagem($mensagem){
        
        if(session_status() == PHP_SESSION_NONE){
            session_start(); 
        }

        $_SESSION['mensagemRetorno'] = $mensagem;
    }

    public static function mostrarMensagem(){

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if(isset($_SESSION['mensagemRetorno']) && !empty($_SESSION['mensagemRetorno'])){
            echo "<script>alert('".$_SESSION['mensagemRetorno']."')</script>";
            unset($_SESSION['mensagemRetorno']);
        }
    }

}

?>