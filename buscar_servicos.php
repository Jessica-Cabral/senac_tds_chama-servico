<?php
include_once 'autoload.php'; // Inclua o autoloader para carregar suas classes

if (isset($_GET['tipo_servico_id'])) {
    $tipoServicoId = $_GET['tipo_servico_id'];

    $objServico = new Servico();
    $objServico->setIdTipoServico($tipoServicoId);
    $servicos = $objServico->consultarServicoPorTipo($tipoServicoId); // Suponha que este método existe

    if ($servicos) {
        echo "<option value=''>Selecione um Serviço</option>";
        foreach ($servicos as $servico) {
            echo "<option value='" . $servico->id_servico . "'>" . $servico->descricao_servico . "</option>";
        }
    } else {
        echo "<option value=''>Nenhum serviço encontrado</option>";
    }
}
?>