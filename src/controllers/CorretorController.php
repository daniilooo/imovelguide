<?php

namespace controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use models\Corretor;
use rn\RnCorretor;

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
                    //colocar mensagem de corretor cadastrado com sucesso                    
                } else {
                    //colocar mensagem de falha ao cadastrar corretor
                }

            } else {
                //colocar mensagem de falta de campos preenchidos
            }
        } else {
            //colocar mensagem de tipo de requisição não suportada pelo controlador
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
                    //colocar mensagem de sucesso na alteração
                } else {
                    //colocar mensagem de falha na alteração
                }

            } else {
                //colocar mensagem para preencher todos os campos
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
                //colocar mensgem corretor excluido com sucesso;
            } else {
                //colocar mensagem falha ao excluir corretor;
            }
        } else {
            //colocar mensagem corretor não encontrado na base de dados;
        }
        
        header("Location: /imovelguide/corretores");
        exit;
    }

}

?>