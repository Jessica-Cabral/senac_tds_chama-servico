<?php

//incluir Classe de conexão
include_once "Conexão.class.php";

//classe Usuário
class TipoUsuario extends Conexao
{
    private $id_tipo_usuario;
    private $descricao_tipo_usuario;

    //getters e setters
    public function getIdTipoUsuario()
    {
        return $this->id_tipo_usuario;
    }


    public function setIdTipoUsuario($id_tipo_usuario)
    {
        $this->id_tipo_usuario = $id_tipo_usuario;
    }

    public function getDescricaoTipoUsuario()
    {
        return $this->descricao_tipo_usuario;
    }


    public function setDescricaoTipoUsuario($descricao_tipo_usuario)
    {
        $this->descricao_tipo_usuario = $descricao_tipo_usuario;

    }

    //médotos
        //métodos inserir Tipo Usuario
    public function inserirTipoUsuario($descricao_tipo_usuario){
        //setar dos atributos
        $this->setDescricaoTipoUsuario($descricao_tipo_usuario);

        //montar query
        $sql = "INSERT INTO tb_tipo_usuario (id_descricao_tipo_usuario, descricao_tipo_usuario) VALUES (NULL, :$descricao_tipo_usuario)";
        
            //executar a query
            try{
                //conectar com o banco
                $bd = $this->conectar();
                //preparar sql
                $query = $bd->prepare($sql);
                //blidagem dos dados
                $query->bindValue(':descricao_tipo_usuario', $this->getDescricaoTipoUsuario(), PDO::PARAM_STR);
                //executar a query
                $query->execute();
                //retornar o resultado
                //echo "Inserido!";
                return true;

            }
            catch (PDOException $e) {
                //echo "Erro ao inserir!";
                return false;
            }
    }
        
        //método  consultar Descricao Tipo Usuario
        public function consultarTipoUsuario($descricao_tipo_usuario){
            //setar dos atributos
            $this->setDescricaoTipoUsuario($descricao_tipo_usuario);

            //montar query
            $sql = "SELECT * FROM tb_tipo_usuario where true";
            //
            if ($this->getDescricaoTipoUsuario() !=null){
                $sql .= " AND $descricao_tipo_usuario LIKE :descricao_tipo_usuario";
            }
            //executar a query
                try{
                    //conectar com o banco
                    $bd = $this->conectar();
                    //preparar sql
                    $query = $bd->prepare($sql);
                    //blidagem dos dados
                    if ($this->getDescricaoTipoUsuario()!= null) {
                        $this->setDescricaoTipoUsuario("%".$descricao_tipo_usuario."%");
                        $query->bindValue(':descricao_tipo_usuario', $this->getDescricaoTipoUsuario(), PDO::PARAM_STR);
                    }
                    //executar a query no banco de dados
                    $query->execute();
                    //Armazena os resultados em formato de objeto (FETCH_obj)
                    $resultado = $query->fetchAll(PDO::FETCH_OBJ);
                    //Retorna os dados da consult
                    return $resultado;
                } catch (PDOException $e) {
                    //echo "Erro ao consultar!";
                    return false;
                }
        }
        
        //métodos alterar tipo de usuário
        public function alterarTipoUsuario($id_tipo_usuario, $descricao_tipo_usuario){
            //setar dos atributos
            $this->setIdTipoUsuario($id_tipo_usuario);
            $this->setDescricaoTipoUsuario($descricao_tipo_usuario);

            //montar query
            $sql = "UPDATE tb_tipo_usuario SET descricao_tipo_usuario = :descricao_tipo_usuario WHERE id_tipo_usuario = :id_tipo_usuario";
        
            //executar a query
            try{
                //conectar com o banco
                $bd = $this->conectar();
                //preparar sql
                $query = $bd->prepare($sql);
                //blidagem dos dados
                $query->bindValue(':id_tipo_usuario', $this->getIdTipoUsuario(), PDO::PARAM_INT);
                $query->bindValue(':descricao_tipo_usuario', $this->getDescricaoTipoUsuario(), PDO::PARAM_STR);
                //executar a query
                $query->execute();
                //retornar o resultado
                //echo "Alterado!";
                return true;

            }
            catch (PDOException $e) {
                //echo "Erro ao alterar!";
                return false;
            }
        }
        
        //método excluir
        public function excluirTipoUsuario($id_tipo_usuario){
            //setar dos atributos
            $this->setIdTipoUsuario($id_tipo_usuario);

            //montar query
            $sql = "DELETE FROM tb_tipo_usuario WHERE id_tipo_usuario = :id_tipo_usuario;";
        
            //executar a query
            try{
                //conectar com o banco
                $bd = $this->conectar();
                //preparar sql
                $query = $bd->prepare($sql);
                //blidagem dos dados
                $query->bindValue(':id_tipo_usuario', $this->getIdTipoUsuario(), PDO::PARAM_INT);
                //executar a query
                $query->execute();
                //retornar o resultado
                //echo "Excluído!";
                return true;

                }
            catch (PDOException $e) {
                //echo "Erro ao excluir!".$e->getMessage();
                return false;
                }
        }
}

?>