<html>

<head>
  <title>Pago de Nomina</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
    function ActualizarSaldo()
         {
         var totalitem = document.getElementById("tActualizaciones").value
         var pagado = 0;
         var Proceso = 0;
         var Auxi = 0;
         for (i=1;i<=totalitem;i++)
             {
              if (document.getElementById("datos[" + i + "]").checked == true ){
                  Proceso= parseFloat(document.getElementById("TotalN[" + i + "]").value);
                  pagado = parseFloat(pagado + Proceso);
                  document.getElementById("VlrPagar").value =  parseFloat(pagado);
              }
            }
         }

</script>
</head>
<body>
<?
  if (!isset($Empresa)):
     include("../conexion.php");
  ?>
  <center><h4><u>Pagar Nomina</u></h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
  <tr>
    <td><b>Desde:</b></td>
    <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" class="cajas" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" class="cajas" size="10" maxlegth="10"></td>
  </tr>
  <tr>
         <td><b>Empresa:</b></td>
                              <td colspan="12"><select name="Empresa" class="cajas">
                              <option value="0">Seleccione la empresa
                                <?
                                 $consulta_z="select codmaestro,nomaestro from maestro ";
                                 $resultado_z=mysql_query($consulta_z)or die ("Error al buscar empresa");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codmaestro"];?>"> <?echo $filas_z["nomaestro"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
	<tr>
      <td><b>Tipo_Pago:</b></td>
      <td><input type="radio" value="Zona" name="Pago">Zona</td><td><input type="radio" value="Sucursal" name="Pago">Sucursal</td><td><input type="radio" value="General" name ="Pago">General</td>
    </tr>	
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
</table>
</form>
<?
elseif (empty($Empresa)):
?>
  <script language="javascript">
    alert ("Seleccione la empresa de la lista!")
    history.back()
  </script>
    <?

elseif (empty($Pago)):
?>
  <script language="javascript">
    alert ("Seleccione el tipo de pago a exportar!")
    history.back()
  </script>
    <?
else:
    include("../conexion.php");
    if($Pago=='Zona'):?>
        <center><h4><u>Pagar Nomina</u></h4></center>
        <form action="DetalladoZona.php" method="post" width="200">
        <input type="hidden" value="<?echo $desde;?>" name="desde">
	    <input type="hidden" value="<?echo $hasta;?>" name="hasta">
        <input type="hidden" value="<?echo $Empresa;?>" name="Empresa">
        <input type="hidden" value="<?echo $Pago;?>" name="Pago">
        <table border="0" align="center">
        <tr><td><br></td></tr>
        <tr>
         <td><b>Zona:</b></td>
         <td colspan="12"><select name="DatoZona" class="cajas">
                <option value="0">Seleccione la Zona
                <?
                $consulta_z="select zona.codzona,zona.zona from zona,periodo
                where zona.codzona=periodo.codzona and
                      periodo.desde='$desde' and
                      periodo.hasta='$hasta' and
                      periodo.pagado='' order by zona.zona";
                $resultado_z=mysql_query($consulta_z)or die ("Error al buscar empresa");
                while($filas_z=mysql_fetch_array($resultado_z)):
                   ?>
                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                   <?
               endwhile;
                   ?>
            </select></td>
          </tr>
          <tr>
		             <td><b>Banco:</b></td>
		                 <td colspan="12"><select name="Banco" class="cajas">
		                  <option value="0">Seleccione el banco
		                  <?
		                   $consulta_z="select codbanco,bancos from banco where banco.nomina='SI' order by bancos";
		                   $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
		                   while($filas_z=mysql_fetch_array($resultado_z)):
		                       ?>
		                       <option value="<?echo $filas_z["codbanco"];?>"> <?echo $filas_z["bancos"];?>
		                      <?
		                   endwhile;
		                      ?>
		                 </select></td>
	   </tr>
	    <tr>
                   <td><b>Cerrar_Pago:</b></td>
                       <td><input type="radio" value="NO" checked name="CerrarPago">NO&nbsp;<input type="radio" value="SI" name="CerrarPago">SI</td>
		</tr>  
          <tr><td><br></td></tr>
          <tr>
	    <td colspan="2">
	      <input type="submit" value="Buscar" class="boton">
	    </td>
	  </tr>
        </table>
        <div align="center"><h5><a href="exportarnomina.php"><font color="red"><u>Volver</u></font></a></h5></div>
      </form>
    <?else:
        if($Pago=='Sucursal'):?>
	        <center><h4><u>Pagar Nomina</u></h4></center>
	        <form action="DetalladoSucursal.php" method="post" width="200">
	        <input type="hidden" value="<?echo $desde;?>" name="desde">
		    <input type="hidden" value="<?echo $hasta;?>" name="hasta">
	        <table border="0" align="center">
	        <tr><td><br></td></tr>
	        <tr>
	         <td><b>Sucursal:</b></td>
	         <td colspan="12"><select name="DatoSucursal" class="cajas">
	                <option value="0">Seleccione la Sucursal
	                <?
	                $consulta_z="select sucursal.codsucursal,sucursal.sucursal from sucursal order by sucursal.sucursal";
	                $resultado_z=mysql_query($consulta_z)or die ("Error al buscar empresa");
	                while($filas_z=mysql_fetch_array($resultado_z)):
	                   ?>
	                   <option value="<?echo $filas_z["codsucursal"];?>"> <?echo $filas_z["sucursal"];?>
	                   <?
	               endwhile;
	                   ?>
	            </select></td>
	          </tr>
	          <tr>
			             <td><b>Banco:</b></td>
			                 <td colspan="12"><select name="Banco" class="cajas">
			                  <option value="0">Seleccione el banco
			                  <?
			                   $consulta_z="select codbanco,bancos from banco where banco.nomina='SI' and banco.estado='ACTIVO' order by bancos";
			                   $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
			                   while($filas_z=mysql_fetch_array($resultado_z)):
			                       ?>
			                       <option value="<?echo $filas_z["codbanco"];?>"> <?echo $filas_z["bancos"];?>
			                      <?
			                   endwhile;
			                      ?>
			                 </select></td>
		   </tr>
		    <tr>
                       <td><b>Cerrar_Pago:</b></td>
                       <td><input type="radio" value="NO" checked name="CerrarPago">NO&nbsp;<input type="radio" value="SI" name="CerrarPago">SI</td>
			   	  </tr>  
	          <tr><td><br></td></tr>
	          <tr>
		    <td colspan="2">
		      <input type="submit" value="Buscar" class="boton">
		    </td>
		  </tr>
	        </table>
	        <div align="center"><h5><a href="exportarnomina.php"><font color="red"><u>Volver</u></font></a></h5></div>
	      </form><?
        else:
	         $consu="select zona.codzona,zona.zona,periodo.codigo from maestro,sucursal,periodo,zona where
	         maestro.codmaestro=sucursal.codmaestro and
	         sucursal.codsucursal=zona.codsucursal and
	         zona.codzona=periodo.codzona and
	         periodo.desde='$desde' and periodo.hasta='$hasta' and
	         periodo.pagado='' and
	         maestro.codmaestro='$Empresa'order by zona.zona";
		 $resulta=mysql_query($consu)or die ("Error de busqueda de nomina");
		 $registro=mysql_affected_rows();
		 if ($registro!=0):?>
		    <center><h4><u>Pagar Nomina</u></h4></center>
		    <form action="DatosExportados.php" method="post" name="empresa" id="empresa">
		    <input type="hidden" value="<?echo $desde;?>" name="desde">
		    <input type="hidden" value="<?echo $hasta;?>" name="hasta">
		       <table border="0" align="center" width="565">
		          <tr>
		             <td><b>Banco:</b></td>
		                 <td colspan="12"><select name="Banco" class="cajas">
		                  <option value="0">Seleccione el banco
		                  <?
		                   $consulta_z="select codbanco,bancos from banco where banco.nomina='SI' order by bancos";
		                   $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
		                   while($filas_z=mysql_fetch_array($resultado_z)):
		                       ?>
		                       <option value="<?echo $filas_z["codbanco"];?>"> <?echo $filas_z["bancos"];?>
		                      <?
		                   endwhile;
		                      ?>
		                 </select></td>
		          </tr>
                  <tr>
			           <td><b>Vlr_Seleccionado:</b></td>
                       <td><input type="text" name="VlrPagar" value="0" class="cajas" size="15" id="VlrPagar" style="text-align:right;background-color:#FFDDBB"></td>
		          </tr>
				   <tr>
                       <td><b>Cerrar_Pago:</b></td>
                       <td><input type="radio" value="NO" checked name="CerrarPago">NO&nbsp;<input type="radio" value="SI" name="CerrarPago">SI</td>
			   	  </tr>   
		        </table>
		        <tr><td><br></td></tr>
		       <table border="0" align="center" width="565">
		          <tr class="cajas">
			   <th><b>Item</b></td><th></th><th>Cod_Zona</th><th><b>Zona</b></th><th>Vlr_Nómina</th>
		          </tr>
			  <?
			  $i=1;
                          $Contavalor=0;
			  echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");
			  while ($filas_Z = mysql_fetch_array($resulta)):
                                $CodigoVal=$filas_Z["codigo"];
                                $ConP="select nomina.codigo, sum(nomina.neto) as Valor from nomina
                                     where nomina.codigo='$CodigoVal' group by nomina.codigo";
                                $ResP=mysql_query($ConP)or die ("erro al buscar nomina");
                                $filas = mysql_fetch_array($ResP);
                                $Valores=number_format($filas["Valor"],0)
			           ?>
			           <tr class="cajas">
		                   <th><?echo $i;?></th>
			              <?
                                      echo ("<td><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_Z['codzona'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>
			              <td class="cajas"><input type="text" value="<?echo $filas_Z["codzona"];?>"  size="9" readonly class="cajas"></td>
			              <td class="cajas"><input type="text" value="<?echo $filas_Z["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="67" readonly class="cajas"></td>
                                      <input type="hidden" value="<?echo $filas["Valor"];?>" name="TotalN[<? echo $i;?>]" id="TotalN[<? echo $i;?>]" size="11" readonly class="cajas"></font>
                                       <td class="cajas"><input type="text" value="<?echo $Valores;?>" name="Total[<? echo $i;?>]" id="Total[<? echo $i;?>]" size="11" readonly style="text-align:right;background-color:orange" class="cajas"></font></td>
			            <tr>
			           <?
			           $i=$i+1;
                                   $Contavalor = $Contavalor + $filas["Valor"];
			  endwhile;
                          $Contavalor=number_format($Contavalor,0);
		          ?>
		          <tr><td colspan="10"><div align="right"><b>Total_Nómina:&nbsp;<?echo $Contavalor;?></b></div></td></tr>
		       <td colspan="5">
		          <input type="submit" value="Buscar Zonas" class="boton"></td>
		       </table><?
		    else:
		       ?>
		       <script language="javascript">
		            alert("No hay empresas activas pendiente por pago de nomina!")
		            history.back()
		       </script>
		       <?
		    endif;
        endif;
    endif;
 endif;
  ?>
</table>

</body>
</html>
