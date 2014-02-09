<?php include_once '../layouts/header.php'; ?>

   <?php
  require_once '../../library/Simple_sessions.php';
   $obj_ses = new Simple_sessions();
  if($obj_ses->check_sess('userid')):
 ?><div id="content"> 
   <h2>Bienvenid@ <?php echo $obj_ses->get_value('fullname');?></h2>
</div>
 <?php
    else:?>
<div id="formbox">
    <?php include_once BASEPATH.'application/layouts/elementForm.php';?>
    <h3>Iniciar Sesión</h3>
    <?php if(isset($_GET['m']) && $_GET['m'] == '1' ):?>
    <div class="bad">El email o la contraseña estan vacios...</div>
     <?php elseif(isset($_GET['m']) && $_GET['m'] == '2' ):?>
    <div class="bad">Error! El email o contraseña no son correctos.</div>
    <?php endif; ?>
    <?php
    require_once BASEPATH . 'library/zebra_form/Zebra_Form.php';
    $form = new Zebra_Form('loginform', 'post', '../controllers/LoginController.php');

    /*
     * Email =  Correo del Usuarios
     * Password = La contraseña del usuario
     */

    // label, Input y validaciones para Email
    $form->add('label', 'label_email', 'email', 'Dirección de correo electronico');
    $obj = & $form->add('text', 'email');
    $obj->set_rule(array(
        'required' => array('error', 'Digite su correo electronico'),
        'email' => array('error', 'Ingrese un correo Valido')
    ));

    // label, Input y validaciones para password
    $form->add('label', 'label_pass', 'password', 'Contraseña');
    $obj = & $form->add('password', 'password', '', array('autocomplete' => 'off'));
    $obj->set_rule(array(
        'required' => array('error', 'Introdusca la contraseña!'),
        'length' => array(6, 'error', 'Digite minimo 6 caracteres!'),
    ));
    
    $obj = & $form->add('hidden', 'enviar', 'Enviar');
    // "submit"
    $form->add('submit', 'btnlogin', 'Iniciar Sesión');

    if ($form->validate()) {
        
    } else
        $form->render('*horizontal');
    ?>
</div>
<?php
    endif;
 ?>
<?php include_once '../layouts/footer.php'; ?>