<html>
<head>
<title>Generar Comisiones</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
include("../conexion.php");
$conB="select decartera.codigo,decartera.fechaini,decartera.fechacorte,decartera.codzona from decartera
 where decartera.codigo='$codigo' order by conse";
$resuB=mysql_query($conB) or die ("Error en la busquedas de  facturas con administracion $consulta");
$regB=mysql_num_rows($resuB);
if($regB==0):
    $consulta="select zona.codzona,factura.nrofactura,defactura.total,defactura.remision,factura.estado,factura.subtotal from zona,factura,defactura,item
	            where  zona.codzona=factura.codzona and
	                   factura.fechaini between '$desde'and'$hasta' and
	                   zona.codzona='$codzona' and
	                   factura.nrofactura=defactura.nrofactura and
	                   defactura.codcom=item.codcom and
	                   item.codcom='$servicio'";
	         $resultado=mysql_query($consulta) or die ("Error en la busquedas de  facturas con administracion $consulta");
	         $registros=mysql_num_rows($resultado);
	         if($registros!=0):
	            ?>
	            <center><h5><u>Facturas encontradas</u></h5></center>
	            <form action="grabarcartera.php" method="post">
	             <input type="hidden" name="codzona" value="<? echo $codzona;?>">
	             <input type="hidden" name="cedula" value="<? echo $cedula;?>">
	             <input type="hidden" name="desde" value="<? echo $desde;?>">
	             <input type="hidden" name="hasta" value="<? echo $hasta;?>">
	              <input type="hidden" name="zona" value="<? echo $zona;?>">
                     <input type="hidden" name="codigo" value="<? echo $codigo;?>">
	            <input type="hidden" name="empresa" value="<? echo $empresa;?>">
	             <input type="hidden" name="servicio" value="<? echo $servicio;?>">
	             <tr><td><br></td></tr>
	             <table border="0" align="center">
	               <tr  class="cajas">
	                   <th>Item</th>
	                   <th>Chekeo</th>
	                   <th>Nro_Factura</th>
					   <th>Subtotal</th>
	                   <th>Vlr_Admon</th>
	                   <th>%</th>
	                   <th>Vlr_Comisión</th>
                          <th>Estado</th>
	               </tr>
	               <?
	               $a=1;
	               $i=1;
	               echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resultado) . "\">");
	               while ($filas=mysql_fetch_array($resultado)):
	                 $vlrComision=round(($filas["total"]* $porcentaje)/100);
	                  ?>
	                 <tr class="cajas">
	                    <th><?echo $a;?></th>
	                     <? echo ("<td><input type=\"checkbox\" id=name=\"buscar[" . $i . "]\" name=\"buscar[" . $i . "]\" value=\"" . $filas['remision'] ."\" onClick=\"\">" .$filas['remision']."</td>")?>
	                    <input type="hidden" value="<?echo $codzona;?>" name="codzona[<? echo $i;?>]"id="codzona[<? echo $i;?>]"size="11" readonly>
	                     <input type="hidden" value="<?echo $zona;?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]"size="50" readonly>
	                   <input type="hidden" value="<?echo $desde;?>" name="desde[<? echo $i;?>]"id="desde[<? echo $i;?>]"size="11" readonly>
	                   <input type="hidden" value="<?echo $hasta;?>" name="hasta[<? echo $i;?>]"id="hasta[<? echo $i;?>]"size="11" readonly>
	                   <input type="hidden" value="<?echo $filas["remision"];?>" name="remision[<? echo $i;?>]"id="remision[<? echo $i;?>]"size="11" readonly>
	                     <td><input type="text" value="<?echo $filas["nrofactura"];?>" name="factura[<? echo $i;?>]"id="factura[<? echo $i;?>]"size="11" readonly>
						 <td><input type="text" value="<?echo $filas["subtotal"];?>" name="subtotal[<? echo $i;?>]"id="subtotal[<? echo $i;?>]"size="11" readonly>
						  <td><input type="text" value="<?echo $filas["total"];?>" name="admon[<? echo $i;?>]"id="admon[<? echo $i;?>]"size="11" readonly>
	                     <td><input type="text" value="<?echo $porcentaje;?>" name="porcentaje[<? echo $i;?>]"id="porcentaje[<? echo $i;?>]"size="4" readonly>
	                     <td><input type="text" value="<?echo round($vlrComision,0);?>" name="vlrcomision[<? echo $i;?>]"id="vlrcomision[<? echo $i;?>]"size="11"><td><input type="text" value="<?echo $filas["estado"];?>" name="estado[<? echo $i;?>]"id="estado[<? echo $i;?>]"size="11" readonly>

	                 </tr>
	                 <?
	                 $i=$i+1;
	                 $a=$a+1;
	              endwhile;
	         else:
	                  ?>
	                  <script language="javascript">
	                    alert("No facturacion en este rango de fechas para esta empresa")
	                    history.back()
	                  </script>
	                  <?
	         endif;
 else:
 while ($filas_s=mysql_fetch_array($resuB)):
  $Aux=$filas_s["codzona"];
  $conT="select decartera.codigo,decartera.fechaini,decartera.fechacorte,decartera.codzona from decartera
   where decartera.codigo='$codigo' and
         decartera.codzona='$codzona'";
   $resuT=mysql_query($conT) or die ("Valores duplicados");
   $regT=mysql_num_rows($resuT);
   $estado=0;
   if($regT!=0):
      $estado=1;
           ?>
	   <script language="javascript">
	   alert("Esta comision ya fue cargada a esta empresa..")
	   history.back()
	  </script>
	   <?
    endif;
   endwhile;
  if($estado==0):
    $consulta="select zona.codzona,factura.nrofactura,defactura.total,defactura.remision,factura.estado,factura.subtotal from zona,factura,defactura,item
	            where  zona.codzona=factura.codzona and
	                   factura.fechaini between '$desde'and'$hasta' and
	                   zona.codzona='$codzona' and
	                   factura.nrofactura=defactura.nrofactura and
	                   defactura.codcom=item.codcom and
	                   item.codcom='$servicio'";
	         $resultado=mysql_query($consulta) or die ("Error en la busquedas de  facturas con administracion $consulta");
	         $registros=mysql_num_rows($resultado);
	         if($registros!=0):
                ?>
	            <center><h5><u>Facturas encontradas</u></h5></center>
	            <form action="grabarcartera.php" method="post">
	             <input type="hidden" name="codzona" value="<? echo $codzona;?>">
	             <input type="hidden" name="cedula" value="<? echo $cedula;?>">
	             <input type="hidden" name="desde" value="<? echo $desde;?>">
	             <input type="hidden" name="hasta" value="<? echo $hasta;?>">
	              <input type="hidden" name="zona" value="<? echo $zona;?>">
	            <input type="hidden" name="codigo" value="<? echo $codigo;?>">
	            <input type="hidden" name="empresa" value="<? echo $empresa;?>">
	             <input type="hidden" name="servicio" value="<? echo $servicio;?>">
	             <tr><td><br></td></tr>

	             <table border="0" align="center">
	               <tr  class="cajas">
	                   <th>Item</th>
	                   <th>Chekeo</th>
	                   <th>Nro_Factura</th>
					   <th>Subtotal</th>
	                   <th>Vlr_Admon</th>
	                   <th>%</th>
	                   <th>Vlr_Comisión</th>
                           <th>Estado</th>

	               </tr>
	               <?
	               $a=1;
	               $i=1;
	               echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resultado) . "\">");
	               while ($filas=mysql_fetch_array($resultado)):
	                 $vlrComision=round($filas["total"]* $porcentaje)/100;
	                  ?>
	                 <tr class="cajas">
	                    <th><?echo $a;?></th>
	                     <? echo ("<td><input type=\"checkbox\" id=name=\"buscar[" . $i . "]\" name=\"buscar[" . $i . "]\" value=\"" . $filas['remision'] ."\" onClick=\"\">" .$filas['remision']."</td>")?>
	                    <input type="hidden" value="<?echo $codzona;?>" name="codzona[<? echo $i;?>]"id="codzona[<? echo $i;?>]"size="11" readonly>
	                     <input type="hidden" value="<?echo $zona;?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]"size="50" readonly>
	                   <input type="hidden" value="<?echo $desde;?>" name="desde[<? echo $i;?>]"id="desde[<? echo $i;?>]"size="11" readonly>
	                   <input type="hidden" value="<?echo $hasta;?>" name="hasta[<? echo $i;?>]"id="hasta[<? echo $i;?>]"size="11" readonly>
	                   <input type="hidden" value="<?echo $filas["remision"];?>" name="remision[<? echo $i;?>]"id="remision[<? echo $i;?>]"size="11" readonly>
	                     <td><input type="text" value="<?echo $filas["nrofactura"];?>" name="factura[<? echo $i;?>]"id="factura[<? echo $i;?>]"size="11" readonly>
						 <td><input type="text" value="<?echo $filas["subtotal"];?>" name="subtotal[<? echo $i;?>]"id="subtotal[<? echo $i;?>]"size="11" readonly>
	                     <td><input type="text" value="<?echo $filas["total"];?>" name="admon[<? echo $i;?>]"id="admon[<? echo $i;?>]"size="11" readonly>
	                     <td><input type="text" value="<?echo $porcentaje;?>" name="porcentaje[<? echo $i;?>]"id="porcentaje[<? echo $i;?>]"size="4" readonly>
	                     <td><input type="text" value="<?echo round($vlrComision,0);?>" name="vlrcomision[<? echo $i;?>]"id="vlrcomision[<? echo $i;?>]"size="11" ><td><input type="text" value="<?echo $filas["estado"];?>" name="estado[<? echo $i;?>]"id="estado[<? echo $i;?>]"size="11" readonly>

	                 </tr>
	                 <?
	                 $i=$i+1;
	                 $a=$a+1;
	              endwhile;
	         else:
	                  ?>
	                  <script language="javascript">
	                    alert("No facturacion en este rango de fechas para esta empresa")
	                    history.back()
	                  </script>
	                  <?
	         endif;
   endif;
endif;


    ?>
     <input type="hidden" name="datos" value="<? echo $codzona;?>">
             <input type="hidden" name="cedula" value="<? echo $cedula;?>">
             <input type="hidden" name="desde" value="<? echo $desde;?>">
             <input type="hidden" name="hasta" value="<? echo $hasta;?>">
              <input type="hidden" name="zona" value="<? echo $zona;?>">
            <input type="hidden" name="codigo" value="<? echo $codigo;?>">
            <input type="hidden" name="empresa" value="<? echo $empresa;?>">
            <input type="hidden" name="servicio" value="<? echo $servicio;?>">
       <tr><td><br></td></tr>
     <tr>
        <td colspan="2"><input type="submit" Value="Guardar" class="boton"></td>
    </tr>
  </table>
</form>


