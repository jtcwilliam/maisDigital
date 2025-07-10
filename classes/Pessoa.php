<?php



class Pessoa
{




    private $sqlQuery;

    private $idPessoas;
    private $nomePessoa;
    private $tipoPessoa;
    private $statusPessoa;
    private $documentoPessoa;
    private $emailUsuario;
    private $unidade;
    private $prefixoDoc;
    private $validaTipoCadastro;

    private $confirmaTermo;


    private $senha;
    private $confirme;



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $PdoConn;





    //mexer na conexão para retornar os dados conexao, usuario e senha



    function __construct()
    {
        include_once 'conecaoPDO.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $objbanco = $objConectar->ConectarPDO();

        $this->setPdoConn($objbanco);
    }




    public function  logarAgendamento($cpf, $senha)
    {
        try {


            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("select * from pessoas where documentoPessoa =:cpf  and pwd= :pwd  ");

            $stmt->execute(array(':cpf' => $cpf, ':pwd' => $senha));

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();
            $i = 0;

            foreach ($row as $key => $value) {
                $dados[] = $value;
                $retorno['condicao'] = true;
                $retorno['dados'] = $dados;
                $i++;
                session_start();
                $_SESSION['usuariosLogados'] = $dados;
                $_SESSION['condicao'] = true;
            }

            if (empty($dados)) {
                $retorno['condicao'] = false;
            }

            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }






    public function  pesquisarCPF($cpf)
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("select *, UCASE(nomePessoa) as nomePessoa from pessoas where documentoPessoa =:cpf   ");

            $stmt->execute(array(':cpf' => $cpf));

            $retorno = array();

            $dados = array();

            $row = $stmt->fetchAll();
            $i = 0;

            foreach ($row as $key => $value) {
                $dados[] = $value;
                $retorno['condicao'] = true;
                $retorno['dados'] = $dados;
                $i++;
            }

            if (empty($dados)) {
                $retorno['condicao'] = false;
            }

            return $retorno;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




    ///fazer essa classe igual a da backup pessoa

    /*
        $sql = "   INSERT INTO  pessoas ( `nomePessoa`, `tipoPessoa`,`statusPessoa`, `documentoPessoa`) 
            VALUES ('" . $this->getNomePessoa() . "',  '" . $this->getTipoPessoa() . "', '" . $this->getStatusPessoa() . "', '" . $this->getDocumentoPessoa() . "');";
*/
    public function  inserirPessoasAgendamento()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("  INSERT INTO  pessoas ( nomePessoa, tipoPessoa,statusPessoa, documentoPessoa, prefixoDoc, validaTipoCadastro, emailUsuario, pwd, termoUso   ) 
            values (:nomePessoa, :tipoPessoa, :statusPessoa, :documentoPessoa, :prefixoDoc, :validaTipoCadastro,  :emailUsuario, :pwd, :termoUso ) ");

            $stmt->bindValue(':nomePessoa',  $this->getNomePessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':tipoPessoa', $this->getTipoPessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':documentoPessoa', md5($this->getDocumentoPessoa()), PDO::PARAM_STR);
            $stmt->bindValue(':statusPessoa', $this->getStatusPessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':prefixoDoc', $this->getPrefixoDoc(), PDO::PARAM_STR);
            $stmt->bindValue(':validaTipoCadastro', $this->getValidaTipoCadastro(), PDO::PARAM_STR);
            $stmt->bindValue(':emailUsuario', $this->getEmailUsuario(), PDO::PARAM_STR);
            $stmt->bindValue(':pwd', $this->getSenha(), PDO::PARAM_STR);
            $stmt->bindValue(':termoUso', $this->getConfirmaTermo(), PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function  inserirFuncionarioPrefs()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("  INSERT INTO  pessoas ( nomePessoa, tipoPessoa,statusPessoa, documentoPessoa, emailUsuario, unidade, prefixoDoc) 
            values (:nomePessoa, :tipoPessoa, :statusPessoa, :documentoPessoa, :emailUsuario, :unidade, :prefixoDoc) ");



            $stmt->bindValue(':nomePessoa',  $this->getNomePessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':tipoPessoa', $this->getTipoPessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':documentoPessoa', md5($this->getDocumentoPessoa()), PDO::PARAM_STR);
            $stmt->bindValue(':statusPessoa', $this->getStatusPessoa(), PDO::PARAM_STR);
            $stmt->bindValue(':emailUsuario', $this->getEmailUsuario(), PDO::PARAM_STR);
            $stmt->bindValue(':unidade', $this->getUnidade(), PDO::PARAM_STR);
            $stmt->bindValue(':prefixoDoc', $this->getPrefixoDoc(), PDO::PARAM_STR);



            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function  alterarSenha()
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  UPDATE  pessoas SET pwd =  :senha  WHERE idPessoas = :idPessoa   ");

            $stmt->bindValue(':senha',  $this->getSenha(), PDO::PARAM_STR);

            $stmt->bindValue(':idPessoa', $this->getIdPessoas(), PDO::PARAM_STR);

            if ($stmt->execute()) {

                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function  alterarDados()
    {
        try {

            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("  UPDATE  pessoas SET nomePessoa= :nome,    emailUsuario = :email  WHERE idPessoas = :idPessoa   ");

            $stmt->bindValue(':email',  $this->getEmailUsuario(), PDO::PARAM_STR);

            $stmt->bindValue(':nome',  $this->getNomePessoa(), PDO::PARAM_STR);

            $stmt->bindValue(':idPessoa', $this->getIdPessoas(), PDO::PARAM_STR);

            if ($stmt->execute()) {

                return true;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }





    public function  logarPessoa()
    {




        try {

            $pdo = $this->getPdoConn();



            $stmt = $pdo->prepare("select  ps.nomePessoa as 'nome', un.nomeUnidade as 'nomeUnidade', st.descricaoStatus as 'descricaoStatus' , 
            tp.descricaoTipoPessoa as 'tipoPessoa', ps.pwd, ps.documentoPessoa  as 'documentoPessoa',  
            ps.*, st.*, tp.*, un.* from pessoas ps 
            inner join unidade un on ps.unidade = un.idUnidade 
            inner join status st on st.idStatus = ps.statusPessoa  
            inner join tipoPessoa tp on tp.idTipoPessoa = ps.tipoPessoa 
            where emailUsuario = '" . $this->getEmailUsuario() . "'");

            $stmt->execute();



            $retorno = array();

            $dados = array();



            $row = $stmt->fetchAll();

            foreach ($row as $key => $value) {
                $dados[] = $value;
                $retorno['condicao'] = true;
                $retorno['dados'] = $dados;
            }

            if (!isset($dados)) {
                $retorno['condicao'] = false;
            }

            return $retorno;
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
     * Get the value of idUnidade
     */

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
     * Get the value of senha
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of PdoConn
     */
    public function getPdoConn()
    {
        return $this->PdoConn;
    }

    /**
     * Set the value of PdoConn
     *
     * @return  self
     */
    public function setPdoConn($PdoConn)
    {
        $this->PdoConn = $PdoConn;

        return $this;
    }

    /**
     * Get the value of emailUsuario
     */
    public function getEmailUsuario()
    {
        return $this->emailUsuario;
    }

    /**
     * Set the value of emailUsuario
     *
     * @return  self
     */
    public function setEmailUsuario($emailUsuario)
    {
        $this->emailUsuario = $emailUsuario;

        return $this;
    }

    /**
     * Get the value of unidade
     */
    public function getUnidade()
    {
        return $this->unidade;
    }

    /**
     * Set the value of unidade
     *
     * @return  self
     */
    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * Get the value of prefixoDoc
     */
    public function getPrefixoDoc()
    {
        return $this->prefixoDoc;
    }

    /**
     * Set the value of prefixoDoc
     *
     * @return  self
     */
    public function setPrefixoDoc($prefixoDoc)
    {
        $this->prefixoDoc = $prefixoDoc;

        return $this;
    }

    /**
     * Get the value of validaTipoCadastro
     */
    public function getValidaTipoCadastro()
    {
        return $this->validaTipoCadastro;
    }

    /**
     * Set the value of validaTipoCadastro
     *
     * @return  self
     */
    public function setValidaTipoCadastro($validaTipoCadastro)
    {
        $this->validaTipoCadastro = $validaTipoCadastro;

        return $this;
    }

    /**
     * Get the value of confirmaTermo
     */
    public function getConfirmaTermo()
    {
        return $this->confirmaTermo;
    }

    /**
     * Set the value of confirmaTermo
     *
     * @return  self
     */
    public function setConfirmaTermo($confirmaTermo)
    {
        $this->confirmaTermo = $confirmaTermo;

        return $this;
    }

    /**
     * Get the value of confirme
     */
    public function getConfirme()
    {
        return $this->confirme;
    }

    /**
     * Set the value of confirme
     *
     * @return  self
     */
    public function setConfirme($confirme)
    {
        $this->confirme = $confirme;

        return $this;
    }
}
