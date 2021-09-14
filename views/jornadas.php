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
                            <h3 class="animated fadeInLeft">Jornadas</h3>
                            <p class="animated fadeInDown">
                                <?php
                                include '../libs/conexion.php';

                                // $tablaDeMysql = "co"; //Define el nombre de la tabla donde estan los datos


                                //Checamos si se lleno el campo de usuario en el formulario


                                $consulta = "SELECT * FROM categoria WHERE id_categoria LIKE ".$_GET['id'];
                                $resultado = $mysqli->query($consulta);

                                // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                while ($row = mysqli_fetch_row($resultado)) {
                                    $nombre = $row[2];

                                }
                                ?>
                                Jornadas de categoria <?php echo $nombre ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn-flip btn btn-raised btn-success" onclick="javascript:location.href='../forms/formJornada.php?idC=<?php echo $_GET['id']; ?>&idT=<?php echo $_GET['idT']; ?>'">

                        <div class="side">
                            Agregar Jornada <span class="fa fa-plus"></span>
                        </div>

                        <span class="icon"></span>
                    </button>
                </div>
                <div class="col-md-12 top-20 padding-0">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading"><h3>Categorias</h3></div>
                            <div class="panel-body">
                                <div class="responsive-table">
                                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Encuentros</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php


                                        // $tablaDeMysql = "co"; //Define el nombre de la tabla donde estan los datos


                                        //Checamos si se lleno el campo de usuario en el formulario


                                        $consulta = "SELECT * FROM jornada WHERE id_categoria LIKE ".$_GET['id']." AND active like 1";
                                        $resultado = $mysqli->query($consulta);

                                        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                        while ($row = mysqli_fetch_row($resultado)) {
                                            $id = $row[0];


                                            ?>
                                            <tr>


                                                <td><?php echo $row[3]; ?></td>


                                                <td><?php $consulta5 = "SELECT * FROM encuentro WHERE id_jornada like ".$id;
                                                    $resultado5 = $mysqli->query($consulta5);

                                                    $total = mysqli_num_rows($resultado5); //Contamos la cantidad de filas que nos arrojo el resultado

                                                    ?><a href="../views/encuentros.php?idJ=<?php echo $id; ?>&idT=<?php echo $_GET['idT']; ?>&idC=<?php echo $_GET['id']; ?>">
                                                        <input type="button" class="btn btn-round btn-wrapper" value="<?php echo $total;?> +">
                                                    </a></td>
                                                <td>
                                                    <a href="../forms/formUpdateJornada.php?idJ=<?php echo $id; ?>&idT=<?php echo $_GET['idT']; ?>&idC=<?php echo $_GET['id']; ?>">
                                                        <input type="button" class="btn btn-round btn-primary" value="Editar">
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-round btn-danger" value="Eliminar" onclick="Pregunta(<?php echo $id; ?>,<?php echo $_GET['id']; ?>,<?php echo $_GET['idT']; ?>)">
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

            function Pregunta(value1,value2,value3){

                if(confirm("¿Estas seguro de eliminar esta jornada?")){
                    document.location.href="../controllers/deleteController.php?a=deleteJornada&id="+value1+"&idC="+value2+"&idT="+value3;

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
