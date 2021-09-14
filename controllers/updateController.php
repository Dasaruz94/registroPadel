<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 22/11/2017
 * Time: 11:36 PM
 */


date_default_timezone_set('America/Mexico_City');

SESSION_START();

include '../libs/conexion.php';

if($_GET['a'] == 'updateSede'){

    $nombre_img = date('Y-m-d').'_'.$_FILES['foto']['name'];
    $tipo = $_FILES['foto']['type'];
    $tamano = $_FILES['foto']['size'];

//Si existe logotype y tiene un tama�o correcto
    if (($_FILES['foto']['name'] == !NULL)){


        //indicamos los formatos que permitimos subir a nuestro servidor
        if (($_FILES["foto"]["type"] == "image/jpeg")
            || ($_FILES["foto"]["type"] == "image/jpg")
            || ($_FILES["foto"]["type"] == "image/png"))
        {
            // Ruta donde se guardar�n las im�genes que subamos
            $directorio = '../asset/images/sedes/';
            // Muevo la logotype desde el directorio temporal a nuestra ruta indicada anteriormente
            move_uploaded_file($_FILES['foto']['tmp_name'],$directorio.$nombre_img);

            $sql = 'UPDATE sede SET nombre="'.$_POST['nombre'].'", encargado="'.$_POST['encargado'].'", ubicacion="'.$_POST['direccion'].'", logo="'.$nombre_img.'", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_sede ="'.$_GET['id'].'"';

            if (mysqli_query($mysqli, $sql)) {

                mysqli_close($mysqli);


                header('Location: ../views/sedes.php?e=update');
            } else {
                echo "Error updating record: " . mysqli_error($mysqli);
            }

        }else{
            //si no cumple con el formato
            echo "No se puede subir una logotype con ese formato ";
        }
    }else{


        $sql = 'UPDATE sede SET nombre="'.$_POST['nombre'].'", encargado="'.$_POST['encargado'].'", ubicacion="'.$_POST['direccion'].'", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_sede ="'.$_GET['id'].'"';

        if (mysqli_query($mysqli, $sql)) {

            mysqli_close($mysqli);

           header('Location: ../views/sedes.php?e=update');
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }

    }

}

if($_GET['a'] == 'updateCancha'){

        $sql = 'UPDATE cancha SET cancha="'.$_POST['nombre'].'", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_cancha ="'.$_GET['id'].'"';

        if (mysqli_query($mysqli, $sql)) {

            mysqli_close($mysqli);

            header('Location: ../views/canchas.php?e=update&id='.$_GET['idS']);
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }



}

if($_GET['a'] == 'updateTorneo'){

    $sql = 'UPDATE torneo SET nombre="'.$_POST['nombre'].'", fecha="'.$_POST['fecha'].'", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_torneo ="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        mysqli_close($mysqli);

        header('Location: ../views/torneos.php?e=update&id='.$_GET['id']);
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }



}

if($_GET['a'] == 'updatePago'){

    $sql = 'UPDATE inscripcion SET tipo_pago="'.$_POST['pago'].'" WHERE id_inscripcion LIKE "'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        mysqli_close($mysqli);

        header('Location: ../views/inscritos.php?e=update&id='.$_GET['idT']);
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }


}

if($_GET['a'] == 'updateJornada'){

    $sql = 'UPDATE jornada SET jornada="'.$_POST['jornada'].'", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_jornada ="'.$_GET['idJ'].'"';

    if (mysqli_query($mysqli, $sql)) {

        mysqli_close($mysqli);

        header('Location: ../views/jornadas.php?e=update&id='.$_GET['idC'].'&idT='.$_GET['idT']);
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }



}

