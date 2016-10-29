<html>

<head>
  <title>Consolidado de Primas</title>
      <LINK  REL="stylesheet" HREF="../formato.css"  type="text/css">

</head>

<?
  if (!isset($Desde)):
     include("../conexion.php");
  ?>
  <center><h4><u>Primas Semestrales</u></h4></center>
<form action="" method="post" width="200">
  <table border="1" align="center">
  <tr><td>
   <table border="0" align="center">
  <tr class="fondo">
       <th colspan="8"><br></th>
  </tr>
  <tr>
    <td><b>F_Inicio:</b></td>
    <td><input type="text" name="Desde" value="<? echo date("Y-m-d");?>" size="13" maxlength="10" id='Desde'></td>
    <td><b>F_Final:</b></td>
    <td><input type="text" name="Hasta" value="<? echo date("Y-m-d");?>" size="13" maxlength="10" id='Hasta'></td>
  </tr>
  <?if($CodZona==''){?>
       <tr>
         <td><b>Zona:</b></td>
                              <td colspan="12"><select name="CodZona" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select codzona,zona from zona where zona.nomina='SI' order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
        </tr>
  <?}?>	
     <tr><td><br></td></tr>
   <tr>
    <td colspan="5">
      <input type="submit" value="Buscar">
      <input type="reset" value="Limpiar">
    </th>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($CodZona)):
   ?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
    <?
else:
    ?>
    <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
    </script>
    <body onLoad="imprimir()" >
    <?
    include ("../conexion.php");
   $consulta="select prima.*,sucursal.sucursal,empleado.cuenta,maestro.dirmaestro,maestro.telmaestro,departamento.departamento,municipio.municipio,maestro.faxmaestro,maestro.web from prima,departamento,municipio,empleado,zona,sucursal,maestro
          where  maestro.codmaestro=sucursal.codmaestro and
		         sucursal.codsucursal=zona.codsucursal and
                 maestro.codmuni=municipio.codmuni and
                 municipio.codepart=departamento.codepart and
				 zona.codzona = prima.codzona and
                 prima.fechai='$Desde' and prima.fechacorte='$Hasta' and
                 empleado.cedemple=prima.cedemple and
                 prima.codzona='$CodZona' order by prima.nombre";
                 $resultado=mysql_query($consulta) or die("Error al buscar primas");
                 $registros=mysql_num_rows($resultado);
                 if($registros!=0):
                        while ($filas=mysql_fetch_array($resultado)):
		            $cedula=number_format($filas["cedemple"],0);
		            $salario=number_format($filas["salario"],0);
		            $total=number_format($filas["total"],0);
		             ?>
		              <table border="1" align="center" width="717" height="420" >
		               <tr>
		               <td>
		               <table border="0" align="center" width="717" >
		               <img src="../image/logounico.png" border="0" heigth="130" width="135">
		                <tr>
		                 <td colspan="10"></td><td colspan="20" align="center"><b><u>PRIMA SEMESTRAL</u></b></td><td colspan="20"><td class="cajas"><b>Nro:</b>&nbsp;<?echo $filas["nroprima"];?></td>
		                </tr>
		                <tr>
		                 <td colspan="60">---------------------------------------------------------------------------------------------------------------------------------</td>
		                 </tr>
		                 <tr class="cajas">
		                  </td><td colspan="15"><b>Documento:</b>&nbsp;<?echo $cedula;?></td>
		                </tr>
		                <tr class="cajas">
		                 </td><td colspan="25"><b>Empleado:</b>&nbsp;<?echo $filas["nombre"];?></td>
		                </tr>
		                <tr class="cajas">
		                <td colspan="15"><b>F_Proceso:</b>&nbsp;<?echo $filas["fechap"];?></td><td colspan="11"><b>F_Inicio:</b>&nbsp;<?echo $filas["fechai"];?></td><td colspan="15"><b>F_Corte:</b>&nbsp;<?echo $filas["fechacorte"];?></td>
		                </tr>
		                <tr class="cajas">
		                <td colspan="15"><b>F_Inicio_Cont:</b>&nbsp;<?echo $filas["fechainicio"];?></td><td colspan="11"><b>Dias:</b>&nbsp;<?echo $filas["dias"];?></td><td colspan="10"><b>Ibc:</b>&nbsp;$<?echo $salario;?></td><td colspan="15"><b>Vlr_Pagado:</b>&nbsp;$<?echo $total;?></td>
		                </tr>
		                <tr class="cajas">
		                 <td colspan="15"><b>Cuenta:</b>&nbsp;<?echo $filas["cuenta"];?></td><td colspan="20"><b>Sucursal:</b>&nbsp;<?echo $filas["sucursal"];?></td>
		                </tr>
		                  <tr>
		                   <td>&nbsp;</td>
		                  </tr>
		                                     <tr class="cajas">
		                    <td colspan="40"><b>Nota:</b>&nbsp;<?echo $filas["nota"];?></td>
		                    </tr>
		                  <tr>
		                   <tr>
		                   <td>&nbsp;</td>
		                  </tr>
		                  <tr>
		                   <td>&nbsp;</td>
		                  </tr>
		                  <tr class="cajas">
		                    <td colspan="30"><b>Firma:</b>&nbsp;-----------------------------------------------</td>
		                    </tr>
                                     <tr>
		                   <td>&nbsp;</td>
		                  </tr>
		                  <tr>
		                   <td>&nbsp;</td>
		                  </tr>
		                  <tr class="cajas" align="center">
		                     <td colspan="60"><b><?echo $filas["municipio"];?></b>&nbsp;&nbsp;<?echo $filas["dirmaestro"];?>&nbsp;&nbsp; <b>PBX:</b>&nbsp;<?echo $filas["telmaestro"];?>&nbsp;<b>Fax:</b>&nbsp;<?echo $filas["faxmaestro"];?>&nbsp;<b>Web:</b>&nbsp;<?echo $filas["web"];?></td>
		                </tr>
		                 </table>
		                 </td></tr>
		               </table>
					   <br>
		             <?
		           endwhile;
		      endif;
  endif;
		            ?>

                   </body>
</html>
