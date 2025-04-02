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
if (isset($_POST['login'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $email = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['senha']);
    //invocar o método validar
    $objController->validar($email, $senha);
}

#ROTA AUTOR
//inserir autor
if (isset($_POST['inserir_autor'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome_autor = htmlspecialchars($_POST['nome_autor']);
    //invocar o método inserir_autor
    $objController->inserir_autor($nome_autor);
}

//consultar autor
if (isset($_POST['consultar_autor'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome_autor = htmlspecialchars($_POST['nome_autor']);
    //invocar o método inserir_autor
    $objController->consultar_autor($nome_autor);
}

//alterar_autor
if (isset($_POST['alterar_autor'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_autor = htmlspecialchars($_POST['id_autor']);
    $nome_autor = htmlspecialchars($_POST['nome_autor']);
    //invocar o método de alterar_autor
    $objController->alterar_autor($id_autor, $nome_autor);
}

//excluir_autor
if (isset($_POST['excluir_autor'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_autor = htmlspecialchars($_POST['id_autor']);
    //invocar o método de excluir_autor
    $objController->excluir_autor($id_autor);
}

#ROTA EDITORA
//inserir editora
if (isset($_POST['inserir_editora'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome_editora = htmlspecialchars($_POST['nome_editora']);
    //invocar o método inserir_editora
    $objController->inserir_editora($nome_editora);
}

//consultar editora
if (isset($_POST['consultar_editora'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $nome_editora = htmlspecialchars($_POST['nome_editora']);
    //invocar o método inserir_autor
    $objController->consultar_editora($nome_editora);
}

//alterar_editora
if (isset($_POST['alterar_editora'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_editora = htmlspecialchars($_POST['id_editora']);
    $nome_editora = htmlspecialchars($_POST['nome_editora']);
    //invocar o método de alterar_autor
    $objController->alterar_editora($id_editora, $nome_editora);
}

//excluir_editora
if (isset($_POST['excluir_editora'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_editora = htmlspecialchars($_POST['id_editora']);
    //invocar o método de excluir_editora
    $objController->excluir_editora($id_editora);
}

#ROTA GêNERO
//inserir gênero
if (isset($_POST['inserir_genero'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $descricao = htmlspecialchars($_POST['descricao']);
    //invocar o método inserir_genero
    $objController->inserir_genero($descricao);
}

//consultar genero
if (isset($_POST['consultar_genero'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $descricao = htmlspecialchars($_POST['descricao']);
    //invocar o método consultar_genero
    $objController->consultar_genero($descricao);
}

//alterar_genero
if (isset($_POST['alterar_genero'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_genero = htmlspecialchars($_POST['id_genero']);
    $id_genero = htmlspecialchars($_POST['descricao']);
    //invocar o método de alterar_autor
    $objController->alterar_genero($id_genero, $descricao);
}

//excluir_genero
if (isset($_POST['excluir_genero'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_genero = htmlspecialchars($_POST['id_genero']);
    //invocar o método de excluir_editora
    $objController->excluir_genero($id_genero);
}

#ROTA LIVRO
//inserir livro
if (isset($_POST['inserir_livro'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $titulo = htmlspecialchars($_POST['titulo']);
    $id_editora = htmlspecialchars($_POST['id_editora']);
    $id_genero = htmlspecialchars($_POST['id_genero']);
    $preco = htmlspecialchars($_POST['preco']);
    //captura imagem do livro
    $id_autor = $_POST['autor'];
    //captura imagem do livro
    $imagem = $_FILES['imagem'];
    //var_dump($autor);
    //die('Ainda estou aqui');
    //invocar o método inserir_editora
    $objController->inserir_livro($preco, $id_editora, $id_genero, $titulo, $autor, $imagem);
}

//consultar livro
if (isset($_POST['consultar_livro'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $titulo = htmlspecialchars($_POST['titulo']);
    $id_genero = htmlspecialchars($_POST['id_genero']);
    //invocar o método consultar_livro
    $objController->consultar_livro($titulo, $id_genero);
}
//alterar_livro
if (isset($_POST['alterar_livro'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_livro = htmlspecialchars($_POST['id_livro']);
    $titulo = htmlspecialchars($_POST['titulo']);
    //invocar o método alterar_livro
    $objController->alterar_livro($id_livro, $titulo);
}
//excluir_livro
if (isset($_POST['excluir_livro'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $id_livro = htmlspecialchars($_POST['id_livro']);
    //invocar o método de excluir_livro
    $objController->excluir_livro($id_livro);
}

//consultar geral
if (isset($_POST['consultar_geral'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $palavra = htmlspecialchars($_POST['palavra']);
    //invocar o método consultar_geral
    $objController->consultar_geral($palavra);
}

//gerar PDF
if (isset($_POST['gerar_pdf'])) {
    //instanciar controller
    $objController = new Controller();
    //dados
    $palavra = htmlspecialchars($_POST['resultado']);
    //invocar o método gerar pdf
    $objController->gerar_pdf($resultado);
}

