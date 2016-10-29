<html>
        <head>
                <title>Agregar Memorando</title>
               <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">

        </head>
        <body>
<input type="hidden" name="FechaP" value="<?echo $FechaP;?>">
<?
include("../conexion.php");
$fechaActual=date("Y-m-d");
$DiaP = substr($FechaP, 8, 2)+15;
$DiaA = substr($fechaActual, 8, 2);
$MesP = substr($FechaP, 5, 2);
$MesA = substr($fechaActual, 5, 2);
if (strcmp(trim($MesP) , trim($MesA)) <= 0){
	if($DiaP < $DiaA){
         $Estado="update memorando set estado='INACTIVO' where radicado='$nroradicado'";
         $res=mysql_query($Estado) or die("Error al actualizar");
	 }	 
}
include("../conexion.php");
$conB="select memorando.* from memorando
where memorando.estado='ACTIVO' and
      memorando.radicado='$nroradicado'";
$resulB=mysql_query($conB) or die("Error al busca procesos");
$filas=mysql_fetch_array($resulB);
$regB=mysql_num_rows($resulB);
if($regB==0):
?>
<script language="javascript">
  alert("Este Radicado no se puede modificar, favor solicitar autorización en Gerencia!")
  history.back()
</script>
<?
else:
?>
<div align="center"><h4><u>Editar Registro</u></h4></div>
<form action="GrabarEditar.php" method="post">
 <input type="hidden" name="admon" value="<?echo $admon;?>">
  <input type="hidden" name="nroradicado" value="<?echo $nroradicado;?>">
  <table border="0" align="center">
      <tr><td><br></td></tr>
      <tr>
        <td><b>Fecha_Proceso:</b></td>
        <td><input type="text" name="fecha" value="<?echo $filas["fecha"];?>" size="15" maxlength="10" class="cajas"></td>
      </tr>
       <tr>
        <td><b>Señor:</b></td>
        <td><input type="text" name="senor" value="<?echo $filas["senor"];?>" size="15" readonly class="cajas"></td>
       </tr>
       <tr>
          <td><b>Documento:</b></td>
          <td><input type="text"  name="cedula" value="<?echo $filas["cedemple"];?>" size="15" readonly class="cajas"></td>
       </tr>
       <tr>
         <td><b>Empleado:</b></td>
         <td><input type="text"  value="<?echo $empleado;?>" size="40"  readonly class="cajas"></td>
       </tr>
        <tr>
            <td><b>Municipio:</b></td>
            <td>    <select name="municipio"class="cajas">
                 <?
                 $aux=$filas["codmuni"];
                 $consulta_c="select codmuni,municipio from municipio order by municipio";
                 $resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
                 while ($filas_c=mysql_fetch_array($resultado_c)):
                       if($aux==$filas_c["codmuni"]):
                          ?>
                           <option value="<?echo $filas_c["codmuni"];?>" selected><?echo $filas_c["municipio"];?>
                          <?
                       else:
                          ?>
                          <option value="<?echo $filas_c["codmuni"];?>"><?echo $filas_c["municipio"];?>
                          <?
                      endif;
                  endwhile;
                          ?>
                </select></td>
        </tr>
       <tr>
          <td><b>Dirigida:</b></td>
          <td><input type="text" name="dirigida" value="<?echo $filas["dirigida"];?>" size="40" class="cajas" readonly></td>
       </tr>
       <tr>
       <td><b>Remitente:</b></td>
       <td><input type="text" name="remitente" value="<?echo $filas["remitente"];?>" size="25"  readonly class="cajas"></td>
       </tr>
       <tr>
            <td><b>Tipo_Proceso:</b></td>
            <td>    <select name="CodProceso"class="cajas" id="CodProceso">
                 <?
                 $auxP=$filas["idproceso"];
                 $consulta="select tipoprocesomemo.* from tipoprocesomemo order by concepto ASC";
                 $resultado=mysql_query($consulta) or die("Error al validar los conceptos");
                 while ($fila=mysql_fetch_array($resultado)):
                       if($auxP==$fila["idproceso"]):
                          ?>
                           <option value="<?echo $fila["idproceso"];?>" selected><?echo $fila["concepto"];?>
                          <?
                       else:
                          ?>
                          <option value="<?echo $fila["idproceso"];?>"><?echo $fila["concepto"];?>
                          <?
                      endif;
                  endwhile;
                          ?>
                </select></td>
        </tr>
       <td><b>Informe:</b></td>
       <td colspan="5"><p align="justify"><textarea name="nota" cols="89" rows="12" class="cajas" ><?echo $filas["nota"];?></textarea></td>
       </tr>
       <tr>
       <td><b>Firma:</b></td>
       <td><input type="text" name="firma" value="<?echo $filas["firma"];?>" size="40" maxlength="40"class="cajas"></td>
       <td><b>Cargo:</b></td>
       <td><input type="text" name="cargo" value="<?echo $filas["cargo"];?>" size="40" maxlength="40" class="cajas"></td>
       </tr>
       <tr>
       <td><b>Empresa:</b></td>
       <td><input type="text" name="empresa" value="<?echo $filas["empresa"];?>" size="40" readonly class="cajas"></td>
       <td><b>Estado:</b></td>
            <td><select name="estado" class="cajas">
                <option value="<?echo $filas["estado"];?>" selected><?echo $filas["estado"];?>
              <option value="ACTIVO">ACTIVO
            <option value="INACTIVO">INACTIVO
            <option value="ANULADO">ANULADO
            </select></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
       <td colspan="6">
	   <input type="submit" Value="Guardar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
       </tr>
 </table>
 </form>
<?
endif;
?>
  </body>
</html>


