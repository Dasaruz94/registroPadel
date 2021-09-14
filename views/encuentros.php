<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 21/05/2017
 * Time: 07:27 PM
 */

SESSION_START();
if(isset($_SESSION['email'])) {

    if($_SESSION['tipo_usuario']== 1){

        ?>
        <!DOCTYPE html>
        <html lang="en">

        <?php

        include 'head.php';

        ?>
        <body id="mimin" class="dashboard" ">
        <!-- start: Header -->
        <?php
        include 'header.php'
        ?>
        <!-- end: Header -->

        <div class="container-fluid mimin-wrapper">

            <!-- start:Left Menu -->
            <?php
            include 'menu.php';
            ?>
            <!-- end: Left Menu -->


            <!-- start: Content -->
            <div id="content">
                <div class="panel box-shadow-none content-header">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h3 class="animated fadeInLeft">Encuentros</h3>
                            <p class="animated fadeInDown">
                                <?php
                                include '../libs/conexion.php';

                                // $tablaDeMysql = "co"; //Define el nombre de la tabla donde estan los datos


                                //Checamos si se lleno el campo de usuario en el formulario


                                $consulta = "SELECT * FROM jornada WHERE id_jornada LIKE ".$_GET['idJ'];
                                $resultado = $mysqli->query($consulta);

                                // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                while ($row = mysqli_fetch_row($resultado)) {
                                    $nombre = $row[3];

                                }
                                ?>
                                Encuentros de <?php echo $nombre ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn-flip btn btn-raised btn-success" onclick="javascript:location.href='../forms/formEncuentro.php?idC=<?php echo $_GET['idC']; ?>&idT=<?php echo $_GET['idT']; ?>&idJ=<?php echo $_GET['idJ'] ?>'">

                        <div class="side">
                            Agregar Encuentro <span class="fa fa-plus"></span>
                        </div>

                        <span class="icon"></span>
                    </button>
                </div>
                <div class="col-md-12 top-20 padding-0">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading"><h3>Encuentros</h3></div>
                            <div class="panel-body">
                                <div class="responsive-table">
                                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Pareja1</th>
                                            <th>Pareja2</th>
                                            <th>Fecha</th>
                                            <th>Cancha</th>
                                            <th>Finalizar</th>
                                            <!--<th>Editar</th> -->
                                            <th>Eliminar</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php


                                        // $tablaDeMysql = "co"; //Define el nombre de la tabla donde estan los datos


                                        //Checamos si se lleno el campo de usuario en el formulario

                                        $finalizado = false;

                                        $consulta = "SELECT * FROM encuentro WHERE id_jornada LIKE ".$_GET['idJ']." AND active like 1";
                                        $resultado = $mysqli->query($consulta);

                                        //$total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                        while ($row = mysqli_fetch_row($resultado)) {


                                            $id = $row[0];
                                            echo $id;

                                            ?>
                                            <tr>


                                            <td><?php
                                                $consulta1 = "SELECT * FROM pareja WHERE id_pareja like " . $row[5];
                                                $resultado1 = $mysqli->query($consulta1);
                                                while ($row1 = mysqli_fetch_row($resultado1)) {





                                                $consulta2 = "SELECT * FROM datos_usuario WHERE id_usuario LIKE ".$row1[5];
                                                $resultado2 = $mysqli->query($consulta2);
                                                while ($row2 = mysqli_fetch_row($resultado2)) {

                                                    $nombre1 = $row2[2].' '.$row2[3];


                                                }

                                                $consulta2 = "SELECT * FROM datos_usuario WHERE id_usuario LIKE ".$row1[6];
                                                $resultado2 = $mysqli->query($consulta2);
                                                while ($row2 = mysqli_fetch_row($resultado2)) {

                                                    $nombre2 = $row2[2].' '.$row2[3];

                                                }

                                                }

                                                echo $nombre1.' - '.$nombre2; ?></td>

                                            <td><?php
                                                $consulta1 = "SELECT * FROM pareja WHERE id_pareja like " . $row[6];
                                                $resultado1 = $mysqli->query($consulta1);
                                                while ($row1 = mysqli_fetch_row($resultado1)) {





                                                    $consulta2 = "SELECT * FROM datos_usuario WHERE id_usuario LIKE ".$row1[5];
                                                    $resultado2 = $mysqli->query($consulta2);
                                                    while ($row2 = mysqli_fetch_row($resultado2)) {

                                                        $nombre1 = $row2[2].' '.$row2[3];


                                                    }

                                                    $consulta2 = "SELECT * FROM datos_usuario WHERE id_usuario LIKE ".$row1[6];
                                                    $resultado2 = $mysqli->query($consulta2);
                                                    while ($row2 = mysqli_fetch_row($resultado2)) {

                                                        $nombre2 = $row2[2].' '.$row2[3];

                                                    }

                                                }

                                                echo $nombre1.' - '.$nombre2; ?></td>
                                            <td><?php echo $row[7]; ?></td>

                                            <td>  <?php

                                                $consulta = "SELECT sede.nombre, cancha.cancha FROM sede INNER JOIN cancha  ON sede.id_sede = cancha.id_sede WHERE cancha.id_cancha LIKE '" . $row[4] . "'";

                                                $resultado3 = $mysqli->query($consulta);

                                                // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                                while ($row3 = mysqli_fetch_row($resultado3)) {

                                                    $sede = $row3[0];
                                                    $cancha = $row3[1];

                                                    echo $sede . '-' . $cancha;
                                                }
                                                ?></td>
                                            <td>

                                            <?php

                                            $consulta4 = "SELECT * FROM sets WHERE id_encuentro like ".$id;
                                            $resultado4 = $mysqli->query($consulta4);
                                            while ($row4 = mysqli_fetch_row($resultado4)) {
                                                $punto1 = $row4[3];

                                                break;
                                            }
                                            if ($punto1 != 0) {

                                               echo 'Finalizado';


                                            }else{
                                                ?>
                                                <a href="../forms/formSets.php?idJ=<?php echo $_GET['idJ'] ?>&idT=<?php echo $_GET['idT']; ?>&idC=<?php echo $_GET['idC']; ?>&idE=<?php echo $id; ?>">
                                                    <input type="button" class="btn btn-round btn-success"
                                                           value="Finalizar">
                                                </a>
                                                <?php
                                            }
                                            ?>
                                                </td>
                                               <!-- <td>
                                                    <?php   if ($punto1 != 0) {
                                                        echo 'Finalizado';
                                                    }else{
                                                      ?>
                                                        <a target="_blank" href="../forms/formUpdateEncuentro.php?idJ=<?php echo $_GET['idJ'] ?>&idT=<?php echo $_GET['idT']; ?>&idC=<?php echo $_GET['idC']; ?>&idE=<?php echo $id; ?>">
                                                            <input type="button" class="btn btn-round btn-primary" value="Editar">
                                                        </a>
                                                    <?php }  ?>
                                                </td> -->
                                                <td>
                                                    <button class="btn btn-round btn-danger" value="Eliminar" onclick="Pregunta(<?php echo $id; ?>,<?php echo $_GET['idC'] ?>)">
                                                        Eliminar
                                                    </button>


                                                </td>

                                            </tr>
                                            <?php
                                        }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end: content -->


            <!-- start: right menu -->

            <!-- end: right menu -->

        </div>

        <!-- start: Mobile -->

        <!-- end: Mobile -->


        <!-- end: Content -->
        <!-- start: Javascript -->
        <script src="../asset/js/jquery.min.js"></script>
        <script src="../asset/js/jquery.ui.min.js"></script>
        <script src="../asset/js/bootstrap.min.js"></script>

        <!-- plugins ../-->
        <script src="../asset/js/plugins/jquery.datatables.min.js"></script>
        <script src="../asset/js/plugins/datatables.bootstrap.min.js"></script>
        <script src="../asset/js/plugins/moment.min.js"></script>
        <script src="../asset/js/plugins/jquery.nicescroll.js"></script>


        <!-- custom -->
        <script src="../asset/js/main.js"></script>
        <script type="text/javascript">

            function Pregunta(value1,value2){

                if(confirm("¿Estas seguro de eliminar esta categoria?")){
                    document.location.href="../controllers/deleteController.php?a=deleteCategoria&id="+value1+"&idT="+value2;

                }

            }

            $(document).ready(function(){
                $('#datatables-example').DataTable();
            });
        </script>
        <!-- end: Javascript -->
        </body>
        </html>

        <?php
    }else{

        SESSION_UNSET();

        SESSION_DESTROY();
        header('Location: ../index.php?e=error1');

    }
}else{

    header('Location: ../index.php?e=error');
    echo 'El usuario no es correcto';
}
?>
