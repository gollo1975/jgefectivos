<html>
<body>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 <?
include("../conexion.php");
$conE="select parametroexamenzona.* from parametroexamenzona
where parametroexamenzona.codzona='$IdZona'";
$resuE=mysql_query($conE)or die ("Error al buscar examen");
$regE=mysql_num_rows($resuE);
$filas_E=mysql_fetch_array($resuE);
$CodZona=$filas_E["codzona"];
if($regE!=0):
   ?>
    <table border="0" align="center">
       <tr class="cajas">
          <td><b>Codigo_Zona:</b>&nbsp;<?echo $filas_E["codzona"];?></td>
       </tr>
       <tr class="cajas">
          <td><b>Zona:</b>&nbsp;<?echo $filas_E["zona"];?></td>
       </tr>
       </table>
   <?
  $con1="select detalladoparametroexamenzona.* from parametroexamenzona,detalladoparametroexamenzona
   where detalladoparametroexamenzona.codzona=parametroexamenzona.codzona and
         parametroexamenzona.codzona='$CodZona' order by detalladoparametroexamenzona.idexamen";
   $resu1=mysql_query($con1)or die ("Error al buscar examen");
   $reg1=mysql_num_rows($resu1);
   ?>
   <form action="".php" method="post" id="eliminar">
   <input type="hidden" name="Nro" value="<? echo $Nro;?>">
   <input type="hidden" name="CostoE" value="<? echo $CostoE;?>">
     <table border="0" align="center">
          <tr class="cajas">
          <th><br></th><th><b><u>Id</u></b></th><th><b><u>Id_Examen.</u></b></th><th><b>&nbsp;<u>Descripción</u></b></th><th><b>&nbsp;<u>Estado</u></b></th>
          </tr>

          <?
          while ($filas_s = mysql_fetch_array($resu1)):
                ?>
                <tr class="cajas">
                    <td>&nbsp;&nbsp;<a href="EditarDetalleConfiguracion.php?Codigo=<?echo $filas_s["codigo"];?>&IdZona=<?echo $CodZona;?>"><img src="../image/mod.jpg" border="0" alt="Permite Modificar el Registro"></a></td><td>&nbsp;&nbsp;<?echo $filas_s["codigo"];?></td>
                     <td><div align="center"><?echo $filas_s["idexamen"];?></div></td>
                     <td><div align="left"><?echo $filas_s["concepto"];?></div></td>
                     <td><div align="left"><?echo $filas_s["estado"];?></div></td>
               </tr>
         <?
          endwhile;
	 ?>
              </table>
   </form>
<?
else:
?>
  <script language="javascript">
     alert("Este documento no tiene detallado de examenes creados ?")
     history.back()
  </script>
<?
endif;
$Sql="select examenglobal.* from examenglobal
      where examenglobal.tipo='SI' order by examenglobal.descripcion";
$Rs=mysql_query($Sql)or die ("Error al buscar examenes");
$Cont=mysql_num_rows($Rs);
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
             $ValidarCodigo = 0;
             while ($registro = mysql_fetch_array($Rs))
                  {
                  $ValidarCodigo = $registro["conse"];
                  $SqlValidar="select detalladoparametroexamenzona.*idexamen from detalladoparametroexamenzona
                        where detalladoparametroexamenzona.idexamen='$ValidarCodigo' and detalladoparametroexamenzona.codzona='$IdZona'";
                   $RsValidar=mysql_query($SqlValidar)or die ("Error al buscar duplicidad");
                   $Cont=mysql_num_rows($RsValidar);
                   if($Cont == 0 ){
                      ?>
	               <tr class="cajas">
	               <td>&nbsp;&nbsp;<a href="AdicionarConfiguracion.php?Codigo=<?echo $registro["conse"];?>&IdZona=<?echo $IdZona;?>"><img src="../image/mod.jpg" border="0" alt="Permite agregar Registro"></a></td><td><div align="center"><?echo $registro["conse"];?></div></td>
	              <td>&nbsp;&nbsp;<?echo $registro["descripcion"];?></td>
	              <td><div align="center"><?echo $registro["valor"];?></div></td>
	              </tr>
	              <?
                  }
              }
              ?>

</table>
</form>
<td><a href="ListadoConfiguracionZona.php"><b><u><h5><div align="center"><font color="red">Regresar</font></div></h5></u></b></td>
</body>
</html>
