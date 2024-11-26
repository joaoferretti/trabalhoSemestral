<?php 

    class viewListarUsuario {

        public function listar() {
            //Retornar a lista de usuários para o front-end - Produzir tabela em HTML.
            $modelUsuarios = Application::getInstance()->getModel('usuarios');
            $usuarios = $modelUsuarios->getAll();
            $html = '<table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Login</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Pass</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach($usuarios as $usuario) {
                $html .=  "<tr>                            
                             <td>" . $usuario->getUserLogin() . "</td>
                             <td>" . $usuario->getUserName() . "</td>
                             <td>" . $usuario->getUserPass() . "</td>
                          </tr>";
                     };
            $html .= "   </tbody>
                      </table>";
            
            Application::getInstance()->Display($html);
        }

    } 

?>