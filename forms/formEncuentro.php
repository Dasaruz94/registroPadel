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
                            <h3 class="animated fadeInLeft">Encuentros</h3>
                            <p class="animated fadeInDown">
                                Agregar un Encuentro
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12 panel">
                        <div class="col-md-12 panel-heading">
                            <h4>Dar de alta un encuentro</h4>
                        </div>
                        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                            <div class="col-md-12">
                                <form class="cmxform" enctype="multipart/form-data" id="signupForm" method="post" action="../controllers/createController.php?a=createEncuentro&idT=<?php echo $_GET['idT']; ?>&idC=<?php echo $_GET['idC']; ?>&idJ=<?php echo $_GET['idJ']; ?>">
                                    <div class="col-md-12">
                                        <label>Fecha</label>
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="datetime-local" class="form-text" id="validate_firstname" name="fecha" required>
                                            <span class="bar"></span>

                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <br><br>
                                                <label>Seleccionar pareja 1</label>
                                                <div class="col-sm-12 padding-0">
                                                    <select class="form-control" name="pareja1">
                                                        <?php
                                                        include '../libs/conexion.php';

                                                        $consulta = "SELECT * FROM pareja WHERE active LIKE 1 AND id_categoria LIKE ".$_GET['idC']." AND uno != 0";
                                                        $resultado = $mysqli->query($consulta);
                                                        while ($row = mysqli_fetch_row($resultado)) {



                                                            $consulta2 = "SELECT * FROM datos_usuario WHERE id_usuario LIKE ".$row[5];
                                                            $resultado2 = $mysqli->query($consulta2);
                                                            while ($row2 = mysqli_fetch_row($resultado2)) {

                                                                $nombre1 = $row2[2].' '.$row2[3];


                                                            }

                                                            $consulta2 = "SELECT * FROM datos_usuario WHERE id_usuario LIKE ".$row[6];
                                                            $resultado2 = $mysqli->query($consulta2);
                                                            while ($row2 = mysqli_fetch_row($resultado2)) {

                                                                $nombre2 = $row2[2].' '.$row2[3];

                                                            }


                                                            ?>
                                                            <option value="<?php echo $row[0]; ?>"><?php echo $nombre1.' - '.$nombre2; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <br><br>
                                                <label>Seleccionar pareja 2</label>
                                                <div class="col-sm-12 padding-0">
                                                    <select class="form-control" name="pareja2">
                                                        <?php

                                                        $consulta = "SELECT * FROM pareja WHERE active LIKE 1 AND id_categoria LIKE ".$_GET['idC']." AND uno != 0";
                                                        $resultado = $mysqli->query($consulta);
                                                        while ($row = mysqli_fetch_row($resultado)) {



                                                        $consulta2 = "SELECT * FROM datos_usuario WHERE id_usuario LIKE ".$row[5];
                                                        $resultado2 = $mysqli->query($consulta2);
                                                        while ($row2 = mysqli_fetch_row($resultado2)) {

                                                            $nombre1 = $row2[2].' '.$row2[3];


                                                        }

                                                            $consulta2 = "SELECT * FROM datos_usuario WHERE id_usuario LIKE ".$row[6];
                                                            $resultado2 = $mysqli->query($consulta2);
                                                            while ($row2 = mysqli_fetch_row($resultado2)) {

                                                                $nombre2 = $row2[2].' '.$row2[3];

                                                            }


                                                            ?>
                                                            <option value="<?php echo $row[0]; ?>"><?php echo $nombre1.' - '.$nombre2; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <br><br>
                                                <label>Cancha</label>
                                                <div class="col-sm-12 padding-0">
                                                    <select class="form-control" name="cancha">
                                                        <?php

                                                        $consulta = "SELECT sede.id_sede, sede.nombre, sede.ubicacion, sede.logo FROM sede INNER JOIN torneo_tiene_sede  ON sede.id_sede = torneo_tiene_sede.id_sede WHERE torneo_tiene_sede.id_torneo LIKE '".$_GET['idT']."' AND torneo_tiene_sede.active LIKE 1";

                                                        $resultado = $mysqli->query($consulta);

                                                        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                                        while ($row = mysqli_fetch_row($resultado)) {

                                                            $idSede = $row[0];
                                                            $sede = $row[1];


                                                            $consulta1 = "SELECT * FROM cancha WHERE active LIKE 1 AND id_sede LIKE ".$idSede;
                                                            $resultado1 = $mysqli->query($consulta1);

                                                            while ($row1 = mysqli_fetch_row($resultado1)) {

                                                                $idCancha = $row1[0];
                                                                $cancha = $row1[2];

                                                                ?>
                                                                <option value="<?php echo $idCancha; ?>"><?php echo $sede.'-'.$cancha; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <br><br>
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
        <script type="text/javascript">
            $(document).ready(function(){

                $("#signupForm").validate({
                    errorElement: "em",
                    errorPlacement: function(error, element) {
                        $(element.parent("div").addClass("form-animate-error"));
                        error.appendTo(element.parent("div"));
                    },
                    success: function(label) {
                        $(label.parent("div").removeClass("form-animate-error"));
                    },
                    rules: {
                        validate_firstname: "required",
                        validate_lastname: "required",
                        validate_username: {
                            required: true,
                            minlength: 2
                        },
                        validate_password: {
                            required: true,
                            minlength: 5
                        },
                        validate_confirm_password: {
                            required: true,
                            minlength: 5,
                            equalTo: "#validate_password"
                        },
                        validate_email: {
                            required: true,
                            email: true
                        },
                        validate_agree: "required"
                    },
                    messages: {
                        validate_firstname: "Please enter your firstname",
                        validate_lastname: "Please enter your lastname",
                        validate_username: {
                            required: "Please enter a username",
                            minlength: "Your username must consist of at least 2 characters"
                        },
                        validate_password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 5 characters long"
                        },
                        validate_confirm_password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 5 characters long",
                            equalTo: "Please enter the same password as above"
                        },
                        validate_email: "Please enter a valid email address",
                        validate_agree: "Please accept our policy"
                    }
                });
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