<?php
	$peticion_ajax=true;
	require_once "../config/APP.php";
	include "../vistas/inc/session_start.php";

	if(isset($_POST['modulo_signin'])){

		/*--------- Instancia al controlador - Instance to controller ---------*/
		require_once "../controladores/signinControlador.php";
        $ins_signin = new signinControlador();
        

        /*--------- Cerrar sesion administrador - Log out administrator ---------*/
        if($_POST['modulo_signin']=="logout_usuario"){
            echo $ins_signin->cerrar_sesion_usuario_controlador();
		}


	}else{
		session_destroy();
		header("Location: ".SERVERURL."index/");
	}