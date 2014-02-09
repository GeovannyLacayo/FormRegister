<?php
/*
 * @Archivo: LoginController  
 * @Descripcion: para el tratamiento de los datos antes de enviarlos a al capa de persistencia(usuarios)
 *               y al modelo usuarios DAO.
 * 
 */

require_once $_SERVER["DOCUMENT_ROOT"] . '/06-formRegister/config.ini.php';
require_once BASEPATH . 'library/Inputfilter.php';
require_once BASEPATH . 'library/Helpers.php';
require_once BASEPATH . 'application/models/Usuarios.php';
require_once BASEPATH . 'application/models/UsuariosDao.php';

//Enviar variable oculta enviada desde el formulario
if (isset($_POST['enviar']) && $_POST['enviar'] == 'Enviar') {

    if (!Helpers::validDatas(array($_POST['email'], $_POST['password']))) {
        header('location:' . BASEURL . 'application/views/login.php?m=1'); // Error! Existen datos vacios...
    } else {
       
        $obj_clean = new InputFilter();
        $email = $obj_clean->process($_POST['email']);
        $password = $obj_clean->process(md5($_POST['password']));
        $password2 = md5($password);
        
        $usuarios = new Usuarios();
        $usuarios->setEmail($email);
        $usuarios->setPassword($password);
        $usuarios->setPassword2($password2);
        
        $obj_user = new UsuariosDao();
        $obj_user->login($usuarios);
        
        
    }
} else {
    // Devolvemos al index a quien intente abrir el archivo por URL
    header('location:' . BASEURL . '');
}
?>
