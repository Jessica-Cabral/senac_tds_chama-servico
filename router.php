<?php
//pegar a url
$url = explode('?', $_SERVER['REQUEST_URI']);
//escolher na variável $url do link desejado
$pagina = $url[1];
#ROTAS DE REDIRECIONAMENTO
//redirecionar para principal
if (isset($pagina)) {
    $objController = new Controller();
    $objController->redirecionar($pagina);
}
##ROTAS DE AÇÃO
//verifica se o botao login foi acionado -login - isset direciona o que deve ser exibido para o usuário
if (isset($_POST['Login'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $email = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['senha']);
    //invocar o método validar
    $objController->validar($email, $senha);
}
//Rota para LoginAdmin
if (isset($_POST['validarAdmin'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $email = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['senha']);
    //invocar o método validar
    $objController->validarAdmin($email, $senha);
}
if (isset($_POST['abrirHomepage'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    //invocar o método inserir_autor
    $objController->abrirHomepage();
}

if (isset($_POST['recuperarSenha'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    //invocar o método inserir_autor
    $objController->recuperarSenha();
}

if (isset($_POST['abrirformpessoa'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    //invocar o método inserir_autor
    $objController->abrirformpessoa();
}
//inserir Servico
// if (isset($_POST['inserir_servico'])) {
//     //instanciar controller
//     $objControllerSolicitacaoServico = new ControllerServico();
//     //dados
//     $id_prestador = htmlspecialchars($_POST['id_prestador']);
//     $id_servico = htmlspecialchars($_POST['id_servico']);
//     $descricao = htmlspecialchars($_POST['descricao']);
//     $id_endereco = htmlspecialchars($_POST['id_endereco']);
//     $orcamento = htmlspecialchars($_POST['orcamento']);
//     $imagens = htmlspecialchars($_FILES['imagens']);
//     $id_status_solicitacao = htmlspecialchars($_POST['id_status_solicitacao']);

//     $objControllerSolicitacaoServicoo->inserirServico($id_prestador, $id_servico, $descricao, $id_endereco, $orcamento, $imagens, $id_status_solicitacao);
// }

//inserir Pessoa
if (isset($_POST['cadastrar_pessoa'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $cpf = htmlspecialchars($_POST['cpf']);
    $data_nascimento = htmlspecialchars($_POST['data_nascimento']);
    $telefone = htmlspecialchars($_POST['telefone']);
    $senha = htmlspecialchars($_POST['senha']);
    $foto_perfil = htmlspecialchars($_FILES['foto_perfil']);
    $cliente = htmlspecialchars($_POST['cliente']);
    $prestador = htmlspecialchars($_POST['prestador']);

    $objController->cadastrar_pessoa($nome, $email, $cpf, $data_nascimento, $telefone, $senha, $foto_perfil, $cliente, $prestador);
}

#ROTA  SERVIÇO
//inserir tipo de servico
if (isset($_POST['cadastrar_servico'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
   
    $id_pessoa = htmlspecialchars($_POST['id_pessoa']);
    $id_tipo_servico = htmlspecialchars($_POST['id_tipo_servico']);
    $descricao = htmlspecialchars($_POST['descricao']);
    $cep = htmlspecialchars($_POST['cep']);
    $logradouro = htmlspecialchars($_POST['logradouro']);
    $numero = htmlspecialchars($_POST['numero']);
    $complemento = htmlspecialchars($_POST['complemento']);
    $bairro = htmlspecialchars($_POST['bairro']);
    $cidade = htmlspecialchars($_POST['cidade']);
    $uf = htmlspecialchars($_POST['uf']);
    $portfolio = $_FILES['portfolio'];
    $id_status_solicitacao = htmlspecialchars($_POST['id_status_solicitacao']);
   
    //invocar o método
    $objController->cadastrar_servico($id_pessoa, $id_tipo_servico, $descricao, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $uf, $portfolio, $id_status_solicitacao);
}

//consultar tipo de serviço
if (isset($_POST['consultar_tipo_serviço'])) {
    //instanciar controller
    $objControllerServico = new ControllerServico();
    //dados
    $descricao_tipo_servico = htmlspecialchars($_POST['descricao_tipo_servico']);
    //invocar o método
    $objControllerServico->consultar_tipo_servico($descricao_tipo_servico);
}

//alterar tipo de serviço
if (isset($_POST['alterar_tipo_servico'])) {
    //instanciar controller
    $objControllerServico = new ControllerServico();
    //dados
    $id_tipo_servico = htmlspecialchars($_POST['id_tipo_servico']);
    $descricao_tipo_servico = htmlspecialchars($_POST['descricao_tipo_servico']);
    //invocar o método de alterar_autor
    $objControllerServico->alterar_tipo_servico($id_tipo_servico, $descricao_tipo_servico);
}
//Class Pessoa
if (isset($_POST['consultar_pessoa'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    //invocar o método
    $objController->consultar_pessoa($id_pessoa);
}

if (isset($_POST['botao_alterar_pessoa'])) { 
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_pessoa = htmlspecialchars($_POST['id_pessoa']);
    $telefone = htmlspecialchars($_POST['telefone']);
    $foto_perfil = $_FILES['foto_perfil'];
    $cliente = htmlspecialchars($_POST['cliente']);
    $prestador = htmlspecialchars($_POST['prestador']);

    $objController->alterar_pessoa($id_pessoa, $telefone, $foto_perfil,$cliente,$prestador);//invoca a função alterar pessoa
}
if (isset($_POST['excluir_pessoa'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_pessoa = htmlspecialchars($_POST['id_pessoa']);
    //invocar o método
    $objController->excluir_pessoa($id_pessoa);
}
#ROTA PESSOA ADMIN

if (isset($_POST['alterar_pessoa_admin'])) { 
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_pessoa = htmlspecialchars($_POST['id_pessoa']);
    $nome = htmlspecialchars($_POST['nome']);
    $telefone = htmlspecialchars($_POST['telefone']);
    $email = htmlspecialchars($_POST['email']);
    $status = htmlspecialchars($_POST['status']);
    $cliente = htmlspecialchars($_POST['cliente']);
    $prestador = htmlspecialchars($_POST['prestador']);

    $objController->alterar_pessoa_admin($id_pessoa, $nome, $telefone, $email, $status, $cliente, $prestador); // invoca a função alterar pessoa
}
if (isset($_POST['consultar_pessoa_admin'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    //invocar o método
    $objController->consultar_pessoa_admin($id_pessoa);
}
if (isset($_POST['excluir_pessoa_admin'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_pessoa = htmlspecialchars($_POST['id_pessoa']);
    //invocar o método
    $objController->excluir_pessoa_admin($id_pessoa);
}
#ROTA PRESTADOR ADMIN
if (isset($_POST['alterar_prestador_admin'])) { 
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_pessoa = htmlspecialchars($_POST['id_pessoa']);
    $nome = htmlspecialchars($_POST['nome']);
    $telefone = htmlspecialchars($_POST['telefone']);
    $email = htmlspecialchars($_POST['email']);
    $status = htmlspecialchars($_POST['status']);
    $cliente = htmlspecialchars($_POST['cliente']);
    $prestador = htmlspecialchars($_POST['prestador']);

    $objController->alterar_prestador_admin($id_pessoa, $nome, $telefone, $email, $status, $cliente, $prestador); // invoca a função alterar prestador
}
if (isset($_POST['consultar_prestador_admin'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    //invocar o método
    $objController->consultar_prestador_admin($id_pessoa);
}
if (isset($_POST['excluir_prestador_admin'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_pessoa = htmlspecialchars($_POST['id_pessoa']);
    //invocar o método
    $objController->excluir_prestador_admin($id_pessoa);
}