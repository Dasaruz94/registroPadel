<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 11/01/2018
 * Time: 10:48 AM
 */

ob_start();

date_default_timezone_set('UTC'); // PHP's date function uses this value!
include '../libs/conexion.php';


$consulta = "SELECT * FROM datos_usuario WHERE active LIKE 1";

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

    $tituloReporte = "Inscritos en la liga Padel Experience México";
    $titulosColumnas = array('Nombre', 'Correo', 'Telefono', 'Sexo','Edad','Playera','Ciudad','UltimoTorneo','FechaInscripcion');
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
    $objPHPExcel->getActiveSheet()->SetCellValue("H2", $titulosColumnas[7]);
    $objPHPExcel->getActiveSheet()->SetCellValue("I2", $titulosColumnas[8]);

    $i = 1;

    while ($fila = mysqli_fetch_array($resultado)) {


        $ultimoT = '';

        $consulta2 = "SELECT * FROM inscripcion WHERE id_usuario like ".$fila['id_usuario']." ORDER BY id_inscripcion DESC limit 1";
        $resultado2 = $mysqli->query($consulta2);

        while ($row2 = mysqli_fetch_row($resultado2)) {

            $consulta3 = "SELECT * FROM torneo WHERE id_torneo like ".$row2[2];
            $resultado3 = $mysqli->query($consulta3);

            while ($row3 = mysqli_fetch_row($resultado3)) {

                $ultimoT = $row3[1];

            }

        }


        if($ultimoT == ''){
            $ultimoT = 'Ninguno';
        }

        $nombre = $fila['nombre'].' '.$fila['ap'].' '.$fila['am'];


        $fecha  = explode(" ", $fila['created_at']);



        switch ($fila['sexo']) {
            case 1:
                $sexo = "Masculino";
                break;
            case 2:
                $sexo = "Femenino";
                break;

        }

        switch ($fila['playera']) {
            case 1:
                $playera = "Chica";
                break;
            case 2:
                $playera = "Mediana";
                break;

            case 3:
                $playera = "Grande";
                break;

        }


        $objPHPExcel->getActiveSheet()->SetCellValue("A" . $counter, $nombre);
        $objPHPExcel->getActiveSheet()->SetCellValue("B" . $counter, $fila['correo']);
        $objPHPExcel->getActiveSheet()->SetCellValue("C" . $counter, $fila['tel']);
        $objPHPExcel->getActiveSheet()->SetCellValue("D" . $counter, $sexo);
        $objPHPExcel->getActiveSheet()->SetCellValue("E" . $counter, $fila['edad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("F" . $counter, $playera);
        $objPHPExcel->getActiveSheet()->SetCellValue("G" . $counter, $fila['ciudad']);
        $objPHPExcel->getActiveSheet()->SetCellValue("H" . $counter, $ultimoT);
        $objPHPExcel->getActiveSheet()->SetCellValue("I" . $counter, $fecha[0]);


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
    $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($estiloTituloReporte);
    // $objPHPExcel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($estiloTituloColumnas);
    //$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A3:M".($counter-1));

    $nombreArchivo = "ReporteLiga". date('d-m-Y');

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