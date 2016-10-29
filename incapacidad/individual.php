<html>

<head>
  <title>Consulta de Pago de Incapacidades</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                    function Validar(){
                      if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento de identidad. ");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matinca").submit();
                    }

  </script>
</head>

<body>
<?
if (!isset($cedula)):
     ?>
     <center><h4><u>Pago de Incapacidad</u></h4></center>
    <form action="" method="post" id="matinca" >
      <table border="0" align="center">
      <tr>
           <td colspan="2"><br></td>
      </tr>
       <tr>
         <td><b>Documento de Identidad:</b></td>
         <td><input type="text" name="cedula" value="" size="20" maxlength="20" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
       </tr>
       <tr>
         <td><b>Opcion de busqueda:</b></td>
         <td><input type="radio" name="dato" value="1">Individual<input type="radio" name="dato" value="2">Por Zona</td>
       </tr>
       <tr><td><br></td></tr>
      <tr>
        <td colspan="2">
          <input type="button" value="Buscar" class="boton" onclick="Validar()">
          <input type="reset" value="limpiar" class="boton">
        </td>
      </tr>
    </table>
    </form>
<?
 elseif(empty($dato)):
    ?>
          <script language="javascript">
             alert("Seleccion una opción de busqueda ?")
            history.back()
          </script>
        <?
 else:
    include("../conexion.php");
    $opcion=" select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado
           where  empleado.cedemple='$cedula'";
    $re=mysql_query($opcion)or die ("Eror de consulta $opcion");
    $reg= mysql_num_rows($re);
    $filas=mysql_fetch_array($re);
    if ($reg!=0):
         ?>
         <table border="0" align="center">
           <tr class="cajas">
           <center><td>&nbsp;&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td></center>
           </tr>
         </table>
         <?
         if($dato==1):
	      $consulta="select pagado.nropago,pagado.fechap,pagado.valor,pagado.nroinca from empleado,pagado where
	           empleado.cedemple=pagado.cedemple and
	           empleado.cedemple='$cedula'";
	       $resultado=mysql_query($consulta)or die ("Erro al buscar incapacidad individual");
	       $registro=mysql_num_rows($resultado);
	       if ($registro==0):
	         ?>
	        <script language="javascript">
	        alert ("Este empleado no tiene Incapacidades Pagadas individuales...?")
	       history.back()
	        </script>
	        <?
	       else:
	        ?>
	          <tr><td><br></td></tr>
	           <table border="0" align="center">
	                    <tr class="cajas">
	                      <td>Presione Click sobre el Nro_Pago para Ver el Reporte..</td>
	                    </tr>
	                  </table>
	            <table border="0" align="center">
	               <tr>
	                 <td colspan="30"></td>
	               </tr>
	               <tr class="cajas">
                       <th>Item</th>
	                 <th>Nro_Pago</th>
	                  <th>Nro_Incapacidad</th>
	                 <th>F_Proceso</th>
	                 <th>Vrl_Pagado</th>
	                 </tr>
	                <? $f=1;
	                 while($filas_s=mysql_fetch_array($resultado)):
                          $valor=number_format($filas_s["valor"],0);
	                           ?>
	                     <tr class="cajas">
                             <th><?echo $f;?></th>
	                       <td><a href="imprimirpago.php?nropago=<?echo $filas_s["nropago"];?>"><?echo $filas_s["nropago"];?></a></td>
	                       <td><?echo $filas_s["nroinca"];?></td>
	                        <td><?echo $filas_s["fechap"];?></td>
	                       <td>$<?echo $valor;?></td>
	                       </tr>
	                       <?
                               $f=$f+1;
                               $sumaT=$sumaT+$filas_s["valor"];
	                  endwhile;
                          $sumaT=number_format($sumaT,0);
	                  ?>
	                   </table>
                            <div align="center"><b>Total_Pagado:&nbsp;<td>$<?echo $sumaT;?></td> </b></div>
	                  <?
	           endif;
         else:
               $consulta="select depagozona.* from empleado,depagozona,incapacidad
               where empleado.cedemple=incapacidad.cedemple and
                     incapacidad.nroinca=depagozona.nroinca and
	             empleado.cedemple='$cedula' order by depagozona.radicado";
	       $resultado=mysql_query($consulta)or die ("Erro al buscar incapacidad por zona");
	       $registro=mysql_num_rows($resultado);
	       if ($registro==0):
	          ?>
	          <script language="javascript">
	              alert ("Este empleado no tiene Incapacidades Pagadas por zona...?")
	               history.back()
	          </script>
	           <?
	       else:
	        ?>
	          <tr><td><br></td></tr>
	           <table border="0" align="center">
	                    <tr class="cajas">
	                      <td>Presione Click sobre el Radicado para Ver el Reporte..</td>
	                    </tr>
	                  </table>
	            <table border="0" align="center">
	               <tr>
	                 <td colspan="30"></td>
	               </tr>
	               <tr class="cajas">
                         <th>Item</th>
	                 <th>Nro_Radicado</th>
	                  <th>Nro_Incap.</th>
	                 <th>Dias</th>
	                 <th>Ibc</th>
                         <th>%Pago</th>
                         <th>Valor</th>
	                 </tr>
	                <?$v=1;
	                 while($filas_s=mysql_fetch_array($resultado)):
                           $total=number_format($filas_s["total"],0);
                           $ibc=number_format($filas_s["ibc"],0);
	                           ?>
	                     <tr class="cajas align="center">
                             <th><?echo $v;?></th>
	                       <td><a href="imprimirpagozona.php?codigo=<?echo $filas_s["radicado"];?>"><?echo $filas_s["radicado"];?></a></td>
	                       <td><?echo $filas_s["nroinca"];?></td>
	                        <td><?echo $filas_s["dias"];?></td>
	                       <td>$<?echo $ibc;?></td>
                               <td><?echo $filas_s["porcentaje"];?></td>
                               <td>$<?echo $total;?></td>
	                       </tr>
	                       <?
                               $suma=$suma+$filas_s["total"];
                               $v=$v+1;
	                  endwhile;
                          $suma=number_format($suma,0);
	                  ?>
	                   </table>
                           <div align="center"><b>Total_Pagado:&nbsp;<td>$<?echo $suma;?></td> </b></div>
	                  <?
	           endif;
            endif;
     else:
        ?>
          <script language="javascript">
             alert("El documento digitado no existe en Sistema ?")
            history.back()
          </script>
        <?
     endif;
 endif;
 ?>
</body>
</html>
