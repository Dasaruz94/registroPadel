<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 23/11/2017
 * Time: 12:07 AM
 */
date_default_timezone_set('America/Mexico_City');

SESSION_START();

include '../libs/conexion.php';


if($_GET['a'] == 'deleteSede'){


        $sql = 'UPDATE sede SET active="0" WHERE id_sede ="'.$_GET['id'].'"';

        if (mysqli_query($mysqli, $sql)) {

            mysqli_close($mysqli);

            header('Location: ../views/sedes.php?e=deleted');
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }


}

if($_GET['a'] == 'deleteUser'){


    $sql = 'UPDATE usuario SET active="0" WHERE id_usuario ="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        $sql = 'UPDATE datos_usuario SET active="0" WHERE id_usuario ="'.$_GET['id'].'"';

        if (mysqli_query($mysqli, $sql)) {

            mysqli_close($mysqli);

            header('Location: ../views/usuarios.php?e=deleted');
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }

    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }


}


if($_GET['a'] == 'deleteCancha'){


    $sql = 'UPDATE cancha SET active="0" WHERE id_cancha ="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        mysqli_close($mysqli);

        header('Location: ../views/canchas.php?e=deleted&id='.$_GET['idS']);
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }


}

if($_GET['a'] == 'deleteTorneo'){


    $sql = 'UPDATE torneo SET active="0" WHERE id_torneo ="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        mysqli_close($mysqli);

        header('Location: ../views/torneos.php?e=deleted&id='.$_GET['id']);
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }


}

if($_GET['a'] == 'deleteCategoria'){


    $sql = 'UPDATE categoria SET active="0" WHERE id_categoria ="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        mysqli_close($mysqli);

        header('Location: ../views/categorias.php?e=deleted&id='.$_GET['idT']);
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

}

if($_GET['a'] == 'deleteJornada'){


    $sql = 'UPDATE jornada SET active="0" WHERE id_jornada ="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        mysqli_close($mysqli);

        header('Location: ../views/jornadas.php?e=deleted&id='.$_GET['idC'].'&idT='.$_GET['idT']);
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }

}

if($_GET['a'] == 'deleteSedeTorneo'){


    $sql = 'UPDATE torneo_tiene_sede SET active="0" WHERE id_torneo ="'.$_GET['idT'].'" AND id_sede = "'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        mysqli_close($mysqli);

        header('Location: ../views/sedesTorneo.php?e=deleted&id='.$_GET['idT']);
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }


}

if($_GET['a'] == 'deleteInscripcion'){


    $sql = 'DELETE FROM inscripcion WHERE id_inscripcion ="'.$_GET['id'].'"';

    if (mysqli_query($mysqli, $sql)) {

        mysqli_close($mysqli);

        header('Location: ../views/inscritos.php?e=deleted&id='.$_GET['idT']);
    } else {
        echo "Error updating record: " . mysqli_error($mysqli);
    }


}