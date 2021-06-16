<?php
/**
 * Mi Tienda Pagadito 1.2 (API PHP)
 *
* Es un ejemplo de plataforma de e-commerce, que realiza venta de productos
 * electrónicos, y efectúa los cobros utilizando Pagadito, a través de la API.
 *
 * cobro.php
 *
 * Este script procesa la transacción a petición del script index.php. Se
 * comunica con Pagadito a través de la API, para conectarse y procesar la
 * transacción.
 *
 * LICENCIA: Éste código fuente es de uso libre. Su comercialización no está
 * permitida. Toda publicación o mención del mismo, debe ser referenciada a
 * su autor original Pagadito.com.
 *
 * @author      Pagadito.com <soporte@pagadito.com>
 * @copyright   Copyright (c) 2017, Pagadito.com
 * @version     2.0
 * @link        https://dev.pagadito.com/index.php?mod=docs&hac=wspg
 */

/**
 * Se incluye el script config.php que contiene las constantes de conexión.
 * También se incluye la API Pagadito.php para realizar la conexión con
 * Pagadito.
 */
require_once('lib/config.php');
require_once('lib/Pagadito.php');

if (isset($_POST["cantidad1"]) && is_numeric($_POST["cantidad1"]) &&
    isset($_POST["cantidad2"]) && is_numeric($_POST["cantidad2"]) &&
    isset($_POST["cantidad3"]) && is_numeric($_POST["cantidad3"])) {
      
    /*
     * Lo primero es crear el objeto nusoap_client, al que se le pasa como
     * parámetro la URL de Conexión definida en la constante WSPG
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
         * Luego pasamos a agregar los detalles
         */
        if ($_POST["cantidad1"] > 0) {
            $Pagadito->add_detail($_POST["cantidad1"], $_POST["descripcion1"], $_POST["precio1"], $_POST["url1"]);
        }
        if ($_POST["cantidad2"] > 0) {
            $Pagadito->add_detail($_POST["cantidad2"], $_POST["descripcion2"], $_POST["precio2"], $_POST["url2"]);
        }
        if ($_POST["cantidad3"] > 0) {
            $Pagadito->add_detail($_POST["cantidad3"], $_POST["descripcion3"], $_POST["precio3"], $_POST["url3"]);
        }
        //Agregando campos personalizados de la transacción
        $Pagadito->set_custom_param("param1", "Valor de param1");
        $Pagadito->set_custom_param("param2", "Valor de param2");
        $Pagadito->set_custom_param("param3", "Valor de param3");
        $Pagadito->set_custom_param("param4", "Valor de param4");
        $Pagadito->set_custom_param("param5", "Valor de param5");

        //Habilita la recepción de pagos preautorizados para la orden de cobro.
        $Pagadito->enable_pending_payments();

        /*
         * Lo siguiente es ejecutar la transacción, enviandole el ern.
         *
         * A manera de ejemplo el ern es generado como un número
         * aleatorio entre 1000 y 2000. Lo ideal es que sea una
         * referencia almacenada por el Pagadito Comercio.
         */
        $ern = rand(1000, 2000);
        if (!$Pagadito->exec_trans($ern)) {
            /*
             * En caso de fallar la transacción, verificamos el error devuelto.
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
                case "PG3004":
                    /*Match error*/
                case "PG3005":
                    /*Disabled connection*/
                default:
                    echo "
                        <SCRIPT>
                            alert(\"".$Pagadito->get_rs_code().": ".$Pagadito->get_rs_message()."\");
                            location.href = 'index.php';
                        </SCRIPT>
                    ";
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
                echo "
                    <SCRIPT>
                        alert(\"".$Pagadito->get_rs_code().": ".$Pagadito->get_rs_message()."\");
                        location.href = 'index.php';
                    </SCRIPT>
                ";
                break;
        }
    }

} else {
    echo "
        <script>
            alert('No ha llenado los campos adecuadamente.');
            location.href = 'index.php';
        </script>
    ";
}
