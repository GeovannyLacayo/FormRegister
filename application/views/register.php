<?php include_once '../layouts/header.php';?>

<div id="formbox">
   <!-- Archivos necesarios para el formulario -->
    <?php include_once BASEPATH.'application/layouts/elementForm.php';?>   
      <h3>Registro de usuarios</h3>
      <?php if (isset($_GET['m']) && $_GET['m'] == '1'): ?>
          <div class="good">Registro exitoso! ahora puedes iniciar seción.</div>
      <?php elseif (isset($_GET['m']) && $_GET['m'] == '2'): ?>
          <div class="bad">Error! intente nuevamente...</div>
      <?php elseif (isset($_GET['m']) && $_GET['m'] == '3'): ?>
          <div class="bad">Error! El email ya esta registrado...</div>
      <?php endif; ?>
      <?php
       require_once BASEPATH.'library/zebra_form/Zebra_Form.php';
       $form = new Zebra_Form('formregister', 'post', '../controllers/UsuariosController.php');
       
       /*
        * FullName = nombre completo del usuario.
        * Email =  Correo del Usuarios
        * Password = La contraseña del usuario
        * PasswordTwo = verificador de la contraseña
        * Captcha = validador para evitar spam.
        */
       
        //Label para el FullName
        $form->add('label', 'label_fullname', 'fullname', 'Nombre Completo:');
        // Imput para el FullName
        $obj = & $form->add('text', 'fullname', '', array('autocomplete' => 'off'));
        // validaciones para el input FullName
        $obj->set_rule(array(
            'required' => array('error', 'Ingrese el nombre completo'),
            'alphabet' => array(' ', 'error', 'Solo se permiten letras')
        ));
       
       //Label para el Email
        $form->add('label','label_email', 'email', 'Correo:');
       // Input para el Email
        $obj = & $form->add('text','email');
       // validaciones para el Email
        $obj->set_rule(array(
                     'required' => array('error', 'Ingrese el correo'),
                     'email' => array('error', 'Ingrese un correo Valido')           
       ));
       
       //Label para el Password
       $form->add('label','label_password', 'password', 'Contraseña:');
       // Input para el Password
       $obj = & $form->add('password','password');
       // validaciones para el password
        $obj->set_rule(array(
                     'required' => array('error', 'Ingrese la contraseña'),
                     'length' => array(6,20, 'error', 'El minimo de caracteres es de seis') 
                      
       ));
       
       //Label para el password repeat
       $form->add('label','label_passwordtwo', 'passwordtwo', 'Repetir contraseña:');
       // Input para el password repeat
        $obj = & $form->add('password','passwordtwo');
       // validaciones password repeat
         $obj->set_rule(array(
                     'required' => array('error', 'Escriba nuevamente la contraseña'),
                     'compare' => array('password', 'error', 'Las contraseñas no coinciden') 
                      
       ));
       
       
       // Captcha

    $form->add('captcha', 'captcha_image', 'captcha_code');
    $form->add('label', 'label_captcha_code', 'captcha_code', 'Digita el Codigo');
    $obj = & $form->add('text', 'captcha_code', '', array('autocomplete' => 'off'));
    $form->add('note', 'note_captcha', 'captcha_code', 'Digite solo las letras de color negro', array('style' => 'width: 200px'));
    $obj->set_rule(array(
        'captcha' => array('error', 'Los caracteres no coinciden!')
    ));
       
   //Boton para enviar el formulario
   $form->add('submit', 'guardar', 'Guardar');

  // validacion, si el formulario esta correcto lo envia, sino muestra nuevamente el mismo.
    if ($form->validate()) {}  
    else
    $form->render('*vertical');
    ?>
    
</div>
<?php include_once '../layouts/footer.php';?>