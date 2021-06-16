<div class="bg-white full-box">
    <div class="container container-web-page">
        <h3 class="font-weight-bold poppins-regular text-uppercase">Productos en tienda</h3>
        <p class="text-justify">Bienvenido al menú de productos, acá encontrara todos los productos disponibles en nuestra tienda. Puede ordenar los productos por categoría en el botón "<i class="fas fa-tags fa-fw"></i> CATEGORÍAS" y también ordenarlos por orden alfabético o por precio en el botón "<i class="fas fa-sort-alpha-down fa-fw"></i> ORDENAR POR". Además, puede buscar productos por nombre haciendo clic en el botón "<i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR"</p>
    
        <div class="container-fluid" style="border-top: 1px solid #E1E1E1; padding: 20px; 0">
            <div class="row align-items-center">
                <div class="col-12 col-sm-4 text-center text-sm-start">
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle" type="button" id="categorySubMenu" data-mdb-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-tags fa-fw"></i> &nbsp; CATEGORÍAS
                        </button>
                        <div class="dropdown-menu" aria-labelledby="categorySubMenu">
                            <a class="dropdown-item" href="#">Menú 1</a>
                            <a class="dropdown-item" href="#">Menú 2</a>
                            <a class="dropdown-item" href="#">Menú 3</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4 text-center">
                    <button type="button" class="btn btn-link" data-mdb-toggle="modal" data-mdb-target="#saucerModal">
                        <i class="fas fa-search fa-fw"></i> &nbsp; Buscar
                    </button>
                </div>
                <div class="col-12 col-sm-4 text-center text-sm-end">
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle" type="button" id="OrderSubMenu" data-mdb-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-sort-alpha-down fa-fw"></i> &nbsp; Ordenar por
                        </button>
                        <div class="dropdown-menu" aria-labelledby="OrderSubMenu">
                            <a class="dropdown-item" href="#">Ascendente (A-Z)</a>
                            <a class="dropdown-item" href="#">Descendente (Z-A)</a>
                            <a class="dropdown-item" href="#">Precio (Menor a Mayor)</a>
                            <a class="dropdown-item" href="#">Precio (Mayor a Menor)</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
        <div class="container-fluid" style="padding: 20px 0;">
            <div class="row">
                <div class="col-12 col-md-8">
                    <p class="text-left lead"><i class="fas fa-search fa-fw"></i> &nbsp; Resultados de la búsqueda: <span class="font-weight-bold poppins-regular text-uppercase">Producto</span></p>
                </div>
                <div class="col-12 col-md-4">
                    <button type="button" class="btn btn-danger">
                        <i class="fas fa-times fa-fw"></i> &nbsp; Eliminar busqueda
                    </button>
                </div>
            </div>
        </div>
    
        <!-- Pagadito-->    
        <form action="<?php echo SERVERURL; ?>cobro/" method="POST">    
        <div class="container-cards full-box">
            <div class="container-cards full-box">
                <div>
                    <h5 class="text-center text-uppercase bg-success" style="color: #FFF; padding: 10px 0;">Resumen de la orden</h5>
                            <table class="text-uppercase poppins-regular font-weight-bold">
                                <tr>
                                    <td>Producto</td><td>Cantidad</td><td>Precio(USD)</td>
                                </tr>
                                <tr>
                                    <td><input type="text" value="Producto 1" id="nProducto1"  readonly="readonly"/></td>
                                    <td><input type="text" size="8" value="0" id="c12" class="form-control text-center" readonly="readonly"/></td>
                                    <td><input type="text" size="8" value="0.00" id="c13" class="form-control text-center" readonly="readonly"/></td>
                                </tr>
                                <tr>
                                    <td><input type="text" value="Producto 2" id="nProducto2"  readonly="readonly"/></td>
                                    <td><input type="text" size="8" value="0" id="c22" class="form-control text-center" readonly="readonly"/></td>
                                    <td><input type="text" size="8" value="0.00" id="c23" class="form-control text-center" readonly="readonly"/></td>
                                </tr>
                                <tr>
                                    <td><input type="text" value="Producto 3" id="nProducto3"  readonly="readonly"/></td>
                                    <td><input type="text" size="8" value="0" id="c32" class="form-control text-center" readonly="readonly"/></td>
                                    <td><input type="text" size="8" value="0.00" id="c33" class="form-control text-center" readonly="readonly"/></td>
                                </tr>
                            </table>
                            <hr>
                            <input type="text" size="4" value="US$ 0.00" id="cTot" class="form-control text-center text-uppercase poppins-regular font-weight-bold" readonly="readonly"/>
                            <div class="clear"></div>
                            <p></p>
                            <p class="text-center">
                            <input type="submit" value="Comprar" id="btnComprar" class="btn btn-primary"/>
                            </p>
                            <p></p>
                </div>
            </div>
        </div>

            <!-- Detalle de Productos -->
            <div class="container-cards full-box">
                <div class="container-cards full-box">
                    <?php
                        require_once "./controladores/productoControlador.php";
                        $ins_producto = new productoControlador();

                        echo $ins_producto->detalle_producto_controlador($pagina[2],15,$pagina[1],"");
                    ?>
                </div>
            </div> 
        </form>
        <div class="clear"></div>
            

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="saucerModal" tabindex="-1" aria-hidden="true" aria-labelledby="saucerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saucerModalLabel">Buscar producto</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-outline mb-4">
                    <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,25}" class="form-control" name="buscar_producto" id="buscar_producto" maxlength="25">
                    <label for="buscar_producto" class="form-label">¿Qué estás buscando?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-mdb-dismiss="modal"><i class="fas fa-times fa-fw"></i> &nbsp; Cerrar</button>
                <button type="button" class="btn btn-info"><i class="fas fa-search fa-fw"></i> &nbsp; Buscar</button>
            </div>
        </div>
    </div>
</div>