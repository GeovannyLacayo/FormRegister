<?php
/**
 * Clase UsuariosDao = para manejar las rutinas concernientes al CRUD, 
 * ademas contiene el objeto de conexión para la DB, utilizando el patron singleton
 * el cual permite crear siempre la misma instancia, una solo instancia para cualquier llamado. 
 *
 * @author Jeison Varilla
 * @link www.keyphercom.com
 * Monteria - Colombia 2013
 */
require_once $_SERVER["DOCUMENT_ROOT"] . '/06-formRegister/config.ini.php';
require_once BASEPATH . "application/models/Usuarios.php";
require_once BASEPATH . 'library/DbPdo.php';
require_once BASEPATH . 'library/Simple_sessions.php';


class UsuariosDao {
    
    /**
     * _getDbh = obtiene el metodo de conexión a la DB mediante singleton
     */

    protected function _getDbh() {
        return DbPdo::getInstance()->getConn();
    }

    /**
     * Metodo guardar = crea, inserta, guarda al usuario por argumento, 
     * el objeto usuarios (valueObject) contiene los valores de la peticion
     * enviados desde el formulario, y estos son procesador mediante los 
     * metodos getter and setter de la clase Usuarios, lo cual permite acceder a
     * sus atributos (encapsulamiento).
     */

    public function guardar(Usuarios $usuarios) {


        $sql = "INSERT INTO `usuarios` (`fullname`, `email`, `password`, `password2`)"
                . "VALUES(?, ?, ?, ?)";

        $stm = $this->_getDbh()->prepare($sql);
        $stm->bindvalue(1, $usuarios->getFullname(), PDO::PARAM_STR);
        $stm->bindvalue(2, $usuarios->getEmail(), PDO::PARAM_STR);
        $stm->bindvalue(3, $usuarios->getPassword(), PDO::PARAM_STR);
        $stm->bindvalue(4, $usuarios->getPassword2(), PDO::PARAM_STR);

        $result = $stm->execute();
        return $result;
    }

    /**
     * DuplicateCheck = verifica si existe almenos un correo 
     * asociado a una cuenta de usuario, retornando true para indicar 
     * que si existe y false nos indica que no existe usuario con ese correo. 
     */

    public function DuplicateCheck($data) {

        $sql = "SELECT `email` from `usuarios`"
                . "WHERE `email` = ?";

        $stm = $this->_getDbh()->prepare($sql);
        $stm->bindParam(1, $data, PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    /**
     * Login = comprobamos que los datos existan en al DB y le damos acceso al cpanel
     */
    
    public function login(Usuarios $usuarios){
        
        $sql = "SELECT * from `usuarios`"
               ."WHERE `email` = ? AND `password` = ? AND `password2` = ?";
        
        $stm = $this->_getDbh()->prepare($sql);
        $stm->bindParam(1, $usuarios->getEmail(), PDO::PARAM_STR);
        $stm->bindParam(2, $usuarios->getPassword(), PDO::PARAM_STR);
        $stm->bindParam(3, $usuarios->getPassword2(), PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        
        // usuario no existe
        if($result == FALSE){
            
            header('location: ../views/login.php?m=2');
        }else{
            
            $obj_ses = new Simple_sessions();
            $data = array('userid' => $result['iduser'],
                          'fullname' => $result['fullname']);
            
            $obj_ses->add_sess($data);
            header('location: ../views/admin.php');
  
        }
        
    }

}

