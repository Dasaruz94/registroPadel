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
                            <h3 class="animated fadeInLeft">Parejas</h3>
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
                               Parejas dentro de la categoria <?php echo $nombre ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <button class="btn-flip btn btn-raised btn-success" onclick="javascript:location.href='../forms/formPareja.php?idC=<?php echo $_GET['id']; ?>&idT=<?php echo $_GET['idT']; ?>'">

                        <div class="side">
                            Agregar pareja <span class="fa fa-plus"></span>
                        </div>

                        <span class="icon"></span>
                    </button>
                </div>
                <div class="col-md-12 top-20 padding-0">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading"><h3>Parejas</h3>
                                <a target="_blank" href="..\controllers\parejasExcel.php?id=<?php echo $_GET['id']; ?>">
                                    <input type="button" class="btn btn-round btn-success" value="Reporte Excel">
                                </a>
                            </div>
                            <div class="panel-body">
                                <div class="responsive-table">
                                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Num/Grupo</th>
                                            <th>Participante 1</th>
                                            <th>Foto</th>
                                            <th>Participante 2</th>
                                            <th>Foto</th>
                                            <th>Puntos torneo</th>
                                            <th>CambiarNumGrP</th>
                                            <th>Editar</th>
                                            <th>Eliminar</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        include '../libs/conexion.php';

                                        // $tablaDeMysql = "co"; //Define el nombre de la tabla donde estan los datos


                                        //Checamos si se lleno el campo de usuario en el formulario


                                        $consulta = "SELECT * FROM pareja WHERE id_categoria LIKE ".$_GET['id'];
                                        $resultado = $mysqli->query($consulta);

                                        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                        while ($row = mysqli_fetch_row($resultado)) {
                                            $id = $row[0];


                                            ?>
                                            <tr>

                                                <td><?php echo $row[4].' '. $row[3]; ?></td>

                                                <td><?php

                                                    if($row[5] != 0){

                                                    $consulta3 = "SELECT * FROM datos_usuario WHERE id_usuario like ".$row[5];
                                                    $resultado3 = $mysqli->query($consulta3);

                                                        while ($row3 = mysqli_fetch_row($resultado3)) {

                                                            $nombre = $row3[2].' '. $row3[3].' '. $row3[4];
                                                            $foto = '<img src="../assets/images/players/'.$row3[11].'" style="width: 20%">';


                                                        }


                                                    }else{

                                                        $nombre = 'NA';
                                                        $foto = 'NA';

                                                    }
                                                    echo $nombre;

                                                    ?></td>
                                                <td><?php echo $foto; ?></td>

                                                <td><?php
                                                    if($row[6] != 0){
                                                    $consulta3 = "SELECT * FROM datos_usuario WHERE id_usuario like ".$row[6];
                                                    $resultado3 = $mysqli->query($consulta3);


                                                        while ($row3 = mysqli_fetch_row($resultado3)) {

                                                            $nombre = $row3[2].' '. $row3[3].' '. $row3[4];
                                                            $foto = '<img src="../assets/images/players/'.$row3[11].'" style="width: 20%">';


                                                        }


                                                    }else{

                                                        $nombre = 'NA';
                                                        $foto = 'NA';

                                                    }
                                                    echo $nombre;

                                                    ?></td>
                                                <td><?php echo $foto; ?></td>
                                                <td><?php
                                                    echo $row[7];
                                                    ?></td>
                                                <td>
                                                    <a href="../forms/formUpdateParejaNYG.php?id=<?php echo $row[0] ?>&idC=<?php echo $_GET['id']; ?>&idT=<?php echo $_GET['idT'] ?>">
                                                        <input type="button" class="btn btn-round btn-primary" value="Cambiar">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a target="_blank" href="../forms/formUpdatePareja.php?id=<?php echo $row[0] ?>&idC=<?php echo $_GET['id']; ?>&idT=<?php echo $_GET['idT'] ?>">
                                                        <input type="button" class="btn btn-round btn-primary" value="Editar">
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-round btn-danger" value="Vaciar" onclick="Pregunta(<?php echo $row[0]; ?>,<?php echo $_GET['id']; ?>,<?php echo $_GET['idT']; ?>)">
                                                        Vaciar
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

            function Pregunta(id,idC,idT){

                if(confirm("¿Estas seguro de vaciar esta pareja?")){
                    document.location.href="../controllers/updateController.php?a=updateParejaVaciar&id="+id+"&idC="+idC+"&idT="+idT;

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
