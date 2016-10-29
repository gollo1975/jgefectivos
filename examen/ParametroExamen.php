<html>
        <head>
                <title>Examenes por Zona</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

        </head>
        <body>
<?
if (!isset($CodZona)):
     include("../conexion.php");
     ?><center><h4><u>Configuracion de Examenes</u></h4></center>
     <form action="" method="post"id="f1">
           <table border="0" align="center">
                  <tr><td><br></td></tr>
                  <tr>
		     <td><b>Zona:</b></td>
		     <td colspan="1"><select name="CodZona" class="cajasletra" id="CodZona">
			 <option value="0">Seleccione la zona
			 <?
			 $consulta_z="select codzona,zona from zona where estado='ACTIVA' and nomina='SI'  order by zona ASC";
			 $resultado_z=mysql_query($consulta_z) or die("Error al buscar proveedor");
			 while ($filas_z=mysql_fetch_array($resultado_z)):
			                   ?>
			                   <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
			                   <?
			 endwhile;
			                    ?>
		     </select></td>
		  </tr>
                  <tr><td>&nbsp;</td></tr>
                  <tr>
                       <td colspan="2"><input type="submit" Value="Guardar" class="boton"></td>
                  </tr>


           </table>
      </form>
    <?
elseif(empty($CodZona)):
    ?>
    <script language="javascript">
        alert("Seleccione la zona de la lista.!")
        history.back()
    </script>
    <?
else:
     include("../conexion.php");
     /*CODIGO PARA ZONAS*/
     $SqlZona="select zona.zona from zona
           where codzona='$CodZona'";
     $RsZona=mysql_query($SqlZona)or die ("Error al buscar zona");
     $FilasZona=mysql_fetch_array($RsZona);
     /*CODIGO PARA EXAMENES*/
     $Sql="select examenglobal.* from examenglobal
           where examenglobal.tipo='SI' order by examenglobal.descripcion";
     $Rs=mysql_query($Sql)or die ("Error al buscar examenes");
     $Cont=mysql_num_rows($Rs);
     ?>
     <center><h4><u>Configuracion de Examenes</u></h4></center>
     <form action="GrabarConfiguracionExamen.php" method="post"id="f2">
     <input type="hidden" name="CodZona" value="<? echo $CodZona;?>">
        <table border="0" align="center">
           <tr>
	            <td><b>Zona</b></td>
	            <td><input type="text" name="Zona" value="<? echo $FilasZona["zona"];?>" class="cajas"size="55" readonly id="Zona"></td>
	   </tr>
            <tr class="cajas">
                <th>Id</th><th><b>&nbsp;<u>Descripción</u></b></th><th><b><u>Valor</u></b></th>
            </tr>
            <tr><td><br></td></tr>
	    <input type="hidden" id="TotalVector" name="TotalVector" value="<?php echo mysql_num_rows($Rs);?>">
             <?
             $i=0;
              while ($filas_s = mysql_fetch_array($Rs)):
                                       $i++;
                                      ?>
                                       <tr class="cajas"><?
                                        echo "<td><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_s['conse'] ."\" " .$filas_s['conse']."</td>";?>
                                        <td><input type="text" value="<?echo $filas_s["descripcion"];?>" name="concepto[<? echo $i;?>]"id="concepto[<? echo $i;?>]" size="56"  readonly class="cajas"> </td>
                                        <td><input type="text" value="<? echo $filas_s["valor"];?>" name="valorE[<?php echo $i;?>]" id="valorE[<?php echo $i;?>]" size="11"  readonly class="cajas"> </td>

                                      </tr>
                                       <?
             endwhile;
         ?>
          <tr><td><br></td></tr>
	  <td colspan="5">
	                <input type="submit" value="Enviar" class="boton" id="enviar">
          </td>
         </table>
         <?

endif;
?>
</body>
</html>
