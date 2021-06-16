<?php
    include "./vistas/inc/admin_security.php";
?>
<div class="full-box page-header">
    <h3 class="text-start roboto-condensed-regular text-uppercase">
        <i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo Producto
    </h3>
</div>


<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified mb-4" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" href="<?php echo SERVERURL.DASHBOARD; ?>/producto-new/" ><i class="fas fa-plus fa-fw"></i> &nbsp; Nuevo producto</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="<?php echo SERVERURL.DASHBOARD; ?>/producto-list/" ><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de productos</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="<?php echo SERVERURL.DASHBOARD; ?>/producto-search/" ><i class="fas fa-search fa-fw"></i> &nbsp; Buscar productos</a>
        </li>
    </ul>
</div>


<div class="container-fluid">
    <form class="dashboard-container FormularioAjax" method="POST" data-form="save" data-lang="<?php echo LANG; ?>" autocomplete="off" action="<?php echo SERVERURL;?>ajax/productoAjax.php" enctype="multipart/form-data">
        <input type="hidden" name="modulo_producto" value="registro">
        <fieldset class="mb-4">
            <legend><i class="fas fa-tag fa-fw"></i> &nbsp; Información de producto</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,49}" class="form-control" name="producto_codigo_reg" id="producto_codigo" maxlength="49">
                            <label for="producto_codigo" class="form-label">Codigo del Producto <?php echo FIELD_OBLIGATORY; ?></label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,49}" class="form-control" name="producto_sku_reg" id="producto_sku" maxlength="49">
                            <label for="producto_sku" class="form-label">SKU </label>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,49}" class="form-control" name="producto_nombre_reg" id="producto_nombre" maxlength="49">
                            <label for="producto_nombre" class="form-label">Nombre <?php echo FIELD_OBLIGATORY; ?></label>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-outline mb-4">
                            <textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s ]{4,700}" class="form-control" name="producto_descripcion_reg" id="producto_descripcion" maxlength="700" rows="4"></textarea>
                            <label for="producto_descripcion" class="form-label">Descripción</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="number" pattern="[0-9 ]{1,20}" class="form-control" name="producto_stock_reg" id="producto_stock" maxlength="49">
                            <label for="producto_stock" class="form-label">stock <?php echo FIELD_OBLIGATORY; ?></label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="number" step="0.01" pattern="[0-9]{1,20}" class="form-control" name="producto_precio_venta_reg" id="producto_precio_venta" maxlength="49">
                            <label for="producto_precio_venta" class="form-label">Precio de Venta <?php echo FIELD_OBLIGATORY; ?></label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="">
                            <select class="form-control" name="producto_estado_reg" id="producto_estado">
                                <option value="" selected="" >Estado de categoría</option>
                                <option value="Activo" >Activo</option>
                                <option value="Inactivo" >Inactivo</option>
                            </select>
                            <label for="producto_estado" class="form-label"></label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="producto_portada" class="form-label"> Imagen del Producto <?php echo FIELD_OBLIGATORY; ?></label>
                        <div class="form-outline mb-4">
                        <input type="file"  class="form-control" name="imagen" id="imagen" >
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-outline mb-4">
                            <input type="number" pattern="[0-9 ]{1,49}" class="form-control" name="producto_categoria_reg" id="producto_categoria" maxlength="49">
                            <label for="producto_categoria" class="form-label">Categoria <?php echo FIELD_OBLIGATORY; ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <p class="text-center" style="margin-top: 40px;">
            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
        </p>
        <p class="text-center">
            <small>Los campos marcados con <?php echo FIELD_OBLIGATORY; ?> son obligatorios</small>
        </p>
    </form>
</div>