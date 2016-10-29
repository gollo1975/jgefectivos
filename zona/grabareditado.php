<html>

<head>
  <title></title>
</head>
<body>
<?
if(empty($vendedor)):
     ?>
       <script language="javascript">
         alert("Seleccion un vendedor de la lista")
         history.back()
       </script>
    <?
     elseif(empty($comision)):
     ?>
       <script language="javascript">
         alert("Debe de digitar el porcetaje de la comisión")
         history.back()
       </script>
    <?
else:
       include("../conexion.php");
       $fechaP=date("Y-m-d");
	          $consulta="update relacioncomision set codzona='$codzona',cedulaven='$vendedor',comision='$comision',compartida='$compartida',fechap='$fechaP',estado='$Estado' where relacioncomision.nro='$nro'";
	          $resultad=mysql_query($consulta)or die("Error al grabar datos modificados");
	          $registro=mysql_affected_rows();
                   ?>
		       <script language="javascript">
		         alert("Se grabao con exito el registro en el sistema.!")
		        open ("modificarelacion.php?cedula=<?echo $cedula;?>","_self")
		       </script>
		    <?
                         
 endif;
       ?>
</body>
</html>
