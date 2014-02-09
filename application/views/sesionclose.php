<?php 
    // Destruye toda la sesión
    destroy_sess();
    header('location:' . BASEURL . '');
?>