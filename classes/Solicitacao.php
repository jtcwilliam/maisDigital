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
    private $solicitante;
    private $tipoDocumento;
    private $protocolo;
    private $arquivo;
    private $solicitacao;
    private $documentoSolicitante;
    private $idAtendente;

    private $cepSolicitacao;
    private $logradouroSol;
    private $numeroSol;
    private $complemento;
    private $bairro;


    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $objbanco = $objConectar->ConectarPDO();

        $this->setPdoConn($objbanco);
    }


    //

    public function  consultaSolicitacaoPorStatus($status)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = "select        sl.assuntoSolicitacao,  descricaoCarta, date_format(dataSolicitacao, '%d/%m/%Y  ás  %H:%i') as dias, nomeSecretaria,  stt.descricaoStatus , sl.idsolicitacao      from solicitacao sl 
             inner join status stt on sl.statusSolicitacao = stt.idStatus inner join linkCartaServico lcs on lcs.idlinkCartaServico = sl.assuntoSolicitacao 
             where sl.statussolicitacao in(" . $status . ")";



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

    public function  pesquisarSolicitacoesPorCategoria($idCategoria)
    {
        try {


            $pdo = $this->getPdoConn();

            $sql = "select  idSolicitacao     ,lc.descricaoCarta,  sl.descricaoSolicitacao  ,lc.nomeSecretaria, sl.solicitante,
                    sl.tipoDocumento, sl.documentoPublico,
                    dc.descricaoDoc, ps.nomePessoa, ps.emailUsuario, sl.docSolicitacaoPessoal, sl.assuntoSolicitacao,  sl.cepSolicitacao,  
                    sl.logradouroSol    ,  sl.numeroSol,
                    sl.complemento, sl.bairro ,
                    date_format(dataSolicitacao, '%d ' ) as 'dias', 
                    date_format(dataSolicitacao, '%M' ) as 'mes', 
                    date_format(dataSolicitacao, ' de %Y ' ) as 'ano',  date_format(dataSolicitacao, '%d/%m/%Y') as 'diaDaSolicitacao' ,
                    sts.descricaoStatus, descricaoCategoria 
                    from solicitacao sl inner join  linkCartaServico lc on lc.idlinkCartaServico = sl.assuntoSolicitacao 
                    inner join documentos dc on dc.idDoc = sl.tipoDocumento inner join pessoas ps on ps.idPessoas = sl.solicitante                     
                    inner join status sts on sts.idStatus = sl.statusSolicitacao
                    inner join pessoaTemCategoria ptc on ptc.categoriaPessoas = lc.categoria
                    inner join categoria ct on ct.idCategoria = ptc.categoriaPessoas
                    where  statusSolicitacao = 10 and   lc.categoria = " . $idCategoria;


            $stmt = $pdo->prepare($sql);

            $stmt->execute();

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


    public function  consultarSolicitacaoRelatorio($idSolicitacao)
    {
        try {


            $pdo = $this->getPdoConn();



            $sql = " select lc.descricaoCarta,  sl.descricaoSolicitacao  ,lc.nomeSecretaria, sl.solicitante, sl.tipoDocumento, sl.documentoPublico, dc.descricaoDoc, ps.nomePessoa, ps.emailUsuario, sl.docSolicitacaoPessoal, sl.assuntoSolicitacao
                    from solicitacao sl inner join  linkCartaServico lc on lc.idlinkCartaServico = sl.assuntoSolicitacao
                    inner join documentos dc on dc.idDoc = sl.tipoDocumento inner join pessoas ps on ps.idPessoas = sl.solicitante 
                    where idsolicitacao = " . $idSolicitacao;



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


    public function  pesquisarAssinatura($idSolicitacao)
    {
        try {

            $pdo = $this->getPdoConn();

            $sql = " select lc.descricaoCarta,  sl.descricaoSolicitacao  ,lc.nomeSecretaria, sl.solicitante,
             sl.tipoDocumento, sl.documentoPublico,  nomeArquivo, tipoArquivo, 
                dc.descricaoDoc, ps.nomePessoa, ps.emailUsuario, sl.docSolicitacaoPessoal, sl.assuntoSolicitacao,  sl.cepSolicitacao   ,  sl.logradouroSol    ,  sl.numeroSol,
                sl.complemento, sl.bairro ,
                date_format(dataSolicitacao, '%d ' ) as 'dias', 

                date_format(dataSolicitacao, '%M' ) as 'mes', 

                date_format(dataSolicitacao, ' de %Y ' ) as 'ano', sl.assinaturaSolicitacao,
                date_format(dataSolicitacao, '%d/%m/%Y') as 'diaDaSolicitacao' , sts.descricaoStatus
                
                
                from solicitacao sl inner join  linkCartaServico lc on lc.idlinkCartaServico = sl.assuntoSolicitacao 
                inner join documentos dc on dc.idDoc = sl.tipoDocumento inner join pessoas ps on ps.idPessoas = sl.solicitante 
                INNER join arquivos ar on ar.idSolicitacao  = sl.idsolicitacao 
                inner join status sts on sts.idStatus = sl.statusSolicitacao
                where sl.idsolicitacao =" . $idSolicitacao . "  and statusSolicitacao in (10,11) ";



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



    public function  atribuirSolicitacaoAtendente()
    {
        try {

            $pdo = $this->getPdoConn();


            $idAtendente =   $this->getIdAtendente();
            $idSolicitacao = $this->getSolicitacao();
            $idStatusSolicitacao = $this->getStatusSolicitacao();

            $stmt = $pdo->prepare("  UPDATE solicitacao set idAtendente=?, statusSolicitacao=?     where idSolicitacao=?");

            //corrigir isto aqui
            $stmt->bindParam(1,  $idAtendente, PDO::PARAM_INT);
            $stmt->bindParam(2,  $idStatusSolicitacao, PDO::PARAM_INT);
            $stmt->bindParam(3,  $idSolicitacao, PDO::PARAM_INT);





            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  inserirAssinaturaSolicitacao()
    {
        try {

            $pdo = $this->getPdoConn();


            $arquivo =   $this->getArquivo();
            $idSolicitacao = $this->getSolicitacao();





            $stmt = $pdo->prepare("  UPDATE solicitacao set assinaturaSolicitacao=?, statusSolicitacao=10   where idSolicitacao=?");


            //corrigir isto aqui
            $stmt->bindParam(1,  $arquivo, PDO::PARAM_LOB);
            $stmt->bindParam(2,  $idSolicitacao, PDO::PARAM_INT);



            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  gravarSolicitacao()
    {
        try {

            $pdo = $this->getPdoConn();


            //
            $stmt = $pdo->prepare(" INSERT INTO solicitacao (assuntoSolicitacao,descricaoSolicitacao, documentoPublico, dataSolicitacao,statusSolicitacao,
             solicitante,tipoDocumento, protocolo, docSolicitacaoPessoal,  cepSolicitacao   ,  logradouroSol    ,  numeroSol, complemento, bairro    )
             VALUES ( :assuntoSolicitacao,:descricaoSolicitacao, :documentoPublico, :dataSolicitacao,
              :statusSolicitacao, :solicitante, :tipoDocumento, :protocolo, :docSolicitacaoPessoal,  :cepSolicitacao,   :logradouroSol, :numeroSol,  :complemento,   :bairro   )");


            $stmt->bindValue(':assuntoSolicitacao',  $this->getAssuntoSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':descricaoSolicitacao',  $this->getDescricaoSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':documentoPublico',  $this->getDocumentoPublico(), PDO::PARAM_STR);

            $stmt->bindValue(':dataSolicitacao',  $this->getDataSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':statusSolicitacao',  $this->getStatusSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':solicitante',  $this->getsolicitante(), PDO::PARAM_STR);

            $stmt->bindValue(':tipoDocumento',  $this->getTipoDocumento(), PDO::PARAM_STR);

            $stmt->bindValue(':protocolo',  $this->getProtocolo(), PDO::PARAM_STR);

            $stmt->bindValue(':docSolicitacaoPessoal',  $this->getDocumentoSolicitante(), PDO::PARAM_STR);


            //            //
            $stmt->bindValue(':cepSolicitacao',  $this->getCepSolicitacao(), PDO::PARAM_STR);

            $stmt->bindValue(':logradouroSol',  $this->getLogradouroSol(), PDO::PARAM_STR);

            $stmt->bindValue(':numeroSol',  $this->getNumeroSol(), PDO::PARAM_STR);

            $stmt->bindValue(':complemento',  $this->getComplemento(), PDO::PARAM_STR);

            $stmt->bindValue(':bairro',  $this->getBairro(), PDO::PARAM_STR);
            //            \\





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
     * Get the value of solicitante
     */
    public function getsolicitante()
    {
        return $this->solicitante;
    }

    /**
     * Set the value of solicitante
     *
     * @return  self
     */
    public function setsolicitante($solicitante)
    {
        $this->solicitante = $solicitante;

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
     * Get the value of solicitacao
     */
    public function getSolicitacao()
    {
        return $this->solicitacao;
    }

    /**
     * Set the value of solicitacao
     *
     * @return  self
     */
    public function setSolicitacao($solicitacao)
    {
        $this->solicitacao = $solicitacao;

        return $this;
    }

    /**
     * Get the value of documentoSolicitante
     */
    public function getDocumentoSolicitante()
    {
        return $this->documentoSolicitante;
    }

    /**
     * Set the value of documentoSolicitante
     *
     * @return  self
     */
    public function setDocumentoSolicitante($documentoSolicitante)
    {
        $this->documentoSolicitante = $documentoSolicitante;

        return $this;
    }

    /**
     * Get the value of cepSolicitacao
     */
    public function getCepSolicitacao()
    {
        return $this->cepSolicitacao;
    }

    /**
     * Set the value of cepSolicitacao
     *
     * @return  self
     */
    public function setCepSolicitacao($cepSolicitacao)
    {
        $this->cepSolicitacao = $cepSolicitacao;

        return $this;
    }

    /**
     * Get the value of logradouroSol
     */
    public function getLogradouroSol()
    {
        return $this->logradouroSol;
    }

    /**
     * Set the value of logradouroSol
     *
     * @return  self
     */
    public function setLogradouroSol($logradouroSol)
    {
        $this->logradouroSol = $logradouroSol;

        return $this;
    }

    /**
     * Get the value of numeroSol
     */
    public function getNumeroSol()
    {
        return $this->numeroSol;
    }

    /**
     * Set the value of numeroSol
     *
     * @return  self
     */
    public function setNumeroSol($numeroSol)
    {
        $this->numeroSol = $numeroSol;

        return $this;
    }

    /**
     * Get the value of complemento
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set the value of complemento
     *
     * @return  self
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Get the value of bairro
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set the value of bairro
     *
     * @return  self
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get the value of idAtendente
     */
    public function getIdAtendente()
    {
        return $this->idAtendente;
    }

    /**
     * Set the value of idAtendente
     *
     * @return  self
     */
    public function setIdAtendente($idAtendente)
    {
        $this->idAtendente = $idAtendente;

        return $this;
    }
}
