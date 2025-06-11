<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <style>
        .required:after {
            content: " *";
            color: red;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .loading {
            display: none;
            color: rgb(123, 14, 133);
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-tools me-2"></i>Solicitar Orçamento/Serviço</h4>
                    </div>
                    <div class="card-body">
                        <form action="index.php" method="POST" enctype="multipart/form-data" id="form-solicitacao">
                            <?php
                            foreach ($_SESSION['dadosPessoa'] as $key => $valor) {
                                print '<div class="mb-4">
                                    <h5 class="mb-3 border-bottom pb-2"><i class="fas fa-user me-2"></i>Dados do Solicitante</h5>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="nome" class="form-label required">Nome Completo</label>
                                            <input type="text" class="form-control" id="nome" name="nome" value="' . $valor->nome . '" disabled>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="telefone" class="form-label required">Telefone</label>
                                            <input type="tel" class="form-control" id="telefone" name="telefone" value="' . $valor->telefone . '">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" value="' . $valor->email . '">
                                    </div>
                                </div>';
                            }
                            ?>

                            <div class="mb-4">
                                <h5 class="mb-3 border-bottom pb-2"><i class="fas fa-clipboard-list me-2"></i>Dados do
                                    Serviço</h5>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tipo_servico" class="form-label required">Tipo de Serviço</label>
                                        <select name="tipo_servico" id="tipo_servico" class="form-select" required>
                                            <option value="">Selecione um Tipo</option>
                                            <?php
                                            $objTipoServico = new TipoServico();
                                            $tipos = $objTipoServico->consultarTipoServico(null);
                                            if ($tipos) {
                                                foreach ($tipos as $tipo) {
                                                    echo "<option value='" . $tipo->id_tipo_servico . "'>" . $tipo->descricao_tipo_servico . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="servico" class="form-label required">Serviço</label>
                                        <select name="servico" id="servico" class="form-select" required>
                                            <option value="">Selecione um Serviço</option>
                                        </select>
                                    </div>
                                </div>

                                <h6 class="mb-3 border-bottom pb-2"><i class="fas fa-map-marker-alt me-2"></i>Endereço
                                </h6>

                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="cep" class="form-label required">CEP</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cep" name="cep" required>
                                            <button class="btn btn-outline-secondary" type="button" id="buscar-cep">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        <span id="loading-cep" class="loading">
                                            <i class="fas fa-spinner fa-spin"></i> Buscando...
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label for="logradouro" class="form-label required">Logradouro</label>
                                        <input type="text" class="form-control" id="logradouro" name="logradouro"
                                            required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="numero" class="form-label required">Número</label>
                                        <input type="text" class="form-control" id="numero" name="numero" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" id="complemento" name="complemento">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="bairro" class="form-label required">Bairro</label>
                                        <input type="text" class="form-control" id="bairro" name="bairro" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="cidade" class="form-label required">Cidade</label>
                                        <input type="text" class="form-control" id="cidade" name="cidade" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="uf" class="form-label required">Estado</label>
                                        <input type="text" class="form-control" id="uf" name="uf" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="descricao" class="form-label required">Descrição Detalhada</label>
                                    <textarea class="form-control" id="descricao" name="descricao" rows="4"
                                        required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="portfolio" class="form-label">Fotos (Fotos/Arquivos)</label>
                                    <input type="file" class="form-control" id="portfolio" name="portfolio[]" multiple
                                        accept="image/*,.pdf">
                                    <small class="text-muted">Formatos aceitos: JPG, PNG, GIF, PDF (Máx. 5MB
                                        cada)</small>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-secondary me-md-2">
                                    <i class="fas fa-eraser me-1"></i> Limpar
                                </button>
                                <button type="submit" name="cadastrar_solicitacao" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-1"></i> Enviar Solicitação
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função para buscar CEP
        function buscarCEP() {
            const cep = document.getElementById('cep').value.replace(/\D/g, '');
            const loading = document.getElementById('loading-cep');

            if (cep.length !== 8) {
                alert('CEP deve conter 8 dígitos');
                return;
            }

            loading.style.display = 'inline-block';

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (data.erro) {
                        throw new Error('CEP não encontrado');
                    }

                    // Preenche os campos com os dados da API
                    document.getElementById('logradouro').value = data.logradouro || '';
                    document.getElementById('bairro').value = data.bairro || '';
                    document.getElementById('cidade').value = data.localidade || '';  // Corrigido para 'cidade'
                    document.getElementById('uf').value = data.uf || '';

                    // Foca no campo número após preencher
                    document.getElementById('numero').focus();
                })
                .catch(error => {
                    console.error('Erro ao buscar CEP:', error);
                    alert('CEP não encontrado. Por favor, preencha os dados manualmente.');
                    document.getElementById('logradouro').focus();
                })
                .finally(() => {
                    loading.style.display = 'none';
                });
        }

        // Máscara para o CEP
        function mascaraCEP(input) {
            input.value = input.value.replace(/\D/g, '');
            if (input.value.length > 5) {
                input.value = input.value.replace(/^(\d{5})(\d)/, '$1-$2');
            }
            if (input.value.length > 8) {
                input.value = input.value.substring(0, 9);
            }
        }

        // Máscara para o telefone
        function mascaraTelefone(input) {
            input.value = input.value.replace(/\D/g, '');
            if (input.value.length > 2) {
                input.value = '(' + input.value.substring(0, 2) + ') ' + input.value.substring(2);
            }
            if (input.value.length > 10) {
                input.value = input.value.substring(0, 10) + '-' + input.value.substring(10, 14);
            }
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function () {
            // Buscar CEP ao clicar no botão
            document.getElementById('buscar-cep').addEventListener('click', buscarCEP);

            // Buscar CEP ao pressionar Enter no campo CEP
            document.getElementById('cep').addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    buscarCEP();
                }
            });

            // Aplicar máscara ao digitar CEP
            document.getElementById('cep').addEventListener('input', function () {
                mascaraCEP(this);
            });

            // Aplicar máscara ao digitar telefone
            document.getElementById('telefone').addEventListener('input', function () {
                mascaraTelefone(this);
            });

            // Evento de change para o select de tipo de serviço
            document.getElementById('tipo_servico').addEventListener('change', function () {
                var idTipoServico = this.value;
                if (idTipoServico) {
                    // Enviar requisição AJAX para buscar os serviços
                    fetch('buscar_servicos.php?tipo_servico_id=' + idTipoServico)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('servico').innerHTML = data;
                        });
                } else {
                    // Limpar o select de serviços se nenhum tipo for selecionado
                    document.getElementById('servico').innerHTML = '<option value="">Selecione um Serviço</option>';
                }
            });
        });

        // Validação do formulário
        document.getElementById('form-solicitacao').addEventListener('submit', function (e) {
            let isValid = true;
            const camposObrigatorios = [
                'tipo_servico', 'servico', 'cep', 'logradouro', 'numero', 'bairro',
                'cidade', 'uf', 'descricao', 'nome', 'telefone'
            ];

            camposObrigatorios.forEach(function (id) {
                const campo = document.getElementById(id);
                if (!campo.value.trim()) {
                    campo.classList.add('is-invalid');
                    isValid = false;
                } else {
                    campo.classList.remove('is-invalid');
                }
            });

            // Validar arquivos (se enviados)
            const arquivos = document.getElementById('portfolio').files;
            if (arquivos.length > 0) {
                for (let i = 0; i < arquivos.length; i++) {
                    if (arquivos[i].size > 5 * 1024 * 1024) { // 5MB
                        alert('O arquivo ' + arquivos[i].name + ' excede o tamanho máximo de 5MB');
                        isValid = false;
                        break;
                    }
                }
            }

            if (!isValid) {
                e.preventDefault();
                alert('Por favor, preencha todos os campos obrigatórios corretamente!');
            }
        });
    </script>
</body>

</html>