<html>

<head>
<title>Programacion deducciones</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 <script type="text/javascript">
     function ActualizarSaldo()
      {
         var totalitem = 0;
         var totalP = 0;
         var pagado = 0;
         totalitem =  document.getElementById("tActualizaciones").value;
         var nEle = document.f1.elements.length;
         for (i=0; i<nEle; i++) {
            if (document.f1.elements[i].type=="checkbox" &&
	                document.f1.elements[i].name.lastIndexOf('datoN')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
	    }
         }
         for (i=1;i<=totalitem;i++)
             {
                pagado += parseFloat(document.getElementById("Vlr_Pagado[" + i+ "]").value);
                document.getElementById("TotalPagar").value = pagado;
                    // f1.TotalPagar.value = TotalP;
            }
     }
     function Actualizar(){
         var pagado = 0;
         var totalitem = 0
         totalitem =  document.getElementById("tActualizaciones").value;
         for (k=1;k<=totalitem;k++)
             {
                if (document.getElementById("datoN[" + k + "]").checked == true ){
                      pagado += parseFloat(document.getElementById("Vlr_Pagado[" + k+ "]").value);
                      document.getElementById("TotalPagar").value = pagado;
                    // f1.TotalPagar.value = TotalP;
                }
            }
     }

</script>
</head>
<body>
<?
if (!isset($desde)):
include("../conexion.php");
$Buscar="select salario.desala from salario where
              salario.codsala='$CodSala'";
$ResB=mysql_query($Buscar)or die("consulta incorrecta uno");
$fila_B=mysql_fetch_array($ResB);

$Dato="select programardeduccion.ultimafecha from programardeduccion where
       programardeduccion.codsala='$CodSala' group by id_p DESC limit 1 ";
$res=mysql_query($Dato)or die("consulta incorrecta uno");
$reg=mysql_num_rows($res);
$filas=mysql_fetch_array($res);
$UltimaF=$filas["ultimafecha"];

