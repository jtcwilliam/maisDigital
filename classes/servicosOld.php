<?php





class servicosFacil
{

    private $conexao;

    function getConexao()
    {
        return $this->conexao;
    }



    function setConexao($conexao)
    {
        $this->conexao = $conexao;
    }



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




    public function trazerServicos()
    {

        $sql = "select  * from linkCartaServico ";

        $executar = mysqli_query($this->getConexao(), $sql);

        while ($row = mysqli_fetch_assoc($executar)) {

            $dados[] = $row;
        }

        if (isset($dados)) {

            return $dados;
        } else {
        }
    }



    public function consultarDadosServicos($info)
    {

        $sql = "SELECT * FROM  links where idlinks  = '" . $info . "'";

        $executar = mysqli_query($this->getConexao(), $sql);

        while ($row = mysqli_fetch_assoc($executar)) {

            $dados[] = $row;
        }

        if (isset($dados)) {

            return $dados;
        } else {
        }
    }

    public function consultarDadosServicosTextos($info)
    {

        $sql = "SELECT * FROM  links where nomeDoLink  like '%" . $info . "%'";



        $executar = mysqli_query($this->getConexao(), $sql);

        $dados = array();

        while ($row = mysqli_fetch_assoc($executar)) {


            $dados[] = $row;
        }

        if (sizeof($dados) > 0) {

            return $dados;
            exit();
        } else {


            return $dados[] = false;
        }
    }
}
