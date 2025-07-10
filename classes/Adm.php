<?php



class Adm
{



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


    public function  inserirAgendamento($todos)
    {
        try {


            $pdo = $this->getPdoConn();

            $sql = ('INSERT INTO   agendamento  ( dia ,  idUnidade ,    idStatus ,    idTipoAgendamento ) 
                                                        VALUES(:dia,  :idUnidade,  :idStatus,  :idTipoAgendamento )');

            $stmt = $pdo->prepare($sql);

            $qtdeElementos = sizeof($todos);

            $contador = 0;

            foreach ($todos as $key => $value) {


                 $data =   $value['data'];
                

                $stmt->bindValue(':dia', $data, PDO::PARAM_STR);
                
                $stmt->bindValue(':idUnidade', $value['unidade'], PDO::PARAM_STR);

                $stmt->bindValue(':idStatus', $value['status'], PDO::PARAM_STR);
                $stmt->bindValue(':idTipoAgendamento', $value['agendamento'], PDO::PARAM_STR);
                if ($stmt->execute()) {
                    $contador++;
                } else {

                    $contador--;
                }
            }


      

            if ($contador == $qtdeElementos) {

                return true;
            } else {
                // echo $contador . '    ' . $qtdeElementos;
                return false;
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
