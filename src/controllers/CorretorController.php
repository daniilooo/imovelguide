<?php

namespace controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use models\Corretor;
use rn\RnCorretor;
use util\Alertas;

class CorretorController{
    private $rnCorretor;
    
    function __construct($rnCorretor){   
        $this->rnCorretor = $rnCorretor;
    }

    function index(){

        $listaCorretores = $this->rnCorretor->listarCorretores();

        //var_dump($listaCorretores);

        require_once __DIR__ .'/../views/cadastrocorretores.php';
    }

    function inserirCorretor(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            if(isset($_POST['nome'], $_POST['cpf'], $_POST['creci'])){
                $corretor = new Corretor(null, $_POST['nome'], $_POST['cpf'], $_POST['creci']);

                $corretorCadastrado = $this->rnCorretor->inserirCorretor($corretor);

                if($corretorCadastrado != null){
                    Alertas::salvarMensagem("Corretor ".$corretorCadastrado->getNomeCorretor()." cadastrado com sucesso.");                   
                } else {
                    Alertas::salvarMensagem("Não foi possível cadatrar o corretor na base de dados.");
                }

            } else {
                Alertas::salvarMensagem("Preencha todos os campos.");
            }
        } else {
            Alertas::salvarMensagem("Tipo de requisição não suportada pelo sistema");
        }

        
        header("Location: /imovelguide/corretores");
        exit;
    }

    function alterarCorretor(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            if(isset($_POST['idCorretor'], $_POST['nome'], $_POST['cpf'], $_POST['creci'])){
                $corretor = new Corretor($_POST['idCorretor'], $_POST['nome'], $_POST['cpf'], $_POST['creci']);

                $qtdLinhasAlteradas = $this->rnCorretor->atualizarCorretor($corretor);

                if($qtdLinhasAlteradas > 0){
                    Alertas::salvarMensagem("Cadastro do corretor alterado com sucesso.");
                } else {
                    Alertas::salvarMensagem("Não foi possível cadatrar o corretor na base de dados.");
                }

            } else {
                Alertas::salvarMensagem("Todos os campos devem ser preenchidos.");
            }

            header("Location: /imovelguide/corretores");
            exit;

        } else {
            //selecionar corretor
            if(isset($_GET['idcorretor'])){
                $corretor = $this->rnCorretor->selecionarCorretor($_GET['idcorretor']);

                //var_dump($corretor);

                require_once __DIR__ . '/../views/alteracaocorretor.php';
            }            
            
        }

    }

    function excluirCorretor($idCorretor){
        $corretor = $this->rnCorretor->selecionarCorretor($idCorretor);

        if($corretor != null){
            if($this->rnCorretor->excluirCorretor($corretor)){
                Alertas::salvarMensagem("Corretor excluído com sucesso.");
            } else {
                Alertas::salvarMensagem("Não foi possível excluir o corretor.");
            }
        } else {
            Alertas::salvarMensagem("Corretor não encontrado na base de dados.");
        }
        
        header("Location: /imovelguide/corretores");
        exit;
    }

}

?>