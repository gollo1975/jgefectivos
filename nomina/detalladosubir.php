        <html>

<head>
  <title>Empleados por Zona</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

</body>
<?
 include("../conexion.php");
 $consu="select zona.zona from zona where zona.codzona='$codzona'";
 $resu=mysql_query($consu);
 $reg=mysql_num_rows($resu);
 if ($reg!=0):
   ?>
   <table border="0" align="center">
  <?
    while($filas_s=mysql_fetch_array($resu)):
      ?>
      <tr  class="cajas">
             <td><?echo $filas_s["zona"];?></td>
      </tr>
      <?
    endwhile;
    ?>
    </table>
    <table border="0" align="center">
  <tr class="cajas">
    <td>Para Generar la Nomina por Empleado, Presiones Click sobre el campo (DOCUMENTO)..</td>
  </tr>
</table>
    <?

if($Auxiliar!=''):
     $consu="select procesonomina.codproceso from procesonomina,zona
     where procesonomina.codzona=zona.codzona and
           zona.codzona='$codzona' and
           procesonomina.estado='ABIERTO'";
     $resu=mysql_query($consu);
     $reg=mysql_num_rows($resu);
     if ($reg!=0):
	     $consulta="select empleado.*,contrato.*,zona.codzona from empleado,zona,contrato where
	      empleado.codzona=zona.codzona and
	      empleado.codemple=contrato.codemple and
	      contrato.fechater='0000-00-00'and
	      contrato.fechainic <= '$hasta' and
	      empleado.nomina='SI' and
	      zona.codzona='$codzona' order by empleado.nomemple,empleado.apemple,contrato.fechainic";
	      $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
	      $registro=mysql_num_rows($resultado);
	      if ($registro==0):
	          ?>

	          <script language="javascript">
	             alert("No hay empleados en esta Zona para Nomina")
	             history.back()
	          </script>
	          <?
	       else:
		       ?>
	              <tr><td><br></td></tr>
	              <table border="0" align="center">
	              <tr  class="fondo">
	             <td colspan="9"></td>
	             </tr>
	             <tr  class="cajas">
	               <th>Item</th>
	              <th>Ducumento</th>
	              <th>Nombre</th>
	              <th>Apellido</th>
	               <th>Salario</th>
	               <th>Fecha_Ingreso</th>
	              <th>Nomina</th>
	              <th>Estado</th>
		           </tr>
		        <?
		        $listo='OK';
		        $suma=1;
		           while($filas=mysql_fetch_array($resultado)):
		           $salario=number_format($filas["salario"],0);
		       ?>

	            <tr  class="cajas">
	                 <input type="hidden" name="fechainic" value="<? echo $filas["fechainic"];?>">
	                 <th><?echo $suma;?></th>
	                 <td><a href="cargar.php?cedula=<?echo $filas["cedemple"];?>&codnomina=<?echo $codnomina;?>&codzona=<?echo $codzona;?>&fechainic=<? echo $filas["fechainic"];?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>&codigo=<?echo $codigo;?>&Documento=<?echo $Documento;?>&Auxiliar=<?echo $Auxiliar;?>"><?echo $filas["cedemple"];?></a></td>
	                 <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
	                 <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
	                 <td><?echo $salario;?></td>
	                 <td><?echo $filas["fechainic"];?></td>
	                 <td><?echo $filas["nomina"];?></a></td>
	                  <?
	                 if($cedula==$filas["cedemple"]):
	                  ?>
	                   <td><?echo $listo;?></a></td>
	                  <?
	                 else:
	                endif;
	                 ?>
	            </tr>
	             <?
	             $suma=$suma+1;

	           endwhile;
	           ?>
	           <td><input type="hidden" name="codzona" value="<? echo $codzona;?>"></td>

	           </table>
	           <tr><td><br></td></tr>
	           <?
             endif;
        else:
          ?>
          <script language="javascript">
             alert("Debe de abrir el proceso para esta zona.")
             history.back()
          </script>
          <?
        endif;
else:

	     $consulta="select empleado.*,contrato.*,zona.codzona from empleado,zona,contrato where
	      empleado.codzona=zona.codzona and
	      empleado.codemple=contrato.codemple and
	      contrato.fechater='0000-00-00'and
	      contrato.fechainic <= '$hasta' and
	      empleado.nomina='SI' and
	      zona.codzona='$codzona' order by empleado.nomemple,empleado.apemple,contrato.fechainic";
	      $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
	      $registro=mysql_num_rows($resultado);
	      if ($registro==0):
	          ?>

	          <script language="javascript">
	             alert("No hay empleados en esta Zona para Nomina")
	             history.back()
	          </script>
	          <?
	       else:
		       ?>
	              <tr><td><br></td></tr>
	              <table border="0" align="center">
	              <tr  class="fondo">
	             <td colspan="9"></td>
	             </tr>
	             <tr  class="cajas">
	               <th>Item</th>
	              <th>Ducumento</th>
	              <th>Nombre</th>
	              <th>Apellido</th>
	               <th>Salario</th>
	               <th>Fecha_Ingreso</th>
	              <th>Nomina</th>
	              <th>Estado</th>
		           </tr>
		        <?
		        $listo='OK';
		        $suma=1;
		           while($filas=mysql_fetch_array($resultado)):
		           $salario=number_format($filas["salario"],0);
		       ?>

	            <tr  class="cajas">
	                 <input type="hidden" name="fechainic" value="<? echo $filas["fechainic"];?>">
	                 <th><?echo $suma;?></th>
	                 <td><a href="cargar.php?cedula=<?echo $filas["cedemple"];?>&codnomina=<?echo $codnomina;?>&codzona=<?echo $codzona;?>&fechainic=<? echo $filas["fechainic"];?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>&codigo=<?echo $codigo;?>&Documento=<?echo $Documento;?>&Auxiliar=<?echo $Auxiliar;?>"><?echo $filas["cedemple"];?></a></td>
	                 <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
	                 <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
	                 <td><?echo $salario;?></td>
	                 <td><?echo $filas["fechainic"];?></td>
	                 <td><?echo $filas["nomina"];?></a></td>
	                  <?
	                 if($cedula==$filas["cedemple"]):
	                  ?>
	                   <td><?echo $listo;?></a></td>
	                  <?
	                 else:
	                endif;
	                 ?>
	            </tr>
	             <?
	             $suma=$suma+1;

	           endwhile;
	           ?>
	           <td><input type="hidden" name="codzona" value="<? echo $codzona;?>"></td>

	           </table>
	           <tr><td><br></td></tr>
	           <?
               endif;
      endif;         
    endif;
 ?>
 </body>
</html>
