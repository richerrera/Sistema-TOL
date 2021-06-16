<?php
	$peticion_ajax=true;
	require_once "../config/APP.php";
	include "../vistas/inc/session_start.php";

	

	if(isset($_POST['modulo_producto'])){

		/*--------- Instancia al controlador - Instance to controller ---------*/
		require_once "../controladores/productoControlador.php";
        $ins_producto = new productoControlador();
        

        /*--------- Registrar producto - Register product ---------*/
        if($_POST['modulo_producto']=="registro"){
            echo $ins_producto->registrar_producto_controlador();
		}

		/*--------- Eliminar producto - Delete product ---------*/
        if($_POST['modulo_producto']=="eliminar"){
            echo $ins_producto->eliminar_producto_controlador();
		}

		/*--------- Actualizar producto - Update product ---------*/
        if($_POST['modulo_producto']=="actualizar"){
            echo $ins_producto->actualizar_producto_controlador();
        }

	}else{
		session_destroy();
		header("Location: ".SERVERURL."index/");
	}