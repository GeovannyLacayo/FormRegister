<?php
require_once '../../library/Simple_sessions.php';
$obj_ses = new Simple_sessions();
if($obj_ses->check_sess('userid')):
?>
<h1>Bienvenid@ <?php echo $obj_ses->get_value('fullname');?> al administrador</h1>
<?php
else:
    header('location: login.php');
 endif;
?>