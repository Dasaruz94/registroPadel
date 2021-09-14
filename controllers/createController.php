<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 21/05/2017
 * Time: 06:04 PM
 */

date_default_timezone_set('America/Mexico_City');

SESSION_START();

include '../libs/conexion.php';

/////// Creacion de Cliente (lugar y usuario administrador)

if($_GET['a'] == 'createPlayer'){

    ///   username password name ap am email set_kind logotype direction tel name_set information

    // Recibo los datos de la logotype
    $nombre_img = date('Y-m-d').'_'.$_FILES['foto']['name'];
    $tipo = $_FILES['foto']['type'];
    $tamano = $_FILES['foto']['size'];

//Si existe logotype y tiene un tama�o correcto
    if (($nombre_img == !NULL)){
        //indicamos los formatos que permitimos subir a nuestro servidor
        if (($_FILES["foto"]["type"] == "image/jpeg")
            || ($_FILES["foto"]["type"] == "image/jpg")
            || ($_FILES["foto"]["type"] == "image/png"))
        {
            // Ruta donde se guardar�n las im�genes que subamos
            $directorio = '../assets/images/players/';
            // Muevo la logotype desde el directorio temporal a nuestra ruta indicada anteriormente
            move_uploaded_file($_FILES['foto']['tmp_name'],$directorio.$nombre_img);
        }else{
            //si no cumple con el formato
            echo "No se puede subir una logotype con ese formato ";
        }
    }else{
        //si existe la variable pero se pasa del tama�o permitido
        if($nombre_img == NULL){
            echo "no se subio logotype";
        }
    }

    $b=$_POST['password'];
    $patron='Zn5G7hnkL0bhgf1';
    $b=$patron.md5($b);

    /// registro de usuarios

    $sql = "INSERT INTO usuario (username,password,user_type,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$_POST['correo']."', '".$b."', '2', '".date('Y-m-d h:i:s')."', '0', '".date('Y-m-d h:i:s')."', '0', '1')";

    if (mysqli_query($mysqli, $sql)) {

        /////si el registro se completa con exito se consulta el usuario registrado para llenar los datos de usuario

        $consulta = "SELECT * FROM usuario WHERE username LIKE '".$_POST['correo']."' AND password LIKE '".$b."' AND active LIKE 1 ";
        $resultado = $mysqli->query($consulta);

        while ($row=mysqli_fetch_row($resultado))
        {

            $id_usuario= $row[0];

        }

        $sqldatos = "INSERT INTO datos_usuario (id_usuario,nombre,ap,am,correo,tel,sexo,edad,playera,ciudad,foto,created_at,created_by,updated_at,updated_by,active) VALUES ('".$id_usuario."', '".$_POST['nombre']."', '".$_POST['ap']."', '".$_POST['am']."','".$_POST['correo']."', '".$_POST['tel']."', '".$_POST['sexo']."', '".$_POST['edad']."', '".$_POST['playera']."', '".$_POST['ciudad']."', '".$nombre_img."',  '".date('Y-m-d h:i:s')."', '0', '".date('Y-m-d h:i:s')."', '0', '1')";


        if (mysqli_query($mysqli, $sqldatos)) {

            $sqlranking = "INSERT INTO ranking (id_usuario,ranking, created_at,created_by,updated_at,updated_by,active) VALUES ('".$id_usuario."', '0', '".date('Y-m-d h:i:s')."', '0', '".date('Y-m-d h:i:s')."', '0', '1')";

            if (mysqli_query($mysqli, $sqlranking)) {

                header('Location: ../../success.html');

            } else {
                echo "Error add record: " . mysqli_error($mysqli);
            }

        } else {
            echo "Error add record: " . mysqli_error($mysqli);
        }


    } else {
        echo "Error add record: " . mysqli_error($mysqli);
    }

}

