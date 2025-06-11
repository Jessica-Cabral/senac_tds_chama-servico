<?php

// A classe de controle a ligação entre os models e as classes
class Controller
{
    //atributos

    //métodos

    //redirecionar página
    public function redirecionar($pagina)
    {
        //iniciar sessao
        session_start();
        $menu = $this->menu();
        //incluir a view
       // print 'view/' . $pagina . '.php';
       // die();
        include_once 'view/' . $pagina . '.php';
    }
    

    public function abrirHomepage()
    {
              //incluir a view
        include_once 'view/HomeServico.php';
    }


    
    public function recuperarSenha()
    {
              //incluir a view
        include_once 'view/Recuperar.php';
    }

    public function abrirformpessoa()
    {
              //incluir a view
        include_once 'view/CadPessoa.php';
    }
  
      //validar loginAdmin
    public function validarAdmin($email, $senha)
    {
        //instanciar a classe Usuário
        $objUsuario = new Usuario();
        //validar usuario
        if ($objUsuario->validarAdmin($email, $senha) == true) {
            //iniciar sessao
            session_start();
            //iniciar variaves de sessao
            $_SESSION['email'] = $email;
            $_SESSION['perfil'] = 'admin';      
            //menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/Principal.php';
        } else {
            include_once 'LoginAdmin.php';
            $this->mostrarMensagem("Login ou senha inválidos!");
        }
    }

    //validar Pessoa - login
    public function validar($email, $senha)
    {
        // Inicializar a variável de mensagem de erro
        $errorMessage = '';
    
        // Validar se os campos estão vazios
        if (empty($email) || empty($senha)) {
            $errorMessage = "Por favor, digite seu email e senha.";
            include_once "Login.php";
            return; // Para a execução do método
        }
    
        // Instanciar a classe Pessoa
        $objPessoa = new Pessoa();
    
        // Validar Pessoa
        if ($objPessoa->validarPessoa($email, $senha) == true) {
            // Iniciar sessão
            session_start();
            // Iniciar as variáveis de sessão
            $_SESSION['email'] = $email;
            //$_SESSION['prestador'] = $objPessoa->perfilPrestador($email);
            $_SESSION['perfil'] = $objPessoa ->perfilPessoa($email);
            //Pegar ID_PESSOA
            $id_pessoa = $objPessoa->consultarIdPessoa($email);
            // var_dump($id_pessoa);
            // die();
            //CONSULTAR PESSOA PELO ID
            $_SESSION['dadosPessoa'] = $objPessoa->consultarDadosPessoa($id_pessoa);
            // var_dump($_SESSION['dadosPessoa']);
            // die();

 
            // Menu
            $menu = $this->menu();
            // Incluir a view
            include_once "view/Principal.php";
        } else {
            // Definir mensagem de erro para login inválido
            $errorMessage = "Login ou senha inválidos!";
            include_once "Login.php";
        }
    }

    public function validarSessao()
    {
        //verificar variaveis de sessao
        if (!isset($_SESSION['email']) and !isset($_SESSION['ativo'])) {
            //acesso negado
            header("location: Login.php");
        }
    }

    //Class Servico
    public function abrirformCadServico()
{
               //incluir a view
               include_once 'view/CadPessoa.php';
}



//Class Pessoa
    public function cadastrar_pessoa($nome, $email, $cpf, $data_nascimento, $telefone, $senha, $foto_perfil, $cliente, $prestador)
    {
        // Instanciar a classe Pessoa
        $objPessoa = new Pessoa();
        // Invocar o método, agora passando 8 argumentos incluindo $senha
        if ($objPessoa->cadastrarPessoa($nome, $cpf, $email, $data_nascimento, $telefone, $senha, $cliente, $prestador) == true) {
            // Iniciar sessão
            session_start();
            // Menu
            // Incluir a view
            include_once "view/Login.php";
            // Mostrar mensagem
            //$this->mostrarMensagem("Pessoa incluída com sucesso!");
        } else {
            // Iniciar sessão
            session_start();
            // Menu
            
            // Incluir a view
            include_once "view/Login.php";
            // Mostrar mensagem
            $this->mostrarMensagem("Erro ao incluir pessoa!");
        }
    }
    public function consultar_pessoa($nome = null, $email = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Inicia a sessão apenas se não estiver ativa
        }

