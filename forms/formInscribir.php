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
                            <h3 class="animated fadeInLeft">Usuarios</h3>
                            <p class="animated fadeInDown">
                                Agregar un usuario
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12 panel">
                        <div class="col-md-12 panel-heading">
                            <h4>Dar de alta un usuario</h4>
                        </div>
                        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                            <div class="col-md-12">
                                <form class="cmxform" enctype="multipart/form-data" id="signupForm" method="post" action="../controllers/createController.php?a=createInscripcion&id=<?php echo $_GET['id'];?>">
                                    <div class="col-md-12">

                                        <label>Torneo</label>
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <select  name="torneo">
                                                <?php
                                                include '../libs/conexion.php';

                                                // $tablaDeMysql = "co"; //Define el nombre de la tabla donde estan los datos


                                                //Checamos si se lleno el campo de usuario en el formulario


                                                $consulta = "SELECT * FROM torneo WHERE active LIKE 1 ORDER BY id_torneo DESC LIMIT 1";
                                                $resultado = $mysqli->query($consulta);

                                                // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                                while ($row = mysqli_fetch_row($resultado)) {

                                                    $idTorneo = $row[0];


                                                    ?>
                                                    <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <label>Categoria</label>
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <select  name="categoria">
                                                <?php
                                                include '../libs/conexion.php';

                                                // $tablaDeMysql = "co"; //Define el nombre de la tabla donde estan los datos


                                                //Checamos si se lleno el campo de usuario en el formulario


                                                $consulta = "SELECT * FROM categoria WHERE id_torneo LIKE ".$idTorneo;
                                                $resultado = $mysqli->query($consulta);

                                                // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                                while ($row = mysqli_fetch_row($resultado)) {



                                                    ?>
                                                    <option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <label>Tipo de pago</label>
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <select  name="tipoPago">
                                                <option value="1">Pagado</option>
                                                <option value="0">Por Pagar</option>

                                            </select>

                                        </div>


                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="validate_lastname" name="cantidad" required>
                                            <span class="bar"></span>
                                            <label>Cantidad</label>
                                        </div>




                                        <div class="col-md-12">

                                            <input class="submit btn btn-danger" type="submit" value="Subir">
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