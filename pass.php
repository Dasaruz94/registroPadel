<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 21/11/2017
 * Time: 11:40 AM
 */
include 'libs/conexion.php';
/*

$consulta = "SELECT * FROM datos_usuario WHERE correo LIKE 'staff@padelexperiencemexico.com'";
$resultado = $mysqli->query($consulta);

// $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado

$contador = 1;

while ($row = mysqli_fetch_row($resultado)) {

    $idUsuario = $row[1];
    $idDatos = $row[0];
    $nombre = $row[2];
    $ap = $row[3];

    $nombreCompleto  = $nombre;
    $nom = explode(" ", $nombreCompleto);

    $correo = $nom[0].$ap[0].$ap[1].'@pem.com';

    $correoMin = strtolower($correo);


    $sql = 'UPDATE usuario SET username="'.$correoMin.'" WHERE id_usuario ="'.$idUsuario.'"';

    if (mysqli_query($mysqli, $sql)) {

        $sql = 'UPDATE datos_usuario SET correo="'.$correoMin.'" WHERE id_datos_usuario ="'.$idDatos.'"';

        if (mysqli_query($mysqli, $sql)) {

            echo $contador.' '.$nombre.' '.$ap.' Nuevo correo: '.$correoMin.'<br>';

            $contador ++;

        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }

    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

} */



$b='1234';
$patron='Zn5G7hnkL0bhgf1';
$b=$patron.md5($b);

echo $b;



/*$sql = 'UPDATE usuario SET password="'.$b.'" WHERE active LIKE 1';

if (mysqli_query($mysqli, $sql)) {


} else {
    echo "Error updating record: " . mysqli_error($mysqli);
} */


