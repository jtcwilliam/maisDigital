<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);



class TipoAgendamento
{



    private $conexao;
    private $idTipoAgendamento;
    private $tipoAtendamentocol;

  

 
    private $dns;
    private $user;
    private $pwd;



    private $pdoConn;
    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $objbanco = $objConectar->ConectarPDO();

        $this->setPdoConn($objbanco);

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
     * Get the value of idTipoAgendamento
     */ 
    public function getIdTipoAgendamento()
    {
        return $this->idTipoAgendamento;
    }

    /**
     * Set the value of idTipoAgendamento
     *
     * @return  self
     */ 
    public function setIdTipoAgendamento($idTipoAgendamento)
    {
        $this->idTipoAgendamento = $idTipoAgendamento;

        return $this;
    }

    /**
     * Get the value of tipoAtendamentocol
     */ 
    public function getTipoAtendamentocol()
    {
        return $this->tipoAtendamentocol;
    }

    /**
     * Set the value of tipoAtendamentocol
     *
     * @return  self
     */ 
    public function setTipoAtendamentocol($tipoAtendamentocol)
    {
        $this->tipoAtendamentocol = $tipoAtendamentocol;

        return $this;
    }
    


    //arquivo atualizado//
//  finalizando //


    public function  carregartipoAgendamento()
    {
        try {

         

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" SELECT * FROM  tipoAgendamento where idTipoAgendamento in (1,2) ");

            $stmt->execute();

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();
            $i=0;

            foreach ($row as $key => $value) {
                $dados[] = $value;
                $retorno['condicao'] = true;
                $retorno['dados'] = $dados;
                $i++;

            }
             

            if (empty($dados)) {
                $retorno['condicao'] = 'false';
            }

            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

 
    }



    /**
     * Get the value of dns
     */ 
    public function getDns()
    {
        return $this->dns;
    }

    /**
     * Set the value of dns
     *
     * @return  self
     */ 
    public function setDns($dns)
    {
        $this->dns = $dns;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

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

    /**
     * Get the value of pdoConn
     */ 
    public function getPdoConn()
    {
        return $this->pdoConn;
    }

    /**
     * Set the value of pdoConn
     *
     * @return  self
     */ 
    public function setPdoConn($pdoConn)
    {
        $this->pdoConn = $pdoConn;

        return $this;
    }
}
