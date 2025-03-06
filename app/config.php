<?php

define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASSWORD','');
define('BD','sisechobolivia');

define('APP_NAME','SISTEMA HECHO EN BOLIVIA');
define('APP_URL','http://192.168.100.44/sisechobolivia'); //PORSIACASO CAMBIE localhost por 192.168.100.44
define('KEY_API_MAPS','');


$servidor="mysql:dbname=".BD.";host=".SERVIDOR;

try{
    $pdo=new PDO($servidor,USUARIO,PASSWORD,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    //echo "CONEXION EXITOSA ALA BASE DE DATOS";
}catch (PDOException $e){
    echo "ERROR NO SE PUDO CONECTAR ALA BD";
}
date_default_timezone_set('America/Caracas');
$fechaHora=date("Y-m-d H:i:s");
$fecha_actual=date("Y-m-d");
$dia_actual=date("d");
$mes_actual=date("m");
$ano_actual=date("Y");
$estado_de_registro='1';