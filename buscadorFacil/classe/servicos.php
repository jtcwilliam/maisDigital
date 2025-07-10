<?php

 



class servicosFacil
{




    private $conexao;
    private $pagina;
    private $formaAtendimento;
    private $prazoExecucao;
    private $tituloServico;
    private $sistemaLegado;
    private $oQueE;
    private $quandoNecessario;
    private $unidadeExecutora;
    private $tipo;
    private $esfera;
    private $numero;
    private $ano;
    private $textoCompletoLei;
    private $caminhoLegislacao;
    private $descricaoTaxa;
    private $unidade;
    private $ufg;
    private $valorReais;


 





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
        include_once 'db.php';
        //criar uma instancia de conexao;
        $objConectar = new Conexao();

        //chamar o metdo conectar
        $banco = $objConectar->Conectar();

        //criar uma instancia dessa nova conexao
        $this->setConexao($banco);
    }

  

    public function  inserirOrdem($nomeOrdemo)
    {
        $sql = "INSERT INTO  ordemAnexo (nomeOrdemAnexo, valor) VALUES ('Ordem de Anexo - ".$nomeOrdemo."',1)";

         

        $executar = mysqli_query($this->getConexao(), $sql);

        if ($executar == true) {

            return true;
        } else {

            return false;
        }
    }

 

    public function trazerServicos()
    {

        $sql = "select  * from arquivos ";

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

        $consulta= array();

        $consulta[0] = $info;
 
        $sql = "select  * from servicosfacil where tituloServico = '".$consulta[0]."'"  ;

       

        $executar = mysqli_query($this->getConexao(), $sql);

        while ($row = mysqli_fetch_assoc($executar)) {

            $dados[] = $row;
        }

        if (isset($dados)) {

            return $dados;
        } else {
        }
    }






   

    /**
     * Get the value of valorReais
     */ 
    public function getValorReais()
    {
        return $this->valorReais;
    }

    /**
     * Set the value of valorReais
     *
     * @return  self
     */ 
    public function setValorReais($valorReais)
    {
        $this->valorReais = $valorReais;

        return $this;
    }

    /**
     * Get the value of ufg
     */ 
    public function getUfg()
    {
        return $this->ufg;
    }

    /**
     * Set the value of ufg
     *
     * @return  self
     */ 
    public function setUfg($ufg)
    {
        $this->ufg = $ufg;

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
     * Get the value of descricaoTaxa
     */ 
    public function getDescricaoTaxa()
    {
        return $this->descricaoTaxa;
    }

    /**
     * Set the value of descricaoTaxa
     *
     * @return  self
     */ 
    public function setDescricaoTaxa($descricaoTaxa)
    {
        $this->descricaoTaxa = $descricaoTaxa;

        return $this;
    }

    /**
     * Get the value of caminhoLegislacao
     */ 
    public function getCaminhoLegislacao()
    {
        return $this->caminhoLegislacao;
    }

    /**
     * Set the value of caminhoLegislacao
     *
     * @return  self
     */ 
    public function setCaminhoLegislacao($caminhoLegislacao)
    {
        $this->caminhoLegislacao = $caminhoLegislacao;

        return $this;
    }

    /**
     * Get the value of otextoCompletoLei
     */ 
    public function getTextoCompletoLei()
    {
        return $this->textoCompletoLei;
    }

    /**
     * Set the value of otextoCompletoLei
     *
     * @return  self
     */ 
    public function setTextoCompletoLei($textoCompletoLei)
    {
        $this->textoCompletoLei = $textoCompletoLei;

        return $this;
    }

    /**
     * Get the value of ano
     */ 
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Set the value of ano
     *
     * @return  self
     */ 
    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of esfera
     */ 
    public function getEsfera()
    {
        return $this->esfera;
    }

    /**
     * Set the value of esfera
     *
     * @return  self
     */ 
    public function setEsfera($esfera)
    {
        $this->esfera = $esfera;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of unidadeExecutora
     */ 
    public function getUnidadeExecutora()
    {
        return $this->unidadeExecutora;
    }

    /**
     * Set the value of unidadeExecutora
     *
     * @return  self
     */ 
    public function setUnidadeExecutora($unidadeExecutora)
    {
        $this->unidadeExecutora = $unidadeExecutora;

        return $this;
    }

    /**
     * Get the value of quandoNecessario
     */ 
    public function getQuandoNecessario()
    {
        return $this->quandoNecessario;
    }

    /**
     * Set the value of quandoNecessario
     *
     * @return  self
     */ 
    public function setQuandoNecessario($quandoNecessario)
    {
        $this->quandoNecessario = $quandoNecessario;

        return $this;
    }

    /**
     * Get the value of oQueE
     */ 
    public function getOQueE()
    {
        return $this->oQueE;
    }

    /**
     * Set the value of oQueE
     *
     * @return  self
     */ 
    public function setOQueE($oQueE)
    {
        $this->oQueE = $oQueE;

        return $this;
    }

    /**
     * Get the value of sistemaLegado
     */ 
    public function getSistemaLegado()
    {
        return $this->sistemaLegado;
    }

    /**
     * Set the value of sistemaLegado
     *
     * @return  self
     */ 
    public function setSistemaLegado($sistemaLegado)
    {
        $this->sistemaLegado = $sistemaLegado;

        return $this;
    }

    /**
     * Get the value of tituloServico
     */ 
    public function getTituloServico()
    {
        return $this->tituloServico;
    }

    /**
     * Set the value of tituloServico
     *
     * @return  self
     */ 
    public function setTituloServico($tituloServico)
    {
        $this->tituloServico = $tituloServico;

        return $this;
    }

    /**
     * Get the value of prazoExecucao
     */ 
    public function getPrazoExecucao()
    {
        return $this->prazoExecucao;
    }

    /**
     * Set the value of prazoExecucao
     *
     * @return  self
     */ 
    public function setPrazoExecucao($prazoExecucao)
    {
        $this->prazoExecucao = $prazoExecucao;

        return $this;
    }

    /**
     * Get the value of formaAtendimento
     */ 
    public function getFormaAtendimento()
    {
        return $this->formaAtendimento;
    }

    /**
     * Set the value of formaAtendimento
     *
     * @return  self
     */ 
    public function setFormaAtendimento($formaAtendimento)
    {
        $this->formaAtendimento = $formaAtendimento;

        return $this;
    }

    /**
     * Get the value of pagina
     */ 
    public function getPagina()
    {
        return $this->pagina;
    }

    /**
     * Set the value of pagina
     *
     * @return  self
     */ 
    public function setPagina($pagina)
    {
        $this->pagina = $pagina;

        return $this;
    }
}
