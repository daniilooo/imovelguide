<?php

namespace rn;

require_once __DIR__ . '/../../vendor/autoload.php';

use models\Corretor;
use DAO\DaoCorretor;
use database\Conexao;
use Exception;

class RnCorretor{
    
    function inserirCorretor(Corretor $corretor){
        return (new DaoCorretor((new Conexao())->conectar()))->inserirCorretor($corretor);
    }

    function selecionarCorretor($idCorretor){
        return (new DaoCorretor((new Conexao())->conectar()))->selecionarCorretor($idCorretor);
    }

    function atualizarCorretor(Corretor $corretor){
        return (new DaoCorretor((new Conexao())->conectar()))->alterarCorretor($corretor);
    }

    function excluirCorretor(Corretor $corretor){
        return (new DaoCorretor((new Conexao())->conectar()))->excluirCorretor($corretor);
    }

    function listarCorretores(){
        return (new DaoCorretor((new Conexao())->conectar()))->listarCorretores();
    }
}
?>