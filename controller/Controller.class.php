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
        include_once 'view/' . $pagina . '.php';
    }
    //validar login
    public function validar($email, $senha)
    {

        //instanciar a classe Usuário
        $objPessoa = new Pessoa();

        //validar Pessoa
        if ($objPessoa->validar_pessoa($email, $senha) == true) {
            //iniciar sessão
            session_start();
            //iniciar as variáveis de sessão
            $_SESSION['email'] = $email;
            //menu
            $menu = $this->menu();
            //incluir a view
            include_once "view/Principal.php";
        } else {
            include_once "Login.php";
            $this->mostrarMensagem("Login ou senha inválidos!");
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

    public function recuperarSenha($email)
    {
        //instanciar a classe Usuário
        $objPessoa = new Pessoa();
        //verificar se email existe
        if ($objPessoa->validarEmail($email) == true) {
            //gerar nova senha
            $senha = md5('123456');
            //$senha = md5(substr(md5(date("YmdHis")), 1, 6));

            //atualizar senha
            $objPessoa->alterarSenha($email, $senha);

            //definir o servidor
            define('HOST', 'smtp.gmail.com');
            define('PORT', '587');
            define('USERNAME', 'senacdf.operadormicro@gmail.com');
            define('PASSWORD', 'uetz ezsn jjuy klyo');
            define('FROM', 'senacdf.operadormicro@gmail.com');

            //dados do envio
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "TLS";
            $mail->Host = HOST;
            $mail->Port = PORT;
            $mail->Username = USERNAME;
            $mail->Password = PASSWORD;

            //dados do remetente
            $mail->setFrom(FROM, 'SISTEMA SGL');
            $mail->addAddress($email);

            //dados do email
            $mail->IsHTML(true);
            $mail->Subject = ('Recuperação de Senha - SGL');
            $mail->Body = ('<br>Sua nova senha é: <b>12345678</b>');
            $mail->Charset = 'UTF-8';

            //eviar email
            if (!$mail->Send()) {
                include_once 'recuperar.php';
                $this->mostrarMensagem("Erro ao enviar e-mail! $mail->ErrorInfo");
            } else {
                include_once 'Login.php';
                $this->mostrarMensagem("A nova senha foi enviada para o e-mail informado!");
            }

        } else {
            include_once 'Recuperar.php';
            $this->mostrarMensagem("E-mail não cadastrado!");
        }

    }

  // FUNÇÕES MENU PESSOA

// Inserir pessoa
public function inserir_pessoa($nome, $email, $id_status_usuario, $documento_usuario, $data_nascimento, $telefone, $senha, $foto_perfil, $cliente, $prestador)
{
    // Instanciar a classe Pessoa
    $objPessoa = new Pessoa();

    // Invocar o método
    if ($objPessoa->inserirPessoa($nome, $email, $id_status_usuario, $documento_usuario, $data_nascimento, $telefone, $senha, $foto_perfil, $cliente, $prestador) == true) {
        // Iniciar sessão
        session_start();
        // Iniciar as variáveis de sessão
        $_SESSION['nome_pessoa'] = $nome;
        $_SESSION['email_pessoa'] = $email;
        // Menu
        $menu = $this->menu();
        // Incluir a view
        include_once "view/consultar.php";
        // Mostrar mensagem
        $this->mostrarMensagem("Pessoa incluída com sucesso!");
    } else {
        // Iniciar sessão
        session_start();
        // Iniciar as variáveis de sessão
        $_SESSION['nome_pessoa'] = $nome;
        $_SESSION['email_pessoa'] = $email;
        // Menu
        $menu = $this->menu();
        // Incluir a view
        include_once "view/consultar.php";
        // Mostrar mensagem
        $this->mostrarMensagem("Erro ao incluir pessoa!");
    }
}

// Consultar pessoa
public function consultar_pessoa($nome = null, $email = null)
{
    // Instanciar a classe Pessoa
    $objPessoa = new Pessoa();

    // Invocar o método
    $resultado = $objPessoa->consultarPessoa($nome, $email);
    if ($resultado === false) {
        // Iniciar sessão
        session_start();
        // Menu
        $menu = $this->menu();
        // Incluir a view
        include_once "view/ConsultarPessoa.php";
        // Mostrar mensagem
        $this->mostrarMensagem("Erro ao consultar!");
    } else {
        // Iniciar sessão
        session_start();
        // Menu
        $menu = $this->menu();
        // Resultado da consulta
        $resultado = $objPessoa->consultarPessoa($nome, $email);
        // Incluir a view
        include_once "view/ConsultarPessoa.php";
    }
}

// Alterar pessoa
public function alterar_pessoa($id_pessoa, $nome, $email, $id_status_usuario, $documento_usuario, $data_nascimento, $telefone, $senha, $foto_perfil, $cliente, $prestador)
{
    // Instanciar a classe Pessoa
    $objPessoa = new Pessoa();

    // Invocar o método
    if ($objPessoa->alterarPessoa($id_pessoa, $nome, $email, $id_status_usuario, $documento_usuario, $data_nascimento, $telefone, $senha, $foto_perfil, $cliente, $prestador) == true) {
        // Iniciar sessão
        session_start();
        // Inserir menu
        $menu = $this->menu();
        // Incluir a view
        include_once 'view/consultar.php';
        // Mostrar mensagem
        $this->mostrarMensagem("Pessoa alterada com sucesso!");
    } else {
        // Iniciar sessão
        session_start();
        // Inserir menu
        $menu = $this->menu();
        // Incluir a view
        include_once 'view/cConsultarPessoa.php';
        // Mostrar mensagem
        $this->mostrarMensagem("Erro ao alterar pessoa!");
    }
}

// Excluir pessoa
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
    switch ($_SESSION['perfil']) {
        case 'pessoa':
            // Início da Navbar - Área do Cliente
            print '    <!-- Navbar -->';
            print '    <nav class="navbar navbar-expand-lg">';  // Container principal da navbar com expansão para telas grandes
            print '        <div class="container-fluid">';      // Container fluido que ocupa toda a largura disponível
            
            // Brand/Marca da Navbar
            print '            <a class="navbar-brand" href="#">Área do Cliente</a>';  // Link/logo que identifica a área
            
            // Botão Toggler para menu mobile
            print '            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
            print '                <span class="navbar-toggler-icon"></span>';  // Ícone de hambúrguer para mobile
            print '            </button>';
            
            // Área colapsável do menu (itens de navegação)
            print '            <div class="collapse navbar-collapse" id="navbarNav">';  // Div que será expandida/recolhida
            print '                <ul class="navbar-nav ms-auto">';  // Lista de itens alinhada à direita (ms-auto)
            
            // Itens do Menu - Cada li representa um item de navegação
            print '                    <li class="nav-item">';
            // Link que abre modal de Histórico (deve existir um modal com id="historicoModal")
            print '                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#historicoModal">Histórico</a>';
            print '                    </li>';
            
            print '                    <li class="nav-item">';
            // Link que abre modal de Alterar Senha (deve existir um modal com id="alterarSenhaModal")
            print '                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#alterarSenhaModal">Alterar Senha</a>';
            print '                    </li>';
            
            print '                    <li class="nav-item">';
            // Link que abre modal de Excluir Conta (deve existir um modal com id="excluirContaModal")
            print '                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#excluirContaModal">Excluir Conta</a>';
            print '                    </li>';
            
            print '                    <li class="nav-item">';
            // Link para Sair - redireciona para index.html (considerar usar logout.php para segurança)
            print '                        <a class="nav-link" href="index.html">Sair</a>';
            print '                    </li>';
            
            print '                </ul>';  // Fim da lista de itens
            print '            </div>';     // Fim da área colapsável
            print '        </div>';         // Fim do container-fluid
            print '    </nav>';             // Fim da navbar
            print '    <!-- Fim Navbar -->';
            
            break;
    
        case 'prestador':
            print '    <!-- Início da Navbar - Área do Prestador -->';
            print '    <nav class="navbar navbar-expand-lg">';  
            print '        <div class="container-fluid">';      
            
            // LOGO/IDENTIFICAÇÃO DA ÁREA
            print '            <a class="navbar-brand" href="#">Área do Prestador</a>';  // Texto que identifica a área de acesso
            
            // BOTÃO TOGGLER (MENU HAMBÚRGUER - MOBILE)
            print '            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
            print '                <span class="navbar-toggler-icon"></span>';  // Ícone padrão do Bootstrap para menu mobile
            print '            </button>';
            
            // ÁREA DOS ITENS DE NAVEGAÇÃO (COLAPSÁVEL)
            print '            <div class="collapse navbar-collapse" id="navbarNav">';  // Div que expande/recolhe nos dispositivos móveis
            print '                <ul class="navbar-nav ms-auto">';  // Lista de itens alinhada à direita (ms-auto = margin-start: auto)
            
            // ITEM 1 - FATURAMENTO (ACIONA MODAL)
            print '                    <li class="nav-item">';
            print '                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#faturamentoModal">Faturamento</a>';  // Link que abre modal de relatórios financeiros
            print '                    </li>';
            
            // ITEM 2 - ALTERAR SENHA (ACIONA MODAL)
            print '                    <li class="nav-item">';
            print '                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#alterarSenhaModal">Alterar Senha</a>';  // Modal para atualização de credenciais
            print '                    </li>';
            
            // ITEM 3 - EXCLUIR CONTA (ACIONA MODAL)
            print '                    <li class="nav-item">';
            print '                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#excluirContaModal">Excluir Conta</a>';  // Modal para remoção da conta do sistema
            print '                    </li>';
            
            // ITEM 4 - MUDAR PARA MODO CLIENTE
            print '                    <li class="nav-item">';
            print '                        <a class="nav-link" href="cliente.php">Mudar para Cliente</a>';  // Alterna entre perfis (prestador/cliente)
            print '                    </li>';
            
            // ITEM 5 - SAIR DO SISTEMA
            print '                    <li class="nav-item">';
            print '                        <a class="nav-link" href="index.html">Sair</a>';  // Encerra a sessão (recomendado usar logout.php)
            print '                    </li>';
            
            print '                </ul>';  // Fechamento da lista de itens
            print '            </div>';     // Fechamento da área colapsável
            print '        </div>';         // Fechamento do container-fluid
            print '    </nav>';             // Fechamento da navbar
            print '    <!-- Fim da Navbar -->';
            
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

    ##MODAIS
    //modal alterar autor
    public function modal_alterar_autor($id_autor, $nome_autor)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_autor' . $id_autor . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Autor</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <input type="text" class="form-control" name="nome_autor" value="' . $nome_autor . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_autor" value="' . $id_autor . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_autor" class="btn btn-primary">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    //modal excluir autor
    public function modal_excluir_autor($id_autor, $nome_autor)
    {
        /// Modal
        echo '<div class="modal fade" id="excluir_autor' . $id_autor . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo    '<div class="modal-dialog">';
        echo        '<div class="modal-content">';
        echo            '<div class="modal-header">';
        echo                '<h5 class="modal-title fs-5" id="exampleModalLabel">Excluir Autor</h5>';
        echo                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo            '</div>';
        echo            '<div class="modal-body">';
        echo            $nome_autor;
        echo            '</div>';
        echo            '<form method="post" action="index.php">';
        echo                '<div class="modal-footer">';
        echo                    '<input type="hidden" name="id_autor" value="' . $id_autor . '">';
        echo                    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo                    '<button type="submit" name="excluir_autor" class="btn btn-danger">Excluir</button>';
        echo                '</div>';
        echo            '</form>';
        echo        '</div>';
        echo    '</div>';
        echo '</div>';
    }

    //modal alterar editora
    public function modal_alterar_editora($id_editora, $nome_editora)
    {
        //Modal
        echo '<div class="modal fade" id="alterar_editora' . $id_editora . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Editora</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <input type="text" class="form-control" name="nome_editora" value="' . $nome_editora . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_editora" value="' . $id_editora . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_editora" class="btn btn-primary">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    //modal excluir editora
    public function modal_excluir_editora($id_editora, $nome_editora)
    {
        // Modal
        echo '<div class="modal fade" id="excluir_autor' . $id_editora . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo    '<div class="modal-dialog">';
        echo        '<div class="modal-content">';
        echo            '<div class="modal-header">';
        echo                '<h5 class="modal-title fs-5" id="exampleModalLabel">Excluir Autor</h5>';
        echo                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo            '</div>';
        echo            '<div class="modal-body">';
        echo            $nome_editora;
        echo            '</div>';
        echo            '<form method="post" action="index.php">';
        echo                '<div class="modal-footer">';
        echo                    '<input type="hidden" name="id_autor" value="' . $id_editora . '">';
        echo                    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo                    '<button type="submit" name="excluir_autor" class="btn btn-danger">Excluir</button>';
        echo                '</div>';
        echo            '</form>';
        echo        '</div>';
        echo    '</div>';
        echo '</div>';
    }
    //função para criar select para listar editoras
    public function select_editora()
    {
        //instanciar classe editora
        $objEditora = new Editora();
        //invocar o método
        $resultado = $objEditora->consultarEditora(null);//null para o método retornar todas as editoras
        echo '<label for="nome_editora" class="form-label">Editora</label>';
        echo '<select class="form-select" aria-label="Default select example">';
        echo '    <option selected>Selecione a editora</option>';
        foreach($resultado as $key =>$valor){
            echo '    <option value="' . $valor->id_editora . '">' .$valor->nome . '</option>';
        } 
        echo '</select>';
    }
    //Função para criar select para listar os generos
    public function select_genero()
    {
        //instanciar classe editora
        $objGenero = new Genero();
        //invocar o método
        $resultado = $objGenero->consultarGenero(null);//null para o método retornar todas as editoras
        echo '<label for="nome_genero" class="form-label">Genero</label>';
        echo '<select class="form-select" aria-label="Default select example">';
        echo '    <option selected>Selecione o gênero</option>';
        foreach($resultado as $key =>$valor){
            echo '    <option value="' . $valor->id_genero . '">' .$valor->nome . '</option>';
        } 
        echo '</select>';
    }

        # FUNÇÕES MENU LIVRO
    //inserir livro
    public function inserir_livro($preco,$titulo,$id_editora, $id_genero)
    {
        //instanciar a classe Autor
        $objLivro = new Livro();

        //invocar o método
        if ($objLivro->inserirLivro($preco,$titulo,$id_editora, $id_genero) == true) {
            //iniciar sessão
            session_start();
            //menu
            $menu = $this->menu();
            //incluir a view
            include_once "view/consultar_livro.php";
            //mostrar mensagem
            $this->mostrarMensagem("Livro incluído com sucesso!");
        } else {
            //iniciar sessão
            session_start();
            //iniciar as variáveis de sessão
            $_SESSION['nome_autor'] = $nome_autor;
            //menu
            $menu = $this->menu();
            //incluir a view
            include_once "view/consultar_livro.php";
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao incluir livro!");
        }
    }
}