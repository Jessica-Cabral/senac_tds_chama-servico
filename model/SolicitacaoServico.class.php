<?php
// Incluir classe de conexão
include_once 'Conexao.class.php';

// Classe SolicitacaoServico
class SolicitacaoServico extends Conexao
{
    // Atributos
    private $id_solicitacao;
    private $descricao_solicitacao;
    private $id_endereco;
    private $data_abertura;
    private $data_fim;
    private $img_solicitacao;
    private $id_status_solicitacao;
    private $id_pessoa;
    private $id_servico;
    private $id_prestador;
    private $orcamento;


    // Getters e Setters
    public function getIdSolicitacao()
    {
        return $this->id_solicitacao;
    }

    public function setIdSolicitacao($id_solicitacao)
    {
        $this->id_solicitacao = $id_solicitacao;
    }

    public function getDescricaoSolicitacao()
    {
        return $this->descricao_solicitacao;
    }

    public function setDescricaoSolicitacao($descricao_solicitacao)
    {
        $this->descricao_solicitacao = $descricao_solicitacao;
    }

    public function getIdEndereco()
    {
        return $this->id_endereco;
    }

    public function setIdEndereco($id_endereco)
    {
        $this->id_endereco = $id_endereco;
    }

    public function getDataAbertura()
    {
        return $this->data_abertura;
    }

    public function setDataAbertura($data_abertura)
    {
        $this->data_abertura = $data_abertura;
    }

    public function getDataFim()
    {
        return $this->data_fim;
    }

    public function setDataFim($data_fim)
    {
        $this->data_fim = $data_fim;
    }

    public function getImgSolicitacao()
    {
        return $this->img_solicitacao;
    }

    public function setImgSolicitacao($img_solicitacao)
    {
        $this->img_solicitacao = $img_solicitacao;
    }

    public function getIdStatusSolicitacao()
    {
        return $this->id_status_solicitacao;
    }

    public function setIdStatusSolicitacao($id_status_solicitacao)
    {
        $this->id_status_solicitacao = $id_status_solicitacao;
    }

    public function getIdPessoa()
    {
        return $this->id_pessoa;
    }

    public function setIdPessoa($id_pessoa)
    {
        $this->id_pessoa = $id_pessoa;
    }

    public function getIdServico()
    {
        return $this->id_servico;
    }

    public function setIdServico($id_servico)
    {
        $this->id_servico = $id_servico;
    }

    public function getIdPrestador()
    {
        return $this->id_prestador;
    }

    public function setIdPrestador($id_prestador)
    {
        $this->id_prestador = $id_prestador;
    }

    public function getOrcamento()
    {
        return $this->orcamento;
    }

    public function setOrcamento($orcamento)
    {
        $this->orcamento = $orcamento;
    }

    /**
     * Método para inserir uma solicitação de serviço
     */
    public function inserirServico($id_solicitacao, $descricao_solicitacao,
        $id_endereco, $data_abertura, $data_fim, $img_solicitacao, $id_status_solicitacao, $id_pessoa, $id_servico)
    {
        // Setar os atributos
        $this->setIdSolicitacao($id_solicitacao);
        $this->setDescricaoSolicitacao($descricao_solicitacao);
        $this->setIdEndereco($id_endereco);
        $this->setDataAbertura($data_abertura);
        $this->setDataFim($data_fim);
        $this->setImgSolicitacao($img_solicitacao);
        $this->setIdStatusSolicitacao($id_status_solicitacao);
        $this->setIdPessoa($id_pessoa);
        $this->setIdServico($id_servico);

        // Montar query
        $sql = "INSERT INTO tb_solicitacao 
                (id_solicitacao, descricao_solicitacao, id_endereco, data_abertura, data_fim, img_solicitacao, id_status_solicitacao, id_pessoa, id_servico) 
                VALUES (:id_solicitacao, :descricao_solicitacao, :id_endereco, :data_abertura, :data_fim, :img_solicitacao, :id_status_solicitacao, :id_pessoa, :id_servico)";

        // Executar a query
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_solicitacao', $this->getIdSolicitacao(), PDO::PARAM_INT);
            $query->bindValue(':descricao_solicitacao', $this->getDescricaoSolicitacao(), PDO::PARAM_STR);
            $query->bindValue(':id_endereco', $this->getIdEndereco(), PDO::PARAM_INT);
            $query->bindValue(':data_abertura', $this->getDataAbertura(), PDO::PARAM_STR);
            $query->bindValue(':data_fim', $this->getDataFim(), PDO::PARAM_STR);
            $query->bindValue(':img_solicitacao', $this->getImgSolicitacao(), PDO::PARAM_STR);
            $query->bindValue(':id_status_solicitacao', $this->getIdStatusSolicitacao(), PDO::PARAM_INT);
            $query->bindValue(':id_pessoa', $this->getIdPessoa(), PDO::PARAM_INT);
            $query->bindValue(':id_servico', $this->getIdServico(), PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) {
            error_log("Erro ao inserir serviço: " . $e->getMessage());
            return false;
        }
    }
    
    // ... [mantenha os outros métodos existentes]
}
?>