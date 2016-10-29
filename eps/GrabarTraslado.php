<?
if(empty($CodEpNueva)){
    ?>
    <script language="javascript">
        alert("Seleccione la nueva EPS para el Traslado.!")
        history.back()
    </script>
    <?
}else{
   include("../conexion.php");
   $fechap=date("Y-m-d");
    $consulta="insert into trasladoeps(codemple,cedemple,empleado,codigo_eps_actual_fk,codigo_eps_nueva_fk,fecha_inicio_traslado,fecha_aplicacion_traslado, fechaproceso)
	   values ('$CodEmple','$Documento','$Empleado','$CodEpsActual','$CodEpNueva','$Desde','$FechaAplicacion','$fechap')";
   $resultado=mysql_query($consulta)or die("error al grabar el traslado");
   /*codigo que actualiza*/
   $Sql="update empleado set codeps='$CodEpNueva' where empleado.codemple='$CodEmple'";
   $Rs=mysql_query($Sql) or die("Error al actualizar la eps");
   $registro=mysql_affected_rows();
   echo ("<script language=\"javascript\">");
   echo ("alert (\"Se grabo el registro con exito en el sistema.!\" ,\"\");");
   echo ("</script>");
   ?>
   <script language="javascript">
      open("TrasladoEps.php","_self");
   </script>
  <?
}
?>
</body>
</html>
