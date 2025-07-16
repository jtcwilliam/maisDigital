<?php



class Solicitacao
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $pdoConn;

    private $assuntoSolicitacao;
    private $descricaoSolicitacao;
    private $documentoPublico;
    private $dataSolicitacao;
    private $statusSolicitacao;
    private $solicitacante;
    private $tipoDocumento;
    private $protocolo;


    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $objbanco = $objConectar->ConectarPDO();

        $this->setPdoConn($objbanco);
    }

    public function  trazerSolicitacao($protocolo)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = "select  * from solicitacao where  protocolo='" . $protocolo . "'";



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

    public function  gravarSolicitacao()
    {
        try {

            $pdo = $this->getPdoConn();


            //
            $stmt = $pdo->prepare(" INSERT INTO solicitacao (assuntoSolicitacao,descricaoSolicitacao, documentoPublico, dataSolicitacao,statusSolicitacao, solicitacante,tipoDocumento, protocolo)
             VALUES ( :assuntoSolicitacao,:descricaoSolicitacao, :documentoPublico, :dataSolicitacao, :statusSolicitacao, :solicitacante, :tipoDocumento, :protocolo)");


            $stmt->bindValue(':assuntoSolicitacao',  $this->getAssuntoSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':descricaoSolicitacao',  $this->getDescricaoSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':documentoPublico',  $this->getDocumentoPublico(), PDO::PARAM_STR);

            $stmt->bindValue(':dataSolicitacao',  $this->getDataSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':statusSolicitacao',  $this->getStatusSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':solicitacante',  $this->getSolicitacante(), PDO::PARAM_STR);

            $stmt->bindValue(':tipoDocumento',  $this->getTipoDocumento(), PDO::PARAM_STR);

            $stmt->bindValue(':protocolo',  $this->getProtocolo(), PDO::PARAM_STR);


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
     * Get the value of assuntoSolicitacao
     */
    public function getAssuntoSolicitacao()
    {
        return $this->assuntoSolicitacao;
    }

    /**
     * Set the value of assuntoSolicitacao
     *
     * @return  self
     */
    public function setAssuntoSolicitacao($assuntoSolicitacao)
    {
        $this->assuntoSolicitacao = $assuntoSolicitacao;

        return $this;
    }

    /**
     * Get the value of descricaoSolicitacao
     */
    public function getDescricaoSolicitacao()
    {
        return $this->descricaoSolicitacao;
    }

    /**
     * Set the value of descricaoSolicitacao
     *
     * @return  self
     */
    public function setDescricaoSolicitacao($descricaoSolicitacao)
    {
        $this->descricaoSolicitacao = $descricaoSolicitacao;

        return $this;
    }

    /**
     * Get the value of documentoPublico
     */
    public function getDocumentoPublico()
    {
        return $this->documentoPublico;
    }

    /**
     * Set the value of documentoPublico
     *
     * @return  self
     */
    public function setDocumentoPublico($documentoPublico)
    {
        $this->documentoPublico = $documentoPublico;

        return $this;
    }

    /**
     * Get the value of dataSolicitacao
     */
    public function getDataSolicitacao()
    {
        return $this->dataSolicitacao;
    }

    /**
     * Set the value of dataSolicitacao
     *
     * @return  self
     */
    public function setDataSolicitacao($dataSolicitacao)
    {
        $this->dataSolicitacao = $dataSolicitacao;

        return $this;
    }

    /**
     * Get the value of statusSolicitacao
     */
    public function getStatusSolicitacao()
    {
        return $this->statusSolicitacao;
    }

    /**
     * Set the value of statusSolicitacao
     *
     * @return  self
     */
    public function setStatusSolicitacao($statusSolicitacao)
    {
        $this->statusSolicitacao = $statusSolicitacao;

        return $this;
    }

    /**
     * Get the value of solicitacante
     */
    public function getSolicitacante()
    {
        return $this->solicitacante;
    }

    /**
     * Set the value of solicitacante
     *
     * @return  self
     */
    public function setSolicitacante($solicitacante)
    {
        $this->solicitacante = $solicitacante;

        return $this;
    }

    /**
     * Get the value of tipoDocumento
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Set the value of tipoDocumento
     *
     * @return  self
     */
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get the value of protocolo
     */
    public function getProtocolo()
    {
        return $this->protocolo;
    }

    /**
     * Set the value of protocolo
     *
     * @return  self
     */
    public function setProtocolo($protocolo)
    {
        $this->protocolo = $protocolo;

        return $this;
    }
}
