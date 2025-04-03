<?php

namespace models;

class Corretor{
    private $idCorretor;
    private $nome;
    private $cpf;
    private $creci;

    function __construct($idCorretor, $nomeCorretor, $cpf, $creci){
        $this->setIdCorretor($idCorretor);
        $this->setNomeCorretor($nomeCorretor);
        $this->setCpf($cpf);
        $this->setCreci($creci);
    }

    //setters
    function setIdCorretor($idCorretor = 0){
        $this->idCorretor = $idCorretor;
    }

    function setNomeCorretor($nomeCorretor){
        $this->nome = $nomeCorretor;
    }

    function setCpf($cpf){
        $this->cpf = $cpf;
    }

    function setCreci($creci){
        $this->creci = $creci;
    }

    //getters
    function getIdCorretor(){
        return $this->idCorretor;
    }

    function getNomeCorretor(){
        return $this->nome;
    }

    function getCpf(){
        return $this->cpf;
    }

    function getCreci(){
        return $this->creci;
    }
}

?>