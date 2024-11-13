<?php

include 'conexion_be.php';

$Nombre_Completo = $_POST['Nombre_Completo'];
$Correo = $_POST['Correo'];
$Usuario = $_POST['Usuario'];
$Contraseña = $_POST['Contraseña'];
$Contraseña = hash('sha512', $Contraseña);

if (isset($_POST['registro'])) {

    if ($Nombre_Completo!= '' & $Correo != '' & $Usuario!= '' & $Contraseña != '') {
        $Verificar = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Correo= '$Correo' or Usuario= '$Usuario'");
        if(mysqli_num_rows($Verificar) >0) {
            echo '
            <script>
            alert("Datos repetidos, intenta con uno diferente");
            window.location = "../index.php";
            </script>
            ';
            exit();
        }else{
        $query = "INSERT INTO usuarios(Nombre_Completo, Correo, Usuario, Contraseña) 
        VALUES ('$Nombre_Completo', '$Correo', '$Usuario', '$Contraseña')";
        $ejecutar = mysqli_query($conexion, $query);
            if($ejecutar){
                echo '
                <script>
                alert("Usuario almacenado correctamente");
                window.location = "../index.php";
                </script>
                ';
            }else{
                echo '
                <script>
                    alert("Intentalo de nuevo, usuario no almacenado");
                    window.location = "../index.php";
                </script>
                ';
            }
        }
    }else{
        echo '
        <script>
            alert("Ingrese todos los datos");
            window.location = "../index.php";
         </script>
            ';
            exit();
    }
}

mysqli_close($conexion)


?>
