<?php

class ControllerServico
{
    redirecionar($pagina);

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
        //instanciar a classe
        $objTipoServico = new TipoServico();
        //invocar o método
        if ($objTipoServico->inserirEditora($descricao_tipo_servico) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultarTipoServico.php';
            //mostrar mensagem
            $this->mostrarMensagem("Tipo de serviço cadastrado com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultarTipoServico.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao cadastrar tipo de serviço!");
        }
    }

    //consultar Tipo de serviço
    public function consultar_tipo_servico($descricao_tipo_servico)
    {
        //instanciar a classe
        $objTipoServico = new TipoServico();
        //invocar o método
        if ($objTipoServico->consultarEditora($descricao_tipo_servico) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultarTipoServico.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar!");
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
        //instanciar a classe
        $objTipoServico = new TipoServico();
        //invocar o método
        if ($objTipoServico->alterar_tipo_servico($id_tipo_servico, $descricao_tipo_servico) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultarTipoServico.php';
            //mostrar mensagem
            $this->mostrarMensagem("Tipo de serviço alterado com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultarTipoServico.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar Tipo de serviço!");
        }
    }

    //excluir Tipo de serviço
    public function excluir_tipo_servico($id_tipo_servico)
    {
        //instanciar a classe
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


      
}