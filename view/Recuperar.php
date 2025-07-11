<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha </title>

    <!--CSS-->
    <link rel="stylesheet" href="assets/css/styleLogin.css">
    <link rel="stylesheet" href="assets/css/mediaLogin.css">

    <!--JS & jQuery-->
    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <div id="container">
        <div class="banner">
            <img src="assets/img/login.png" alt="imagem-login">
            <p style="color: #fff;">
                Seja bem vindo, acesse e aproveite todo o conteúdo,
                <br>somos uma equipe de profissionais empenhados em
                <br>trazer o melhor conteúdo direcionado a você usuário. 
            </p>
        </div>

        <div class="box-login">
            <h1>Perdeu a sua senha?<br>recupere via email agora</h1>

            <div class="box-account">
                <h2>insira a sua conta existente</h2>
                
                <input type="email" name="email" id="email" placeholder="e-mail">
                <input type="email" name="cmail" id="cmail" placeholder="confirmar o e-mail">
                
                <p style="text-align: justify; padding: 0px 30px 0px 30px;">
                    Um código será enviado para a sua caixa
                    de entrada, copie esse código e cole na
                    próxima tela, cetifique-se de que o seu
                    apelido bem como o e-mail esteja corretos
                    e que seja o mesmo da conta que você deseja
                    recuperar
                </p>
                <button type="submit" name="recuperar_senha" class="btn btn-primary">Enviar<i class="bi bi-box-arrow-in-right"></i></button>
                <form class="d-flex" action="login.php">
            <button type="subtmit" class="btn btn-warning">Entrar</button>
        </form>
            </div>
        </div>
    </div>

    <a href="index.php">
        <div id="bubble">
            <img src="assets/img/user.png" alt="icone-usuário" title="fazer-login">
        </div>
    </a>
</body>
</html>