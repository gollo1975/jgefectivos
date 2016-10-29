<?
if($TipoProceso=='CerrarP'){
    include("../conexion.php");
    $fechaI=date("Y-m-d");
    $con="update retiroprovision set fechare='$fecha',dias='$dia',diasperiodo='$diaPago',estado='$Estado' where retiroprovision.codretiro='$codigo'";
    $resultado=mysql_query($con) or die("Actualizacion Incorrecta  ");
   /*CODIGO DE CIERRE DE CONTRATO*/
    $consulta = "select count(*) from retiro";
    $result = mysql_query ($consulta);
    $sw = mysql_fetch_row($result);
    if ($sw[0]>0):
      $consult1 = "select max(cast(nroretiro as unsigned)) + 1  from retiro";
      $result1 = mysql_query ($consult1);
      $codec = mysql_fetch_row($result1);
      $nroretiro = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
    else:
      $nroretiro="00001";
    endif;
    $consulta="insert into retiro(nroretiro,cedemple,nombres,zona,fecha,fechare,dias)
    values('$nroretiro','$cedula','$nombre','$zona','$fechaI','$fecha','$dia')";
    $resultad=mysql_query($consulta)or die("Error al actualizar los datos del retiro");
    /*codigo de busqeuda de contrato*/
     $con1="select contrato.* from contrato,empleado
           where  empleado.codemple=contrato.codemple and
                  contrato.fechater='0000-00-00' and
                  empleado.cedemple='$cedula'";
    $resu1=mysql_query($con1)or die ("Consulta Incorrecta 1");
    $fila=mysql_fetch_array($resu1);
    $Contrato=$fila["contrato"];
    /*codigo de actualizacion*/
    $con="update contrato set fechater='$fecha' where contrato.contrato='$Contrato'";
         $resultad=mysql_query($con)or die("Inserccion incorrecta dos");
    $registros=mysql_affected_rows();
   ?>
  <script language="javascript">
    alert("El contrato se cerro con exito en sistema!")
   open("modificaretiro.php?desde=<?echo $desde;?>&hasta=<?echo $hasta;?>&auxcodigo=<?echo $auxcodigo;?>","_self");
  </script>
  <?
}else{
     if($TipoProceso=='Actualizar'){
          include("../conexion.php");
          $fechaI=date("Y-m-d");
          $con="update retiroprovision set fechare='$fecha',dias='$dia',diasperiodo='$diaPago',estado='$Estado' where retiroprovision.codretiro='$codigo'";
          $resultado=mysql_query($con) or die("Actualizacion Incorrecta  ");
          ?>
	  <script language="javascript">
	    alert("Registro Moficado con éxito en sistema ?")
	   open("modificaretiro.php?desde=<?echo $desde;?>&hasta=<?echo $hasta;?>&auxcodigo=<?echo $auxcodigo;?>","_self");
	  </script>
	  <?
     }else{
         ?>
           <script language="javascript">
               alert("Debes de seleccionar que tipo de proceso vas  a realizar!")
	       history.back()
           </script>
         <?
     }
}
?>
