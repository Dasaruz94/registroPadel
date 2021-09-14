<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 21/05/2017
 * Time: 07:27 PM
 */

SESSION_START();
if(isset($_SESSION['username'])) {

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
                            <h3 class="animated fadeInLeft">Categorias</h3>
                            <p class="animated fadeInDown">
                                <?php
                                include '../libs/conexion.php';

                                // $tablaDeMysql = "co"; //Define el nombre de la tabla donde estan los datos


                                //Checamos si se lleno el campo de usuario en el formulario


                                $consulta = "SELECT * FROM torneo WHERE id_torneo LIKE ".$_GET['id'];
                                $resultado = $mysqli->query($consulta);

                                // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                while ($row = mysqli_fetch_row($resultado)) {
                                    $nombre = $row[1];

                                }
                                ?>
                                Categorias del torneo <?php echo $nombre ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn-flip btn btn-raised btn-success" onclick="javascript:location.href='../forms/formCategoria.php?id=<?php echo $_GET['id']; ?>'">

                        <div class="side">
                            Agregar categoria <span class="fa fa-plus"></span>
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
                                            <th>Grupos</th>
                                            <th>Parejas</th>
                                            <th>Precio</th>
                                            <th>Registradas</th>
                                            <th>Jornadas</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php


                                        // $tablaDeMysql = "co"; //Define el nombre de la tabla donde estan los datos


                                        //Checamos si se lleno el campo de usuario en el formulario


                                        $consulta = "SELECT * FROM categoria WHERE id_torneo LIKE ".$_GET['id']." AND active like 1";
                                        $resultado = $mysqli->query($consulta);

                                        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                        while ($row = mysqli_fetch_row($resultado)) {
                                            $id = $row[0];


                                            ?>
                                            <tr>

                                                <td><?php echo $row[2]; ?></td>
                                                <td><?php echo $row[3]; ?></td>

                                                <td><?php echo $row[4]; ?></td>
                                                <td><?php echo '$'.$row[5]; ?></td>
                                                <td><?php

                                                    $consulta1 = "SELECT * FROM pareja WHERE id_categoria LIKE ".$row[0]." AND active like 1 AND uno != 0";
                                                    $resultado1 = $mysqli->query($consulta1);

                                                   $total = mysqli_num_rows($resultado1); //Contamos la cantidad de filas que nos arrojo el resultado

                                                    $consulta1 = "SELECT * FROM pareja WHERE id_categoria LIKE ".$row[0]." AND active like 1";
                                                    $resultado1 = $mysqli->query($consulta1);

                                                    $total2 = mysqli_num_rows($resultado1);



                                                    $pareja =  $total.'/'.$total2; ?>

                                                    <a href="../views/parejas.php?id=<?php echo $row[0]?>&idT=<?php echo $_GET['id']; ?>">
                                                        <input type="button" class="btn btn-round btn-wrapper" value="<?php echo $pareja;?> +">
                                                    </a></td>
                                                </td>

                                                <td><?php $consulta5 = "SELECT * FROM jornada WHERE id_categoria like ".$row[0];
                                                    $resultado5 = $mysqli->query($consulta5);

                                                    $total = mysqli_num_rows($resultado5); //Contamos la cantidad de filas que nos arrojo el resultado

                                                    ?><a href="../views/jornadas.php?id=<?php echo $row[0]?>&idT=<?php echo $_GET['id']; ?>">
                                                        <input type="button" class="btn btn-round btn-wrapper" value="<?php echo $total;?> +">
                                                    </a></td>
                                                <td>
                                                    <a target="_blank" href="../forms/formUpdateCategoria.php?id=<?php echo $row[0] ?>&idT=<?php echo $_GET['id']; ?>">
                                                        <input type="button" class="btn btn-round btn-primary" value="Editar">
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-round btn-danger" value="Eliminar" onclick="Pregunta(<?php echo $id; ?>,<?php echo $_GET['id'] ?>)">
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
