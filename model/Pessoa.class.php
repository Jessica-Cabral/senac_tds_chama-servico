<?php

//Classe Pessoa
class Pessoa
{
    //atributos
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
    
    //getters e setters
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

    // métodos da classe Pessoa

    public function cadastrarPessoa()
    {
        //setar os atributos
        $this->setIdPessoa
        $this->setNome
        $this->setCpf
        $this->setEmail
        $this->setDataNascimento
        $this->setDataCadastro
        $this->setTelefone
        $this->setFotoPerfil
        $this->setCliente
        $this->setPrestador
        $this->setLocalidade
        $this->setPortfolio

        //motar query
        $sql = INSERT INTO tb_pessoa
            (id_pessoa, nome, email, data_nascimento, data_cadastro, data_inativacao, telefone, senha, foto_perfil, cliente, prestador, localidade, cpf) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]','[value-13]')

    }
}

