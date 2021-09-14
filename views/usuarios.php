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
                            <h3 class="animated fadeInLeft">Usuarios</h3>
                            <p class="animated fadeInDown">
                              Usuarios registrados en Padel Experience México
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn-flip btn btn-raised btn-success" onclick="javascript:location.href='../forms/formUser.php'">

                        <div class="side">
                            Agregar Usuario <span class="fa fa-plus"></span>
                        </div>
                        <span class="icon"></span>
                    </button>


                </div>

                <div class="col-md-6">
                </div>

                <div class="col-md-3">
                    <a target="_blank" href="..\controllers\usuariosLigaExcel.php">
                        <input type="button" class="btn btn-round btn-success" value="Reporte Excel">
                    </a>

                </div>

                <div class="col-md-12 top-20 padding-0">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading"><h3>Usuarios</h3></div>
                            <div class="panel-body">
                                <div class="responsive-table">
                                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Telefono</th>
                                            <th>sexo</th>
                                            <th>ciudad</th>
                                            <th>foto</th>
                                            <th>Ultimo Torneo</th>
                                            <th>Inscribir a un torneo</th>
                                            <th>Eliminar</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        include '../libs/conexion.php';

                                        // $tablaDeMysql = "co"; //Define el nombre de la tabla donde estan los datos


                                        //Checamos si se lleno el campo de usuario en el formulario


                                        $consulta = "SELECT * FROM datos_usuario WHERE active LIKE 1";
                                        $resultado = $mysqli->query($consulta);

                                        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                        while ($row = mysqli_fetch_row($resultado)) {
                                            $id = $row[0];


                                            ?>
                                            <tr>

                                                <td><?php echo $row[2].' '. $row[3].' '. $row[4]; ?></td>
                                                <td><?php echo $row[5]; ?></td>
                                                <td><?php echo $row[6]; ?></td>
                                                <td><?php

                                                    if($row[7] == 1){

                                                        echo 'Masculino';
                                                    }else{

                                                        echo 'Femenino';
                                                    }

                                                    ?></td>
                                                <td><?php echo $row[10]; ?></td>

                                                <td><img src="../assets/images/players/<?php echo $row[11]; ?>" style="width: 20%"></td>

                                                <td><?php $consulta2 = "SELECT * FROM inscripcion WHERE id_usuario like ".$row[1]." ORDER BY id_inscripcion DESC limit 1";
                                                    $resultado2 = $mysqli->query($consulta2);

                                                    while ($row2 = mysqli_fetch_row($resultado2)) {

                                                        $consulta3 = "SELECT * FROM torneo WHERE id_torneo like ".$row2[2];
                                                        $resultado3 = $mysqli->query($consulta3);

                                                        while ($row3 = mysqli_fetch_row($resultado3)) {


                                                            echo $row3[1];

                                                        }

                                                    }

                                                    ?></td>
                                                <td>
                                                    <a href="../forms/formInscribir.php?id=<?php echo $row[1] ?>">
                                                        <input type="button" class="btn btn-round btn-primary" value="Inscribir">
                                                    </a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-round btn-danger" value="Eliminar" onclick="Pregunta(<?php echo $row[1]; ?>)">
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

            function Pregunta(value1){

                if(confirm("¿Estas seguro de eliminar este usuario?")){
                    document.location.href="../controllers/deleteController.php?a=deleteUser&id="+value1;

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
