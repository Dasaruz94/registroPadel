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
                                Usuarios registrados en el torneo
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 top-20 padding-0">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading"><h3>Inscritos</h3>

                                    <a target="_blank" href="..\controllers\inscritosExcel.php?id=<?php echo $_GET['id']; ?>">
                                        <input type="button" class="btn btn-round btn-success" value="Reporte Excel">
                                    </a>
                               
                            </div>

                            <div class="panel-body">
                                <div class="responsive-table">
                                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Telefono</th>
                                            <th>categoria</th>
                                            <th>tipoPago</th>
                                            <th>cantidad</th>
                                            <th>codigo</th>
                                            <th>pagar</th>
                                            <th>Eliminar</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        include '../libs/conexion.php';

                                        // $tablaDeMysql = "co"; //Define el nombre de la tabla donde estan los datos


                                        //Checamos si se lleno el campo de usuario en el formulario


                                        $consulta = "SELECT * FROM inscripcion WHERE id_torneo LIKE ".$_GET['id'];
                                        $resultado = $mysqli->query($consulta);

                                        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                        while ($row = mysqli_fetch_row($resultado)) {
                                            $id = $row[0];


                                            ?>
                                            <tr>

                                                <td><?php $consulta2 = "SELECT * FROM datos_usuario WHERE id_usuario like ".$row[1];
                                                    $resultado2 = $mysqli->query($consulta2);

                                                    while ($row2 = mysqli_fetch_row($resultado2)) {

                                                        $nombre = $row2[2].' '.$row2[3].' '.$row2[4];

                                                        $correo = $row2[5];

                                                        $telefono = $row2[6];

                                                    }

                                                    echo $nombre;

                                                    ?></td>
                                                <td><?php echo $correo; ?></td>
                                                <td><?php echo $telefono; ?></td>
                                                <td><?php $consulta2 = "SELECT * FROM categoria WHERE id_categoria like ".$row[3];
                                                    $resultado2 = $mysqli->query($consulta2);

                                                    while ($row2 = mysqli_fetch_row($resultado2)) {

                                                        $categoria = $row2[2];



                                                    }

                                                    echo $categoria;

                                                    ?></td>
                                                <td><?php

                                                    switch ($row[4]) {
                                                        case 0:
                                                            echo "Deposito por confirmar";
                                                            break;
                                                        case 1:
                                                            echo "Pagado para 1 persona";
                                                            break;
                                                        case 2:
                                                            echo "Pagado para 2 personas";
                                                            break;
                                                    }

                                                    ?></td>
                                                <td><?php echo $row[5]; ?></td>

                                                <td><?php echo $row[6]; ?></td>
                                                <td>
                                                    <?php if($row[4] == 0){
                                                        ?>
                                                        <a  href="../forms/formPago.php?id=<?php echo $row[0];?>&idT=<?php echo $_GET['id']; ?>">
                                                            <input type="button" class="btn btn-round btn-primary" value="Pagar">
                                                        </a>

                                                        <?php
                                                    }else{
                                                        echo 'Ya ha sido pagado';
                                                    } ?>


                                                </td>

                                                <td>
                                                    <button class="btn btn-round btn-danger" value="Eliminar" onclick="Pregunta(<?php echo $row[0]; ?>,<?php echo $_GET['id'] ?>)">
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

            function Pregunta(value1,idT){

                if(confirm("¿Estas seguro eliminar esta inscripcion?")){
                    document.location.href="../controllers/deleteController.php?a=deleteInscripcion&id="+value1+"&idT="+idT;

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
