<?php

ob_start();

date_default_timezone_set('UTC'); // PHP's date function uses this value!
include '../libs/conexion.php';


$consulta1 = "SELECT * FROM torneo WHERE id_torneo LIKE ".$_GET['id'];
$resultado1 = $mysqli->query($consulta1);
// $total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado


while ($row1 = mysqli_fetch_row($resultado1)) {
    $nombreTorneo = $row1[1];
}


$consulta = "SELECT * FROM inscripcion WHERE id_torneo LIKE ".$_GET['id'];

$resultado = $mysqli->query($consulta);


//Checamos si se lleno el campo de usuario en el formulario


$total = mysqli_num_rows($resultado); //Contamos la cantidad de filas que nos arrojo el resultado

if ($resultado->num_rows > 0) {

    require_once '../libs/PHPExcel.php';

    $objPHPExcel = new PHPExcel();
// Set properties
    $objPHPExcel->getProperties()->setCreator("PadelExperience");
    $objPHPExcel->getProperties()->setLastModifiedBy("PadelExperience");
    $objPHPExcel->getProperties()->setTitle("Inscritos");
    $objPHPExcel->getProperties()->setSubject("Reporte Inscritos");
    $objPHPExcel->getProperties()->setDescription("Reporte Inscritos");



    $arrayLabels = array();
//Nos va servir para obtener los labels de cada campo

    $counter = 3;

    $rango = range("A","Z");

    $tituloReporte = "Inscritos en torneo: ".$nombreTorneo;
    $titulosColumnas = array('Nombre', 'Correo', 'Telefono', 'Categoria','tipoPago','Cantidad','Codigo');
    //ancho de celdas automatico
    for($i = 'A'; $i <= 'C'; $i++){
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
    }



    ob_clean();
    /*Aqui se deben de elegir que campos se pueden mostrar para el usuario*/
    $objPHPExcel->getActiveSheet()->SetCellValue("A1", $tituloReporte);
    $objPHPExcel->getActiveSheet()->SetCellValue("A2", $titulosColumnas[0]);
    $objPHPExcel->getActiveSheet()->SetCellValue("B2", $titulosColumnas[1]);
    $objPHPExcel->getActiveSheet()->SetCellValue("C2", $titulosColumnas[2]);
    $objPHPExcel->getActiveSheet()->SetCellValue("D2", $titulosColumnas[3]);
    $objPHPExcel->getActiveSheet()->SetCellValue("E2", $titulosColumnas[4]);
    $objPHPExcel->getActiveSheet()->SetCellValue("F2", $titulosColumnas[5]);
    $objPHPExcel->getActiveSheet()->SetCellValue("G2", $titulosColumnas[6]);

    $i = 1;

    while ($fila = mysqli_fetch_array($resultado)) {


        $consulta2 = "SELECT * FROM datos_usuario WHERE id_usuario like ".$fila['id_usuario'];
        $resultado2 = $mysqli->query($consulta2);

        while ($row2 = mysqli_fetch_row($resultado2)) {

            $nombre = $row2[2].' '.$row2[3].' '.$row2[4];

            $correo = $row2[5];

            $telefono = $row2[6];

        }

        $consulta2 = "SELECT * FROM categoria WHERE id_categoria like ".$fila['id_categoria'];
        $resultado2 = $mysqli->query($consulta2);

        while ($row2 = mysqli_fetch_row($resultado2)) {

            $categoria = $row2[2];

        }

        switch ($fila['tipo_pago']) {
            case 0:
                $tP = "Pendiente de pago";
                break;
            case 1:
                $tP = "Pagado para 1 persona";
                break;
            case 2:
                $tP = "Pagado para 2 personas";
                break;
        }


        $objPHPExcel->getActiveSheet()->SetCellValue("A" . $counter, $nombre);
        $objPHPExcel->getActiveSheet()->SetCellValue("B" . $counter, $correo);
        $objPHPExcel->getActiveSheet()->SetCellValue("C" . $counter, $telefono);
        $objPHPExcel->getActiveSheet()->SetCellValue("D" . $counter, $categoria);
        $objPHPExcel->getActiveSheet()->SetCellValue("E" . $counter, $tP);
        $objPHPExcel->getActiveSheet()->SetCellValue("F" . $counter, $fila['cantidad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("G" . $counter, $fila['codigo_inv']);


        $counter++;
        $i++;
    }
     ob_start();



//otros dispositivos



    $estiloTituloReporte = array(
        'font' => array(
            'name'      => 'Georgia',
            'bold'      => true,
            'italic'    => false,
            'strike'    => false,
            'size' =>13,
            'color'     => array(
                'rgb' => 'FFFFFF'
            )
        ),
        'fill' => array(
            'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
            'color'	=> array(
                'rgb' => '40BF48')
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_NONE
            )
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'rotation' => 0,
            'wrap' => TRUE
        )
    );




//forma sencilla de dar estilos
    $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($estiloTituloReporte);
    // $objPHPExcel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($estiloTituloColumnas);
    //$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A3:M".($counter-1));

    $nombreArchivo = "ReporteInscritos". date('d-m-Y');

    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");;
    header("Content-Disposition: attachment;filename=$nombreArchivo.xls");
    header("Content-Transfer-Encoding: binary ");

    $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
    $objWriter->save('php://output');

}


?>