if($_GET['a'] == 'updatePareja'){

    ///VERIFICAR Y QUITAR PAREJA 1 DE LOS REGISTROS PARA DESPUES PONERLO EN LA PAREJA QUE PERTENECE AHORA EN POSICION UNO

    $consulta2 = "SELECT * FROM pareja WHERE id_categoria like ".$_GET['idC']." AND uno LIKE ".$_POST['uno'];

    $resultado2 = $mysqli->query($consulta2);

    $total = mysqli_num_rows($resultado2);

    echo 'Pareja uno tiene id: '.$_POST['uno'].'<br>';
    echo 'Pareja dos tiene id: '.$_POST['dos'].'<br>';

    if($total == 1){

        while ($row2 = mysqli_fetch_row($resultado2)) {

            $sql = 'UPDATE pareja SET uno = "0", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_pareja ="'.$row2[0].'"';

          if (mysqli_query($mysqli, $sql)) {


                 } else {
                     echo "Error updating record: " . mysqli_error($mysqli);
                 }

        }

    }else{


        $consulta2 = "SELECT * FROM pareja WHERE id_categoria like ".$_GET['idC']." AND dos LIKE ".$_POST['uno'];

        $resultado2 = $mysqli->query($consulta2);

        $total = mysqli_num_rows($resultado2);

        if($total == 1){

            while ($row2 = mysqli_fetch_row($resultado2)) {

                $sql = 'UPDATE pareja SET dos = "0", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_pareja ="'.$row2[0].'"';
                if (mysqli_query($mysqli, $sql)) {


                } else {
                    echo "Error updating record: " . mysqli_error($mysqli);
                }


            }

        }

    }

    $sql = 'UPDATE pareja SET uno = "'.$_POST['uno'].'", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_pareja ="'.$_GET['idP'].'"';
    if (mysqli_query($mysqli, $sql)) {


    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }




    ///// LO MISMO PERO CON LA PAREJA 2

    $consulta2 = "SELECT * FROM pareja WHERE id_categoria like ".$_GET['idC']." AND uno LIKE ".$_POST['dos'];

    $resultado2 = $mysqli->query($consulta2);

    $total = mysqli_num_rows($resultado2);

    if($total == 1){

        while ($row2 = mysqli_fetch_row($resultado2)) {

            $sql = 'UPDATE pareja SET uno = "0", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_pareja ="'.$row2[0].'"';
            if (mysqli_query($mysqli, $sql)) {


            } else {
                echo "Error updating record: " . mysqli_error($mysqli);
            }


        }

    }else{

        $consulta2 = "SELECT * FROM pareja WHERE id_categoria like ".$_GET['idC']." AND dos LIKE ".$_POST['dos'];

        $resultado2 = $mysqli->query($consulta2);

        $total = mysqli_num_rows($resultado2);

        if($total == 1){

            while ($row2 = mysqli_fetch_row($resultado2)) {

                $sql = 'UPDATE pareja SET dos = "0", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_pareja ="'.$row2[0].'"';
                if (mysqli_query($mysqli, $sql)) {


                } else {
                    echo "Error updating record: " . mysqli_error($mysqli);
                }


            }

        }

    }

    $sql = 'UPDATE pareja SET dos = "'.$_POST['dos'].'", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_pareja ="'.$_GET['idP'].'"';
    echo '<br>';
    echo $sql;

   if (mysqli_query($mysqli, $sql)) {

        mysqli_close($mysqli);

        header('Location: ../views/parejas.php?e=update&id='.$_GET['idC'].'&idT='.$_GET['idT']);

    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }


}

if($_GET['a'] == 'updateSetEncuentro'){

    $consulta2 = "SELECT * FROM encuentro WHERE id_encuentro like ".$_GET['idE'];

    $resultado2 = $mysqli->query($consulta2);

    while ($row2 = mysqli_fetch_row($resultado2)) {

        $pareja1 = $row2[5];
        $pareja2 = $row2[6];

    }

    $consulta1 = "SELECT * FROM sets WHERE id_encuentro like ".$_GET['idE'];

    $resultado = $mysqli->query($consulta1);

    $total = mysqli_num_rows($resultado);

    $puntuacion = false;
    $contador = 1;

    $puntosP1 = 0;

    $puntosP2 = 0;

    while ($row = mysqli_fetch_row($resultado)) {

      $id = $row[0];

    $sql = 'UPDATE sets SET punto1="'.$_POST['punto1_'.$contador].'", punto2="'.$_POST['punto2_'.$contador].'", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_sets ="'.$id.'"';

    if (mysqli_query($mysqli, $sql)) {

        if($_POST['punto1_'.$contador] > $_POST['punto2_'.$contador]){

            $puntosP1 ++;
        }
        if($_POST['punto1_'.$contador] < $_POST['punto2_'.$contador]){

            $puntosP2++;
        }

        if($contador == $total){

            $puntuacion = true;
        }

       $contador++;

    } else {
     mysqli_close($mysqli);


    }

    if($puntuacion == true){

      /*  if($puntosP1 == 2 && $puntosP2 == 0){
            $puntosP1 = 3;
            $puntosP2 = 0;
        }

        if($puntosP2 == 2 && $puntosP1 == 0){
            $puntosP2 = 3;
            $puntosP1 = 0;
        }

        */

      $puntosP2 = 0;
      $puntosP1 = 0;
      

        $sql = 'UPDATE pareja SET puntos_totales= puntos_totales + ("'.$puntosP1.'"), updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_pareja ="'.$pareja1.'"';

        if (mysqli_query($mysqli, $sql)) {

            $sql = 'UPDATE pareja SET puntos_totales= puntos_totales + ("'.$puntosP2.'"), updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_pareja ="'.$pareja2.'"';
            if (mysqli_query($mysqli, $sql)) {

                mysqli_close($mysqli);
                header('Location: ../views/encuentros.php?e=update&idJ='.$_GET['idJ'].'&idT='.$_GET['idT'].'&idC='.$_GET['idC']);

            }else {
                mysqli_close($mysqli);
                echo "Error updating record: " . mysqli_error($mysqli);
            }

        }else {
            mysqli_close($mysqli);
            echo "Error updating record: " . mysqli_error($mysqli);
        }

    }

    }

}

if($_GET['a'] == 'updateParejaVaciar'){

    $sql = 'UPDATE pareja SET uno="0", dos="0" WHERE id_pareja LIKE "'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        mysqli_close($mysqli);

        header('Location: ../views/parejas.php?e=update&id='.$_GET['idC'].'&idT='.$_GET['idT']);
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }


}


if($_GET['a'] == 'updateParejaNYG'){

    $sql = 'UPDATE pareja SET grupo="'.$_POST['grupo'].'", num_pareja="'.$_POST['numero'].'", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_pareja ="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        mysqli_close($mysqli);

        header('Location: ../views/parejas.php?e=update&id='.$_GET['idC'].'&idT='.$_GET['idT']);
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }



}