if($_GET['a'] == 'createPlayerSistema'){

    ///   username password name ap am email set_kind logotype direction tel name_set information

    // Recibo los datos de la logotype
    $nombre_img = date('Y-m-d').'_'.$_FILES['foto']['name'];
    $tipo = $_FILES['foto']['type'];
    $tamano = $_FILES['foto']['size'];

//Si existe logotype y tiene un tama�o correcto
    if (($nombre_img == !NULL)){
        //indicamos los formatos que permitimos subir a nuestro servidor
        if (($_FILES["foto"]["type"] == "image/jpeg")
            || ($_FILES["foto"]["type"] == "image/jpg")
            || ($_FILES["foto"]["type"] == "image/png"))
        {
            // Ruta donde se guardar�n las im�genes que subamos
            $directorio = '../assets/images/players/';
            // Muevo la logotype desde el directorio temporal a nuestra ruta indicada anteriormente
            move_uploaded_file($_FILES['foto']['tmp_name'],$directorio.$nombre_img);
        }else{
            //si no cumple con el formato
            echo "No se puede subir una logotype con ese formato ";
        }
    }else{
        //si existe la variable pero se pasa del tama�o permitido
        if($nombre_img == NULL){
            echo "no se subio logotype";
        }
    }

    $b=$_POST['password'];
    $patron='Zn5G7hnkL0bhgf1';
    $b=$patron.md5($b);

    /// registro de usuarios

    $sql = "INSERT INTO usuario (username,password,user_type,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$_POST['correo']."', '".$b."', '2', '".date('Y-m-d h:i:s')."', '0', '".date('Y-m-d h:i:s')."', '0', '1')";

    if (mysqli_query($mysqli, $sql)) {

        /////si el registro se completa con exito se consulta el usuario registrado para llenar los datos de usuario

        $consulta = "SELECT * FROM usuario WHERE username LIKE '".$_POST['correo']."' AND password LIKE '".$b."' AND active LIKE 1 ";
        $resultado = $mysqli->query($consulta);

        while ($row=mysqli_fetch_row($resultado))
        {

            $id_usuario= $row[0];

        }

        $sqldatos = "INSERT INTO datos_usuario (id_usuario,nombre,ap,am,correo,tel,sexo,edad,playera,ciudad,foto,created_at,created_by,updated_at,updated_by,active) VALUES ('".$id_usuario."', '".$_POST['nombre']."', '".$_POST['ap']."', '".$_POST['am']."','".$_POST['correo']."', '".$_POST['tel']."', '".$_POST['sexo']."', '".$_POST['edad']."', '".$_POST['playera']."', '".$_POST['ciudad']."', '".$nombre_img."',  '".date('Y-m-d h:i:s')."', '0', '".date('Y-m-d h:i:s')."', '0', '1')";


        if (mysqli_query($mysqli, $sqldatos)) {

            $sqlranking = "INSERT INTO ranking (id_usuario,ranking, created_at,created_by,updated_at,updated_by,active) VALUES ('".$id_usuario."', '0', '".date('Y-m-d h:i:s')."', '0', '".date('Y-m-d h:i:s')."', '0', '1')";

            if (mysqli_query($mysqli, $sqlranking)) {

                header('Location: ../views/usuarios.php');

            } else {
                echo "Error add record: " . mysqli_error($mysqli);
            }

        } else {
            echo "Error add record: " . mysqli_error($mysqli);
        }


    } else {
        echo "Error add record: " . mysqli_error($mysqli);
    }

}

