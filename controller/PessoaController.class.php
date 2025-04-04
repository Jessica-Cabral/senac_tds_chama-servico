<?php


class PessoaController
{
    //redirecionar pagina
    public function redirecionar($pagina)
    {
        //iniciar sessao
        session_start();
        //incluir menu
        $menu = $this->menu();
        //incluir a view
        require_once 'views/' . $pagina . '.php';
    }    

    public function cadastrarPessoa()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];
            $data_nascimento = $_POST['data_nascimento'];
            $telefone = $_POST['telefone'];
            $cliente = isset($_POST['cliente']) ? 1 : 0; // Converte checkbox em booleano
            $prestador = isset($_POST['prestador']) ? 1 : 0; // Converte checkbox em booleano
            $localidade = $_POST['localidade'];

            if ($this->pessoa->cadastrarPessoa($nome, $cpf, $email, $data_nascimento, $telefone, $cliente, $prestador, $localidade)) {
                echo "Pessoa cadastrada com sucesso!";
            } else {
                echo "Erro ao cadastrar pessoa.";
            }
        }
    }

    public function consultar($nome = null)
    {
        $resultado = $this->pessoa->consultarPessoa($nome);

        if ($resultado) {
            header('Content-Type: application/json'); // Resposta como JSON
            echo json_encode($resultado);
        } else {
            echo "Nenhuma pessoa encontrada.";
        }
    }

    public function alterar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pessoa = $_POST['id_pessoa'];
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];
            $data_nascimento = $_POST['data_nascimento'];
            $telefone = $_POST['telefone'];
            $foto_perfil = $_POST['foto_perfil'];
            $cliente = isset($_POST['cliente']) ? 1 : 0;
            $prestador = isset($_POST['prestador']) ? 1 : 0;
            $localidade = $_POST['localidade'];

            if ($this->pessoa->alterarPessoa($id_pessoa, $nome, $cpf, $email, $data_nascimento, $telefone, $foto_perfil, $cliente, $prestador, $localidade)) {
                echo "Pessoa alterada com sucesso!";
            } else {
                echo "Erro ao alterar pessoa.";
            }
        }
    }

    public function excluir($id_pessoa)
    {
        if ($this->pessoa->excluirPessoa($id_pessoa)) {
            echo "Pessoa inativada com sucesso!";
        } else {
            echo "Erro ao inativar pessoa.";
        }
    }
}
?>