        $objPessoa = new Pessoa();
        $resultado = $objPessoa->consultarPessoa($nome, $email);
        $menu = $this->menu();

        if ($resultado === false) {
            $this->mostrarMensagem("Erro ao consultar!");
        }

        include_once "view/AlterarPessoa.php";
    }
    public function alterar_pessoa($id_pessoa,$telefone, $foto_perfil, $cliente, $prestador)
    {
        //pasta onde o arquivo será salvo
        $local = "assets/img/";
        //nome da imagem
        $nome_arquivo = $foto_perfil['name'];
        //gerar codigo aleatrorio
        $codigo = strtoupper(substr(md5(date("YmdHis")), 1, 7));
        
        //caminho da imagem
        $caminho_imagem = $local . $codigo . $nome_arquivo;
        //mover para pasta assets/img
        move_uploaded_file($foto_perfil['tmp_name'], $local . $codigo . $nome_arquivo);
    
        // Instanciar a classe Pessoa
        $objPessoa = new Pessoa();

        // Invocar o método
        if ($objPessoa->alterarPessoa($id_pessoa,$telefone, $caminho_imagem, $cliente, $prestador) == true) {
        
            $_SESSION['dadosPessoa'] = $objPessoa->consultarDadosPessoa($id_pessoa);
            
            $_SESSION['dadosPessoa'];
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/AlterarPessoa.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Pessoa alterada com sucesso!");
        } else {
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/AlterarPessoa.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar pessoa!");
        }
    }

    public function excluir_pessoa($id_pessoa)
    {
        // Instanciar a classe Pessoa
        $objPessoa = new Pessoa();

        // Invocar o método
        if ($objPessoa->excluirPessoa($id_pessoa) == true) {
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/ConsultarPessoa.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Pessoa excluída com sucesso!");
        } else {
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/ConsultarPessoa.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir pessoa!");
        }
    }


    // Inativar pessoa
    public function inativar_pessoa($id_pessoa)
    {
        // Instanciar a classe Pessoa
        $objPessoa = new Pessoa();

        // Invocar o método
        if ($objPessoa->inativarPessoa($id_pessoa) == true) {
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/ConsultarPessoa.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Pessoa inativada com sucesso!");
        } else {
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/ConsultarPessoa.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Erro ao inativar pessoa!");
        }
    }
    //Class Serviço



    // Class PessoaAdmin
    public function consultar_pessoa_admin($nome = null, $email = null)
    {
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Inicia a sessão apenas se não estiver ativa
        }

        $objPessoa = new PessoaAdmin();
        $resultado = $objPessoa->consultarPessoaAdmin($nome, $email);
        $menu = $this->menu();

        if ($resultado === false) {
            $this->mostrarMensagem("Erro ao consultar!");
        }

        include_once "view/AdminPessoa.php";
    }

    public function alterar_pessoa_admin($id_pessoa,$nome,$telefone,$email,$status, $cliente, $prestador)
    {

    
        // Instanciar a classe Pessoa
        $objPessoa = new PessoaAdmin();

        // Invocar o método
        if ($objPessoa->alterarPessoaAdmin($id_pessoa,$nome,$telefone,$email,$status, $cliente, $prestador) == true) {
        
            $_SESSION['dadosPessoa'] = $objPessoa->consultarDadosPessoaAdmin($id_pessoa);
            
            $_SESSION['dadosPessoa'];
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/AdminPessoa.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Pessoa alterada com sucesso!");
        } else {
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/AdminPessoa.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar pessoa!");
        }
    }
    public function excluir_pessoa_admin($id_pessoa)
    {
        // Instanciar a classe Pessoa
        $objPessoa = new PessoaAdmin();

        // Invocar o método
        if ($objPessoa->excluirPessoaAdmin($id_pessoa) == true) {
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/ConsultarPessoa.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Pessoa excluída com sucesso!");
        } else {
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/ConsultarPessoa.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir pessoa!");
        }
    }
    //Classe PrestadorAdmin
    public function consultar_prestador_admin($nome = null, $cpf = null)
    {
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Inicia a sessão apenas se não estiver ativa
        }

        $objPrestador = new PrestadorAdmin();
        $resultado = $objPrestador->consultarPrestadorAdmin($nome, $cpf);
        $menu = $this->menu();

        if ($resultado === false) {
            $this->mostrarMensagem("Erro ao consultar!");
        }

        include_once "view/AdminPrestador.php";
    }
    public function alterar_prestador_admin($id_prestador,$nome,$telefone,$email,$status, $cliente, $prestador)
    {

    
        // Instanciar a classe Pessoa
        $objPrestador = new PrestadorAdmin();

        // Invocar o método
        if ($objPrestador->alterarPrestadorAdmin($id_prestador,$nome,$telefone,$email,$status, $cliente, $prestador) == true) {
        
            $_SESSION['dadosPrestador'] = $objPrestador->consultarDadosPrestadorAdmin($id_prestador);
            
            $_SESSION['dadosPrestador'];
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/AdminPrestador.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Prestador alterado com sucesso!");
        } else {
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/AdminPrestador.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar prestador!");
        }
    }
    public function excluir_prestador_admin($id_prestador)
    {
        // Instanciar a classe Pessoa
        $objPrestador = new PrestadorAdmin();

        // Invocar o método
        if ($objPrestador->excluirPrestadorAdmin($id_prestador) == true) {
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/ConsultarPrestador.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Prestador excluído com sucesso!");
        } else {
            // Iniciar sessão
            session_start();
            // Inserir menu
            $menu = $this->menu();
            // Incluir a view
            include_once 'view/ConsultarPrestador.php';
            // Mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir prestador!");
        }
    }

    // Alterar pessoa

    // Inserir prestador
    public function InserirPrestador($nome, $cpf, $data_nascimento, $telefone, $email, $endereco, $imagem)
    {
        // Pasta onde a foto de perfil será salva
        $local = "assets/img/";
        // Nome do arquivo da imagem
        $nome_arquivo = $imagem['name'];
        // Gerar um código aleatório para evitar conflitos de nome
        $codigo = strtoupper(substr(md5(date("YmdHis")), 1, 7));
        // Caminho completo da imagem
        $caminho_imagem = $local . $codigo . $nome_arquivo;
        // Mover a imagem para a pasta assets/img
        move_uploaded_file($imagem['tmp_name'], $local . $codigo . $nome_arquivo);

        // Instanciar a classe Prestador
        $objPrestador = new Prestador();
        // Invocar o método para inserir o prestador no banco de dados
        if ($objPrestador->InserirPrestador($nome, $cpf, $data_nascimento, $telefone, $email, $endereco, $caminho_imagem) == true) {
            // Iniciar sessão
            session_start();
            // Inserir o menu baseado no perfil do usuário
            $menu = $this->menu();
            // Incluir a view de consulta de prestadores
            include_once 'view/ConsultarPrestador.php';
            // Mostrar mensagem de sucesso
            $this->mostrarMensagem("Prestador inserido com sucesso!");
        } else {
            // Iniciar sessão
            session_start();
            // Inserir o menu baseado no perfil do usuário
            $menu = $this->menu();
            // Incluir a view de consulta de prestadores
            include_once 'view/ConsultarPrestador.php';
            // Mostrar mensagem de erro
            $this->mostrarMensagem("Erro ao inserir Prestador!");
        }
    }

    // Consultar prestador
    public function ConsultarPrestador($nome, $cpf)
    {
        // Instanciar a classe Prestador
        $objPrestador = new Prestador();
        // Invocar o método para consultar prestadores no banco de dados
        if ($objPrestador->ConsultarPrestador($nome, $cpf) == false) {
            // Iniciar sessão
            session_start();
            // Inserir o menu baseado no perfil do usuário
            $menu = $this->menu();
            // Incluir a view de consulta de prestadores
            include_once 'view/ConsultarPrestador.php';
            // Mostrar mensagem de erro
            $this->mostrarMensagem("Erro ao consultar!");
        } else {
            // Iniciar sessão
            session_start();
            // Inserir o menu baseado no perfil do usuário
            $menu = $this->menu();
            // Armazenar o resultado da consulta
            $resultado = $objPrestador->ConsultarPrestador($nome, $cpf);
            // Incluir a view de consulta de prestadores
            include_once 'view/ConsultarPrestador.php';
        }
    }

    // Excluir prestador
    public function ExcluirPrestador($id_prestador)
    {
        // Instanciar a classe Prestador
        $objPrestador = new Prestador();
        // Invocar o método para excluir o prestador do banco de dados
        if ($objPrestador->ExcluirPrestador($id_prestador) == true) {
            // Iniciar sessão
            session_start();
            // Inserir o menu baseado no perfil do usuário
            $menu = $this->menu();
            // Incluir a view de consulta de prestadores
            include_once 'view/ConsultarPrestador.php';
            // Mostrar mensagem de sucesso
            $this->mostrarMensagem("Prestador excluído com sucesso!");
        } else {
            // Iniciar sessão
            session_start();
            // Inserir o menu baseado no perfil do usuário
            $menu = $this->menu();
            // Incluir a view de consulta de prestadores
            include_once 'view/ConsultarPrestador.php';
            // Mostrar mensagem de erro
            $this->mostrarMensagem("Erro ao excluir Prestador!");
        }
    }

    // Alterar prestador
    public function AlterarPrestador($id_prestador, $nome, $cpf, $data_nascimento, $telefone, $email, $endereco, $imagem = null)
    {
        // Verificar se uma nova imagem foi enviada
        if ($imagem && $imagem['name'] != '') {
            // Pasta onde a foto de perfil será salva
            $local = "assets/img/";
            // Nome do arquivo da imagem
            $nome_arquivo = $imagem['name'];
            // Gerar um código aleatório para evitar conflitos de nome
            $codigo = strtoupper(substr(md5(date("YmdHis")), 1, 7));
            // Caminho completo da imagem
            $caminho_imagem = $local . $codigo . $nome_arquivo;
            // Mover a imagem para a pasta assets/img
            move_uploaded_file($imagem['tmp_name'], $local . $codigo . $nome_arquivo);
        } else {
            // Se não houver nova imagem, manter a imagem atual (ou null)
            $caminho_imagem = null;
        }

        // Instanciar a classe Prestador
        $objPrestador = new Prestador();
        // Invocar o método para alterar o prestador no banco de dados
        if ($objPrestador->AlterarPrestador($id_prestador, $nome, $cpf, $data_nascimento, $telefone, $email, $endereco, $caminho_imagem) == true) {
            // Iniciar sessão
            session_start();
            // Inserir o menu baseado no perfil do usuário
            $menu = $this->menu();
            // Incluir a view de consulta de prestadores
            include_once 'view/ConsultarPrestador.php';
            // Mostrar mensagem de sucesso
            $this->mostrarMensagem("Prestador alterado com sucesso!");
        } else {
            // Iniciar sessão
            session_start();
            // Inserir o menu baseado no perfil do usuário
            $menu = $this->menu();
            // Incluir a view de consulta de prestadores
            include_once 'view/ConsultarPrestador.php';
            // Mostrar mensagem de erro
            $this->mostrarMensagem("Erro ao alterar Prestador!");
        }
    }
