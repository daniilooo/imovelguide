<?php

namespace DAO;

require_once __DIR__ . '/../../vendor/autoload.php';
include_once __DIR__ . '/../constantes/constTabelasdb.php';

use models\Corretor;
use Exception;

class DaoCorretor{
    private $conexao;
    private $tbl_corretores = TBL_CORRETORES;

    function __construct($conexao){
        $this->conexao = $conexao;
    }

    function inserirCorretor(Corretor $corretor){
        
        $nome = $corretor->getNomeCorretor();
        $cpf = $corretor->getCpf();
        $creci = $corretor->getCreci();

        try{
            $stmt = $this->conexao->prepare("INSERT INTO {$this->tbl_corretores} (NOME, CPF, CRECI) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome, $cpf, $creci);

            if($stmt->execute()){
                return (new Corretor($stmt->insert_id, $nome, $cpf, $creci));                
            }

            $stmt->close();
            return null;

        } catch (Exception $e){
            $erro = "<pre>". $e->getMessage();
            echo $erro;
            return null;
        }
    }

    function selecionarCorretor($idCorretor){
        try{
            $stmt = $this->conexao->prepare("SELECT ID_CORRETOR, NOME, CPF, CRECI FROM {$this->tbl_corretores} WHERE ID_CORRETOR = ?");
            $stmt->bind_param("i", $idCorretor);

            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                return (new Corretor($row['ID_CORRETOR'], $row['NOME'], $row['CPF'], $row['CRECI']));
            }

            return null;

        } catch (Exception $e){
            $erro = "<pre>". $e->getMessage();
            echo $erro;
            return null;
        }
    }

    function alterarCorretor(Corretor $corretor){
        $idCorretor = $corretor->getIdCorretor();
        $nome = $corretor->getNomeCorretor();
        $cpf = $corretor->getCpf();
        $creci = $corretor->getCreci();

        try{
            $stmt = $this->conexao->prepare("UPDATE {$this->tbl_corretores} SET NOME = ?, CPF = ?, CRECI = ? WHERE ID_CORRETOR = ?");
            $stmt->bind_param("sssi", $nome, $cpf, $creci, $idCorretor);            

            if($stmt->execute()){
                return $stmt->affected_rows;
            }

            $stmt->close();
            return -1;
        } catch (Exception $e){
            $erro = "<pre>". $e->getMessage();
            echo $erro;
            return -2;
        }
    }

    function excluirCorretor(Corretor $corretor){
        $idCorretor = $corretor->getIdCorretor();

        try{
            $stmt = $this->conexao->prepare("DELETE FROM {$this->tbl_corretores} WHERE ID_CORRETOR = ?");
            $stmt->bind_param("i", $idCorretor);

            $stmt->execute();
        
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return true;    
            } else {
                $stmt->close();
                return false; 
            }

        } catch (Exception $e){
            $erro = "<pre>". $e->getMessage();
            echo $erro;
            return null;
        }
    }

    function listarCorretores(){
        try{
            $stmt = $this->conexao->prepare("SELECT ID_CORRETOR, NOME, CPF, CRECI FROM {$this->tbl_corretores} ORDER By ID_CORRETOR ASC");
            $stmt->execute();

            $result = $stmt->get_result();

            $listaCorretores = [];

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $corretor = new Corretor($row['ID_CORRETOR'], $row['NOME'], $row['CPF'], $row['CRECI']);
                    $listaCorretores[] = $corretor;
                }
            }

            $stmt->close();
            return $listaCorretores;
        } catch (Exception $e){
            $erro = "<pre>". $e->getMessage();
            echo $erro;
            return [];
        }
    }
}

?>