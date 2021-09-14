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
                                <form class="cmxform" enctype="multipart/form-data" id="signupForm" method="post" action="../controllers/createController.php?a=createPlayerSistema">
                                    <div class="col-md-12">
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="validate_firstname" name="nombre" required>
                                            <span class="bar"></span>
                                            <label>Nombre</label>
                                        </div>


                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="validate_lastname" name="ap" required>
                                            <span class="bar"></span>
                                            <label>Apellido paterno</label>
                                        </div>

                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="validate_lastname" name="am" required>
                                            <span class="bar"></span>
                                            <label>Apellido materno</label>
                                        </div>

                                        <label>Sexo</label>
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <select  name="sexo">
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                            </select>

                                        </div>
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="validate_lastname" name="edad" required>
                                            <span class="bar"></span>
                                            <label>Edad</label>
                                        </div>

                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="validate_lastname" name="tel" required>
                                            <span class="bar"></span>
                                            <label>Telefono</label>
                                        </div>

                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="validate_lastname" name="ciudad" required>
                                            <span class="bar"></span>
                                            <label>Origen</label>
                                        </div>

                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="validate_lastname" name="correo" required>
                                            <span class="bar"></span>
                                            <label>Correo</label>
                                        </div>

                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="text" class="form-text" id="validate_lastname" name="password" required>
                                            <span class="bar"></span>
                                            <label>Contraseña</label>
                                        </div>

                                        <label>Talla playera</label>
                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <select  name="playera">
                                                <option value="1">Chica</option>
                                                <option value="2">Mediana</option>
                                                <option value="3">Grande</option>
                                            </select>

                                        </div>

                                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                            <input type="file" id="validate_lastname" name="foto">
                                            <span class="bar">Seleccionar logotipo</span>

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