// Mostrar menu baseado no perfil do usuário

    public function menu()
    {
      
        switch($_SESSION['perfil']){
            case 'cliente':
               // Navbar para CLIENTE
            print '<nav class="navbar navbar-expand-lg navbar-custom">';
            print '  <div class="container-fluid">';
            print '    <a class="navbar-brand" href="#"><i class="bi bi-person"></i> Cliente</a>';
            print '    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">';
            print '      <span class="navbar-toggler-icon"></span>';
            print '    </button>';
            print '    <div class="collapse navbar-collapse" id="navbarNav">';
            print '      <ul class="navbar-nav ms-auto">';
            print '         <li class="nav-item"><a class="nav-link" href="index.php?CadSolicitacao"><i class="bi bi-calculator"></i> Orçamento</a></li>';
            print '        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-chat-dots"></i> Propostas</a></li>';
            print '        <li class="nav-item dropdown">';
            print '          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="bi bi-person-gear"></i> Conta</a>';
            print '          <ul class="dropdown-menu">';
            print '            <li><a class="dropdown-item" href="index.php?AlterarPessoa">Alterar Dados</a></li>';
            print '            <li><a class="dropdown-item" href="#">Alterar Senha</a></li>';
            print '            <li><a class="dropdown-item" href="#">Excluir Conta</a></li>';
            print '          </ul>';
            print '        </li>';
            print '        <li class="nav-item"><a class="nav-link" href="index.php?sair"><i class="bi bi-box-arrow-right"></i> Sair</a></li>';
            print '      </ul>';
            print '    </div>';
            print '  </div>';
            print '</nav>';
            break;
                break;
    
            case 'prestador':
               // Navbar para PRESTADOR
            print '<nav class="navbar navbar-expand-lg navbar-custom">';
            print '  <div class="container-fluid">';
            print '    <a class="navbar-brand" href="#"><i class="bi bi-tools"></i> Prestador</a>';
            print '    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">';
            print '      <span class="navbar-toggler-icon"></span>';
            print '    </button>';
            print '    <div class="collapse navbar-collapse" id="navbarNav">';
            print '      <ul class="navbar-nav ms-auto">';
            print '        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-journal-richtext"></i> Meu Portfólio</a></li>';
            print '        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-calculator"></i> Orçamento</a></li>';
            print '        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-chat-dots"></i> Propostas</a></li>';
            print '        <li class="nav-item dropdown">';
            print '          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="bi bi-person-gear"></i> Conta</a>';
            print '          <ul class="dropdown-menu">';
            print '            <li><a class="dropdown-item" href="ConsultarPrestador>Alterar Dados</a></li>';
            print '            <li><a class="dropdown-item" href="#">Alterar Senha</a></li>';
            print '            <li><a class="dropdown-item" href="#">Excluir Conta</a></li>';
            print '          </ul>';
            print '        </li>';
            print '        <li class="nav-item"><a class="nav-link" href="index.php?sair"><i class="bi bi-box-arrow-right"></i> Sair</a></li>';
            print '      </ul>';
            print '    </div>';
            print '  </div>';
            print '</nav>';
            break;
                break;
                case 'clientePrestador':
                    // Navbar para CLIENTE + PRESTADOR
                    print '<nav class="navbar navbar-expand-lg navbar-custom">';
                    print '  <div class="container-fluid">';
                    print '    <a class="navbar-brand" href="#"><i class="bi bi-person-badge"></i> Cliente & Prestador</a>';
                    print '    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">';
                    print '      <span class="navbar-toggler-icon"></span>';
                    print '    </button>';
                    print '    <div class="collapse navbar-collapse" id="navbarNav">';
                    print '      <ul class="navbar-nav ms-auto">';
                    print '        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-search"></i> Buscar Serviços</a></li>';
                    print '        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-journal-richtext"></i> Meu Portfólio</a></li>';
                    print '        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-chat-text"></i> Propostas</a></li>';
                    print '        <li class="nav-item dropdown">';
                    print '          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="bi bi-person-gear"></i> Conta</a>';
                    print '          <ul class="dropdown-menu">';
                    print '            <li><a class="dropdown-item" href="index.php?ConsultarPrestador>Alterar Dados</a></li>';
                    print '            <li><a class="dropdown-item" href="#">Alterar Senha</a></li>';
                    print '            <li><a class="dropdown-item" href="#">Excluir Conta</a></li>';
                    print '          </ul>';
                    print '        </li>';
                    print '        <li class="nav-item"><a class="nav-link" href="index.php?sair"><i class="bi bi-box-arrow-right"></i> Sair</a></li>';
                    print '      </ul>';
                    print '    </div>';
                    print '  </div>';
                    print '</nav>';
                    break;
    
            case 'admin':
              // Navbar para ADMINISTRADOR
            print '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">';
            print '  <div class="container-fluid">';
            print '    <a class="navbar-brand" href="#"><i class="bi bi-shield-lock"></i> Admin</a>';
            print '    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">';
            print '      <span class="navbar-toggler-icon"></span>';
            print '    </button>';
            print '    <div class="collapse navbar-collapse" id="navbarNav">';
            print '      <ul class="navbar-nav ms-auto">';
            print '        <li class="nav-item"><a class="nav-link" href="index.php?Dashboard"><i class="bi bi-speedometer2"></i> Dashboard</a></li>';
            print '        <li class="nav-item dropdown">';
            print '          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="bi bi-people"></i> Usuários</a>';
            print '          <ul class="dropdown-menu">';
            print '            <li><a class="dropdown-item" href="index.php?AdminPessoa" >Clientes</a></li>';
            print '            <li><a class="dropdown-item" href="index.php?AdminPrestador">Prestadores</a></li>';
            print '          </ul>';
            print '        </li>';
            print '        <li class="nav-item dropdown">';
            print '          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="bi bi-wrench-adjustable"></i> Serviços</a>';
            print '          <ul class="dropdown-menu">';
            print '            <li><a class="dropdown-item" href="#">Solicitações</a></li>';
            print '            <li><a class="dropdown-item" href="#">Categorias</a></li>';
            print '          </ul>';
            print '        </li>';
            print '        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-graph-up"></i> Relatórios</a></li>';
            print '        <li class="nav-item"><a class="nav-link" href="index.php?sairAdmin"><i class="bi bi-box-arrow-right"></i> Sair</a></li>';
            print '      </ul>';
            print '    </div>';
            print '  </div>';
            print '</nav>';
            break;
        }
       
    }

    //mostrar mensagem

    public function mostrarMensagem($mensagem)
    {
       
        echo '   <!-- Modal -->';
        echo '   <div class="modal fade" id="mensagem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo '        <div class="modal-dialog">';
        echo '           <div class="modal-content">';
        echo '               <div class="modal-header">';
        echo '                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensagem</h1>';
        echo '                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '               </div>';
        echo '               <div class="alert alert-warning" role="alert">';
        echo                    $mensagem;
        echo '               </div>';
        echo '               <div class="modal-footer">';
        echo '                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '               </div>';
        echo '           </div>';
        echo '       </div>';
        echo '    </div>';

        //JavaScript
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo '    var myModal = new bootstrap.Modal(document.getElementById("mensagem"));';
        echo '    myModal.show();';
        echo '})';
        echo '</script>';
    }

     //modal PessoaAdmin
    public function modal_alterar_pessoa_admin($id_pessoa,$nome,$telefone,$email,$status, $cliente, $prestador)
    {
         //Modal
         echo '<div class="modal fade show" id="alterar_pessoa_admin' . $id_pessoa . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
         echo ' <div class="modal-dialog">';
         echo '     <div class="modal-content">';
         echo '      <div class="modal-header">';
         echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Pessoa</h5>';
         echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
         echo '      </div>';
         echo '<form method="post" action="index.php">';
         echo '  <div class="modal-body">';
         echo' <label for="nome">Nome Completo</label>';
         echo '     <input type="text" class="form-control" name="nome" value="' . $nome . '" placeholder="Nome">';
         echo'       <label for="Telefone">Telefone</label>';
         echo '     <input type="text" class="form-control mt-2" name="telefone" value="' . $telefone . '" placeholder="Telefone">';
         echo'       <label for="email">E-mail</label>';
         echo '     <input type="text" class="form-control mt-2" name="email" value="' . $email . '" placeholder="E-mail">';
         echo' <label for="status">Status</label>';
         echo '     <select class="form-select mt-2" name="status">';
         echo '         <option value="ativo"' . ($status == 'ativo' ? ' selected' : '') . '>Ativo</option>';
         echo '         <option value="inativo"' . ($status == 'inativo' ? ' selected' : '') . '>Inativo</option>';
         echo '     </select>';
         echo' <label for="perfil">Perfil</label>';
         echo '     <select class="form-select mt-2" name="perfil">';
         echo '    <option value="cliente"' . ($cliente == 1 ? ' selected' : '') . '>Cliente</option>';
         echo '    <option value="prestador"' . ($prestador == 1 ? ' selected' : '') . '>Prestador</option>';
         echo '     </select>';
         echo '  </div>';
         echo '  <div class="modal-footer">';
         echo '    <input type="hidden" name="id_pessoa" value="' . $id_pessoa . '">';
         echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
         echo '    <button type="submit" name="alterar_pessoa_admin" class="btn btn-primary">Alterar</button>';
         echo '  </div>';
         echo '</form>';
         echo '</div>';
         echo '</div>';
         echo '</div>';
    }
    public function modal_excluir_pessoa_admin($id_pessoa, $nome)
    {
         // Modal
         echo '<div class="modal fade" id="excluir_pessoa_admin' . $id_pessoa . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
         echo    '<div class="modal-dialog">';
         echo        '<div class="modal-content">';
         echo            '<div class="modal-header">';
         echo                '<h5 class="modal-title fs-5" id="exampleModalLabel">Excluir Pessoa</h5>';
         echo                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
         echo            '</div>';
         echo            '<div class="modal-body">';
         echo            $nome;
         echo            '</div>';
         echo            '<form method="post" action="index.php">';
         echo                '<div class="modal-footer">';
         echo                    '<input type="hidden" name="id_pessoa" value="' . $id_pessoa . '">';
         echo                    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
         echo                    '<button type="submit" name="excluir_pessoa_admin" class="btn btn-danger">Excluir</button>';
         echo                '</div>';
         echo            '</form>';
         echo        '</div>';
         echo    '</div>';
         echo '</div>';
    }
    //Modal alterar PrestadorAdmin

    public function modal_alterar_prestador_admin($id_pessoa,$nome,$telefone,$email,$status, $cliente, $prestador)
    {
        //Modal
        echo '<div class="modal fade show" id="alterar_prestador_admin' . $id_pessoa . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Prestado</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo' <label for="nome">Nome Completo</label>';
        echo '     <input type="text" class="form-control" name="nome" value="' . $nome . '" placeholder="Nome">';
        echo'       <label for="Telefone">Telefone</label>';
        echo '     <input type="text" class="form-control mt-2" name="telefone" value="' . $telefone . '" placeholder="Telefone">';
        echo'       <label for="email">E-mail</label>';
        echo '     <input type="text" class="form-control mt-2" name="email" value="' . $email . '" placeholder="E-mail">';
        echo' <label for="status">Status</label>';
        echo '     <select class="form-select mt-2" name="status">';
        echo '         <option value="ativo"' . ($status == 'ativo' ? ' selected' : '') . '>Ativo</option>';
        echo '         <option value="inativo"' . ($status == 'inativo' ? ' selected' : '') . '>Inativo</option>';
        echo '     </select>';
        echo' <label for="perfil">Perfil</label>';
        echo '     <select class="form-select mt-2" name="perfil">';
        echo '    <option value="cliente"' . ($cliente == 1 ? ' selected' : '') . '>Cliente</option>';
        echo '    <option value="prestador"' . ($prestador == 1 ? ' selected' : '') . '>Prestador</option>';
        echo '     </select>';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_pessoa" value="' . $id_pessoa . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_prestador_admin" class="btn btn-primary">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    //Modal excluir PrestadorAdmin
    public function modal_excluir_prestador_admin($id_pessoa, $nome)
    {
        // Modal
        echo '<div class="modal fade" id="excluir_pessoa_admin' . $id_pessoa . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo    '<div class="modal-dialog">';
        echo        '<div class="modal-content">';
        echo            '<div class="modal-header">';
        echo                '<h5 class="modal-title fs-5" id="exampleModalLabel">Excluir Pessoa</h5>';
        echo                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo            '</div>';
        echo            '<div class="modal-body">';
        echo            $nome;
        echo            '</div>';
        echo            '<form method="post" action="index.php">';
        echo                '<div class="modal-footer">';
        echo                    '<input type="hidden" name="id_pessoa" value="' . $id_pessoa . '">';
        echo                    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo                    '<button type="submit" name="excluir_pessoa_admin" class="btn btn-danger">Excluir</button>';
        echo                '</div>';
        echo            '</form>';
        echo        '</div>';
        echo    '</div>';

    echo '</div>';
    } 

   //SERVICOS
       //função para criar select para listar tipo de serviços
       public function select_tipo_servico()
       {
           //instanciar classe TipoServico
           $objTipoServico = new TipoServico();
           //invocar o método
           $resultado = $objTipoServico->consultarTipoServico(null);
           echo '<label for="tipo_servico" class="form-label">Tipo Serviço</label>';
           echo '<select class="form-select" aria-label="Default select example">';
           echo '    <option selected>Selecione o tipo de servico</option>';
           foreach($resultado as $key =>$valor){
               echo '    <option value="' . $valor->id_tipo_servico . '">' .$valor->descricao_tipo_servico . '</option>';
           } 
           echo '</select>';
       }
       //Função para criar select para listar os serviços
       public function select_servico()
       {
           //instanciar classe TipoServico
           $objServico = new Servico();
           //invocar o método
           $resultado = $objServico->consultarServico(null);
           echo '<label for="servico" class="form-label">Serviço</label>';
           echo '<select class="form-select" aria-label="Default select example">';
           echo '    <option selected>Selecione o Srvico</option>';
           foreach($resultado as $key =>$valor){
               echo '    <option value="' . $valor->id_servico . '">' .$valor->descricao_servico . '</option>';
           } 
           echo '</select>';
       }
   
       #TIPO DE SERVIÇO
       //cadastrar Tipo de serviço
       public function cadastrar_tipo_servico($descricao_tipo_servico)
       {
           //instanciar as classes
           $objTipoServico = new TipoServico();
           //invocar o método
           if ($objTipoServico->cadastrarTipoServico($descricao_tipo_servico) == true) {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarTipoServico.php';
               //mostrar mensagem
               $objController->mostrarMensagem("Tipo de serviço cadastrado com sucesso!");
           } else {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarTipoServico.php';
               //mostrar mensagem
               $objController->mostrarMensagem("Erro ao cadastrar tipo de serviço!");
           }
       }
   
       //consultar Tipo de serviço
       public function consultar_tipo_servico($descricao_tipo_servico)
       {
           //instanciar as classes
           $objTipoServico = new TipoServico();
           //invocar o método
           if ($objTipoServico->consultarTipoServico($descricao_tipo_servico) == false) {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarTipoServico.php';
               //mostrar mensagem
               $objController->mostrarMensagem("Erro ao consultar!");
           } else {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //resultado da consulta
               $resultado = $objTipoServico->consultarTipoServico($descricao_tipo_servico);
               //incluir a view
               include_once 'view/consultarTipoServico.php';
           }
        }
       
       //alterar Tipo de serviço
       public function alterar_tipo_servico($id_tipo_servico, $descricao_tipo_servico)
       {
           //instanciar as classes
           $objTipoServico = new TipoServico();
           //invocar o método
           if ($objTipoServico->alterarTipoServico($id_tipo_servico, $descricao_tipo_servico) == true) {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarTipoServico.php';
               //mostrar mensagem
               $objController->mostrarMensagem("Tipo de serviço alterado com sucesso!");
           } else {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarTipoServico.php';
               //mostrar mensagem
               $objController->mostrarMensagem("Erro ao alterar Tipo de serviço!");
           }
       }
   
       //excluir Tipo de serviço
       public function excluir_tipo_servico($id_tipo_servico)
       {
           //instanciar as classes
           $objTipoServico = new TipoServico();
           //invocar o método
           if ($objTipoServico->excluirTipoServico($id_tipo_servico) == true) {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarTipoServico.php';
               //mostrar mensagem
               $this->mostrarMensagem("Tipo de serviço excluído com sucesso!");
           } else {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarTipoServico.php';
               //mostrar mensagem
               $this->mostrarMensagem("Erro ao excluir tipo de serviço!");
           }
       }
   
       # SERVIÇO
       //cadastrar serviço
       public function cadastrar_servico($descricao_servico)
       {
           //instanciar as classes
           $objServico = new Servico();
           //invocar o método
           if ($objServico->cadastrarServico($descricao_servico) == true) {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarServico.php';
               //mostrar mensagem
               $this->mostrarMensagem("Serviço cadastrado com sucesso!");
           } else {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarServico.php';
               //mostrar mensagem
               $this->mostrarMensagem("Erro ao cadastrar tipo de serviço!");
           }
       }
   
       //consultar serviço
       public function consultar_servico($descricao_servico)
       {
           //instanciar as classes
           $objServico = new Servico();
           //invocar o método
           if ($objServico->consultarServico($descricao_servico) == false) {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarServico.php';
               //mostrar mensagem
               $this->mostrarMensagem("Erro ao consultar!");
           } else {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //resultado da consulta
               $resultado = $objServico->consultarServico($descricao_servico);
               //incluir a view
               include_once 'view/consultarServico.php';
           }
       }
       
       //alterar Serviço
       public function alterar_servico($id_servico, $descricao_servico)
       {
           //instanciar as classes
           $objServico = new Servico();
           //invocar o método
           if ($objServico->alterarServico($id_servico, $descricao_servico) == true) {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarServico.php';
               //mostrar mensagem
               $this->mostrarMensagem("Serviço alterado com sucesso!");
           } else {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarServico.php';
               //mostrar mensagem
               $this->mostrarMensagem("Erro ao alterar serviço!");
           }
       }
   
       //excluir serviço
       public function excluir_servico($id_servico)
       {
           //instanciar as classes
           $objServico = new Servico();
           //invocar o método
           if ($objServico->excluirServico($id_servico) == true) {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarServico.php';
               //mostrar mensagem
               $this->mostrarMensagem("Serviço excluído com sucesso!");
           } else {
               //iniciar sessao
               session_start();
               //inserir menu
               $menu = $this->menu();
               //incluir a view
               include_once 'view/consultarServico.php';
               //mostrar mensagem
               $this->mostrarMensagem("Erro ao excluir serviço!");
           }
       }

} 
      
