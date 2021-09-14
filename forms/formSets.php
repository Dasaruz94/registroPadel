<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 30/11/2017
 * Time: 11:54 PM
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
                            <h3 class="animated fadeInLeft">Sets de encuentro</h3>
                            <p class="animated fadeInDown">
                                Finalizar encuentro
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12 panel">
                        <div class="col-md-12 panel-heading">
                            <h4>Finalizar encuentro</h4>
                        </div>
                        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                            <div class="col-md-12">
                                <form class="cmxform" enctype="multipart/form-data" id="signupForm" method="post" action="../controllers/updateController.php?a=updateSetEncuentro&idJ=<?php echo $_GET['idJ'] ?>&idT=<?php echo $_GET['idT']; ?>&idC=<?php echo $_GET['idC']; ?>&idE=<?php echo $_GET['idE']; ?>">
                                    <div class="col-md-12">

                                        <?php

                                        include '../libs/conexion.php';

                                        $consulta = "SELECT * FROM encuentro WHERE id_encuentro LIKE ".$_GET['idE'];
                                        $resultado = $mysqli->query($consulta);

                                        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                        while ($row = mysqli_fetch_row($resultado)) {

                                            $idPareja1 = $row[5];

                                            $idPareja2 = $row[6];


                                        }

                                        $consulta1 = "SELECT * FROM pareja WHERE id_pareja LIKE ".$idPareja1;
                                        $resultado1 = $mysqli->query($consulta1);

                                        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                        while ($row1 = mysqli_fetch_row($resultado1)) {

                                          $pareja1 = $row1[4].'-'.$row1[3];

                                        }

                                        $consulta1 = "SELECT * FROM pareja WHERE id_pareja LIKE ".$idPareja2;
                                        $resultado1 = $mysqli->query($consulta1);

                                        // $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                        while ($row1 = mysqli_fetch_row($resultado1)) {

                                            $pareja2 = $row1[4].'-'.$row1[3];

                                        }

                                        $consulta1 = "SELECT * FROM sets WHERE id_encuentro like ".$_GET['idE'];

                                        $resultado = $mysqli->query($consulta1);

                                        $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


                                        $contador = 1;

                                        while($contador <= $total){





                                        ?>
                                            <label>Set numero <?php echo $contador; ?></label>
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="validate_firstname" name="punto1_<?php echo $contador; ?>" required>
                                            <span class="bar"></span>
                                            <label>Punto pareja <?php echo $pareja1; ?></label>
                                        </div>

                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="validate_firstname" name="punto2_<?php echo $contador; ?>" required>
                                            <span class="bar"></span>
                                            <label>Punto pareja <?php echo $pareja2; ?></label>
                                        </div>

                                        <?php

                                            $contador ++;
                                        }
                                        ?>


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