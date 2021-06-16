<?php

    if($peticion_ajax){
        require_once "../modelos/mainModel.php";
    }else{
        require_once "./modelos/mainModel.php";
    }

	class productoControlador extends mainModel{

        /*--------- Controlador registrar producto - Controller register client ---------*/
        public function registrar_producto_controlador(){

            /*-- Comprobando privilegios - Checking privileges --*/
            if($_SESSION['cargo_sto']!="Administrador"){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Acceso no permitido",
                    "Texto"=>"No tienes los permisos necesarios para realizar esta operación en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
				echo json_encode($alerta);
				exit();
			}


            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $codigo=mainModel::limpiar_cadena($_POST['producto_codigo_reg']);
            $sku=mainModel::limpiar_cadena($_POST['producto_sku_reg']);
            $nombre=mainModel::limpiar_cadena($_POST['producto_nombre_reg']);
            $descripcion=mainModel::limpiar_cadena($_POST['producto_descripcion_reg']);
            $stock=mainModel::limpiar_cadena($_POST['producto_stock_reg']);
            $precio=mainModel::limpiar_cadena($_POST['producto_precio_venta_reg']);
            $estado=mainModel::limpiar_cadena($_POST['producto_estado_reg']);
            $portada=mainModel::limpiar_cadena($_FILES['imagen']['name']);
            $categoria=mainModel::limpiar_cadena($_POST['producto_categoria_reg']);

            if (isset($_FILES['imagen'])) {
							
                //Guardar la imagen
                $file = $_FILES['imagen'];
                $filename = $file['name'];
                $mimetype = $file['type'];
    
                if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
    
                    move_uploaded_file($file['tmp_name'], "../vistas/assets/product/cover/".$filename);
                    $portada=mainModel::limpiar_cadena($filename);
                   
                }
            }
            /*-- Comprobando campos vacios - Checking empty fields --*/
            if($codigo=="" || $nombre=="" || $stock=="" || $precio=="" || $estado=="" || $categoria==""){
                $alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No has llenado todos los campos que son obligatorios",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
            }

           

            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
			$datos_producto_reg=[
				"producto_codigo"=>[
					"campo_marcador"=>":Codigo",
					"campo_valor"=>$codigo
				],
				"producto_sku"=>[
					"campo_marcador"=>":SKU",
					"campo_valor"=>$sku
                ],
				"producto_nombre"=>[
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
                ],
                "producto_descripcion"=>[
					"campo_marcador"=>":Descripcion",
					"campo_valor"=>$descripcion
				],
                "producto_stock"=>[
					"campo_marcador"=>":Stock",
					"campo_valor"=>$stock
                ],
                "producto_precio_venta"=>[
					"campo_marcador"=>":Precio",
					"campo_valor"=>$precio
				],
                "producto_estado"=>[
					"campo_marcador"=>":Estado",
					"campo_valor"=>$estado
				],
				"producto_portada"=>[
					"campo_marcador"=>":Portada",
					"campo_valor"=>$portada
				],
				"categoria_id"=>[
					"campo_marcador"=>":Categoria",
					"campo_valor"=>$categoria
				]
			];

            /*-- Guardando datos del producto - Saving client data --*/
			$agregar_producto=mainModel::guardar_datos("producto",$datos_producto_reg);

			if($agregar_producto->rowCount()==1){
                $alerta=[
                    "Alerta"=>"limpiar",
                    "Titulo"=>"¡producto registrado!",
                    "Texto"=>"Los datos del producto se registraron con éxito",
                    "Icon"=>"success",
                    "TxtBtn"=>"Aceptar"
                ];
			}else{
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos podido registrar los datos, por favor intente nuevamente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
			}

			$agregar_producto->closeCursor();
			$agregar_producto=mainModel::desconectar($agregar_producto);

			echo json_encode($alerta);
        } /*-- Fin controlador registrar producto - End controller --*/


        /*--------- Controlador paginador productos - Clients Pager Controller ---------*/
        public function paginador_producto_controlador($pagina,$registros,$url,$busqueda){
            $pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);

			$url=mainModel::limpiar_cadena($url);
			$url=SERVERURL.DASHBOARD."/".$url."/";

            $busqueda=mainModel::limpiar_cadena($busqueda);
            $id=1;
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
            
            if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM producto WHERE (producto_codigo LIKE '%$busqueda%' OR producto_sku LIKE '%$busqueda%' OR producto_nombre LIKE '%$busqueda%') ORDER BY producto_nombre ASC LIMIT $inicio,$registros";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM producto ORDER BY producto_nombre ASC LIMIT $inicio,$registros";
			}

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();

			$total = $conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();

            $Npaginas =ceil($total/$registros);
            
            /*-- Encabezado de la tabla - Table header --*/
			$tabla.='
            <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr class="text-center font-weight-bold">
                        <th>#</th>
                        <th>Codigo</th>
                        <th>SKU</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
            ';

            if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $rows){
					$tabla.='
						<tr class="text-center" >
							<td>'.$contador.'</td>
                            <td>'.$rows['producto_codigo'].'</td>
							<td>'.$rows['producto_sku'].'</td>
                            <td>'.$rows['producto_nombre'].'</td>
                            <td>'.$rows['producto_stock'].'</td>
							<td>'.$rows['producto_precio_venta'].'</td>
							<td><a class="btn btn-link text-success" href="'.SERVERURL.DASHBOARD.'/producto-update/'.mainModel::encryption($rows['producto_id']).'/"><i class="fas fa-sync-alt"></i></a></td>
							<td>
                                <form class="FormularioAjax" action="'.SERVERURL.'ajax/productoAjax.php" method="POST" data-form="delete" data-lang="'.LANG.'" >
                                    <input type="hidden" name="modulo_producto" value="eliminar">
									<input type="hidden" name="producto_id_del" value="'.$rows['producto_id'].'">
									<button type="submit" class="btn btn-link text-danger"><i class="far fa-trash-alt"></i></button>
								</form>
							</td>
						</tr>
					';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
					$tabla.='
						<tr class="text-center" >
							<td colspan="7">
								<a href="'.$url.'" class="btn btn-primary btn-sm">
									Haga clic acá para recargar el listado
								</a>
							</td>
						</tr>
					';
				}else{
					$tabla.='
						<tr class="text-center" >
							<td colspan="7">
								No hay registros en el sistema
							</td>
						</tr>
					';
				}
			}

            $tabla.='</tbody></table></div>';

			if($total>0 && $pagina<=$Npaginas){
				$tabla.='<p class="text-end">Mostrando productos <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
			}

			/*--Paginacion - Pagination --*/
			if($total>=1 && $pagina<=$Npaginas){
				$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7,LANG);
			}

			return $tabla;
        } /*-- Fin controlador paginador productos- End controller --*/


        /*--------- Controlador eliminar producto - Controller delete client ---------*/
        public function eliminar_producto_controlador(){

            /*-- Comprobando privilegios - Checking privileges --*/
			if($_SESSION['cargo_sto']!="Administrador" && $_SESSION['cargo_sto']!="Usuario"){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Acceso no permitido",
                    "Texto"=>"No tienes los permisos necesarios para realizar esta operación en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
				echo json_encode($alerta);
				exit();
			}

            /*-- Recuperando id del producto - Retrieving client id - --*/
			$id=mainModel::decryption($_POST['producto_id_del']);
			$id=mainModel::limpiar_cadena($id);


            /*-- Comprobando producto en la BD - Checking client in DB --*/
			$check_producto=mainModel::ejecutar_consulta_simple("SELECT producto_id FROM producto WHERE producto_id='$id'");
			if($check_producto->rowCount()<=0){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"producto no encontrado",
					"Texto"=>"El producto que intenta eliminar no existe en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}
			$check_producto->closeCursor();
			$check_producto=mainModel::desconectar($check_producto);

            /*-- Eliminando producto - Deleting client --*/
			$eliminar_producto=mainModel::eliminar_registro("producto","producto_id",$id);

			if($eliminar_producto->rowCount()==1){
				$alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"¡producto eliminado!",
                    "Texto"=>"El producto ha sido eliminado del sistema exitosamente",
                    "Icon"=>"success",
                    "TxtBtn"=>"Aceptar"
                ];
			}else{
				$alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos podido eliminar el producto del sistema, por favor intente nuevamente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
			}

			$eliminar_producto->closeCursor();
			$eliminar_producto=mainModel::desconectar($eliminar_producto);

			echo json_encode($alerta);
        } /*-- Fin controlador eliminar producto- End controller --*/


        /*--------- Controlador actualizar producto - Controller update client ---------*/
		public function actualizar_producto_controlador(){

            /*-- Recibiendo id del producto - Receiving client id --*/
			$id=mainModel::decryption($_POST['producto_id_up']);
			$id=mainModel::limpiar_cadena($id);

            /*-- Comprobando producto en la DB - Checking client in DB --*/
			$check_producto=mainModel::ejecutar_consulta_simple("SELECT * FROM producto WHERE producto_id='$id'");
			if($check_producto->rowCount()<=0){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Cuenta no encontrada",
					"Texto"=>"No hemos encontrado la cuenta en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}else{
				$campos=$check_producto->fetch();
			}
			$check_producto->closeCursor();
			$check_producto=mainModel::desconectar($check_producto);

          

            /*-- Recibiendo datos del formulario - Receiving form data --*/
            $codigo=mainModel::limpiar_cadena($_POST['producto_codigo_up']);
            $sku=mainModel::limpiar_cadena($_POST['producto_sku_up']);
            $nombre=mainModel::limpiar_cadena($_POST['producto_nombre_up']);
            $descripcion=mainModel::limpiar_cadena($_POST['producto_descripcion_up']);
            $stock=mainModel::limpiar_cadena($_POST['producto_stock_up']);
            $precio=mainModel::limpiar_cadena($_POST['producto_precio_venta_up']);
            $estado=mainModel::limpiar_cadena($_POST['producto_estado_up']);
            $portada=mainModel::limpiar_cadena($_POST['producto_portada_up']);
            $categoria=mainModel::limpiar_cadena($_POST['producto_categoria_up']);

        /*-- Comprobando campos vacios - Checking empty fields --*/
        if($codigo=="" || $nombre=="" || $stock=="" || $precio=="" || $estado=="" || $categoria==""){
            $alerta=[
                "Alerta"=>"simple",
                "Titulo"=>"Ocurrió un error inesperado",
                "Texto"=>"No has llenado todos los campos que son obligatorios",
                "Icon"=>"error",
                "TxtBtn"=>"Aceptar"
            ];
            echo json_encode($alerta);
            exit();
        }

                       
          

            /*-- Preparando datos para enviarlos al modelo - Preparing data to send to the model --*/
			$datos_producto_up=[
				"producto_codigo"=>[
					"campo_marcador"=>":Codigo",
					"campo_valor"=>$codigo
				],
				"producto_sku"=>[
					"campo_marcador"=>":SKU",
					"campo_valor"=>$sku
                ],
				"producto_nombre"=>[
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
                ],
                "producto_descripcion"=>[
					"campo_marcador"=>":Descripcion",
					"campo_valor"=>$descripcion
				],
                "producto_stock"=>[
					"campo_marcador"=>":Stock",
					"campo_valor"=>$stock
                ],
                "producto_precio_venta"=>[
					"campo_marcador"=>":Precio",
					"campo_valor"=>$precio
				],
                "producto_estado"=>[
					"campo_marcador"=>":Estado",
					"campo_valor"=>$estado
				],
				"producto_portada"=>[
					"campo_marcador"=>":Portada",
					"campo_valor"=>$portada
				],
				"categoria_id"=>[
					"campo_marcador"=>":Categoria",
					"campo_valor"=>$categoria
				]
			];

            $condicion=[
				"condicion_campo"=>"producto_id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

            if(mainModel::actualizar_datos("producto",$datos_producto_up,$condicion)){
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"¡Cuenta actualizada!",
					"Texto"=>"Los datos de la cuenta se actualizaron con éxito en el sistema",
					"Icon"=>"success",
					"TxtBtn"=>"Aceptar"
				];
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No hemos podido actualizar los datos de la cuenta, por favor intente nuevamente",
					"Icon"=>"error",
					"TxtBtn"=>"Aceptar"
				];
			}
			echo json_encode($alerta);
        } /*-- Fin controlador actualizar producto- End controller --*/


        /*--------- Controlador detalle productos - Product Details Controller ---------*/
        public function detalle_producto_controlador($pagina,$registros,$url,$busqueda){
            $pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);

			$url=mainModel::limpiar_cadena($url);
			$url=SERVERURL.DASHBOARD."/".$url."/";

            $busqueda=mainModel::limpiar_cadena($busqueda);
            $id=1;
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
            
            if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM producto WHERE (producto_codigo LIKE '%$busqueda%' OR producto_sku LIKE '%$busqueda%' OR producto_nombre LIKE '%$busqueda%') ORDER BY producto_nombre ASC LIMIT $inicio,$registros";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM producto ORDER BY producto_nombre ASC LIMIT $inicio,$registros";
			}

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();

			$total = $conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();

            $Npaginas =ceil($total/$registros);
            
            /*-- Encabezado de la tabla - Table header --*/
			if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $rows){
				$tabla.='
                <div class="card-product div-bordered bg-white shadow-2">
                    <input type="hidden" value="'.$rows['producto_nombre'].'" name="descripcion'.$contador.'" id="descripcion'.$contador.'" />
                    <input type="hidden" value="'.$rows['producto_precio_venta'].'" name="precio'.$contador.'" />
                    <figure class="card-product-img">
                        <img class="img-fluid" src="'.SERVERURL.'vistas/assets/product/cover/'.$rows['producto_portada'].'" alt="nombre_producto">
                    </figure>
                    <div class="card-product-body">
                        <div class="card-product-content scroll">
                            <h5 class="text-center fw-bolder" id="nombrep">'.$rows['producto_nombre'].'</h5>
                            <p class="card-product-price text-center fw-bolder">'.$rows['producto_precio_venta'].'</p>
                            <span class="full-box text-center text-muted" style="display: block;">'.$rows['producto_descripcion'].'</span>
                            <span class="full-box text-center text-muted" style="display: block;">En stock</span>
                        </div>
                        <div class="text-uppercase poppins-regular font-weight-bold">
                            <input type="button" value="<" onclick="dw(\'c'.$contador.'1\', \'c'.$contador.'2\', \'c'.$contador.'3\', '.$rows['producto_precio_venta'].')" class="updown">
                            <input id="c'.$contador.'1" type="text" size="2" value="0" name="cantidad'.$contador.'" readonly="readonly"/>
                            <input type="button" value=">" onclick="up(\'c'.$contador.'1\', \'c'.$contador.'2\', \'c'.$contador.'3\', '.$rows['producto_precio_venta'].');myFunction'.$contador.'();" class="updown">
                        </div>
                    </div>
                </div>
				<script>
				function myFunction'.$contador.'(){document.getElementById("nProducto'.$contador.'").value = "'.$rows['producto_nombre'].'";}
				</script>
					';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
					$tabla.='
						<tr class="text-center" >
							<td colspan="7">
								<a href="'.$url.'" class="btn btn-primary btn-sm">
									Haga clic acá para recargar el listado
								</a>
							</td>
						</tr>
					';
				}else{
					$tabla.='
						<tr class="text-center" >
							<td colspan="7">
								No hay registros en el sistema
							</td>
						</tr>
					';
				}
			}

            $tabla.='</tbody></table></div>';

			if($total>0 && $pagina<=$Npaginas){
				$tabla.='<p class="text-end">Mostrando productos <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
			}

			/*--Paginacion - Pagination --*/
			if($total>=1 && $pagina<=$Npaginas){
				$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7,LANG);
			}

			return $tabla;
        } /*-- Fin controlador detalle productos- End controller --*/









        
    }