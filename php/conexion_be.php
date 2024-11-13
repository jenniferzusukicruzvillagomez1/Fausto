<?php
$conexion = mysqli_connect("localhost", "root", "");
$dbname = 'login_register_db';
    if ($conexion->connect_error){
        die('Error en la conexión'. $conexion->connect_error);
    }     
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";


    if ($conexion->query($sql) === TRUE) {
        
    } else {
        echo "Error al crear la base de datos: " . $conexion->error;
    }
    $conexion = mysqli_connect("localhost", "root", "",$dbname);

    $tabla = 'usuarios';

    $query = "CREATE TABLE IF NOT EXISTS $tabla(
        id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
        Nombre_Completo VARCHAR(60) NOT NULL,
        Correo VARCHAR(50)NOT NULL,
        Usuario VARCHAR(15)NOT NULL,
        Contraseña VARCHAR(255) NOT NULL
    )";
    if($conexion->query($query)=== TRUE){
    }else{
        echo 'Error al crear la tabla'. $conexion->error;
    }
?>
