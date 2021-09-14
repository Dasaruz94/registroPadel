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

        include '../views/head.php';

        ?>
        <body id="mimin" class="dashboard" ">
        <!-- start: Header -->
        <?php
        include '../views/header.php'
        ?>
        <!-- end: Header -->

        <div class="container-fluid mimin-wrapper">

            <!-- start:Left Menu -->
            <?php
            include '../views/menu.php';
            ?>
            <!-- end: Left Menu -->


            <!-- start: Content -->
            <div id="content" class="article-v1">
                <div class="panel box-shadow-none content-header">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h3 class="animated fadeInLeft">Sedes</h3>
                            <p class="animated fadeInDown">
                                Agregar una sede al torneo
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12 panel">
                        <div class="col-md-12 panel-heading">
                            <h4>Dar de alta una sede al torneo</h4>
                        </div>
                        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                            <div class="col-md-12">
                                <form class="cmxform" enctype="multipart/form-data" id="signupForm" method="post" action="../controllers/createController.php?a=addSedeTorneo&id=<?php echo $_GET['id']; ?>">
                                    <div class="col-md-12">


                                    <div class="form-group"><label class="col-sm-2 control-label text-right">Seleccionar una sede</label>
                                        <div class="col-sm-10">
                                        <div class="col-sm-12 padding-0">
                                            <select class="form-control" name="sede">
                                                <?php
                                                include '../libs/conexion.php';

                                                // $tablaDeMysql = "co"; //Define el nombre de la tabla donde estan los datos


                                                //Checamos si se lleno el campo de usuario en el formulario


                                                $consulta = "SELECT * FROM sede WHERE active LIKE 1";
                                                $resultado = $mysqli->query($consulta);

                                                // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                                while ($row = mysqli_fetch_row($resultado)) {


                                               ?>
                                                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                                              <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        </div>
                                    </div>


                                        <div class="col-md-12">

                                            <input class="submit btn btn-danger" type="submit" value="Agregar">
                                        </div>
                                </form>

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


        <!-- plugins -->
        <script src="../asset/js/plugins/moment.min.js"></script>
        <script src="../asset/js/plugins/jquery.nicescroll.js"></script>


        <!-- custom -->
        <script src="../asset/js/main.js"></script>

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