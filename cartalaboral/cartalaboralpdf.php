<?
include("../conexion.php");
$datos="select carta.codigo,carta.firma,carta.cargo,carta.empresa,carta.fecha,carta.nota,maestro.telmaestro,maestro.web,maestro.dirmaestro,municipio.municipio,departamento.departamento from departamento,municipio,carta,empleado,zona,sucursal,maestro
       where maestro.codmaestro=sucursal.codmaestro and
             maestro.codmuni=municipio.codmuni and
             municipio.codepart=departamento.codepart and
             sucursal.codsucursal=zona.codsucursal and
             zona.codzona=empleado.codzona and
             empleado.cedemple=carta.cedemple and
             carta.codigo='$Radicado'";
$res=mysql_query($datos)or die("Error al buscar datos");
$filas=mysql_fetch_array($res);
$auxiliar=$filas["fecha"];
$Firma=$filas["firma"];
$Cargo=$filas["cargo"];
$Empresa=$filas["empresa"];
$Radicado=$filas["codigo"];
$Direccion=$filas["dirmaestro"];
$Depto=$filas["departamento"];
$Municipio=$filas["municipio"];
$Telefono=$filas["telmaestro"];
$Nota=$filas["nota"];
$Paginaweb=$filas["web"];
require_once('class.ezpdf.php');
$pdf =& new Cezpdf('a4');
$pdf->selectFont('../fonts/courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);
$pdf->ezStartPageNumbers(550,18,10,'','Pagina : {PAGENUM} de {TOTALPAGENUM}',1);
$pdf->ezText("\n\n\n", 2);
$pdf->ezImage("../image/imagen.JPG",0,510, 'none', 'left');
//$pdf->ezText('Radicado Nro: '.$Radicado,10,'nome', 'right');
$pdf->ezText('Nro_Carta: '.$Radicado,12,array('justification'=>'right'));
$pdf->ezText("\n\n\n", 3);
$pdf->ezText('<b>DEPARTAMENTO DE NOMINA</b> ',14,array('justification'=>'center'));
$pdf->ezText("\n\n\n", 9);
$pdf->ezText('<b>CERTIFICA</b>',14,array('justification'=>'center'));
$pdf->ezText("\n\n\n", 9);
$pdf->ezText($Nota,11,array('justification'=>'full','spacing' =>'1'));
$pdf->ezText("\n\n\n", 10);
//$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 7);
$pdf->ezText('<b>Firmada a los interesados el: </b> '.$auxiliar,12);
$pdf->ezText("\n\n\n", 8);
$pdf->selectFont('font/courier.afm');
$pdf->ezImage("../image/firmaWalter.png", 0, 100, 'none', 'left');
$pdf->ezText(''.$Firma,12);
$pdf->ezText(''.$Cargo,12);
$pdf->ezText(''.$Empresa,12);
$pdf->ezText("<b>Fecha Impresión:</b> ".date("d/m/Y"), 8,'right');
$pdf->ezText("<b>Firmada digitalmente.</b>", 8,'right');
$pdf->ezText("\n\n\n", 7);
$pdf->ezText('<b>Casa Matriz:</b> '. $Direccion,10);
$pdf->ezText('<b>PBX:</b> (4) '. $Telefono,10);
$pdf->ezText('<b>Departamento</b>: '. $Depto,10);
$pdf->ezText('<b>Ciudad:</b> '. $Municipio,10);
$pdf->ezText('<b>Web:</b> '.$Paginaweb,10);
$pdf->ezStream();
?>
