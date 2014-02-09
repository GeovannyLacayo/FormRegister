<?php

/*
 * @Archivo: UsuariosController.php
 * @Descripcion: Archivo donde se resiven los datos enviados desde le formulario de registro de usuarios, 
 *               el cual permite hacer diferentes tareas de validaciones, restricciones y otras; para luego
 *               ser enviadas al metodo "guardar de la clase UsuariosDao" el cual permite la insercion de estos en la base de datos. 
 */
require_once $_SERVER["DOCUMENT_ROOT"] . '/06-formRegister/config.ini.php';
require_once BASEPATH . 'library/Inputfilter.php';
require_once BASEPATH . 'library/Helpers.php';
require_once BASEPATH . 'application/models/Usuarios.php';
require_once BASEPATH . 'application/models/UsuariosDao.php';


if (isset($_POST['guardar']) && $_POST['guardar'] == 'Guardar') {

    // Ud pueden hacer todas las validaciones que requieran...   
    if (!Helpers::validDatas(array($_POST['fullname'], $_POST['email'], $_POST['password']))) {

        header('location:' . BASEURL . 'application/views/register.php?m=1'); // Error! Existen datos vacios...
    } else {

        $obj_clean = new InputFilter();

        $fullname = $obj_clean->process($_POST['fullname']);
        $email = $_POST['email']; // Pueden usar $obj_clean y observen los resultados... tambien es recomendable validar el Email, existe un metodo en Helpers para validar el correo.
        $password = $obj_clean->process(md5($_POST['password']));
        // No es obligatorio tener dos password, en caso tal pudes encriptarlos de la manera que gustes.
        $password2 = md5($password);
        
        $obj_user = new UsuariosDao();
        $response = $obj_user->DuplicateCheck($email);
        if ($response == TRUE) {

            // Ya existe un campo asociado a un usuario
            header('location:' . BASEURL . 'application/views/register.php?m=3');
        } else {

            $usuarios = new Usuarios();
            $usuarios->setFullname($fullname);
            $usuarios->setEmail($email);
            $usuarios->setPassword($password);
            $usuarios->setPassword2($password2);

            $result = $obj_user->guardar($usuarios);
            if ($result == null) {

                //echo "No se pudo guardar";
                header('location:' . BASEURL . 'application/views/register.php?m=2');
            } else {

                //echo "Se ha guardado en la DB";
                header('location:' . BASEURL . 'application/views/register.php?m=1');
            }
        }
    }
} else {
// Devolvemos al index a quien intente abrir el archivo por URL
    header('location:' . BASEURL . '');
}
?>

