<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 21/05/2017
 * Time: 07:27 PM
 */


SESSION_START();

if(isset($_SESSION['email'])) {

    $total=2;


}else{

    include 'libs/conexion.php';


    $tablaDeMysql = "usuario"; //Define el nombre de la tabla donde estan los datos


//Checamos si se lleno el campo de usuario en el formulario
    $b=$_POST['password'];
    $patron='Zn5G7hnkL0bhgf1';
    $b=$patron.md5($b);



    $consulta = "SELECT * FROM ".$tablaDeMysql." WHERE username LIKE '".$_POST['username']."' AND password LIKE '".$b."' ";
    $resultado = $mysqli->query($consulta);



    $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado




}


if($total == 1){


    while ($row=mysqli_fetch_row($resultado))
    {

        $active = $row[8];


        if($active==1){
            $_SESSION['email'] = $_POST['username'];
            $_SESSION['id'] = $row[0];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['tipo_usuario'] = $row[3];

        }
        else{

            SESSION_START();

            SESSION_UNSET();

            SESSION_DESTROY();

            header('Location: index.php?e=wrong1');
        }
    }


    /*$consulta1 = "SELECT * FROM user_data WHERE id_user LIKE '".$_SESSION['id']."'";
    $resultado1 = $mysqli->query($consulta1);

    while ($row1=mysqli_fetch_row($resultado1))
    {

        $_SESSION['name'] = $row1[2].' '.$row1[3];

    } */


    $total=2;
}

if($total==2){

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
        <div id="content" class="article-v1">
            <div class="panel box-shadow-none content-header">
                <div class="panel-body">
                  <div class="col-md-12">
                      <h3 class="animated fadeInLeft">Article v1</h3>
                      <p class="animated fadeInDown">
                        Pages <span class="fa-angle-right fa"></span> Article v1
                      </p>
                  </div>
                </div>
            </div>
            <div class="col-md-12">
              <div class="panel">
                <div class="pull-right article-v1-time">
                  <em> October 1st 2029 - 20:01 Pm</em></div>
                  <div class="panel-body">
                    <div class="col-md-12 text-center article-v1-title"><h2>Lorem ipsum dolor sit amet</h2></div>


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
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery.ui.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>


<!-- plugins -->
<script src="asset/js/plugins/moment.min.js"></script>
<script src="asset/js/plugins/jquery.nicescroll.js"></script>


<!-- custom -->
<script src="asset/js/main.js"></script>
<!-- end: Javascript -->
</body>
</html>

    <?php

}else{

    header('Location: index.php?e=wrong');

}

?>