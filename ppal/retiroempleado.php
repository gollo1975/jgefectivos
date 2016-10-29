<html>

<head>
  <title>Retiro de Asociados</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($desde)):
     include("../conexion.php");
  ?>
  <center><h4><u>Retiro de Empleados</u></h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr><td><br></td></tr>
  <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="12" class="cajas" maxlength="10" id="desde"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="12" class="cajas" maxlength="10" id="hasta"></td>
  </tr>
    <tr><td><br></td></tr>
   <tr>
    <td colspan="10">
      <input type="submit" value="Exportar" class="boton">
    </td>
  </tr>
</table>
</form>
<?
elseif (empty($desde)):
?>
  <script language="javascript">
    alert ("Digite la fecha de inicio. ?")
    history.back()
  </script>
    <?
     else:
       include("../conexion.php");
         $consulta="select zona.zona from zona where
                 zona.codzona='$codzona'";
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta 1");
         $registro=mysql_num_rows($resultado);
         if ($registro==0):
    ?>
          <script language="javascript">
            alert ("La zona No existe en la bd. ?")
            history.back()
          </script>
   <?
        else:
          $consu="select retiroprovision.*,costo.centro,empleado.codcosto from zona,retiroprovision,empleado,costo where
           zona.codzona =retiroprovision.codzona and
		   empleado.cedemple=retiroprovision.cedemple and
    	   empleado.codcosto=costo.codcosto and
           retiroprovision.fechare between '$desde' and '$hasta' and
           zona.codzona='$codzona'order by costo.centro";
          $resulta=mysql_query($consu)or die ("Consulta incorrecta 2" );
          $registro=mysql_num_rows($resulta);
          $registro=mysql_affected_rows();
          if ($registro!=0):
                     header("Content-type: application/vnd.ms-excel");
                     header("Content-Disposition: attachment; filename=Retiro Asociados.xls");
                     header("Pragma: no-cache");
                     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                     header("Expires: 0");
                     ?>
                        <table border="0" align="center" >
                         <tr class="cajas">
                            <td style='font-weight:bold;font-size:1.0em;'>Nro</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Documento</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Empleado</td>
                            <td style='font-weight:bold;font-size:1.0em;'>F_Retiro</td>
                            <td style='font-weight:bold;font-size:1.0em;'>Dias</td>
							<td style='font-weight:bold;font-size:1.0em;'>Cod_Costo</td>
                            <td style='font-weight:bold;font-size:1.0em;'>C_Costo</td>
                         </tr>
                            <?
                            $l=1;
                     while($filas_s=mysql_fetch_array($resulta)):
                        ?>
	                 <tr  class="cajas">
                             <td><?echo $l;?></td>
	                     <td><?echo $filas_s["cedemple"];?></td>
	                     <td><?echo $filas_s["nombres"];?></td>
	                     <td><?echo $filas_s["fechare"];?></td>
	                     <td><?echo $filas_s["dias"];?></td>
							 <td><?echo $filas_s["codcosto"];?></td>
                              <td><?echo $filas_s["centro"];?></td>
	                 </tr>

	                <?
	                $l=$l+1;
	             endwhile;
            ?>
            </table>
            <?
          else:
            ?>
              <script language="javascript">
                alert("No Existen empleados retirados en este Rango de Fechas")
                history.back()
             </script>
            <?

         endif;
    endif;
  endif;
  ?>
</table>

</body>
</html>
