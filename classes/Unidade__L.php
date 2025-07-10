<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);



class Unidade
{



    private $conexao;
    private $idUnidade;
    private $nomeUnidade;
    private $statusUnidade;
    private $responsavelUnidade;




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



    function getConexao()
    {
        return $this->conexao;
    }



    function setConexao($conexao)
    {
        $this->conexao = $conexao;
    }


    /**
     * Get the value of idUnidade
     */
    public function getIdUnidade()
    {
        return $this->idUnidade;
    }

    /**
     * Set the value of idUnidade
     *
     * @return  self
     */
    public function setIdUnidade($idUnidade)
    {
        $this->idUnidade = $idUnidade;

        return $this;
    }

    /**
     * Get the value of nomeUnidade
     */
    public function getNomeUnidade()
    {
        return $this->nomeUnidade;
    }

    /**
     * Set the value of nomeUnidade
     *
     * @return  self
     */
    public function setNomeUnidade($nomeUnidade)
    {
        $this->nomeUnidade = $nomeUnidade;

        return $this;
    }

    /**
     * Get the value of statusUnidade
     */
    public function getStatusUnidade()
    {
        return $this->statusUnidade;
    }

    /**
     * Set the value of statusUnidade
     *
     * @return  self
     */
    public function setStatusUnidade($statusUnidade)
    {
        $this->statusUnidade = $statusUnidade;

        return $this;
    }

    /**
     * Get the value of responsavelUnidade
     */
    public function getResponsavelUnidade()
    {
        return $this->responsavelUnidade;
    }

    /**
     * Set the value of responsavelUnidade
     *
     * @return  self
     */
    public function setResponsavelUnidade($responsavelUnidade)
    {
        $this->responsavelUnidade = $responsavelUnidade;

        return $this;
    }




    public function  carregarTodasUnidades()
    {
        $sql = "SELECT * FROM  unidade";


        $executar = mysqli_query($this->getConexao(), $sql);

        $retorno = array();

        $dados = array();

        while ($row = mysqli_fetch_assoc($executar)) {
            $dados[] = $row;
            
        }
        if (!isset($dados)) {
            $retorno['condicao'] = false;
        }

        return $dados;
    }
}