?>
<center><h4><u>Deducciones</u></h4></center>
  <form  action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2" class="fondo"></td>
      </tr>
      <tr>
             <td><b>Tipo_Deducción:</b></td>
             <td><input type="text" name="Nombre" value="<?echo $fila_B["desala"];?>"  class="cajas" size="40" maxlength="38" readonly id="Nombre"></td>
           </tr>
       <?if($reg != 0){?>
           <tr>
             <td><b>Fecha_Inicio:</b></td>
             <td><input type="text" name="desde" value="<?echo $UltimaF;?>"  class="cajas" size="13" maxlength="10"></td>
           </tr>
       <?}else{?>
             <tr>
             <td><b>Fecha_Inicio:</b></td>
             <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>"  class="cajas" size="13" maxlength="10"></td>
           </tr>
       <?}?>
       <tr>
        <td><b>Fecha Final:</b></td>
         <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="13"  class="cajas" maxlength="10"></td>
       </tr>
       <tr>
         <td><b>Zona:</b></td>
                              <td><select name="CodZona" class="cajas" id="CodZona">
                              <option value="0">Seleccione lazona
                                <?
                                 $con="select codzona,zona  from zona where zona.estado='ACTIVA' order by zona.zona";
                                 $res=mysql_query($con)or die ("error al buscar zona");
                                while($fila=mysql_fetch_array($res)):
                                   ?>
                                   <option value="<?echo $fila["codzona"];?>"> <?echo $fila["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
       </tr>
       <tr>
         <td><b>Empresa:</b></td>
                              <td><select name="Nit" class="cajas" id="Nit">
                              <option value="0">Seleccione
                                <?
                                 $consulta_z="select codmaestro,nomaestro  from maestro ";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codmaestro"];?>"> <?echo $filas_z["nomaestro"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
       </tr>
        <tr>
       <td><b>Factura:</b></td>
       <td colspan="5"><select name="Conse" class="cajas" id="Conse">
       <option value="0">Seleccione la factura
       <?
       $consulta="select pagar.nrofactura,provedor.nomprove,pagar.saldo,pagar.conse from pagar,provedor where
                provedor.nitprove=pagar.nitprove and
                pagar.saldo > 0  order by pagar.fechaven ASC";
       $resultado=mysql_query($consulta) or die("error al buscar facturas de compras");
       while ($fila=mysql_fetch_array($resultado)):
             ?>
             <option value="<?echo $fila["conse"];?>"><?echo $fila["nomprove"];?>-<?echo $fila["nrofactura"];?>-<b>-Saldo:</b><?echo $fila["saldo"];?>
             <?
       endwhile;
       ?>
      </select></td>
      </tr>
      <tr>
      <td><b>Tipo_Deducción:</b></td>
       <td colspan="5"><input type="radio" value="Nomina" checked name="EstadoDeduccion"><b><font color="blue">Nomina</font></b><input type="radio" value="Prestacion" name="EstadoDeduccion"><b><font color="red">Prestaciones</font></b><input type="radio" value="Vacacion" name="EstadoDeduccion"><b><font color="black">Vacaciones</font></b></td>
      </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar"class="boton"> </td>
       </tr>
    </table>
    <br>
    </form>
  <?
elseif (empty($desde)):
   ?>
   <script language="javascript">
     alert("Debe colocar la fecha inicio")
     history.back()
   </script>
    <?
elseif(empty($CodSala)):
   ?>
   <script language="javascript">
     alert("Seleccion un concepto de nomina")
     history.back()
   </script>
   <?

elseif ($Nit==0 and $CodZona==0):
   ?>
   <script language="javascript">
     alert("Debe de seleccionar al menos un items..!")
     history.back()
   </script>
   <?
else:
     include("../conexion.php");
        /*perimirt buscar la empresa*/
        if($Nit!= 0){
           $variable="select maestro.nomaestro,maestro.codmuni from maestro where
                maestro.codmaestro='$Nit'";
           $resultado=mysql_query($variable)or die("Error al buscar empresa");
           $registro=mysql_num_rows($resultado);
           $filas=mysql_fetch_array($resultado);
           $CodMuni = $filas["codmuni"];
        }else{
          $variable="select maestro.nomaestro,maestro.codmuni,maestro.codmaestro from maestro,sucursal,zona where
                maestro.codmaestro=sucursal.codmaestro and
                sucursal.codsucursal=zona.codsucursal and
                zona.codzona='$CodZona'";
           $resultado=mysql_query($variable)or die("Error al buscar zona");
           $registro=mysql_num_rows($resultado);
           $filas=mysql_fetch_array($resultado);
           $Nit = $filas["codmaestro"];
           $CodMuni = $filas["codmuni"];
           } ?>
            <div align="center"><b><u><h4>Programacion Deducciones</h4></u></b></div>
            <table border="0" align="center">
                <tr class="cajas">
                   <td colspan="10"><b>Empresa:&nbsp;</b><?echo $filas["nomaestro"];?></td>
                </tr>
                <tr class="cajas">
                    <td colspan="10"><b>Desde:&nbsp;</b><?echo $desde;?>
                    <b>Hasta:&nbsp;</b><?echo $hasta;?></td>
                </tr>
                <tr class="cajas">
                   <td colspan="10"><b>Concepto:&nbsp;</b><?echo $Nombre;?>
                </tr>
                <tr class="cajas">
                   <td colspan="10"><b>Proceso:&nbsp;</b><?echo $EstadoDeduccion;?>
                </tr>
          </table>
          <?
          if($Nit !=0 and $CodZona==0){
                if($EstadoDeduccion=='Nomina'){
	             include("../conexion.php");
	             $ConBusca="select SUM(denomina.deduccion) 'Pagado',zona.zona,zona.codzona,nomina.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple1)as empleado,maestro.codmuni from maestro,sucursal,zona,nomina,denomina,empleado,salario
	             where maestro.codmaestro=sucursal.codmaestro and
	                   sucursal.codsucursal=zona.codsucursal and
	                   zona.codzona=nomina.codzona and
	                   nomina.fechap >= '$desde' and 
			   nomina.fechap <= '$hasta' and
	                   nomina.consecutivo=denomina.consecutivo and
	                   nomina.cedemple=empleado.cedemple and
	                   denomina.codsala=salario.codsala and
	                   salario.codsala='$CodSala' and
	                   maestro.codmaestro='$Nit' group by nomina.cedemple order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 DESC";
	             $ResBusca=mysql_query($ConBusca)or die("erro al validar la consulta de items");
	             $RegBusca=mysql_num_rows($ResBusca);
	             if ($RegBusca==0):
		           ?>
		           <script language="javascript">
		             alert("No existen deducciones para este concepto")
		             history.back()
		          </script>
		         <?
	             else:
		         ?>
                            <form action="GrabarPagoDeduccion.php" name="f1" id="f1" method="post" width="420">
                              <td><input type="hidden" value="<?echo $Nit;?>" name="Nit"  size="11" id="Nit"></td>
                              <td><input type="hidden" value="<?echo $CodMuni;?>" name="CodMuni"  size="11" id="CodMuni"></td>
                              <td><input type="hidden" value="<?echo $Conse;?>" name="Conse"  size="11" id="Conse"></td>
                            <table border="0" align="center">
	                    <tr class="cajas">
				  <th><b>Item</b></td><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Documento</b></th></th><th><b>Empleado</b></th><th><b>Zona</b></th><th><b>Vlr_Pagar</b></th>
				  </tr><?
		              $i=1;
		              $con=0;
	                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($ResBusca) . "\">");  ;
		             while($fila=mysql_fetch_array($ResBusca)):
	                     $Pagado= $fila["Pagado"];
	                     $Pagado = $Pagado * -1;
	                     $Registro="abono.";
		             ?>
				 <tr class="cajas">
			            <th><?echo $i;?></th>
				    <?
		                    echo ("<td><input type=\"checkbox\" id=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $fila['cedemple'] ."\" onClick=\"Actualizar()\"></td>");?>
				    <td><input type="text" value="<?echo $fila["cedemple"];?>"  size="11" readonly class="cajas"></td>
				    <td><input type="text" value="<?echo $fila["empleado"];?>" name="Empleado[<? echo $i;?>]"id="Empleado[<? echo $i;?>]" size="45" readonly class="cajas"></td>
	                            <td><input type="text" value="<?echo $fila["zona"];?>" name="Zona[<? echo $i;?>]"id="Zona[<? echo $i;?>]"size="45"  class="cajas"></td>
				    <td><input type="text" value="<?echo $Pagado;?>" name="Vlr_Pagado[<? echo $i;?>]"id="Vlr_Pagado[<? echo $i;?>]"size="11" style="text-align:right" class="cajas"></td>
	                            <input type="hidden" value="<?echo $fila["codzona"];?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]"size="4"  class="cajas"></td>
	                            <input type="hidden" value="<?echo $desde;?>" name="Desde" id="Desde" size="11"  class="cajas">
	                           <input type="hidden" value="<?echo $hasta;?>" name="Hasta" id="Hasta" size="11"  class="cajas">
	                           <input type="hidden" value="<?echo $Nit;?>" name="Nit" id="Nit" size="11"  class="cajas">
	                          <input type="hidden" value="<?echo $CodSala;?>" name="CodSala" id="CodSala" size="11"  class="cajas">

				 <tr>
		                <?
		                  $i=$i+1;
		                  $TotalPagar=$TotalPagar + $fila["Pagado"];
		              endwhile;
	                      $TotalPagar=$TotalPagar * -1;
		              ?>
	                       <tr><td><br></td></tr>
	                                    <tr>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
				              <th><div align="left">Total_Pagar:</div></th>
	                                       <td colspan="10"><div align="right"><input type="text" value="<?echo $TotalPagar;?>" name="TotalPagar" id="TotalPagar" size="11" style="text-align:right;background-color:#3EC0FF" class="cajas"></div></td>
				            </tr>
				            <tr><td><br></td></tr>
				           <td colspan="5">
				          <input type="submit" value="Enviar" class="boton" id="buscar" name="buscar" id="buscar"></td>
	                  </table>
                      </form>
	                  <?
	             endif;
                }else{
                      if($EstadoDeduccion=='Prestacion'){
	                       include("../conexion.php");
		               $ConBusca="select detalleprestacion.valorpago as Pagado,zona.zona,zona.codzona,prestacion.cedemple,prestacion.nombres as empleado from maestro,sucursal,zona,prestacion,detalleprestacion,salario
			             where maestro.codmaestro=sucursal.codmaestro and
	                                    sucursal.codsucursal=zona.codsucursal and
	                                   zona.codzona=prestacion.codzona and
	                                   prestacion.nropresta=detalleprestacion.nropresta and
	                                   prestacion.fechapro >= '$desde' and 
									   prestacion.fechapro <= '$hasta' and
	                		   detalleprestacion.codsala=salario.codsala and
			                   salario.codsala='$CodSala' and
			                   maestro.codmaestro='$Nit'order by prestacion.nombres ASC";
		             $ResBusca=mysql_query($ConBusca)or die("erro al validar la consulta de items");
		             $RegBusca=mysql_num_rows($ResBusca);
		             if ($RegBusca==0):
			           ?>
			           <script language="javascript">
			             alert("No existen deducciones para este concepto")
			             history.back()
			          </script>
			         <?
		             else:
			         ?>
	                         <form action="GrabarPagoDeduccion.php" name="f1" id="f1" method="post" width="420">
	                              <td><input type="hidden" value="<?echo $Nit;?>" name="Nit"  size="11" id="Nit"></td>
	                              <td><input type="hidden" value="<?echo $CodMuni;?>" name="CodMuni"  size="11" id="CodMuni"></td>
                                      <td><input type="hidden" value="<?echo $Conse;?>" name="Conse"  size="11" id="Conse"></td>
			              <table border="0" align="center">
		                         <tr class="cajas">
					    <th><b>Item</b></td><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Documento</b></th></th><th><b>Empleado</b></th><th><b>Zona</b></th><th><b>Vlr_Pagar</b></th>
					 </tr><?
				              $i=1;
				              $con=0;
			                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($ResBusca) . "\">");  ;
				             while($fila=mysql_fetch_array($ResBusca)):
			                     $Pagado= $fila["Pagado"];
				             ?>
						 <tr class="cajas">
					            <th><?echo $i;?></th>
						    <?
				                    echo ("<td><input type=\"checkbox\" id=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $fila['cedemple'] ."\" onClick=\"Actualizar()\"></td>");?>
						    <td><input type="text" value="<?echo $fila["cedemple"];?>"  size="11" readonly class="cajas"></td>
						    <td><input type="text" value="<?echo $fila["empleado"];?>" name="Empleado[<? echo $i;?>]"id="Empleado[<? echo $i;?>]" size="45" readonly class="cajas"></td>
			                            <td><input type="text" value="<?echo $fila["zona"];?>" name="Zona[<? echo $i;?>]"id="Zona[<? echo $i;?>]"size="45"  class="cajas"></td>
						    <td><input type="text" value="<?echo $Pagado;?>" name="Vlr_Pagado[<? echo $i;?>]"id="Vlr_Pagado[<? echo $i;?>]"size="11"  class="cajas" style="text-align:right" ></td>
			                            <input type="hidden" value="<?echo $fila["codzona"];?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]"size="4"  class="cajas"></td>
			                            <input type="hidden" value="<?echo $desde;?>" name="Desde" id="Desde" size="11"  class="cajas">
			                           <input type="hidden" value="<?echo $hasta;?>" name="Hasta" id="Hasta" size="11"  class="cajas">
			                           <input type="hidden" value="<?echo $Nit;?>" name="Nit" id="Nit" size="11"  class="cajas">
			                          <input type="hidden" value="<?echo $CodSala;?>" name="CodSala" id="CodSala" size="11"  class="cajas">


						 <tr>
				                <?
				                  $i=$i+1;
				                  $TotalPagar=$TotalPagar + $fila["Pagado"];
				              endwhile;
				              ?>
		                            <tr><td><br></td></tr>
		                                    <tr>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
					              <th><div align="left">Total_Pagar:</div></th>
		                                       <td colspan="10"><div align="right"><input type="text" value="<?echo $TotalPagar;?>" name="TotalPagar" id="TotalPagar" size="11" style="text-align:right;background-color:#3EC0FF" class="cajas"></div></td>
					            </tr>
					            <tr><td><br></td></tr>
					           <td colspan="5">
					          <input type="submit" value="Enviar" class="boton" id="buscar2" name="buscar2" id="buscar2"></td>
		                  </table>
	                        </form>
		                  <?
		             endif;
                       }else{
                              include("../conexion.php");
		               $ConBusca="select detallevacacion.valorpago as Pagado,zona.zona,zona.codzona,vacacion.cedemple,vacacion.nombre as empleado from maestro,sucursal,zona,vacacion,detallevacacion,salario
			             where maestro.codmaestro=sucursal.codmaestro and
	                                   sucursal.codsucursal=zona.codsucursal and
	                                   zona.codzona=vacacion.codzona and
	                                   vacacion.codvaca=detallevacacion.codvaca and
	                                   vacacion.fechap between '$desde' and '$hasta' and
	                		   detallevacacion.codsala=salario.codsala and
			                   salario.codsala='$CodSala' and
			                   maestro.codmaestro='$Nit'order by vacacion.nombre ASC";
		             $ResBusca=mysql_query($ConBusca)or die("erro al validar la consulta de items");
		             $RegBusca=mysql_num_rows($ResBusca);
		             if ($RegBusca==0):
			           ?>
			           <script language="javascript">
			             alert("No existen deducciones para este concepto")
			             history.back()
			          </script>
			         <?
		             else:
			         ?>
	                         <form action="GrabarPagoDeduccion.php" name="f1" id="f1" method="post" width="420">
	                              <td><input type="hidden" value="<?echo $Nit;?>" name="Nit"  size="11" id="Nit"></td>
	                              <td><input type="hidden" value="<?echo $CodMuni;?>" name="CodMuni"  size="11" id="CodMuni"></td>
                                       <td><input type="hidden" value="<?echo $Conse;?>" name="Conse"  size="11" id="Conse"></td>
			              <table border="0" align="center">
		                         <tr class="cajas">
					    <th><b>Item</b></td><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Documento</b></th></th><th><b>Empleado</b></th><th><b>Zona</b></th><th><b>Vlr_Pagar</b></th>
					 </tr><?
				              $i=1;
				              $con=0;
			                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($ResBusca) . "\">");  ;
				             while($fila=mysql_fetch_array($ResBusca)):
			                     $Pagado= $fila["Pagado"];
				             ?>
						 <tr class="cajas">
					            <th><?echo $i;?></th>
						    <?
				                    echo ("<td><input type=\"checkbox\" id=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $fila['cedemple'] ."\" onClick=\"Actualizar()\"></td>");?>
						    <td><input type="text" value="<?echo $fila["cedemple"];?>"  size="11" readonly class="cajas"></td>
						    <td><input type="text" value="<?echo $fila["empleado"];?>" name="Empleado[<? echo $i;?>]"id="Empleado[<? echo $i;?>]" size="45" readonly class="cajas"></td>
			                            <td><input type="text" value="<?echo $fila["zona"];?>" name="Zona[<? echo $i;?>]"id="Zona[<? echo $i;?>]"size="45"  class="cajas"></td>
						    <td><input type="text" value="<?echo $Pagado;?>" name="Vlr_Pagado[<? echo $i;?>]"id="Vlr_Pagado[<? echo $i;?>]"size="11"  class="cajas" style="text-align:right" ></td>
			                            <input type="hidden" value="<?echo $fila["codzona"];?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]"size="4"  class="cajas"></td>
			                            <input type="hidden" value="<?echo $desde;?>" name="Desde" id="Desde" size="11"  class="cajas">
			                           <input type="hidden" value="<?echo $hasta;?>" name="Hasta" id="Hasta" size="11"  class="cajas">
			                           <input type="hidden" value="<?echo $Nit;?>" name="Nit" id="Nit" size="11"  class="cajas">
			                          <input type="hidden" value="<?echo $CodSala;?>" name="CodSala" id="CodSala" size="11"  class="cajas">
						 <tr>
				                <?
				                  $i=$i+1;
				                  $TotalPagar=$TotalPagar + $fila["Pagado"];
				              endwhile;
				              ?>
		                            <tr><td><br></td></tr>
		                                    <tr>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
					              <th><div align="left">Total_Pagar:</div></th>
		                                       <td colspan="10"><div align="right"><input type="text" value="<?echo $TotalPagar;?>" name="TotalPagar" id="TotalPagar" size="11" style="text-align:right;background-color:#3EC0FF" class="cajas"></div></td>
					            </tr>
					            <tr><td><br></td></tr>
					           <td colspan="5">
					          <input type="submit" value="Enviar" class="boton" id="buscar" name="buscar" id="buscar"></td>
		                  </table>
	                        </form>
		                  <?
		             endif;
                       }
                }
           }else{
                if($EstadoDeduccion=='Nomina'){
	                   include("../conexion.php");
		             $ConBusca="select denomina.deduccion as Pagado,zona.zona,zona.codzona,nomina.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple1)as empleado from zona,nomina,denomina,empleado,salario
		             where zona.codzona=nomina.codzona and
		                   nomina.desde between '$desde' and '$hasta' and
		                   nomina.consecutivo=denomina.consecutivo and
		                   nomina.cedemple=empleado.cedemple and
		                   denomina.codsala=salario.codsala and
		                   salario.codsala='$CodSala' and
		                   zona.codzona='$CodZona'order by Empleado ASC";
		           $ResBusca=mysql_query($ConBusca)or die("erro al validar la consulta de items");
		           $RegBusca=mysql_num_rows($ResBusca);
		           if ($RegBusca==0):
			           ?>
			           <script language="javascript">
			             alert("No existen deducciones para este concepto")
			             history.back()
			          </script>
			         <?
		           else:
			         ?>

			           <form action="GrabarPagoDeduccion.php" name="f1" id="f1" method="post" width="420">
                                   <td><input type="hidden" value="<?echo $Nit;?>" name="Nit"  size="11" id="Nit"></td>
                                   <td><input type="hidden" value="<?echo $CodMuni;?>" name="CodMuni"  size="11" id="CodMuni"></td>
                                    <td><input type="hidden" value="<?echo $Conse;?>" name="Conse"  size="11" id="Conse"></td>
			               <table border="0" align="center">
		                      <tr class="cajas">
					  <th><b>Item</b></td><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Documento</b></th></th><th><b>Empleado</b></th><th><b>Zona</b></th><th><b>Vlr_Pagar</b></th>
					  </tr><?
			              $i=1;
			              $con=0;
		                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($ResBusca) . "\">");  ;
			             while($fila=mysql_fetch_array($ResBusca)):
			                     $Pagado= $fila["Pagado"];
			                     $Pagado = $Pagado * -1;
			                     $Registro="abono.";
			             ?>
					 <tr class="cajas">
				            <th><?echo $i;?></th>
					    <?
			                    echo ("<td><input type=\"checkbox\" id=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $fila['cedemple'] ."\" onClick=\"Actualizar()\"></td>");?>
					    <td><input type="text" value="<?echo $fila["cedemple"];?>"  size="11" readonly class="cajas"></td>
					    <td><input type="text" value="<?echo $fila["empleado"];?>" name="Empleado[<? echo $i;?>]"id="Empleado[<? echo $i;?>]" size="45" readonly class="cajas"></td>
		                            <td><input type="text" value="<?echo $fila["zona"];?>" name="Zona[<? echo $i;?>]"id="Zona[<? echo $i;?>]"size="45"  class="cajas"></td>
					    <td><input type="text" value="<?echo $Pagado;?>" name="Vlr_Pagado[<? echo $i;?>]"id="Vlr_Pagado[<? echo $i;?>]"size="11"  style="text-align:right"  class="cajas" ></td>
		                            <input type="hidden" value="<?echo $fila["codzona"];?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]"size="4"  class="cajas"></td>
		                            <input type="hidden" value="<?echo $desde;?>" name="Desde" id="Desde" size="11"  class="cajas">
		                           <input type="hidden" value="<?echo $hasta;?>" name="Hasta" id="Hasta" size="11"  class="cajas">
		                           <input type="hidden" value="<?echo $Nit;?>" name="Nit" id="Nit" size="11"  class="cajas">
		                          <input type="hidden" value="<?echo $CodSala;?>" name="CodSala" id="CodSala" size="11"  class="cajas">


					 <tr>
			                <?
			                  $i=$i+1;
			                  $TotalPagar=$TotalPagar + $fila["Pagado"];
			              endwhile;
		                      $TotalPagar=$TotalPagar * -1;
			              ?>
		                       <tr><td><br></td></tr>
		                                    <tr>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
					              <th><div align="left">Total_Pagar:</div></th>
		                                       <td colspan="10"><div align="right"><input type="text" value="<?echo $TotalPagar;?>" name="TotalPagar" id="TotalPagar" size="11" style="text-align:right;background-color:#3EC0FF" class="cajas"></div></td>
					            </tr>
					            <tr><td><br></td></tr>
					           <td colspan="5">
					          <input type="submit" value="Enviar" class="boton" id="buscar" name="buscar" id="buscar"></td>
		                  </table>
                                 </form>
		                  <?
		           endif;
                  }else{
                       if($EstadoDeduccion=='Prestacion'){
	                        include("../conexion.php");
			             $ConBusca="select SUM(detalleprestacion.valorpago) 'Pagado',zona.zona,zona.codzona,prestacion.cedemple,prestacion.nombres as empleado from zona,prestacion,detalleprestacion,salario
			             where zona.codzona=prestacion.codzona and
	                                   prestacion.nropresta=detalleprestacion.nropresta and
	                                   prestacion.fechapro between '$desde' and '$hasta' and
	                		   detalleprestacion.codsala=salario.codsala and
			                   salario.codsala='$CodSala' and
			                   zona.codzona='$CodZona'group by prestacion.cedemple ASC";
			           $ResBusca=mysql_query($ConBusca)or die("erro al validar la consulta de items");
			           $RegBusca=mysql_num_rows($ResBusca);
			           if ($RegBusca==0):
				           ?>
				           <script language="javascript">
				             alert("No existen deducciones para este concepto")
				             history.back()
				          </script>
				         <?
			           else:
				         ?>
	                                 <form action="GrabarPagoDeduccion.php" name="f1" id="f1" method="post" width="420">
	                                   <td><input type="hidden" value="<?echo $Nit;?>" name="Nit"  size="11" id="Nit"></td>
	                                   <td><input type="hidden" value="<?echo $CodMuni;?>" name="CodMuni"  size="11" id="CodMuni"></td>
                                            <td><input type="hidden" value="<?echo $Conse;?>" name="Conse"  size="11" id="Conse"></td>
				          <table border="0" align="center">
			                   <tr class="cajas">
						  <th><b>Item</b></td><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Documento</b></th></th><th><b>Empleado</b></th><th><b>Zona</b></th><th><b>Vlr_Pagar</b></th>
						  </tr><?
				              $i=1;
				              $con=0;
			                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($ResBusca) . "\">");  ;
				             while($fila=mysql_fetch_array($ResBusca)):
				                     $Pagado= $fila["Pagado"];
				             ?>
						 <tr class="cajas">
					            <th><?echo $i;?></th>
						    <?
				                    echo ("<td><input type=\"checkbox\" id=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $fila['cedemple'] ."\" onClick=\"Actualizar()\"></td>");?>
						    <td><input type="text" value="<?echo $fila["cedemple"];?>"  size="11" readonly class="cajas"></td>
						    <td><input type="text" value="<?echo $fila["empleado"];?>" name="Empleado[<? echo $i;?>]"id="Empleado[<? echo $i;?>]" size="45" readonly class="cajas"></td>
			                            <td><input type="text" value="<?echo $fila["zona"];?>" name="Zona[<? echo $i;?>]"id="Zona[<? echo $i;?>]"size="45"  class="cajas"></td>
						    <td><input type="text" value="<?echo $Pagado;?>" name="Vlr_Pagado[<? echo $i;?>]"id="Vlr_Pagado[<? echo $i;?>]"size="11"  style="text-align:right"  class="cajas"></td>
			                            <input type="hidden" value="<?echo $fila["codzona"];?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]"size="4"  class="cajas"></td>
			                            <input type="hidden" value="<?echo $desde;?>" name="Desde" id="Desde" size="11"  class="cajas">
			                           <input type="hidden" value="<?echo $hasta;?>" name="Hasta" id="Hasta" size="11"  class="cajas">
			                           <input type="hidden" value="<?echo $Nit;?>" name="Nit" id="Nit" size="11"  class="cajas">
			                          <input type="hidden" value="<?echo $CodSala;?>" name="CodSala" id="CodSala" size="11"  class="cajas">

						 <tr>
				                <?
				                  $i=$i+1;
				                  $TotalPagar=$TotalPagar + $fila["Pagado"];
				              endwhile;
				              ?>
			                       <tr><td><br></td></tr>
			                                    <tr>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
						              <th><div align="left">Total_Pagar:</div></th>
			                                       <td colspan="10"><div align="right"><input type="text" value="<?echo $TotalPagar;?>" name="TotalPagar" id="TotalPagar" size="11" style="text-align:right;background-color:#3EC0FF" class="cajas"></div></td>
						            </tr>
						            <tr><td><br></td></tr>
						           <td colspan="5">
						          <input type="submit" value="Enviar" class="boton" id="buscar" name="buscar" id="buscar"></td>
			                  </table>
	                                </form>
			                  <?
			           endif;
                        }else{
                                    include("../conexion.php");
			             $ConBusca="select detallevacacion.valorpago 'Pagado',zona.zona,zona.codzona,vacacion.cedemple,vacacion.nombre as empleado from zona,vacacion,detallevacacion,salario
			             where zona.codzona=vacacion.codzona and
	                                   vacacion.codvaca=detallevacacion.codvaca and
	                                   vacacion.fechap between '$desde' and '$hasta' and
	                		   detallevacacion.codsala=salario.codsala and
			                   salario.codsala='$CodSala' and
			                   zona.codzona='$CodZona'order by vacacion.nombre ASC";
			           $ResBusca=mysql_query($ConBusca)or die("erro al validar la consulta de items");
			           $RegBusca=mysql_num_rows($ResBusca);
			           if ($RegBusca==0):
				           ?>
				           <script language="javascript">
				             alert("No existen deducciones para este concepto")
				             history.back()
				          </script>
				         <?
			           else:
				         ?>
	                                 <form action="GrabarPagoDeduccion.php" name="f1" id="f1" method="post" width="420">
	                                   <td><input type="hidden" value="<?echo $Nit;?>" name="Nit"  size="11" id="Nit"></td>
	                                   <td><input type="hidden" value="<?echo $CodMuni;?>" name="CodMuni"  size="11" id="CodMuni"></td>
                                            <td><input type="hidden" value="<?echo $Conse;?>" name="Conse"  size="11" id="Conse"></td>
				          <table border="0" align="center">
			                   <tr class="cajas">
						  <th><b>Item</b></td><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Documento</b></th></th><th><b>Empleado</b></th><th><b>Zona</b></th><th><b>Vlr_Pagar</b></th>
						  </tr><?
				              $i=1;
				              $con=0;
			                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($ResBusca) . "\">");  ;
				             while($fila=mysql_fetch_array($ResBusca)):
				                     $Pagado= $fila["Pagado"];
				             ?>
						 <tr class="cajas">
					            <th><?echo $i;?></th>
						    <?
				                    echo ("<td><input type=\"checkbox\" id=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $fila['cedemple'] ."\" onClick=\"Actualizar()\"></td>");?>
						    <td><input type="text" value="<?echo $fila["cedemple"];?>"  size="11" readonly class="cajas"></td>
						    <td><input type="text" value="<?echo $fila["empleado"];?>" name="Empleado[<? echo $i;?>]"id="Empleado[<? echo $i;?>]" size="45" readonly class="cajas"></td>
			                            <td><input type="text" value="<?echo $fila["zona"];?>" name="Zona[<? echo $i;?>]"id="Zona[<? echo $i;?>]"size="45"  class="cajas"></td>
						    <td><input type="text" value="<?echo $Pagado;?>" name="Vlr_Pagado[<? echo $i;?>]"id="Vlr_Pagado[<? echo $i;?>]"size="11"  style="text-align:right"  class="cajas"></td>
			                            <input type="hidden" value="<?echo $fila["codzona"];?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]"size="4"  class="cajas"></td>
			                            <input type="hidden" value="<?echo $desde;?>" name="Desde" id="Desde" size="11"  class="cajas">
			                           <input type="hidden" value="<?echo $hasta;?>" name="Hasta" id="Hasta" size="11"  class="cajas">
			                           <input type="hidden" value="<?echo $Nit;?>" name="Nit" id="Nit" size="11"  class="cajas">
			                          <input type="hidden" value="<?echo $CodSala;?>" name="CodSala" id="CodSala" size="11"  class="cajas">

						 <tr>
				                <?
				                  $i=$i+1;
				                  $TotalPagar=$TotalPagar + $fila["Pagado"];
				              endwhile;
				              ?>
			                       <tr><td><br></td></tr>
			                                    <tr>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
						              <th><div align="left">Total_Pagar:</div></th>
			                                       <td colspan="10"><div align="right"><input type="text" value="<?echo $TotalPagar;?>" name="TotalPagar" id="TotalPagar" size="11" style="text-align:right;background-color:#3EC0FF" class="cajas"></div></td>
						            </tr>
						            <tr><td><br></td></tr>
						           <td colspan="5">
						          <input type="submit" value="Enviar" class="boton" id="buscar" name="buscar" id="buscar"></td>
			                  </table>
	                                </form>
			                  <?
			           endif;
                        }
                  }
           }
	           ?>
        </form>
<?
endif;
?>
</body>
</html>
