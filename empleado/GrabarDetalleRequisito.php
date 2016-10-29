<?
include("../conexion.php");
$Concepto=strtoupper($Concepto);
$consulta="update listadodocumentoempleado set concepto='$Concepto',sugerido='$CantidadReal',estado='$Estado' where listadodocumentoempleado.iddocumento='$Id'";
$resultado=mysql_query($consulta) or die("Error al grabar datos");
$registros=mysql_affected_rows();
if ($registros==0):
   ?>
   <script language="javascript">
       alert("No hubo modificaciones en la Base de Datos ?")
       open("ListarDocumento.php","_self");
        
   </script>
   <?
else:
   echo "<script language=\"javascript\">";
   echo "alert (\"Se grabo con exitos los  Registro en la DB.\");";
   echo ("open (\"ListarDocumento.php\",\"_self\");");
   echo "</script>";
endif;
  ?>
