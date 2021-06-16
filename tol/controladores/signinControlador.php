<?php

	if($peticion_ajax){
		require_once "../modelos/mainModel.php";
	}else{
		require_once "./modelos/mainModel.php";
	}

	class signinControlador extends mainModel{

		/*----------  Controlador iniciar sesion usuario - Controller login administrator ----------*/
		public function iniciar_sesion_usuario_controlador(){

			$email=mainModel::limpiar_cadena($_POST['login_email']);
			$clave=mainModel::limpiar_cadena($_POST['login_clave']);

			/*-- Comprobando campos vacios - Checking empty fields --*/
			if($email=="" || $clave==""){
				echo'<script>
					Swal.fire({
					  title: "Ocurrió un error inesperado",
					  text: "No has llenado el campo correctamente.",
					  icon: "error",
					  confirmButtonText: "Aceptar"
					});
				</script>';
				exit();
			}

			$clave=mainModel::encryption($clave);

			/*-- Verificando datos de la cuenta - Verifying account details --*/
			$datos_cuenta=mainModel::datos_tabla("Normal","cliente WHERE cliente_email='$email' AND cliente_clave='$clave' AND cliente_cuenta_estado='Activa'","*",0);

			if($datos_cuenta->rowCount()==1){

				$row=$datos_cuenta->fetch();

				$datos_cuenta->closeCursor();
			    $datos_cuenta=mainModel::desconectar($datos_cuenta);

				$_SESSION['id_sto']=$row['cliente_id'];
				$_SESSION['email_sto']=$row['cliente_email'];
				$_SESSION['apellido_sto']=$row['cliente_apellido'];
				$_SESSION['genero_sto']=$row['cliente_genero'];
				$_SESSION['usuario_sto']=$row['cliente_nombre'];
				$_SESSION['cargo_sto']="Usuario";
				$_SESSION['foto_sto']=$row['cliente_foto'];
				$_SESSION['token_sto']=mainModel::encryption(uniqid(mt_rand(), true));



				if(headers_sent()){
					echo "<script> window.location.href='".SERVERURL.DASHBOARD."/home/'; </script>";
				}else{
					return header("Location: ".SERVERURL.DASHBOARD."/home/");
				}

			}else{
				echo'<script>
					Swal.fire({
					  title: "Datos incorrectos",
					  text: "El nombre de usuario o contraseña no son correctos.",
					  icon: "error",
					  confirmButtonText: "Aceptar"
					});
				</script>';
			}
		} /*-- Fin controlador - End controller --*/


		/*----------  Controlador forzar cierre de sesion - Controller force logout ----------*/
		public function forzar_cierre_sesion_controlador(){
			session_destroy();
			if(headers_sent()){
				echo "<script> window.location.href='".SERVERURL."index/'; </script>";
			}else{
				return header("Location: ".SERVERURL."index/");
			}
		} /*-- Fin controlador - End controller --*/


		/*----------  Controlador cierre de sesion administrador - Controller logout administrator  ----------*/
		public function cerrar_sesion_administrador_controlador(){
			$token=mainModel::decryption($_POST['token']);
			$usuario=mainModel::decryption($_POST['usuario']);

			if($token==$_SESSION['token_sto'] && $usuario==$_SESSION['usuario_sto']){
				unset($_SESSION['id_sto']);
				unset($_SESSION['nombre_sto']);
				unset($_SESSION['apellido_sto']);
				unset($_SESSION['genero_sto']);
				unset($_SESSION['usuario_sto']);
				unset($_SESSION['cargo_sto']);
				unset($_SESSION['foto_sto']);
				unset($_SESSION['token_sto']);
				$alerta=[
					"Alerta"=>"redireccionar",
					"URL"=>SERVERURL."index/"
				];
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se pudo cerrar la sesión",
					"Icon"=>"error",
					"TxtBtn"=>"Aceptar"
				];
			}
			echo json_encode($alerta);
		} /*-- Fin controlador - End controller --*/
	}