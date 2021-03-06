<?php

	/*----------  
	Ruta o dominio del servidor  - Server path or domain
	----------*/
	const SERVERURL="http://localhost/tol/";


	/*----------  
	Nombre de la empresa o compañia -  Company or company name
	----------*/
	const COMPANY="PAGADITO";


	/*----------  Idioma - Language
	Español -> es 
	----------*/
	const LANG="es";

	
	/*----------  
		Palabra clave dashboard - Dashboard keyword
		No usar los siguientes valores - Do not use the following values

		index | product | bag | registration | details | signin
	----------*/
	const DASHBOARD="admin";


	/*----------  
	Nombre de la sesion -  Session name
	----------*/
	const SESSION_NAME="TOL";


	/*----------  Redes sociales - Social networks  ----------*/
	const FACEBOOK="";
	const INSTAGRAM="";
	const YOUTUBE="";
	const TWITTER="";


	/*----------  Direccion - Address  ----------*/
	const COUNTRY="El Salvador";
	const ADDRESS="San Salvador, El Salvador, Centro América";
	

	/*----------  Configuración de moneda - Currency Settings  ----------*/
	const COIN_SYMBOL="$";
	const COIN_NAME="USD";
	const COIN_DECIMALS="2";
	const COIN_SEPARATOR_THOUSAND=",";
	const COIN_SEPARATOR_DECIMAL=".";


	/*----------  Tipos de documentos  ----------*/
	const DOCUMENTS_USERS=["DUI","Licencia","Pasaporte","Otro"];
	const DOCUMENTS_COMPANY=["NCR","NIT","RUC","Otro"];


	/*----------  Tipos de unidades de productos - Types of product units ----------*/
	const PRODUTS_UNITS=["Unidad","Libra","Kilogramo","Caja","Paquete","Lata","Galon","Botella","Tira","Sobre","Bolsa","Saco","Tarjeta","Otro"];


	/*----------  Marcador de campos obligatorios  ----------*/
	const FIELD_OBLIGATORY='&nbsp; <i style="color:red" class="far fa-check-circle"></i> &nbsp;';


	/*----------  Configuración de codigos de barras - Bar code settings

		BARCODE_FORMAT -> CODE128 | CODE39 | EAN | EAN-13 | EAN-8 | EAN-5 | EAN-2 | UPC | ITF | ITF-14 | MSI | MSI10 | MSI11 | MSI1010 | MSI1110 | Pharmacode

		BARCODE_TEXT_ALIGN -> center | left | right

		BARCODE_TEXT_POSITION -> top | bottom

	----------*/

	const BARCODE_FORMAT="CODE128";
	const BARCODE_TEXT_ALIGN="center";
	const BARCODE_TEXT_POSITION="bottom";


	/*----------  Tamaño de papel de impresora termica (en milimetros) - Thermal printer paper size (in millimeters)
		THERMAL_PRINT_SIZE -> 80 | 57
	----------*/
	const THERMAL_PRINT_SIZE="80";


	/*----------  Zona horaria - Time zone  ----------*/
	date_default_timezone_set("America/El_Salvador");

	/*
		Configuración de zona horaria de tu país, para más información visita - Time zone configuration of your country, for more information visit
		
		http://php.net/manual/es/function.date-default-timezone-set.php
		http://php.net/manual/es/timezones.php
	*/

	/*----------  Paramtros de Pagadito  ----------*/
	define("UID", "Solicitar_parametros");
	define("WSK", "Solicitar_parametros");
	define("SANDBOX", true);
