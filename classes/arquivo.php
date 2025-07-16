<?php



class Arquivo
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $arquivo;

    private $pdoConn;
    private $nomeArquivo;
    private $tipoArquivo;
    private $idSolicitacao;
    private $statusArquivo;

    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $objbanco = $objConectar->ConectarPDO();

        $this->setPdoConn($objbanco);
    }


    public function  gerarArquivo()
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" select arquivo from arquivos where idarquivo = 13 ");


            $stmt->execute();



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  consultarQuantidadeArquivo($idSolicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" select arquivo from arquivos where idSolicitacao =" . $idSolicitacao);


            $stmt->execute();



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  inserirArquivos()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $arquivo =   $this->getArquivo();
            $arquivoTipo = $this->getTipoArquivo();
            $nomeArquivo = $this->getNomeArquivo();
            $idSolicitacao = $this->getIdSolicitacao();
            $statusArquivo = $this->getStatusArquivo();



            $stmt = $pdo->prepare("  INSERT INTO  arquivos ( arquivo, tipoArquivo, nomeArquivo, idSolicitacao, statusArquivo   )   values (?,?,?,?,?) ");

            $stmt->bindParam(1,  $arquivo, PDO::PARAM_LOB);
            $stmt->bindParam(2,  $arquivoTipo, PDO::PARAM_LOB);
            $stmt->bindParam(3,  $nomeArquivo, PDO::PARAM_LOB);
            $stmt->bindParam(4,  $idSolicitacao, PDO::PARAM_LOB);
            $stmt->bindParam(5,  $idSolicitacao, PDO::PARAM_LOB);


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
     * Get the value of arquivo
     */
    public function getArquivo()
    {
        return $this->arquivo;
    }

    /**
     * Set the value of arquivo
     *
     * @return  self
     */
    public function setArquivo($arquivo)
    {
        $this->arquivo = $arquivo;

        return $this;
    }

    /**
     * Get the value of nomeArquivo
     */
    public function getNomeArquivo()
    {
        return $this->nomeArquivo;
    }

    /**
     * Set the value of nomeArquivo
     *
     * @return  self
     */
    public function setNomeArquivo($nomeArquivo)
    {
        $this->nomeArquivo = $nomeArquivo;

        return $this;
    }

    /**
     * Get the value of tipoArquivo
     */
    public function getTipoArquivo()
    {
        return $this->tipoArquivo;
    }

    /**
     * Set the value of tipoArquivo
     *
     * @return  self
     */
    public function setTipoArquivo($tipoArquivo)
    {
        $this->tipoArquivo = $tipoArquivo;

        return $this;
    }

    /**
     * Get the value of idSolicitacao
     */
    public function getIdSolicitacao()
    {
        return $this->idSolicitacao;
    }

    /**
     * Set the value of idSolicitacao
     *
     * @return  self
     */
    public function setIdSolicitacao($idSolicitacao)
    {
        $this->idSolicitacao = $idSolicitacao;

        return $this;
    }

    /**
     * Get the value of statusArquivo
     */
    public function getStatusArquivo()
    {
        return $this->statusArquivo;
    }

    /**
     * Set the value of statusArquivo
     *
     * @return  self
     */
    public function setStatusArquivo($statusArquivo)
    {
        $this->statusArquivo = $statusArquivo;

        return $this;
    }
}
