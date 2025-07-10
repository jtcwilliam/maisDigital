<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);



class OrdemAnexo
{




    private $conexao;
    private $nomeOrdem;
    private $idOrdem;


    function getNomeOrdem()
    {
        return $this->nomeOrdem;
    }



    function setNomeOrdem($nomeOrdem)
    {
        $this->conexao = $nomeOrdem;
    }


    function getidOrdem()
    {
        return $this->idOrdem;
    }



    function setidOrdem($idOrdem)
    {
        $this->conexao = $idOrdem;
    }












    function getConexao()
    {
        return $this->conexao;
    }



    function setConexao($conexao)
    {
        $this->conexao = $conexao;
    }



    function __construct()
    {
        include_once 'Conexao.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $banco = $objConectar->Conectar();

        //criar uma instancia dessa nova conexao
        $this->setConexao($banco);
    }

  

    public function  inserirOrdem($nomeOrdemTexto)
    {
        $sql = "INSERT INTO  ordemAnexo (nomeOrdemAnexo, valor) VALUES ('Ordem de Anexo - ".$nomeOrdemTexto."',1)";

         

        $executar = mysqli_query($this->getConexao(), $sql);

        if ($executar == true) {

            return true;
        } else {

            return false;
        }
    }

 

    public function sinteseOrdem()
    {

        $sql = "select count(valor), nomeOrdemAnexo from ordemAnexo group by nomeOrdemAnexo";

        $executar = mysqli_query($this->getConexao(), $sql);

        while ($row = mysqli_fetch_assoc($executar)) {

            $dados[] = $row;
        }

        if (isset($dados)) {

            return $dados;
        } else {
        }
    }


    public function quantitaTivoOrdem()
    {

        $sql = "select count(valor) as 'total' from ordemAnexo  ";

        $executar = mysqli_query($this->getConexao(), $sql);

        while ($row = mysqli_fetch_assoc($executar)) {

            $dados[] = $row;
        }

        if (isset($dados)) {

            return $dados;
        } else {
        }
    }






   
}
