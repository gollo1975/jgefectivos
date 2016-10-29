<html>
<head>
  <title>Programar Prestaciones</title>
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
              if (document.getElementById("datoN[" + i + "]").checked == true ){
                  Proceso= parseFloat(document.getElementById("pagado[" + i + "]").value);
                  pagado = parseFloat(pagado + Proceso);
                  document.getElementById("VlrPagar").value =  parseFloat(pagado);
              }
            }
         }

</script>
</head>
<body>
<?
if (!isset($campo)){
     include("../conexion.php");
?>
<center><h4><u>Programar Prestaciones</u></h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
       <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
<tr>
      <td><b>Empresa:</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione la Empresa
                                <?
                                 $consulta_z="select maestro.codmaestro,maestro.nomaestro from maestro";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
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
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
    </td>
  </tr>
</table>
</form>
<?
}elseif (empty($campo)){
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la Empresa ?")
    history.back()
  </script>
    <?
}else{
   ?>
   <div align="center"><h4><u>Programar Prestaciones</u></h4></div>
      <form action="BuscarPrestacion.php" method="post" name="f1" id="f1">
      <input type="hidden" value="<?echo $campo;?>" name="NitEmpresa">
        <table border="0" align="center" width="552">
          <tr>
	    <td colspan="5"><b>Vlr_Seleccionado:</b>
            <input type="text" name="VlrPagar" value="0" class="cajas" size="15" id="VlrPagar" style="text-align:left;background-color:#FF8040;font-size:1.2em;"></td>
	   </tr>
         <tr class="cajas">
	  <th><b>#</b></td><th>&nbsp;</th><th><b>Nro_Vaca.</b></th><th><b>Documento</b></th><th><b>Empleado</b></th><th><b>F_Proceso</b></th><th><b>Vlr_Pagar</b></th><th><b>Zona</b></th>
	  </tr><?
          include("../conexion.php");
          $consu="select prestacion.*,zona.zona,zona.codzona,empleado.cuenta,empleado.codbanco,banco.bancos from maestro,sucursal,empleado,zona,prestacion,banco
          where maestro.codmaestro=sucursal.codmaestro and
          sucursal.codsucursal=zona.codsucursal and
          zona.codzona=prestacion.codzona and
          empleado.cedemple=prestacion.cedemple and
          empleado.codbanco=banco.codbanco and
          prestacion.control='ACTIVA' and
          prestacion.totalp > 0 and
          maestro.codmaestro='$campo'order by zona.zona,prestacion.fechapro";
          $resulta=mysql_query($consu)or die ("Error de busqueda de vacaciones");
          $Reg=mysql_num_rows($resulta);
          if($Reg != 0){
	          echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");  ;
	          $i=1;
	          while ($fila= mysql_fetch_array($resulta)):
	                ?>
			 <tr class="cajas">
		            <th><?echo $i;?></th>
			    <?
	                    echo ("<td><input type=\"checkbox\" id=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $fila['nropresta'] ."\"  onClick=\"ActualizarSaldo()\"></td>");?>
			    <td><input type="text" value="<?echo $fila["nropresta"];?>"  size="8" readonly class="cajas"></td>
	                    <td><input type="text" value="<?echo $fila["cedemple"];?>" name="Documento[<? echo $i;?>]"id="Documento[<? echo $i;?>]" size="14" readonly class="cajas"></td>
			    <td><input type="text" value="<?echo $fila["nombres"];?>" name="empleado[<? echo $i;?>]"id="empleado[<? echo $i;?>]" size="45" readonly class="cajas"></td>
                            <td><input type="text" value="<?echo $fila["fechapro"];?>" name="F_Proceso[<? echo $i;?>]"id="F_Proceso[<? echo $i;?>]"size="11"  class="cajas"></td>
			    <td><input type="text" value="<?echo $fila["totalp"];?>" name="pagado[<? echo $i;?>]"id="pagado[<? echo $i;?>]"size="11"  class="cajas"></td>
	                    <td><input type="text" value="<?echo $fila["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]"size="40" class="cajas" readonly></td>
                            <td><input type="hidden" value="<?echo $fila["codzona"];?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]"size="40" class="cajas" readonly></td>
                            <td><input type="hidden" value="<?echo $fila["cuenta"];?>" name="CtaBancaria[<? echo $i;?>]"id="CtaBancaria[<? echo $i;?>]"size="20" class="cajas" readonly></td>
                            <td><input type="hidden" value="<?echo $fila["codbanco"];?>" name="CodBanco[<? echo $i;?>]"id="CodBanco[<? echo $i;?>]"size="15" class="cajas" readonly></td>
                            <td><input type="hidden" value="<?echo $fila["bancos"];?>" name="NombreBanco[<? echo $i;?>]"id="NombreBanco[<? echo $i;?>]"size="20" class="cajas" readonly></td>
			 <tr>
			  <?
                          $Cont=$Cont + $fila["totalp"];
			$i=$i+1;
		  endwhile;
                   $Cont=number_format($Cont,0);
          }else{
            ?>
              <script language="javascript">
                alert("No hay registros de prestaciones para pagar!")
             </script>
            <?
          }
           ?>
           <tr><td colspan="10"><div align="right"><b>Total_Pagar:&nbsp;<?echo $Cont;?></b></div></td></tr>

           <tr><td><br></td></tr>
          	   <tr>
	    <td colspan="5">
	      <input type="submit" value="Exportar" class="boton" id="exportar">
	    </td>
        </table>
      </form>
 <?
 }
 ?>
</body>
</html>
