<html>

<head>
  <title>Consulta del Servicio</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <script language="javascript">
       function ActualizarSaldo()
         {
         totalitem = 0
         pagado = 0
         totalitem =  document.getElementById("tActualizaciones").value
         var nEle = document.f1.elements.length;
               for (i=0; i<nEle; i++) {
                  if (document.f1.elements[i].type=="checkbox" &&
	                document.f1.elements[i].name.lastIndexOf('datoN')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
	          }
                }
      }
</script>
 </head>

<?
  if (!isset($Empresa)):
     include("../conexion.php");
  ?>
  <center><h4><u>Detalle del Servicio</u></h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
   <tr>
    <td><b>Desde:</b></td>
    <td><input type="text" name="Desde" value="<? echo date("Y-m-d");?>" class="cajas" size="12" maxlegth="10">
    <b>Hasta:</b>
    <input type="text" name="Hasta" value="<? echo date("Y-m-d");?>" class="cajas" size="12" maxlegth="10"></td>
  </tr>
  <tr>
         <td><b>Zona:</b></td>
                              <td colspan="20"><select name="Empresa" class="cajas">
                              <option value="0">Seleccione la empresa
                                <?
                                 $consulta_z="select maestro.codmaestro,maestro.nomaestro from maestro";
                                 $resultado_z=mysql_query($consulta_z)or die ("Error al buscar empresas");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codmaestro"];?>"> <?echo $filas_z["nomaestro"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="8">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($Empresa)):
?>
  <script language="javascript">
    alert ("Despliegue la empresa de la vista.!")
    history.back()
  </script>
    <?
else:
    include ("../conexion.php");
    $consu="select cobrozona.*,sso_sucursal.nombre from zona,sucursal,maestro,cobrozona,sso_sucursal
           where maestro.codmaestro=sucursal.codmaestro and
           sucursal.codsucursal=zona.codsucursal and
           zona.codzona=cobrozona.codzona and
		   zona.tiponegociacion='MISIONAL' and
		   sso_sucursal.codigo_sucursal_pk = zona.codigo_sso_sucursal_fk and
           cobrozona.desde='$Desde' and cobrozona.hasta='$Hasta' and
           maestro.codmaestro='$Empresa' order by sso_sucursal.nombre DESC";
    $resulta=mysql_query($consu) or die("consulta incorrecta 1  ");
    $reg=mysql_num_rows($resulta);
    if($reg!=0 ){
       ?>
        <center><h4><u>Detalle del Servicio</u></h4></center>
       <form action="ExportarDetalle.php" name="f1" id="f1" method="post">
       <input type="hidden" value="<?echo $Desde;?>" name="Desde">
       <input type="hidden" value="<?echo $Hasta;?>" name="Hasta">
       <table border="0" align="center" width="710">
          <tr class="cajas">
              <th><b>Item</b></td><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Código</b></th><th><b>Zona</b></th><th>Desde</th><th><b>Hasta</b></th><th><b>Sucursal_Pila</b></th>
          </tr>
	  <?
          $i=1;
            echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");
          while ($filas=mysql_fetch_array($resulta)){
              ?>
	      <tr class="cajas">
	         <th><?echo $i;?></th>
                 <?
	        echo ("<td class=\"cajas\"><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\"  value=\"" . $filas['codigo'] ."\"\"> </td>");?>
	        <td class="cajas"><input type="text" value="<?echo $filas["codigo"];?>" size="9" readonly class="cajas"></td>
			<td class="cajas"><input type="text" value="<?echo $filas["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="60" readonly class="cajas"></td>
                <td class="cajas"><input type="text" value="<?echo $filas["desde"];?>" name="desde[<? echo $i;?>]"id="desde[<? echo $i;?>]" size="12" readonly class="cajas"></td>
                <td class="cajas"><input type="text" value="<?echo $filas["hasta"];?>" name="hasta[<? echo $i;?>]"id="hasta[<? echo $i;?>]" size="12" readonly class="cajas"></td>
				<td class="cajas"><input type="text" value="<?echo $filas["nombre"];?>" name="SucursalSs[<? echo $i;?>]"id="SucursalSs[<? echo $i;?>]" size="20" readonly class="cajas"></td>
	      <tr>
	     <?
	    $i=$i+1;
          }?>
         <tr><td><br></td></tr>
         <td colspan="5">
         <input type="submit" value="Exportar" class="boton" ></td>
         </table>
      </form> <?

    }else{
         ?>
         <script language="javascript">
             alert("No hay registros De Facturacion en este rango de fechas ?")
             history.back()
        </script>
         <?
    }
endif;
       ?>


</body>
</html>
