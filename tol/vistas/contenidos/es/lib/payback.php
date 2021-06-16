<?php
/**
 * Mi Tienda Pagadito 1.2 (API PHP)
 *
 * Es un ejemplo de plataforma de e-commerce, que realiza venta de productos
 * electrónicos, y efectúa los cobros utilizando Pagadito, a través de la API.
 *
 * payback.php
 *
 * Este script recibe la redirección desde Pagadito una vez la transacción ha
 * sido finalizada. Se comunica con Pagadito a través de la API y consulta el
 * estado de la transacción.
 *
 * LICENCIA: Éste código fuente es de uso libre. Su comercialización no está
 * permitida. Toda publicación o mención del mismo, debe ser referenciada a
 * su autor original Pagadito.com.
 *
 * @author      Pagadito.com <soporte@pagadito.com>
 * @copyright   Copyright (c) 2017, Pagadito.com
 * @version     1.2
 * @link        https://dev.pagadito.com/index.php?mod=docs&hac=wspg
 */

/**
 * Se incluye el script config.php que contiene las constantes de conexión.
 * También se incluye la API Pagadito.php para realizar la conexión con
 * Pagadito.
 */
require_once('lib/config.php');
require_once('lib/Pagadito.php');

if (isset($_GET["token"]) && $_GET["token"] != "") {
    /*
     * Lo primero es crear el objeto Pagadito, al que se le pasa como
     * parámetros el UID y el WSK definidos en config.php
     */
    $Pagadito = new Pagadito(UID, WSK);
    /*
     * Si se está realizando pruebas, necesita conectarse con Pagadito SandBox. Para ello llamamos
     * a la función mode_sandbox_on(). De lo contrario omitir la siguiente linea.
     */
    if (SANDBOX) {
        $Pagadito->mode_sandbox_on();
    }
    /*
     * Validamos la conexión llamando a la función connect(). Retorna
     * true si la conexión es exitosa. De lo contrario retorna false
     */
    if ($Pagadito->connect()) {
        /*
         * Solicitamos el estado de la transacción llamando a la función
         * get_status(). Le pasamos como parámetro el token recibido vía
         * GET en nuestra URL de retorno.
         */
        if ($Pagadito->get_status($_GET["token"])) {
            /*
             * Luego validamos el estado de la transacción, consultando el
             * estado devuelto por la API.
             */
            switch($Pagadito->get_rs_status())
            {
                case "COMPLETED":
                    /*
                     * Tratamiento para una transacción exitosa.
                     */ ///////////////////////////////////////////////////////////////////////////////////////////////////////
                    $msgPrincipal = "Su compra fue exitosa";
                    $msgSecundario = '
                    Gracias por comprar con Pagadito.<br />
                    NAP(N&uacute;mero de Aprobaci&oacute;n Pagadito): <label class="respuesta">' . $Pagadito->get_rs_reference() . '</label><br />
                    Fecha Respuesta: <label class="respuesta">' . $Pagadito->get_rs_date_trans() . '</label><br /><br />';
                    break;
                
                case "REGISTERED":
                    
                    /*
                     * Tratamiento para una transacción aún en
                     * proceso.
                     */ ///////////////////////////////////////////////////////////////////////////////////////////////////////
                    $msgPrincipal = "Atenci&oacute;n";
                    $msgSecundario = "La transacci&oacute;n fue cancelada.<br /><br />";
                    break;
                
                case "VERIFYING":
                    
                    /*
                     * La transacción ha sido procesada en Pagadito, pero ha quedado en verificación.
                     * En este punto el cobro xha quedado en validación administrativa.
                     * Posteriormente, la transacción puede marcarse como válida o denegada;
                     * por lo que se debe monitorear mediante esta función hasta que su estado cambie a COMPLETED o REVOKED.
                     */ ///////////////////////////////////////////////////////////////////////////////////////////////////////
                    $msgPrincipal = "Atenci&oacute;n";
                    $msgSecundario = '
                    Su pago est&aacute; en validaci&oacute;n.<br />
                    NAP(N&uacute;mero de Aprobaci&oacute;n Pagadito): <label class="respuesta">' . $Pagadito->get_rs_reference() . '</label><br />
                    Fecha Respuesta: <label class="respuesta">' . $Pagadito->get_rs_date_trans() . '</label><br /><br />';
                    break;
                
                case "REVOKED":
                    
                    /*
                     * La transacción en estado VERIFYING ha sido denegada por Pagadito.
                     * En este punto el cobro ya ha sido cancelado.
                     */ ///////////////////////////////////////////////////////////////////////////////////////////////////////
                    $msgPrincipal = "Atenci&oacute;n";
                    $msgSecundario = "La transacci&oacute;n fue denegada.<br /><br />";
                    break;
                
                case "FAILED":
                    /*
                     * Tratamiento para una transacción fallida.
                     */
                default:
                    
                    /*
                     * Por ser un ejemplo, se muestra un mensaje
                     * de error fijo.
                     */ ///////////////////////////////////////////////////////////////////////////////////////////////////////
                    $msgPrincipal = "Atenci&oacute;n";
                    $msgSecundario = "La transacci&oacute;n no fue realizada.<br /><br />";
                    break;
            }
        } else {
            /*
             * En caso de fallar la petición, verificamos el error devuelto.
             * Debido a que la API nos puede devolver diversos mensajes de
             * respuesta, validamos el tipo de mensaje que nos devuelve.
             */
            switch($Pagadito->get_rs_code())
            {
                case "PG2001":
                    /*Incomplete data*/
                case "PG3002":
                    /*Error*/
                case "PG3003":
                    /*Unregistered transaction*/
                default:
                    /*
                     * Por ser un ejemplo, se muestra un mensaje
                     * de error fijo.
                     */ ///////////////////////////////////////////////////////////////////////////////////////////////////////
                    $msgPrincipal = "Error en la transacci&oacute;n";
                    $msgSecundario = "La transacci&oacute;n no fue completada.<br /><br />";
                    break;
            }
        }
    } else {
        /*
         * En caso de fallar la conexión, verificamos el error devuelto.
         * Debido a que la API nos puede devolver diversos mensajes de
         * respuesta, validamos el tipo de mensaje que nos devuelve.
         */
        switch($Pagadito->get_rs_code())
        {
            case "PG2001":
                /*Incomplete data*/
            case "PG3001":
                /*Problem connection*/
            case "PG3002":
                /*Error*/
            case "PG3003":
                /*Unregistered transaction*/
            case "PG3005":
                /*Disabled connection*/
            case "PG3006":
                /*Exceeded*/
            default:
                /*
                 * Aqui se muestra el código y mensaje de la respuesta del WSPG
                 */
                $msgPrincipal = "Respuesta de Pagadito API";
                $msgSecundario = "
                        COD: " . $Pagadito->get_rs_code() . "<br />
                        MSG: " . $Pagadito->get_rs_message() . "<br /><br />";
                break;
        }
    }
} else {
    /*
     * Aqui se muestra el mensaje de error al no haber recibido el token por medio de la URL.
     */
    $msgPrincipal = "Atenci&oacute;n";
    $msgSecundario = "No se recibieron los datos correctamente.<br /> La transacci&oacute;n no fue completada.<br /><br />";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Tienda Demo</title>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="css/default.css" media="screen" />
    </head>
    <body>
        <div id="nav">
            <div class="title">
                <a href="#">Tienda Demo<span class="subtitle"> by pagadito.com</span></a>
            </div>
            <div class="res">
                <ul id="navigation">
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#descargas">Descargas</a></li>
                    <li><a href="#dev">Developers</a></li>
                </ul>
            </div>
        </div>
        <div class="clear"></div>
        <div class="wrapper">
            <label id="inicio"></label>
            <div class="seccion">Respuesta del Pago con Pagadito</div>
            <div class="clear"></div>
            <div class="row">
                <div class="imagenCompra">
                    <img src="imagenes/bolsa.png">
                </div>
                <div class="textoCompra">
                    <label id="principal"><?= $msgPrincipal ?></label><br />
                    <br />
                    <label id="secundario"><?= $msgSecundario ?></label>
                </div>
            </div>
            <br /><br />
            <form method="get" action="index.php">
                <input type="submit" value="Volver a la Tienda" class="retorno"/>
            </form>
            <label id="descargas"></label>
            <div class="seccion">Descargas</div>
            <div class="clear"></div>
            <div class="row">
                <div class="descarga">
                    <a href="https://dev.pagadito.com/index.php?mod=docs&hac=des&file=12">
                        <img src="imagenes/cloud.png">
                    </a>
                    <label><a href="https://dev.pagadito.com/index.php?mod=docs&hac=des&file=12">Tienda demo 1.3</a></label>
                </div>
                <div class="clear"></div>
                <div class="descarga">
                    <a href="https://dev.pagadito.com/index.php?mod=docs&hac=des&file=4">
                        <img src="imagenes/cloud.png">
                    </a>
                    <label><a href="https://dev.pagadito.com/index.php?mod=docs&hac=des&file=4">API PHP</a></label>
                </div>
                <div class="clear"></div>
            </div>
            <label id="dev"></label>
            <div class="seccion">Developers</div>
            <div class="clear"></div>
            <div class="row">
                <div class="imagenDev">
                    <img src="imagenes/programador.jpg">
                </div>
                <div class="textoDev">
                    <label id="principal">&iquest;M&aacute;s informaci&oacute;n sobre c&oacute;mo integrarte a Pagadito?</label><br />
                    <br />
                    <label id="secundario">
                        Entra a <a href="http://dev.pagadito.com/index.php?mod=docs">Pagadito Developers</a><br />
                        Escr&iacute;benos a <a href="mailto:soporte@pagadito.com">soporte@pagadito.com</a><br />
                        Ll&aacute;manos al <a href="javascript:void(0);">(503) 2264-7032</a>
                    </label>
                    <br />
                </div>
            </div>
        </div>
        <div class="pie">
            <label>Pagadito&copy; <?php echo date('Y'); ?></label> <br />
            <label>Esta es una plataforma que simula la venta de productos electr&oacute;nicos y efect&uacute;a los cobros por medio de Pagadito.</label><br />
            <label>La integraci&oacute;n de este demo con Pagadito se realiza por medio de <b>API Pagadito</b>.</label>
        </div>
    </body>
</html>