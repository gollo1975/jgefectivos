<html>
<head>
<title>Generando Prestaciones</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='listadocesantia.php'
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }
</script>
</head>
<body>
<?
include("../conexion.php");
$consulta="SELECT prestacion.*
FROM prestacion, empleado
WHERE empleado.cedemple = prestacion.cedemple
AND empleado.cedemple = '$Cedula'
AND prestacion.nropresta = '$NroPrestacion'";
$res=mysql_query($consulta)or die ("Error al buscar prestaciones");
$reg=mysql_num_rows($res);
$filas=mysql_fetch_array($res);
$TotalP=$filas["total"];
$TotalPagado=$filas["totalp"];
?>
<center><h4><u>Deducciones</u></h4></center>
    <table border="0" align="center" width="300">
         <tr>
         <td><b>Cedula:</b></td>
         <td colspan="1"><input type="text" name="Cedula" value="<? echo $Cedula;?>"class="cajas" size="13" readonly></td>
          <td><b>Nro_Presta.:</b></td>
         <td colspan="1"><input type="text" name="NroPrestacion" value="<? echo $NroPrestacion;?>"class="cajas" size="13" readonly></td>
       </tr>
       <tr>
         <td><b>Empleado:</b></td>
         <td colspan="3"><input type="text" name="nombres" value="<? echo $filas["nombres"];?>" class="cajas"size="46" readonly></td>
       </tr>
       <tr>
         <td><b>F_Proceso:</b></td>
         <td colspan="1"><input type="text" name="fechap" value="<? echo $filas["fechapro"];?>"class="cajas" size="13" maxlength="10" readonly></td>
         <td><b>Total_Pagar:</b></td>
         <td colspan="1"><input type="text"name="TotalP" value="<? echo $filas["total"];?>" class="cajas" size="13" maxlength="10" readonly></td>
        </tr>
      </table>
   <form action="GrabarDeduccion.php" method="post">
      <input type="hidden" name="Cedula" value="<? echo $Cedula;?>">
      <input type="hidden" name="NroPrestacion" value="<? echo $NroPrestacion;?>">
       <input type="hidden" name="Sw" value="<? echo $Sw;?>">
       <input type="hidden" name="TotalP" value="<? echo $TotalP;?>">
       <input type="hidden" name="TotalPagado" value="<? echo $TotalPagado;?>">
      <table border="0" align="center" width="510">
           <?
            include("../conexion.php");
            $consulta_z="select salario.codsala,salario.desala,credito.nuevo,credito.nrocredito from salario,credito,empleado
             where salario.codsala=credito.codsala and
                        credito.cedemple=empleado.cedemple and
                        empleado.cedemple='$Cedula' and
                        credito.nuevo > 0 order by salario.desala";
            $resultado_z=mysql_query($consulta_z) or die("Error al buscar deducciones");
            $Vector=mysql_num_rows($resultado_z);
            if($Vector > 0){
               $Sw=0;?>
               <tr>
                   <td><b>Descto:</b></td>
                   <td ><select name="Deduccion" class="cajasletra">
                   <option value="0">Seleccione el Descuento
                   <?
                     while ($filas_z=mysql_fetch_array($resultado_z))
	                 {
	                 ?>
	                 <option value="<?echo $filas_z["nrocredito"];?>"><?echo $filas_z["nrocredito"];?>&nbsp;<?echo $filas_z["codsala"];?>&nbsp;<?echo $filas_z["desala"];?>&nbsp;<?echo $filas_z["nuevo"];?>
	                <?
	             }
                  ?>
                  </select><?
	    }else{
                 $conM="select salario.codsala,salario.desala,mercado.nsaldo,mercado.codmerca from salario,mercado,empleado
                      where salario.codsala=mercado.codsala and
                        mercado.cedemple=empleado.cedemple and
                        empleado.cedemple='$Cedula' and
                       mercado.nsaldo > 0 order by salario.desala";
                 $resuM=mysql_query($conM) or die("Error al buscar Mercados");
                 $Sw=1;?>
                 <tr>
                     <td><b>Descto:</b></td>
                     <td ><select name="Deduccion" class="cajasletra">
                    <option value="0">Seleccione el Descuento
                    <?
                  while ($filasM=mysql_fetch_array($resuM))
	                      {
	                      ?>
	                      <option value="<?echo $filasM["codmerca"];?>"><?echo $filasM["codsala"];?>&nbsp;<?echo $filasM["desala"];?>&nbsp;<?echo $filasM["nsaldo"];?>
	                      <?
	                      }
                  }
                  ?></select>
                  <input type="radio" value="Otro"  name="Estado"><b>Otro:</b>&nbsp;<input type="text" name="OtroValor" value=""class="cajas" size="12" maxlength="11"></td>
                 </tr>
                  <tr><td><br></td></tr>
                  <input type="hidden" name="Sw" value="<? echo $Sw;?>">
                   <tr>
                  <td colspan="5"><input type="submit" value="Agregar" class="boton"></td>
                   </tr>
          </tr>
     </table>
  </form><?
  $conH="select detalleprestacion.* from detalleprestacion,prestacion,empleado
        where empleado.cedemple=prestacion.cedemple and
         empleado.cedemple='$Cedula' and
         detalleprestacion.nropresta=prestacion.nropresta and
         prestacion.nropresta='$NroPrestacion'order by detalleprestacion.concepto";
   $resuH=mysql_query($conH)or die ("Error al buscar el detalle");
   $regH=mysql_num_rows($resuH);
   ?>
   <form action="EliminarDato.php" method="post">
        <input type="hidden" name="cedemple" value="<?echo $cedemple;?>">
        <input type="hidden" name="estado" value="<?echo $estado;?>">
        <table border="0" align="center" width="550">
             <tr>
                 <th><br></th><th><br></th><th><b><u>Id.</u></b></th><th><b>&nbsp;<u>Cod_Salario</u></b></th><th><b><u>Descripción</u></b></th><th><b><u>Vlr_Pagado.</u></b></th> <th><b><u>Nro_Crédito</u></b></th>
            </tr>
             <?
             while ($filas=mysql_fetch_array($resuH)):
                   $VarD=number_format($filas["valorpago"],0)
                   ?>
		   <tr class="cajas">
	               <input type="hidden" name="Cedula" value="<? echo $Cedula;?>">
	               <td><input type="checkbox" name="busca[]" value="<?echo $filas["id"];?>"></td>
	               <td><a href="editar.php?datos=<?echo $filas["id"];?>&Cedula=<?echo $Cedula;?>"><img src="../image/mod.jpg" border="0" alt="Permite Modificar el Registro"></a></td><td><div align="center"><?echo $filas["id"];?></div></td>
	               <td><div align="center"><?echo $filas["codsala"];?></div></td>
	               <td><?echo $filas["concepto"];?></td>
	               <td><div align="center"><?echo $VarD;?></div></td>
                       <td><div align="center"><?echo $filas["nrocredito"];?></div></td>
		   </tr>
		   <?
                   $TotalD=$TotalD+$filas["valorpago"];
	     endwhile;
              $TotalPagar=round($TotalP-$TotalD);
              $ConA="update prestacion set totald='$TotalD',totalp='$TotalPagar' where prestacion.nropresta='$NroPrestacion'";
	     $resuA = mysql_query ($ConA) or die ("Error al actualizar prestaciones");
	     $regH=mysql_affected_rows();
             $TotalV=number_format($TotalD,2);
	     ?>
             <tr>
                                 <td colspan="9">&nbsp;</td>
                              </tr>
              <tr>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                   <th>&nbsp;</th>
                                  <th><b><div align="right">Deducción:</div></b></th>

                                  <td align="right" colspan="2"><input type="text" name="subtotal" value="$<?echo $TotalV;?>" readonly style="border:0;text-align:right"></td>

                              </tr>
             <tr><td><br></td></br>
             <tr>
             <td align="right" colspan="2"><input type="submit" value="Eliminar" class="boton"></td>
             </tr>
        </table>
   </form>
   <th><a href="imprimirpresta.php?nropresta=<?echo $NroPrestacion;?>" target="_blank" onclick="volver()"><div align="center"><font color="red"><b><h3>Imprimir</h3></b></font></div></a></th>
</body>
</html>
