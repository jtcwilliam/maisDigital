<?php



class Documentos
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $pdoConn;
    private $idDocumento;
    private $idServico;
    private $status;



    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $objbanco = $objConectar->ConectarPDO();

        $this->setPdoConn($objbanco);
    }

    public function  trazerDocumentos($filtro = null)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = "select  * from documentos ";

            if($filtro != null){
                $sql.= $filtro;
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


    public function  trazerDocumentoArquivo($filtro)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = "select * from servicoDocumento dc inner join linkCartaServico sv on sv.idlinkCartaServico = dc.idServico  inner join documentos dcm 
            on dcm.idDoc =  idDocumento
            where idservico =".$filtro;


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






    public function  inserirServicoDocumento()
    {
        try {

            $pdo = $this->getPdoConn();

            //
            $stmt = $pdo->prepare("INSERT INTO servicoDocumento(idServico,idDocumento, status) VALUES (:idservico,:idDocumento,:idstatus)");

            // $stmt = $pdo->prepare("  UPDATE  pessoas SET pwd =  :senha  WHERE idPessoas = :idPessoa   ");

            $stmt->bindValue(':idservico',  $this->getIdServico(), PDO::PARAM_STR);

            $stmt->bindValue(':idDocumento',  $this->getIdDocumento(), PDO::PARAM_STR);

            $stmt->bindValue(':idstatus', $this->getStatus(), PDO::PARAM_STR);

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
     * Get the value of idServico
     */
    public function getIdServico()
    {
        return $this->idServico;
    }

    /**
     * Set the value of idServico
     *
     * @return  self
     */
    public function setIdServico($idServico)
    {
        $this->idServico = $idServico;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of idDocumento
     */
    public function getIdDocumento()
    {
        return $this->idDocumento;
    }

    /**
     * Set the value of idDocumento
     *
     * @return  self
     */
    public function setIdDocumento($idDocumento)
    {
        $this->idDocumento = $idDocumento;

        return $this;
    }
}
