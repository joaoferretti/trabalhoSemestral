<?php 

    class modelUsuarios {

        public function getAll() {
            $result = Array();
            $query = Application::getInstance()->getDataBase()->newQuery();
            $query->setSql("SELECT 'cleber' AS nome, '123456' as pass, 'cleber@login' as login");
            $query->open();
            while($row = $query->getNextRow()) {
                $usuario = Application::getInstance()->getModel('usuario');
                $usuario->setData($row);
                array_push($result, $usuario);
            }
            return $result;
        }

        //Retorna uma instância de usuarário buscada do banco de dados pelo login
        public function findByLogin($login) {
            
        }

    }

?>