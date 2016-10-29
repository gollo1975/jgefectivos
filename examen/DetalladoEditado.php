<html>
<body>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 <?
include("../conexion.php");
$conE="select examen.* from examen
where examen.Nro='$Nro' and examen.estado='ACTIVO'";
$resuE=mysql_query($conE)or die ("Error al buscar examen");
$regE=mysql_num_rows($resuE);
$filas_E=mysql_fetch_array($resuE);
$Nit=$filas_E["nitprove"];
$CostoE=$filas_E["costoe"];
$CodMuni= $filas_E["codmuni"];
if($regE!=0):
   ?>
    <table border="0" align="center">
       <tr class="cajas">
          <td><b>Nro_Examen:</b>&nbsp;<?echo $filas_E["nro"];?></td>
       </tr>
       <tr class="cajas">
          <td><b>Documento:</b>&nbsp;<?echo $filas_E["cedula"];?></td>
       </tr>
       <tr class="cajas">
          <td><b>Empleado:</b>&nbsp;<?echo $filas_E["nombre"];?></td>
       </tr>
        <tr class="cajas">
          <td><b>Tipo_Examen:</b>&nbsp;<?echo $filas_E["tipoe"];?></td>
       </tr>
	   </tr>
        <tr class="cajas">
          <td><b>Cargo:</b>&nbsp;<?echo $filas_E["cargo"];?></td>
       </tr>
    </table>
   <?
  $con1="select detalladoexamen.*,examenglobal.descripcion from examen,detalladoexamen,examenglobal
   where detalladoexamen.nro=examen.nro and
         examenglobal.conse=detalladoexamen.conse and
         examen.Nro='$Nro' order by examenglobal.descripcion";
   $resu1=mysql_query($con1)or die ("Error al buscar examen");
   $reg1=mysql_num_rows($resu1);
   ?>
   <form action="EliminarE.php".php" method="post" id="eliminar">
   <input type="hidden" name="Nro" value="<? echo $Nro;?>">
   <input type="hidden" name="CostoE" value="<? echo $CostoE;?>">
     <table border="0" align="center">
          <tr class="cajas">
          <th><br></th><th><br></th><th><b><u>Reg.</u></b></th><th><b><u>Nro_Exa.</u></b></th><th><b>&nbsp;<u>Descripción</u></b></th><th><b>&nbsp;<u>Vlr_Examen</u></b></th>
          </tr>

          <?
          while ($filas_s = mysql_fetch_array($resu1)):
		       $Suma += $filas_s[vlrexamen]; 
                ?>
                <tr class="cajas">
                    <input type="hidden" name="CodProceso" value="<? echo $filas_s["codigo"];?>">
                    <td>&nbsp;<input type="checkbox" name="DatosE[]" value="<?echo $filas_s["codigo"];?>"></td>
                    <td>&nbsp;&nbsp;<a href="ModificarExamen.php?CodProceso=<?echo $filas_s["codigo"];?>&Nro=<?echo $Nro;?>&CostoE=<?echo $CostoE;?>"><img src="../image/mod.jpg" border="0" alt="Permite Modificar el Registro"></a></td><td>&nbsp;&nbsp;<?echo $filas_s["codigo"];?></td>
                     <td><div align="center"><?echo $filas_s["conse"];?></div></td>
                    <td>&nbsp;&nbsp;<?echo $filas_s["descripcion"];?></td>
                    <td>&nbsp;&nbsp;<?echo $filas_s["vlrexamen"];?></td>
                </tr>
                <?$ConT=$ConT+$filas_s["vlrexamen"];
          endwhile;
		  	
          $ConT=number_format($ConT,0);
          ?>
         <tr><td><br></td></tr>
         <td colspan="5"><div align="right"><b>$<?echo $ConT?>&nbsp;&nbsp;&nbsp;</b></div></td>
          <tr>
          <td align="right" colspan="2"><input type="submit" value="Eliminar" class="boton"></td>
          </tr>
      </table>
   </form>
<?
else:
?>
  <script language="javascript">
     alert("Este documento no tiene detallado de examenes creados y / o se encuentra ANULADO en sistema.!")
     history.back()
  </script>
<?
endif;
$conG="select examenglobal.* from provedor,examenglobal,municipio
  where provedor.nitprove=examenglobal.nitprove and
        examenglobal.codmuni=municipio.codmuni and
		municipio.codmuni='$CodMuni' and
        provedor.nitprove='$Nit' order by examenglobal.descripcion";
$resuG=mysql_query($conG)or die ("Error al buscar gloabal de examen.");
?>
<form action="" method="post">
<div align="center"><h4><b>Listado de Examenes</b></h4></div>
      <table border="0" align="center">
             <tr class="cajas">
               <th><br></th><th><b><u>&nbsp;&nbsp;Código</u></b></th><th>&nbsp;<b><u>Descripción</u></b></th><th>&nbsp;<b><u>Vlr_Examen</u></b></th>
             </tr>
             <tr>
             <td><br></td>
             </tr>
             <?
             while ($registro = mysql_fetch_array($resuG))
               {
               ?>
               <tr class="cajas">
               <td>&nbsp;&nbsp;<a href="CargarExamen.php?Codigo=<?echo $registro["conse"];?>&Nro=<?echo $Nro;?>&CostoE=<?echo $CostoE;?>"><img src="../image/mod.jpg" border="0" alt="Permite agregar Registro"></a></td><td><div align="center"><?echo $registro["conse"];?></div></td>
              <td>&nbsp;&nbsp;<?echo $registro["descripcion"];?></td>
              <td><div align="center"><?echo $registro["valor"];?></div></td>
              </tr>
              <?
              }
              ?>

</table>
</form>
<td><a href="ModificarRegistro.php"><b><u><h5>Regresar</h5></u></b></td>
</body>
</html>
