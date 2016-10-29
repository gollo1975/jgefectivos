<html>

<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
</head>
<body>
 <script language="javascript">
      function ColorFoco(obj)
          {
          document.getElementById(obj).style.background="#9DFF9D"
          }
      function QuitarFoco(obj)
          {
          document.getElementById(obj).style.background="white"
          }
 </script>
<?php
include("../conexion.php");
$sql="select count(*) from tipoprocesomemo ";
$Res=mysql_query($sql)or die ("error al procesar datos");
$sw = mysql_fetch_row($Res);
if ($sw[0] == 0){
    ?>
     <center><h4><u>Ingreso de Procesos</u></h4></center>
        <form action="GrabarInicio.php" method="post" id="proceso" name="proceso">
            <table border="0" align="center"
                 <tr><td><br></td></tr>
                 <tr>
                     <td><b>Descripción:</b></td>
                      <td><input type="text"  name="Concepto" size="40" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Concepto"></td>
                    </tr>
                 </tr>
                 <tr><td><br></td></tr>
                 <tr>
                    <td colspan="6">
                    <input type="submit" Value="Guardar" class="boton" id ="grabar" name="grabar"></td>
                 </tr>
            </table>
        </form>
    <?
}else{
    $Cont="select tipoproceso.*,tipoprocesomemo.concepto from tipoproceso,tipoprocesomemo  where tipoprocesomemo.idproceso=tipoproceso.idproceso and tipoprocesomemo.estado='ACTIVO'";
    $ResC=mysql_query($Cont)or die ("error al procesar la relacion del proceso");
    $swC = mysql_num_rows($ResC);
    if($swC == 0){
       ?>
        <center><h4><u>Ingreso de Relación</u></h4></center>
        <form action="GrabarInicioTipo.php" method="post" id="f1" name="f1">
            <table border="0" align="center"
                 <tr><td><br></td></tr>
	         <tr>
	         <td><b>Tipo_Proceso:</b></td>
	         <td colspan="1"><select name="TipoProceso" class="cajasletra">
	             <option value="0">Seleccione
	             <?
	             $consulta_z="select concepto,idproceso from tipoprocesomemo where estado='ACTIVO'  order by concepto";
	             $resultado_z=mysql_query($consulta_z) or die("Error al buscar el proceso");
	             while ($filas_z=mysql_fetch_array($resultado_z))
	                   {
	                   ?>
	                   <option value="<?echo $filas_z["idproceso"];?>"><?echo $filas_z["concepto"];?>
	                   <?
	                   }
	                   ?>
	                   </select></td>
	           </tr>
                 <tr>
                     <td><b>Concepto:</b></td>
                      <td colspan="5"><p align="justify"><textarea name="Concepto" cols="89" rows="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Concepto"></textarea></td>
                    </tr>
                 </tr>
                  <tr>
                     <td><b>Crear_Proceso:</b></td>
                      <td><input type="radio"  checked name="EstadoT" value="NO"  id="EstadoT">NO<input type="radio"  name="EstadoT" value="SI" id="EstadoT">SI</td>
                    </tr>
                 <tr><td><br></td></tr>
                 <tr>
                    <td colspan="6">
                    <input type="submit" Value="Guardar" class="boton" id ="grabar" name="grabar"></td>
                 </tr>
            </table>
        </form>

       <?
    }else{
         ?>
        <center><h4><u>Ingreso de Relación</u></h4></center>
        <form action="GrabarInicioTipo.php" method="post" id="f1" name="f1">
            <table border="0" align="center"
                 <tr><td><br></td></tr>
	         <tr>
	         <td><b>Tipo_Proceso:</b></td>
	         <td colspan="1"><select name="TipoProceso" class="cajasletra">
	             <option value="0">Seleccione
	             <?
	             $consulta_z="select concepto,idproceso from tipoprocesomemo where estado='ACTIVO'  order by concepto";
	             $resultado_z=mysql_query($consulta_z) or die("Error al buscar el proceso");
	             while ($filas_z=mysql_fetch_array($resultado_z))
	                   {
	                   ?>
	                   <option value="<?echo $filas_z["idproceso"];?>"><?echo $filas_z["concepto"];?>
	                   <?
	                   }
	                   ?>
	                   </select></td>
	           </tr>
                 <tr>
                     <td><b>Concepto:</b></td>
                      <td colspan="5"><p align="justify"><textarea name="Concepto" cols="89" rows="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Concepto"></textarea></td>
                    </tr>
                 </tr>
                  <tr>
                     <td><b>Crear_Proceso:</b></td>
                      <td><input type="radio"  checked name="EstadoT" value="NO"  id="EstadoT">NO<input type="radio"  name="EstadoT" value="SI" id="EstadoT">SI</td>
                    </tr>
                 <tr><td><br></td></tr>
                 <tr>
                    <td colspan="6">
                    <input type="submit" Value="Guardar" class="boton" id ="grabar" name="grabar"></td>
                 </tr>
            </table>
        </form>
       <?
    }
}
?>
</body>
</html>