if($_GET['a'] == 'createSede'){

    ///   username password name ap am email set_kind logotype direction tel name_set information

    var_dump($_FILES['foto']);

    // Recibo los datos de la logotype
    $nombre_img = date('Y-m-d').'_'.$_FILES['foto']['name'];
    $tipo = $_FILES['foto']['type'];
    $tamano = $_FILES['foto']['size'];

//Si existe logotype y tiene un tama�o correcto
    if (($nombre_img == !NULL)){
        //indicamos los formatos que permitimos subir a nuestro servidor
        if (($_FILES["foto"]["type"] == "image/jpeg")
            || ($_FILES["foto"]["type"] == "image/jpg")
            || ($_FILES["foto"]["type"] == "image/png"))
        {
            // Ruta donde se guardar�n las im�genes que subamos
            $directorio = '../asset/images/sedes/';
            // Muevo la logotype desde el directorio temporal a nuestra ruta indicada anteriormente
              move_uploaded_file($_FILES['foto']['tmp_name'],$directorio.$nombre_img);
        }else{
            //si no cumple con el formato
            echo "No se puede subir una logotype con ese formato ";
        }
    }else{
        //si existe la variable pero se pasa del tama�o permitido
        if($nombre_img == NULL){
            echo "no se subio logotype";
        }
    }

    /// registro de usuarios

    $sql = "INSERT INTO sede (nombre,encargado,ubicacion,logo,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$_POST['nombre']."', '".$_POST['encargado']."', '".$_POST['direccion']."', '".$nombre_img."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '1')";

    if (mysqli_query($mysqli, $sql)) {

        /////si el registro se completa con exito se consulta el usuario registrado para llenar los datos de usuario
        header('Location: ../views/sedes.php?a=succes');
    } else {
        echo "Error add record: " . mysqli_error($mysqli);
    }


}

if($_GET['a'] == 'createCancha'){

     /// registro de usuarios

    $sql = "INSERT INTO cancha (id_sede,cancha,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$_GET['id']."', '".$_POST['nombre']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '1')";

    if (mysqli_query($mysqli, $sql)) {

        /////si el registro se completa con exito se consulta el usuario registrado para llenar los datos de usuario
        header('Location: ../views/canchas.php?a=succes&id='.$_GET['id']);
    } else {
        echo "Error add record: " . mysqli_error($mysqli);
    }

}

if($_GET['a'] == 'createTorneo'){

            /// registro de usuarios

            $sql = "INSERT INTO torneo (nombre,fecha,termina,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$_POST['nombre']."', '".$_POST['fecha']."', '".$_POST['termina']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '1')";

            if (mysqli_query($mysqli, $sql)) {

                /////si el registro se completa con exito se consulta el usuario registrado para llenar los datos de usuario
                header('Location: ../views/torneos.php?a=succes');
            } else {
                echo "Error add record: " . mysqli_error($mysqli);
            }

}

if($_GET['a'] == 'addSedeTorneo'){

            /// registro de usuarios

            $sql = "INSERT INTO torneo_tiene_sede (id_torneo,id_sede,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$_GET['id']."', '".$_POST['sede']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '1')";

            if (mysqli_query($mysqli, $sql)) {

                /////si el registro se completa con exito se consulta el usuario registrado para llenar los datos de usuario
                header('Location: ../views/sedesTorneo.php?a=succes&id='.$_GET['id']);
            } else {
                echo "Error add record: " . mysqli_error($mysqli);
            }

}

if($_GET['a'] == 'createCategoria'){

            /// registro de usuarios

            $sql = "INSERT INTO categoria (id_torneo,nombre,grupo,pareja,precio,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$_GET['id']."', '".$_POST['nombre']."', '".$_POST['grupo']."', '".$_POST['pareja']."', '".$_POST['precio']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '1')";

            if (mysqli_query($mysqli, $sql)) {


                $consulta = "SELECT MAX(id_categoria) FROM categoria";
                $resultado = $mysqli->query($consulta);

                // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado
                while ($row=mysqli_fetch_row($resultado))
                {
                    $id_categoria = $row[0];

                }


                $grupo = $_POST['grupo'];
                $pareja = $_POST['pareja'];


                $i = 1;
                $grupoContador = 1;


                while($i <= $pareja) {

                    if($grupo < $grupoContador){

                        break;

                        $termino = 1;
                    }

                    $ascci = $grupoContador + 64;

                    $letra = chr($ascci);


                    $sql = "INSERT INTO pareja (id_torneo,id_categoria,grupo,num_pareja,uno,dos,puntos_totales,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$_GET['id']."', '".$id_categoria."', '".$letra."', '".$i."', '0' , '0' , '0', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '1')";

                    if (mysqli_query($mysqli, $sql)) {


                    } else {
                        echo "Error add record: " . mysqli_error($mysqli);
                    }

                    if($i == $pareja){

                        echo 'entrando <br>';
                        $i = 1;
                        $grupoContador++;
                    }else{
                        $i++;
                    }

                }

                if($termino = 1){

                    header('Location: ../views/categorias.php?a=succes&id='.$_GET['id']);
                }



            } else {
                echo "Error add record: " . mysqli_error($mysqli);
            }

}

