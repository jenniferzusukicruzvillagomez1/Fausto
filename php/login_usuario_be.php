<?php

session_start();

include 'conexion_be.php';

if (isset($_POST['Login'])) {

    function bloqueo() {
        $_SESSION['intento'] = 1;
        $_SESSION['tiempo_bloqueo'] = time() + 60; 
    }   
    $contador = isset($_SESSION['tiempo_bloqueo']);
    if (isset($_SESSION['tiempo_bloqueo']) && $_SESSION['tiempo_bloqueo'] > time()) {
        echo "<script>
                alert('Has agotado tus 3 intentos, inténtalo de nuevo en $contador minuto');
            </script>";
            echo "
                Has agotado tus 3 intentos, inténtalo de nuevo en $contador minuto ;
            ";
        header("Refresh: 30; url=../index.php");
        die();
    }
    if (empty($_POST['Correo']) or empty($_POST['Contraseña'])) {
        echo "<script>
                alert('campos requeridos');
                window.location.href = '../index.php';
            </script>";
    }else{
        $Correo = $_POST['Correo'];
        $Contraseña = hash('sha512', $_POST['Contraseña']);
        $sql = $conexion->query("SELECT Usuario, Correo, Contraseña FROM usuarios WHERE Correo = '$Correo'");
        if ($row = $sql->fetch_object()) {
            $hashAlmacenado = $row->Contraseña;
            if (password_verify($Contraseña, $hashAlmacenado)) {
                $_SESSION['Usuario'] = $row->Usuario; // Corrección aquí
                echo "<script>
                        alert('Logueado correctamente');
                    </script>";
                echo "<script>
                    setTimeout(function () {
                        window.location.href = '../view/bienvenido.php';
                    }, 1000);
                </script>";
                exit;
            } else {
                $_SESSION['intento'] ++;
                echo "<script>
                        alert('Datos erroneos');
                        window.location.href = '../index.php';
                    </script>";
                if ($_SESSION['intento'] >= 3) {
                    bloqueo();
                }
            }
        }else{
            echo "<script>
                    alert('Datos erroneos');
                    window.location.href = '../index.php';
                </script>";
                if (!isset($_SESSION['intento'])) {
                    $_SESSION['intento'] += 1;
                } else {
                    $_SESSION['intento']++;
                }
    
                if ($_SESSION['intento'] >= 3) {
                    bloqueo();
                }
        }
    }

}
?>
