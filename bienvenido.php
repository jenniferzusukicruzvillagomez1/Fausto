<?php
session_start();
include 'php/conexion_be.php';
if(!isset($_SESSION['Usuario'])){
    echo '
    <script>
        alert("Por favor inicia sesión");
        setTimeout(function () {
            window.location.href = "index.php";
        }, 1000);
    </script>';
    session_destroy();
    die();
}
$sql = "SELECT * FROM usuarios";
$res = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienvenido </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
<nav class="blue"><a href="php/cerrar_sesion.php">Cerrar Sesión</a>
</nav>
<div class="container">
    <h1>Bienvenido a similandia</h1>
    <table>
        <thead>
          <tr>
              <th>Id</th>
              <th>Usuario</th>
          </tr>
        </thead>

        <tbody>
        <?php foreach ($res as $rows) :?>
          <tr>
            <td><?php echo $rows['id'] ?></td>
            <td><?php echo $rows['Usuario'] ?></td>
          </tr>
        <?php endforeach;?>
        </tbody>
      </table>
</div>
</body>
</html>