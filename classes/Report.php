<?php



class Report
{



    private $conexao;
    private $dns;
    private $user;
    private $pwd;
    private $idPessoas;
    private $idStatus;
    private $idAgendamento;
    private $idUnidade;
    private $idTipoAgendamento;
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
 
/* select date_format(dia,'%Y-%m-%d' ) as 'dataformatada' ,date_format(dia, '%d/%m/%Y'), count(idAgendamento), st.descricaoStatus, un.nomeUnidade  from agendamento ag
                                        inner join status st on ag.idStatus = st.idStatus  inner join unidade un on ag.idUnidade = un.idUnidade
                                          where dia between  :dataInicial  and  :dataFinal  
                                        group by  date_format(dia, '%d/%m/%Y'),  st.descricaoStatus, un.nomeUnidade   order by dia
                                        */
 


    //metodo que retorna o agendamento da pessoa a partir do clique dela no agendamento clicado
    public function  agendasEmGeral($dataInicial, $dataFinal)
    {
        try {
            


            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare("select nomeUnidade, descricaoStatus,  count(ag.idAgendamento)  as 'qtde'   from agendamento ag inner join status st on ag.idStatus = st.idStatus 
             inner join unidade un on ag.idUnidade = un.idUnidade  where dia between :dataInicial  and  :dataFinal   
               group by   nomeUnidade , descricaoStatus  order by   nomeUnidade ");
                                        

            $stmt->execute(array(':dataInicial' => $dataInicial,  ':dataFinal' => $dataFinal,   ));



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
             
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function  consultaDia($dataInicial)
    {
        try {
            


            $pdo = $this->getPdoConn();

            $stmt = $pdo->prepare(" select date_format(dia, '%d/%m/%Y') as datas , count(ag.idAgendamento)  as 'qtde',  st.descricaoStatus  as descricao
                  from agendamento ag inner join status st on ag.idStatus = st.idStatus  inner join unidade un on ag.idUnidade = un.idUnidade
                                          	  where date_format(dia,'%Y-%m-%d' )=   :dataInicial   
                                          group by date_format(dia, '%d/%m/%Y') , descricao, nomeUnidade order by descricao,  dia asc ");
                                        

            $stmt->execute(array(':dataInicial' => $dataInicial  ));



            $datasDisponiveis = $stmt->fetchAll();


            return $datasDisponiveis;
             
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

 

    public function  registrarAgendamentoUsuario()
    {
        try {

            $pdo = $this->getPdoConn();

            //$pdo = new PDO("mysql:host='" . $host . "' ;dbname='" . $db . "', '" . $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE agendamento SET idPessoa = :idPessoa , idStatus = :idStatus ,  idUnidade= :idUnidade, idTipoAgendamento= :idTipoAgendamento    where idAgendamento= :idAgendamento  ";


            $data = [
                ':idPessoa' =>      $this->getIdPessoas(),
                ':idStatus' =>       $this->getIdStatus(),
                ':idAgendamento' =>  $this->getIdAgendamento(),
                ':idUnidade' => $this->getIdUnidade(),
                ':idTipoAgendamento' => $this->getIdTipoAgendamento()

            ];

            $stmt = $pdo->prepare($sql);



            if ($stmt->execute($data)) {
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
     * Get the value of idStatus
     */
    public function getIdStatus()
    {
        return $this->idStatus;
    }

    /**
     * Set the value of idStatus
     *
     * @return  self
     */
    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;

        return $this;
    }

    /**
     * Get the value of idAgendamento
     */
    public function getIdAgendamento()
    {
        return $this->idAgendamento;
    }

    /**
     * Set the value of idAgendamento
     *
     * @return  self
     */
    public function setIdAgendamento($idAgendamento)
    {
        $this->idAgendamento = $idAgendamento;

        return $this;
    }

    /**
     * Get the value of unidade
     */


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
}
