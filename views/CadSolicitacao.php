<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação de Serviços</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        /* Título */
h1, h2 {
    text-align: center;
    color: #6648EF;
}

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Menu Superior */
        .menu-topo {
            background-color:#6648EF;
            color:#ffffff; /*cor do nome chamaServiço*/
            display: flex;
            justify-content: space-between;
            padding: 10px 50px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .menu-topo a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }

        .menu-topo a:hover {
            color:#dcbee7;
            text-decoration: rgb(0, 10, 4);
        }

        /* Menu Lateral */
        .menu-lateral {
            background-color: #f4f4f4;
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 40px; /* abaixo do menu superior */
            left: 3;
            padding: 30px;
            box-shadow: 3px 0 5px rgba(0, 0, 0, 0.1);
        }

        .menu-lateral h3 {
            margin-bottom: 20px;
            font-size: 18px;
            color:#3c3c5f
        }

        .menu-lateral a {
            display: block;
            color: #5c2d91;
            text-decoration: none;
            padding: 10px 0;
            font-weight: bold;
        }

        .menu-lateral a:hover {
            color: #6648EF;
        }

        /* Conteúdo Central */
        .conteudo {
            margin-left:500px; /* espaço para o menu lateral */
            margin-top: 70px; /* espaço para o menu superior */
            padding: 20px;
            text-align: center;
        }

        .conteudo h1 {
            color:#6648EF;
            margin-bottom: 20px;
        }
                /* Buscar Prestador de Serviço */
        .form-suporte {
            max-width: 500px;
            margin: 0 auto;
            background: #f9f9f9;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .form-suporte label {
            display: block;
            margin-bottom: 2px;
            font-weight: bold;
            color: #333;
            text-align: left;
        }

        .form-suporte input, .form-suporte textarea {
            width: 100%;
            color: #452176;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-suporte button {
            background-color: #5c2d91;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-suporte button:hover {
            background-color: #6648EF;
        }
      /* Formulário de Filtros */
.form-filtros {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
    max-width: 1000px;
    margin: 10px auto;
     padding: 20px;
}

.filtro-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
    flex: 1 1 200px;
}

.filtro-item input, .filtro-item select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s;
}

.filtro-item input:focus, .filtro-item select:focus {
    border-color: #6a2c7c;
    outline: none;
}

.btn-filtrar {
    background-color:#6648EF;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.btn-filtrar:hover {
    background-color:#6648EF;
}

/* Resultados */
.resultado {
    margin-top: 20px;
}

.card-prestador {
    display: flex;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin: 10px 0;
    padding: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    gap: 15px;
}

.foto-prestador {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
}

.info-prestador {
    flex: 1;
}

        /* Rodapé */
        .rodape {
            text-align: center;
            padding: 10px;
            background-color:#6648EF;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Menu Superior -->
    <div class="menu-topo">
        <div>ChamaServiço</div>
        <div>
            <a href="FormBuscarPrestador.html">Buscar</a>
            <a href="FormBuscarPrestador.html">Serviços</a>
            <a href="PerfilAlteraP.html">Atualizar Dados</a>
        </div>
    </div>

    <!-- Menu Lateral -->
    <div class="menu-lateral">
        <h3>Minha Conta</h3>
        <a href="FormBuscarPrestador.html">Buscar</a>
        <a href="ServicosRealizados.html">Serviços Realizados</a>
        <a href="Faturamento.html">Faturamento</a>
        <a href="PerfilPrestador.html">Meu Perfil</a>
        <a href="Suporte.html">Suporte Técnico</a>
        <a href="Login.html">Sair</a>
    </div>


    <!-- Container Principal -->
    <main class="container">
       
        <div class="form-suporte">
            <h1>Solicitação de Serviços</h1>
        <form id="form-servicos" enctype="multipart/form-data">
            <!-- Categoria do Serviço -->
            <div class="filtro-item">
                <label for="categoria">Categoria do Serviço*</label>
                <select id="categoria" required>
                    <option value="">Selecione uma categoria</option>
                    <option value="Eletricista">Eletricista</option>
                    <option value="Encanador">Encanador</option>
                    <option value="Faxina">Faxina</option>
                    <option value="Jardinagem">Jardinagem</option>
                </select>
            </div>

            <!-- Descrição Detalhada -->
            <div class="filtro-item">
                <label for="descricao">Descrição Detalhada*</label>
                <textarea id="descricao" rows="5" placeholder="Descreva os detalhes do serviço" required></textarea>
            </div>

            <!-- Endereço ou Localização -->
            <div class="filtro-item">
                <label for="endereco">Endereço de Prestação do Serviço*</label>
                <input type="text" id="endereco" placeholder="Digite o endereço completo" required>
                <button type="button" id="btn-localizacao">Capturar Localização</button>
            </div>

            <!-- Data e Hora -->
            <div class="filtro-item">
                <label for="data">Data de Execução*</label>
                <input type="date" id="data" required>
            </div>
            <div class="filtro-item">
                <label for="hora">Horário de Execução*</label>
                <input type="time" id="hora" required>
            </div>

            <!-- Orçamento Estimado -->
            <div class="filtro-item">
                <label for="orcamento">Orçamento Estimado (Opcional)</label>
                <input type="number" id="orcamento" placeholder="Ex.: 200,00">
            </div>

            <!-- Upload de Imagens -->
            <div class="filtro-item">
                <label for="imagens">Imagens (Opcional, Máx. 3)</label>
                <input  type="file" id="documentUpload" name="documentUpload" class="form-control" accept=".png, .jpeg, .jpg" required >
            </div>

            <!-- Botão de Submissão -->
            <button type="submit" id="btn-detalhes">Cadastrar Solicitação</button><br>
        </div>
        <br>
        </form>
    </main>
    <!-- Rodapé -->
    <div class="rodape">
        Chama Serviço &copy; Todos os direitos reservados
    </div>
    <!-- Script JS -->
    <script src="assets/js/solicitacao_servico.js"></script>
</body>
</html>
