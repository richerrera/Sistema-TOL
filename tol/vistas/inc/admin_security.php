<?php 
    if($_SESSION['cargo_sto']!="Administrador" || $_SESSION['cargo_sto']=="Usuario"){
        $ins_login->forzar_cierre_sesion_controlador();
        exit();
    }