if($_GET['a'] == 'createInscripcion'){

///SACAMOS CANTIDAD DE PRECIO DE CATEGORIA
    $consulta = "SELECT * FROM categoria WHERE id_categoria LIKE ".$_POST['categoria'];
    $resultado = $mysqli->query($consulta);

    // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


    while ($row = mysqli_fetch_row($resultado)) {

        $cat = $row[2];
        $cantidad = $row[5];

    }

    ///// CREAMOS CODIGO DE INVITACIÓN PARA PAREJA

    $consulta1 = "SELECT * FROM datos_usuario WHERE id_usuario LIKE ".$_GET['id'];
    $resultado1 = $mysqli->query($consulta1);

    // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


    while ($row1 = mysqli_fetch_row($resultado1)) {

        $nom = $row1[2];

    }


    $catSub = substr($cat, 0, 3);
    $nomSub = substr($nom, 0, 3);


    $codigoInv = $nomSub.$catSub.$_GET['id'].$_POST['torneo'].$_POST['categoria'];

    $sql = "INSERT INTO inscripcion (id_usuario,id_torneo,id_categoria,tipo_pago,cantidad,codigo_inv,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$_GET['id']."', '".$_POST['torneo']."', '".$_POST['categoria']."', '".$_POST['tipoPago']."', '".$_POST['cantidad']."', '".$codigoInv."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '1')";


    if (mysqli_query($mysqli, $sql)) {

        $consulta2 = "SELECT * FROM pareja WHERE id_categoria LIKE ".$_POST['categoria']." AND active like 1 AND uno LIKE 0";
        $resultado2 = $mysqli->query($consulta2);

        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado

        while ($row2 = mysqli_fetch_row($resultado2)) {

            $idPareja = $row2[0];

            break;
        }

        $sql = 'UPDATE pareja SET uno="'.$_GET['id'].'", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_pareja ="'.$idPareja.'"';

        if (mysqli_query($mysqli, $sql)) {

            mysqli_close($mysqli);

            header('Location: ../views/usuarios.php?e=update');
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }



    } else {
        echo "Error add record: " . mysqli_error($mysqli);
    }

}

if($_GET['a'] == 'createJornada'){

    /// registro de usuarios

    $sql = "INSERT INTO jornada (id_torneo,id_categoria,jornada,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$_GET['idT']."', '".$_GET['idC']."', '".$_POST['nombre']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '1')";

    if (mysqli_query($mysqli, $sql)) {

        /////si el registro se completa con exito se consulta el usuario registrado para llenar los datos de usuario
        header('Location: ../views/jornadas.php?a=succes&id='.$_GET['idC'].'&idT='.$_GET['idT']);
    } else {
        echo "Error add record: " . mysqli_error($mysqli);
    }

}

if($_GET['a'] == 'createEncuentro'){


    echo $_POST['fecha'];
    /// registro de usuarios

    $sql = "INSERT INTO encuentro (id_torneo,id_categoria,id_jornada,id_cancha,pareja1,pareja2,fecha_encuentro,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$_GET['idT']."', '".$_GET['idC']."', '".$_GET['idJ']."', '".$_POST['cancha']."', '".$_POST['pareja1']."', '".$_POST['pareja2']."', '".$_POST['fecha']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '1')";

    if (mysqli_query($mysqli, $sql)) {

        $consulta = "SELECT MAX(id_encuentro) FROM encuentro";
        $resultado = $mysqli->query($consulta);

        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado
        while ($row=mysqli_fetch_row($resultado))
        {
            $id_encuentro = $row[0];

        }

        $contador = 1;

        while($contador <= 3){

            $sql = "INSERT INTO sets (id_encuentro,num_set,punto1,punto2,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$id_encuentro."', '".$contador."', '0', '0', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '1')";

            if (mysqli_query($mysqli, $sql)) {

                $contador++;

                /////si el registro se completa con exito se consulta el usuario registrado para llenar los datos de usuario

            } else {
                echo "Error add record: " . mysqli_error($mysqli);
            }

            if($contador == 3){
                $final = 1;
            }

        }


        if($final == 1){
            header('Location: ../views/encuentros.php?a=succes&idJ='.$_GET['idJ'].'&idT='.$_GET['idT'].'&idC='.$_GET['idC']);
        }



    } else {
        echo "Error add record: " . mysqli_error($mysqli);
    }

}

