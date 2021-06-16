<?php
    include "./vistas/inc/admin_security.php";
?>
<div class="full-box page-header">
    <h3 class="text-start roboto-condensed-regular text-uppercase">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; Actualizar producto
    </h3>
</div>


<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified mb-4" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="<?php echo SERVERURL.DASHBOARD; ?>/producto-new/" ><i class="fas fa-plus fa-fw"></i> &nbsp; Nueva producto</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="<?php echo SERVERURL.DASHBOARD; ?>/producto-list/" ><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de producto</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="<?php echo SERVERURL.DASHBOARD; ?>/producto-search/" ><i class="fas fa-search fa-fw"></i> &nbsp; Buscar producto</a>
        </li>
    </ul>
</div>


<div class="container-fluid">
    <?php
        include "./vistas/inc/".LANG."/btn_go_back.php";
        
        $datos_producto=$ins_login->datos_tabla("Unico","producto","producto_id",$pagina[2]);
        if($datos_producto->rowCount()==1){
            $campos=$datos_producto->fetch();
    ?>
    <form class="dashboard-container FormularioAjax" method="POST" data-form="update" data-lang="<?php echo LANG; ?>" autocomplete="off" action="<?php echo SERVERURL;?>ajax/productoAjax.php" >
        <input type="hidden" name="modulo_producto" value="actualizar">
        <input type="hidden" name="producto_id_up" value="<?php echo $pagina[2]; ?>">
        <input type="hidden" name="producto_portada_up" value="<?php echo $campos['producto_portada']; ?>">
        <fieldset class="mb-4">
            <legend><i class="fas fa-tag fa-fw"></i> &nbsp; Información de producto</legend>
            <div class="container-fluid">
            <img src="<?php echo SERVERURL; ?>vistas/assets/product/cover/<?php echo $campos['producto_portada']; ?>" class="img-fluid" style="width:150px">
            <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,49}" class="form-control" name="producto_codigo_up" value="<?php echo $campos['producto_codigo']; ?>" id="producto_codigo" maxlength="49">
                            <label for="producto_codigo" class="form-label">Codigo del Producto <?php echo FIELD_OBLIGATORY; ?></label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,49}" class="form-control" name="producto_sku_up" value="<?php echo $campos['producto_sku']; ?>" id="producto_sku" maxlength="49">
                            <label for="producto_sku" class="form-label">SKU </label>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,49}" class="form-control" name="producto_nombre_up" value="<?php echo $campos['producto_nombre']; ?>" id="producto_nombre" maxlength="49">
                            <label for="producto_nombre" class="form-label">Nombre <?php echo FIELD_OBLIGATORY; ?></label>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-outline mb-4">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,49}" class="form-control" name="producto_descripcion_up" value="<?php echo $campos['producto_descripcion']; ?>" id="producto_descripcion" >
                            <label for="producto_descripcion" class="form-label">Descripción</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="number" pattern="[0-9 ]{1,20}" class="form-control" name="producto_stock_up" value="<?php echo $campos['producto_stock']; ?>" id="producto_stock" maxlength="49">
                            <label for="producto_stock" class="form-label">stock <?php echo FIELD_OBLIGATORY; ?></label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="number" step="0.01" pattern="[0-9]{1,20}" class="form-control" name="producto_precio_venta_up" value="<?php echo $campos['producto_precio_venta']; ?>" id="producto_precio_venta" maxlength="49">
                            <label for="producto_precio_venta" class="form-label">Precio de Venta <?php echo FIELD_OBLIGATORY; ?></label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="">
                            <select class="form-control" name="producto_estado_up" id="producto_estado">
                                <option value="" selected="" >Estado de categoría</option>
                                <option value="Activo" <?php if($campos['producto_estado']=="Activo"){ echo 'selected=""'; } ?> >Activo<?php if($campos['producto_estado']=="Activo"){ echo ' (Actual)'; } ?></option>
                                <option value="Inactivo" <?php if($campos['producto_estado']=="inactivo"){ echo 'selected=""'; } ?> >Inactivo<?php if($campos['producto_estado']=="Inactivo"){ echo ' (Actual)'; } ?></option>
                            </select>
                            <label for="producto_estado" class="form-label"></label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="number" pattern="[0-9 ]{1,49}" class="form-control" name="producto_categoria_up" value="<?php echo $campos['categoria_id']; ?>" id="producto_categoria" maxlength="49">
                            <label for="producto_categoria" class="form-label">Categoria <?php echo FIELD_OBLIGATORY; ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <p class="text-center" style="margin-top: 40px;">
            <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
        </p>
        <p class="text-center">
            <small>Los campos marcados con <?php echo FIELD_OBLIGATORY; ?> son obligatorios</small>
        </p>
    </form>
    <?php
        }else{ include "./vistas/inc/".LANG."/error_alert.php";}
    ?>
</div>