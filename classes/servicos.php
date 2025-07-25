<?php



class Servicos
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $pdoConn;

    private $infoAtendente;
    private $servicoHabilitado;
    private $idCartaServico;
    private $categoria;

    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $objbanco = $objConectar->ConectarPDO();

        $this->setPdoConn($objbanco);
    }

    public function  servicosHabilitados($filtro = null)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = "select  * from linkCartaServico  where servicoHabilitado=1";




            $stmt = $pdo->prepare($sql);


            $stmt->execute();

            //$user = $stmt->fetchAll();



            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
            }


            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }




            return $dados;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function  trazerServicos($filtro = null)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = "select  * from linkCartaServico ";

            if ($filtro != null) {
                $sql .= " where idUnidade= " . $filtro;
            }


            $stmt = $pdo->prepare($sql);


            $stmt->execute();

            //$user = $stmt->fetchAll();



            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
            }


            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }




            return $dados;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  habilitarServicos()
    {
        try {

            $pdo = $this->getPdoConn();


            //
            $stmt = $pdo->prepare(" UPDATE `linkCartaServico` SET `servicoHabilitado` = :habilitado,    `categoria` = :categoria,
                `infoAtendente` = :infoAtendente 
           WHERE `idlinkCartaServico` = :idCarta");


            $stmt->bindValue(':habilitado',  $this->getServicoHabilitado(), PDO::PARAM_STR);

            $stmt->bindValue(':infoAtendente',  $this->getInfoAtendente(), PDO::PARAM_STR);

            $stmt->bindValue(':idCarta', $this->getIdCartaServico(), PDO::PARAM_STR);

            $stmt->bindValue(':categoria', $this->getCategoria(), PDO::PARAM_STR);

            if ($stmt->execute()) {

                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
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

    /**
     * Get the value of infoAtendente
     */
    public function getInfoAtendente()
    {
        return $this->infoAtendente;
    }

    /**
     * Set the value of infoAtendente
     *
     * @return  self
     */
    public function setInfoAtendente($infoAtendente)
    {
        $this->infoAtendente = $infoAtendente;

        return $this;
    }

    /**
     * Get the value of servicoHabilitado
     */
    public function getServicoHabilitado()
    {
        return $this->servicoHabilitado;
    }

    /**
     * Set the value of servicoHabilitado
     *
     * @return  self
     */
    public function setServicoHabilitado($servicoHabilitado)
    {
        $this->servicoHabilitado = $servicoHabilitado;

        return $this;
    }

    /**
     * Get the value of idCartaServico
     */
    public function getIdCartaServico()
    {
        return $this->idCartaServico;
    }

    /**
     * Set the value of idCartaServico
     *
     * @return  self
     */
    public function setIdCartaServico($idCartaServico)
    {
        $this->idCartaServico = $idCartaServico;

        return $this;
    }

    /**
     * Get the value of categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */ 
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }
}
