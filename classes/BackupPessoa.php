<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);



class Pessoa_____
{



    private $conexao;

    private $sqlQuery;

    private $idPessoas;
    private $nomePessoa;
    private $tipoPessoa;
    private $statusPessoa;
    private $documentoPessoa;
    private $pwd;




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
     * Get the value of sqlQuery
     */
    public function getSqlQuery()
    {
        return $this->sqlQuery;
    }

    /**
     * Set the value of sqlQuery
     *
     * @return  self
     */
    public function setSqlQuery($sqlQuery)
    {
        $this->sqlQuery = $sqlQuery;

        return $this;
    }

    public function  logarPessoa()
    {

        $sql = "select  ps.nomePessoa as 'nome', un.nomeUnidade as 'nomeUnidade', st.descricaoStatus as 'descricaoStatus' , 
        tp.descricaoTipoPessoa as 'tipoPessoa', ps.pwd, ps.documentoPessoa  as 'documentoPessoa',  ps.*, st.*, tp.*, un.*
        from pessoas ps 
        inner join unidade un on un.responsavelUnidade = ps.idPessoas  
        inner join status st on st.idStatus = ps.statusPessoa 
        inner join tipoPessoa tp on tp.idTipoPessoa = ps.tipoPessoa
         where documentoPessoa = '" . $this->getDocumentoPessoa() . "'  and pwd= '" . $this->getPwd() . "' ";

        $executar = mysqli_query($this->getConexao(), $sql);

        $retorno = array();

        while ($row = mysqli_fetch_assoc($executar)) {
            $dados[] = $row;
            $retorno['condicao'] = true;
            $retorno['dados'] = $dados;
        }
        if (!isset($dados)) {
            $retorno['condicao'] = false;
        }

        return $retorno;
    }

    public function  pesquisarCPF($cpf)
    {
        $sql = "select * from pessoas where documentoPessoa = '" . $cpf . "'";


        $executar = mysqli_query($this->getConexao(), $sql);

        $retorno = array();

        while ($row = mysqli_fetch_assoc($executar)) {
            $dados[] = $row;
            $retorno['condicao'] = true;
            $retorno['dados'] = $dados;
            
        }
        if (!isset($dados)) {
            $retorno['condicao'] = false;
        }

        return $retorno;
    }

    public function   inserirPessoasAgendamento()
    {
        try {

            $sql = "   INSERT INTO  pessoas ( `nomePessoa`, `tipoPessoa`,`statusPessoa`, `documentoPessoa`) 
            VALUES ('" . $this->getNomePessoa() . "', '" . $this->getTipoPessoa() . "', '" . $this->getStatusPessoa() . "', '" . $this->getDocumentoPessoa() . "');";



            $executar = mysqli_query($this->getConexao(), $sql);

            if ($executar == true) {

                return true;
            } else {

                return false;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * Get the value of idPessoas
     */
    public function getIdPessoas()
    {
        return $this->idPessoas;
    }

    /**
     * Set the value of idPessoas
     *
     * @return  self
     */
    public function setIdPessoas($idPessoas)
    {
        $this->idPessoas = $idPessoas;

        return $this;
    }

    /**
     * Get the value of nomePessoa
     */
    public function getNomePessoa()
    {
        return $this->nomePessoa;
    }

    /**
     * Set the value of nomePessoa
     *
     * @return  self
     */
    public function setNomePessoa($nomePessoa)
    {
        $this->nomePessoa = $nomePessoa;

        return $this;
    }

    /**
     * Get the value of tipoPessoa
     */
    public function getTipoPessoa()
    {
        return $this->tipoPessoa;
    }

    /**
     * Set the value of tipoPessoa
     *
     * @return  self
     */
    public function setTipoPessoa($tipoPessoa)
    {
        $this->tipoPessoa = $tipoPessoa;

        return $this;
    }

    /**
     * Get the value of statusPessoa
     */
    public function getStatusPessoa()
    {
        return $this->statusPessoa;
    }

    /**
     * Set the value of statusPessoa
     *
     * @return  self
     */
    public function setStatusPessoa($statusPessoa)
    {
        $this->statusPessoa = $statusPessoa;

        return $this;
    }

    /**
     * Get the value of documentoPessoa
     */
    public function getDocumentoPessoa()
    {
        return $this->documentoPessoa;
    }

    /**
     * Set the value of documentoPessoa
     *
     * @return  self
     */
    public function setDocumentoPessoa($documentoPessoa)
    {
        $this->documentoPessoa = $documentoPessoa;

        return $this;
    }

    /**
     * Get the value of pwd
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     *
     * @return  self
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }
}
