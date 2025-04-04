<?php

class Pessoa extends Conexao
{
    // atributos
    private $id_pessoa;
    private $nome;
    private $cpf;
    private $email;
    private $data_nascimento;
    private $data_cadastro;
    private $telefone;
    private $foto_perfil;
    private $cliente;
    private $prestador;
    private $localidade;
    private $portfolio;
    private $data_inativacao;
    private $status;

    // getters e setters
    public function getIdPessoa()
    {
        return $this->id_pessoa;
    }

    public function setIdPessoa($id_pessoa)
    {
        $this->id_pessoa = $id_pessoa;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getDataNascimento()
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento($data_nascimento)
    {
        $this->data_nascimento = $data_nascimento;
    }

    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }

    public function setDataCadastro($data_cadastro)
    {
        $this->data_cadastro = $data_cadastro;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getFotoPerfil()
    {
        return $this->foto_perfil;
    }

    public function setFotoPerfil($foto_perfil)
    {
        $this->foto_perfil = $foto_perfil;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function getPrestador()
    {
        return $this->prestador;
    }

    public function setPrestador($prestador)
    {
        $this->prestador = $prestador;
    }

    public function getLocalidade()
    {
        return $this->localidade;
    }

    public function setLocalidade($localidade)
    {
        $this->localidade = $localidade;
    }

    public function getPortfolio()
    {
        return $this->portfolio;
    }

    public function setPortfolio($portfolio)
    {
        $this->portfolio = $portfolio;
    }

    public function getDataInativacao()
    {
        return $this->data_inativacao;
    }

    public function setDataInativacao($data_inativacao)
    {
        $this->data_inativacao = $data_inativacao;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    // métodos da classe Pessoa

    public function cadastrarPessoa($nome, $cpf, $email, $data_nascimento, $telefone, $cliente, $prestador, $localidade)
    {
        //setar os atributos
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setEmail($email);
        $this->setDataNascimento($data_nascimento);
        $this->setTelefone($telefone);
        $this->setCliente($cliente);
        $this->setPrestador($prestador);
        $this->setLocalidade($localidade);
        $this->setStatus('Ativo');
    
        // montar query
        $sql = "INSERT INTO tb_pessoa
                (id_pessoa, nome, cpf, email, data_nascimento, data_cadastro, telefone, foto_perfil, cliente, prestador, localidade, status) 
                VALUES (NULL, :nome, :cpf, :email, :data_nascimento, NOW(), :telefone, '', :cliente, :prestador, :localidade, :status)";
    
        // executa a query
        try {
            // conectar com o banco
            $bd = $this->conectar();
            // preparar o sql
            $query = $bd->prepare($sql);
            // blidagem dos dados
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cpf', $this->getCpf(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->bindValue(':data_nascimento', $this->getDataNascimento(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':cliente', $this->getCliente(), PDO::PARAM_INT); // Cliente é um booleano (true/false)
            $query->bindValue(':prestador', $this->getPrestador(), PDO::PARAM_INT); // Prestador é um booleano (true/false)
            $query->bindValue(':localidade', $this->getLocalidade(), PDO::PARAM_STR);
            $query->bindValue(':status', $this->getStatus(), PDO::PARAM_STR);
    
            // excutar a query
            $query->execute();
            // retorna o resultado
            return true;
        } catch (PDOException $e) {
            //print "Erro ao inserir";
            return false;
        }
    }

    public function consultarPessoa($nome_pessoa)
    {
        //setar os atributos
        $this->setNome($nome_pessoa);

        //montar query
        $sql = "SELECT * FROM tb_pessoa where true ";

        //vericar se o nome é nulo
        if ($this->getNome() != null) {
            $sql .= " and nome like :nome";
        }

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            if ($this->getNome() != null) {
                $this->setNome("%" . $nome_pessoa . "%");
                $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            }
            //excutar a query
            $query->execute();
            //retorna o resultado
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;

        } catch (PDOException $e) {
            //print "Erro ao consultar";
            return false;
        }
    }

    public function alterarPessoa($id_pessoa, $nome, $cpf, $email, $data_nascimento, $telefone, $foto_perfil, $cliente, $prestador, $localidade)
    {
        //setar os atributos
        $this->setIdPessoa($id_pessoa);
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setEmail($email);
        $this->setDataNascimento($data_nascimento);
        $this->setTelefone($telefone);
        $this->setFotoPerfil($foto_perfil);
        $this->setCliente($cliente);
        $this->setPrestador($prestador);
        $this->setLocalidade($localidade);

        //montar query
        $sql = "UPDATE tb_pessoa SET nome = :nome, cpf = :cpf, email = :email, data_nascimento = :data_nascimento, telefone = :telefone, foto_perfil = :foto_perfil, cliente = :cliente, prestador = :prestador, localidade = :localidade WHERE id_pessoa = :id_pessoa";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_pessoa', $this->getIdPessoa(), PDO::PARAM_INT);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cpf', $this->getCpf(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->bindValue(':data_nascimento', $this->getDataNascimento(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':foto_perfil', $this->getFotoPerfil(), PDO::PARAM_STR);
            $query->bindValue(':cliente', $this->getCliente(), PDO::PARAM_INT);
            $query->bindValue(':prestador', $this->getPrestador(), PDO::PARAM_INT);
            $query->bindValue(':localidade', $this->getLocalidade(), PDO::PARAM_STR);

            //excutar a query
            $query->execute();
            //retorna o resultado
            return true;

        } catch (PDOException $e) {
            //print "Erro ao alterar";
            return false;
        }
    }

    public function excluirPessoa($id_pessoa)
    {
        //setar os atributos
        $this->setIdPessoa($id_pessoa);
        $this->setStatus('Inativo'); // Definir status como inativo
        //montar query
        $sql = "UPDATE tb_pessoa SET data_inativacao = NOW(), status = :status WHERE id_pessoa = :id_pessoa";

        //executa a query
        try {
            //conectar com o banco
            $bd = $this->conectar();
            //preparar o sql
            $query = $bd->prepare($sql);
            //blidagem dos dados
            $query->bindValue(':id_pessoa', $this->getIdPessoa(), PDO::PARAM_INT);
            $query->bindValue(':status', $this->getStatus(), PDO::PARAM_STR);
            //excutar a query
            $query->execute();
            //retorna o resultado
            return true;
        } catch (PDOException $e) {
            // print "Erro ao excluir: " . $e->getMessage();
            return false;
        }
    }
}
?>