<?
if(empty($CodPensionNueva)){
    ?>
    <script language="javascript">
        alert("Seleccione el nuevo fondo de Pensión para el Traslado.!")
        history.back()
    </script>
    <?
}else{
   include("../conexion.php");
   $fechap=date("Y-m-d");
    $consulta="insert into trasladopension(codemple,cedemple,empleado,codigo_fondo_actual_fk,codigo_fondo_nueva_fk,fecha_inicio_traslado,fecha_aplicacion_traslado ,fechaproceso)
	   values ('$CodEmple','$Documento','$Empleado','$CodPensionActual','$CodPensionNueva','$Desde','$Fecha_Aplicacion','$fechap')";
   $resultado=mysql_query($consulta)or die("error al grabar el traslado");
   /*codigo que actualiza*/
   $Sql="update empleado set codpension='$CodPensionNueva' where empleado.codemple='$CodEmple'";
   $Rs=mysql_query($Sql) or die("Error al actualizar la eps");
   $registro=mysql_affected_rows();
   echo ("<script language=\"javascript\">");
   echo ("alert (\"Se grabo el registro con exito en el sistema.!\" ,\"\");");
   echo ("</script>");
   ?>
   <script language="javascript">
      open("TrasladoFondo.php","_self");
   </script>
  <?
}
?>
</body>
</html>
