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
                                Agregar una sede
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12 panel">
                        <div class="col-md-12 panel-heading">
                            <h4>Dar de alta una sede</h4>
                        </div>
                        <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                            <div class="col-md-12">
                                <form class="cmxform" enctype="multipart/form-data" id="signupForm" method="post" action="../controllers/updateController.php?a=updatePago&id=<?php echo $_GET['id'];?>&idT=<?php echo $_GET['idT'];?>">
                                    <div class="col-md-12">
                                        <label>Participante 1</label>
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <select  name="pago">
                                            <option value="1">Pago 1</option>
                                            <option value="2">Pago 2</option>
                                            </select>

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