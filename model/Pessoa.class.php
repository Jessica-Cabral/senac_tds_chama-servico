<?php
// Incluir classe de conexão
include_once 'Conexao.class.php';

// Classe Pessoa
class Pessoa extends Conexao
{
    // Atributos
    private $id_pessoa;
    private $nome;
    private $email;
    private $data_nascimento;
    private $documento_usuario;
    private $data_inativacao;
    private $telefone;
    private $senha;
    private $foto_perfil;
    private $cliente;
    private $prestador;

    // Getters e Setters
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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getIdStatusUsuario()
    {
        return $this->id_status_usuario;
    }

    public function setIdStatusUsuario($id_status_usuario)
    {
        $this->id_status_usuario = $id_status_usuario;
    }

    public function getDocumentoUsuario()
    {
        return $this->documento_usuario;
    }

    public function setDocumentoUsuario($documento_usuario)
    {
        $this->documento_usuario = $documento_usuario;
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

    public function getDataInativacao()
    {
        return $this->data_inativacao;
    }

    public function setDataInativacao($data_inativacao)
    {
        $this->data_inativacao = $data_inativacao;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
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

    // Método para inserir uma pessoa
    public function inserirPessoa($nome, $email, $id_status_usuario, $documento_usuario, $data_nascimento, $telefone, $senha, $foto_perfil, $cliente, $prestador)
    {
        // Setar os atributos
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setIdStatusUsuario($id_status_usuario);
        $this->setDocumentoUsuario($documento_usuario);
        $this->setDataNascimento($data_nascimento);
        $this->setDataCadastro(date('Y-m-d H:i:s')); // Data atual
        $this->setTelefone($telefone);
        $this->setSenha($senha);
        $this->setFotoPerfil($foto_perfil);
        $this->setCliente($cliente);
        $this->setPrestador($prestador);

        // Montar query
        $sql = "INSERT INTO tb_pessoa (id_pessoa, nome, email, id_status_usuario, documento_usuario, data_nascimento, data_cadastro, telefone, senha, foto_perfil, cliente, prestador) 
                VALUES (NULL, :nome, :email, :id_status_usuario, :documento_usuario, :data_nascimento, :data_cadastro, :telefone, :senha, :foto_perfil, :cliente, :prestador)";

        // Executar a query
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->bindValue(':id_status_usuario', $this->getIdStatusUsuario(), PDO::PARAM_INT);
            $query->bindValue(':documento_usuario', $this->getDocumentoUsuario(), PDO::PARAM_STR);
            $query->bindValue(':data_nascimento', $this->getDataNascimento(), PDO::PARAM_STR);
            $query->bindValue(':data_cadastro', $this->getDataCadastro(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':senha', $this->getSenha(), PDO::PARAM_STR);
            $query->bindValue(':foto_perfil', $this->getFotoPerfil(), PDO::PARAM_STR);
            $query->bindValue(':cliente', $this->getCliente(), PDO::PARAM_INT);
            $query->bindValue(':prestador', $this->getPrestador(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Método para consultar pessoas
    public function consultarPessoa($nome = null, $email = null)
    {
        // Montar query
        $sql = "SELECT * FROM tb_pessoa WHERE true ";

        if ($nome != null) {
            $sql .= " AND nome LIKE :nome ";
            $this->setNome("%" . $nome . "%");
        }
        if ($email != null) {
            $sql .= " AND email LIKE :email ";
            $this->setEmail("%" . $email . "%");
        }

        $sql .= " ORDER BY nome";

        // Executar a query
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            if ($nome != null) {
                $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            }
            if ($email != null) {
                $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            }
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Método para alterar uma pessoa
    public function alterarPessoa($id_pessoa, $nome, $email, $id_status_usuario, $documento_usuario, $data_nascimento, $telefone, $senha, $foto_perfil, $cliente, $prestador)
    {
        // Setar os atributos
        $this->setIdPessoa($id_pessoa);
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setIdStatusUsuario($id_status_usuario);
        $this->setDocumentoUsuario($documento_usuario);
        $this->setDataNascimento($data_nascimento);
        $this->setTelefone($telefone);
        $this->setSenha($senha);
        $this->setFotoPerfil($foto_perfil);
        $this->setCliente($cliente);
        $this->setPrestador($prestador);

        // Montar query
        $sql = "UPDATE tb_pessoa 
                SET nome = :nome, email = :email, id_status_usuario = :id_status_usuario, 
                    documento_usuario = :documento_usuario, data_nascimento = :data_nascimento, 
                    telefone = :telefone, senha = :senha, foto_perfil = :foto_perfil, 
                    cliente = :cliente, prestador = :prestador 
                WHERE id_pessoa = :id_pessoa";

        // Executar a query
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_pessoa', $this->getIdPessoa(), PDO::PARAM_INT);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->bindValue(':id_status_usuario', $this->getIdStatusUsuario(), PDO::PARAM_INT);
            $query->bindValue(':documento_usuario', $this->getDocumentoUsuario(), PDO::PARAM_STR);
            $query->bindValue(':data_nascimento', $this->getDataNascimento(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':senha', $this->getSenha(), PDO::PARAM_STR);
            $query->bindValue(':foto_perfil', $this->getFotoPerfil(), PDO::PARAM_STR);
            $query->bindValue(':cliente', $this->getCliente(), PDO::PARAM_INT);
            $query->bindValue(':prestador', $this->getPrestador(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Método para excluir uma pessoa
    public function excluirPessoa($id_pessoa)
    {
        // Setar os atributos
        $this->setIdPessoa($id_pessoa);

        // Montar query
        $sql = "DELETE FROM tb_pessoa WHERE id_pessoa = :id_pessoa";

        // Executar a query
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_pessoa', $this->getIdPessoa(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Método para inativar uma pessoa (atualiza a data de inativação)
    public function inativarPessoa($id_pessoa)
    {
        // Setar os atributos
        $this->setIdPessoa($id_pessoa);
        $this->setDataInativacao(date('Y-m-d H:i:s')); // Data atual

        // Montar query
        $sql = "UPDATE tb_pessoa SET data_inativacao = :data_inativacao WHERE id_pessoa = :id_pessoa";

        // Executar a query
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_pessoa', $this->getIdPessoa(), PDO::PARAM_INT);
            $query->bindValue(':data_inativacao', $this->getDataInativacao(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}

// Testar a classe (exemplo de uso)
/*
$objPessoa = new Pessoa();

// Inserir uma pessoa
$resultado = $objPessoa->inserirPessoa(
    'João Silva',
    'joao.silva@email.com',
    1,
    '12345678901',
    '1990-05-15',
    '11987654321',
    'senha123',
    'foto_joao.jpg',
    1,
    0
);
if ($resultado) {
    print "Pessoa inserida com sucesso!<br>";
} else {
    print "Erro ao inserir pessoa.<br>";
}

// Consultar pessoas
$pessoas = $objPessoa->consultarPessoa('João', null);
foreach ($pessoas as $pessoa) {
    print "ID: {$pessoa->id_pessoa} / Nome: {$pessoa->nome} / Email: {$pessoa->email}<br>";
}

// Alterar uma pessoa
$resultado = $objPessoa->alterarPessoa(
    1,
    'João Silva Alterado',
    'joao.silva.novo@email.com',
    2,
    '12345678901',
    '1990-05-15',
    '11987654321',
    'nova_senha123',
    'nova_foto_joao.jpg',
    1,
    1
);
if ($resultado) {
    print "Pessoa alterada com sucesso!<br>";
} else {
    print "Erro ao alterar pessoa.<br>";
}

// Inativar uma pessoa
$resultado = $objPessoa->inativarPessoa(1);
if ($resultado) {
    print "Pessoa inativada com sucesso!<br>";
} else {
    print "Erro ao inativar pessoa.<br>";
}

// Excluir uma pessoa
$resultado = $objPessoa->excluirPessoa(1);
if ($resultado) {
    print "Pessoa excluída com sucesso!<br>";
} else {
    print "Erro ao excluir pessoa.<br>";
}
*/