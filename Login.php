<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>

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
            <p style="color: #fff; font-weight: 400;">
                Seja bem vindo, acesse e aproveite todo o conteúdo,
                <br>somos uma equipe de profissionais empenhados em
                <br>trazer o melhor conteúdo direcionado a você, usuário. 
            </p>
        </div>

        <div class="box-login">
        <form action="index.php" method="post">
            <h1>
                Olá!<br>
                Seja bem-vindo de volta.
            </h1>

            <div class="box">
                
                <h2>faça o seu login agora</h2>
                
                <input type="email" name="email" id="email" placeholder="E-mail">
                <input type="password" name="senha" id="senha" placeholder="Senha">
                
                <a href="Recuperar.php">
                    <p>Esqueceu a sua senha?</p>
                </a>

                <button>Login</button>
                
                <a href="CadPessoa.php">
                    <p>Criar uma conta</p>
                </a>
                </form>
                
            </div>
        </div>
    </div>
    <a href="index.php">
      <div id="bubble">
          <img src="assets/img/user.png" alt="icone-usuário" title="fazer-login">
      </div>
  </a>
  <script type="text/javascript" src="assets/js/validarLogin.js" defer></script>

</body>
</html>