if($_GET['a'] == 'createInscriptionWeb'){

    $tipoPago = $_POST['tipo_pago'];

    $_SESSION["id"];

///SACAMOS CANTIDAD DE PRECIO DE CATEGORIA
    $consulta = "SELECT * FROM categoria WHERE id_categoria LIKE ".$_GET['idC'];
    $resultado = $mysqli->query($consulta);

    // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


    while ($row = mysqli_fetch_row($resultado)) {

        $cat = $row[2];
        $cantidad = $row[5];

    }

    if($tipoPago == 2){
        $cantidad = $cantidad*2;
    }

    ///// CREAMOS CODIGO DE INVITACIÓN PARA PAREJA

    $consulta1 = "SELECT * FROM datos_usuario WHERE id_usuario LIKE ".$_SESSION['id'];
    $resultado1 = $mysqli->query($consulta1);

    // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


    while ($row1 = mysqli_fetch_row($resultado1)) {

        $nom = $row1[2];

    }


    $catSub = substr($cat, 0, 3);
    $nomSub = substr($nom, 0, 3);


    $codigoInv = $nomSub.$catSub.$_SESSION['id'].$_GET['idT'].$_GET['idC'];

    $sql = "INSERT INTO inscripcion (id_usuario,id_torneo,id_categoria,tipo_pago,cantidad,codigo_inv,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$_SESSION['id']."', '".$_GET['idT']."', '".$_GET['idC']."', '0', '".$cantidad."', '".$codigoInv."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '1')";


    if (mysqli_query($mysqli, $sql)) {

        $consulta2 = "SELECT * FROM pareja WHERE id_categoria LIKE ".$_GET['idC']." AND active like 1 AND uno LIKE 0";
        $resultado2 = $mysqli->query($consulta2);

        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado

        while ($row2 = mysqli_fetch_row($resultado2)) {

            $idPareja = $row2[0];

            break;
        }

        $sql = 'UPDATE pareja SET uno="'.$_SESSION['id'].'", updated_at="'.date('Y-m-d h:i:s').'", updated_by="'.$_SESSION['id'].'" WHERE id_pareja ="'.$idPareja.'"';

        if (mysqli_query($mysqli, $sql)) {

            mysqli_close($mysqli);

            header('Location: ../../inscripcion.php?idC=' . $_GET['idC'] .'');
        } else {
            echo "Error updating record: " . mysqli_error($mysqli);
        }



    } else {
        echo "Error add record: " . mysqli_error($mysqli);
    }

}

if($_GET['a'] == 'createPareja'){

    /// registro de usuarios

    $sql = "INSERT INTO pareja (id_torneo,id_categoria,grupo,num_pareja,created_at,created_by,updated_at,updated_by,active) VALUES ( '".$_GET['idT']."', '".$_GET['idC']."', '".$_POST['grupo']."', '".$_POST['numero']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '".date('Y-m-d h:i:s')."', '".$_SESSION['id']."', '1')";

    if (mysqli_query($mysqli, $sql)) {

        /////si el registro se completa con exito se consulta el usuario registrado para llenar los datos de usuario
        header('Location: ../views/parejas.php?a=succes&id='.$_GET['idC'].'&idT='.$_GET['idT']);
    } else {
        echo "Error add record: " . mysqli_error($mysqli);
    }

}

