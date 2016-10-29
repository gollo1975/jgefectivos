<html>
<head>
  <title></title>
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
<body>
<?
  if (!isset($Empresa)):
     include("../conexion.php");
      $conP="select periodoprima.* from periodoprima where
          periodoprima.estado='FALTA'";
          $resP=mysql_query($conP)or die ("Error en la busqueda de periodo");
      $fila=mysql_fetch_array($resP);
  ?>
  <center><h4><u>Cerrar pagos[Primas]</u></h4></center>

<form action="" method="post">
  <table border="0" align="center">
  <tr><td><br></td></tr>
  <tr>
    <td><b>Desde:</b></td>
   <td><input type="text" name="Desde" value="<? echo $fila["desde"];?>" size="12" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Desde"></td>
    <td><b>Hasta:</b></td>
    <td><input type="text" name="Hasta" value="<? echo $fila["hasta"];?>" size="12" class="cajas"maxlength="10" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Hasta"></td>
  </tr>
<tr>
         <td><b>Empresa:</b></td>
                              <td colspan="10"><select name="Empresa" class="cajas">
                              <option value="0">Seleccione
                                <?
                                 $consulta_z="select codmaestro,nomaestro from maestro";
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
   <tr><td></td></tr>
    <tr><td></td></tr>
</table>

</form>
<?
elseif (empty($Empresa)):
    ?>
     <script language="javascript">
        alert("Seleccione la empresa para la busqueda")
        history.back()
     </script>
    <?
 else:
     include("../conexion.php");
     $consu="select prima.nroprima,prima.nombre,prima.cedemple,zona.zona,empleado.cuenta from maestro,sucursal,prima,empleado,zona where
	         maestro.codmaestro=sucursal.codmaestro and
	         sucursal.codsucursal=zona.codsucursal and
	         zona.codzona=empleado.codzona and
                 empleado.cedemple=prima.cedemple and
	         prima.fechai='$Desde' and prima.fechacorte='$Hasta' and prima.estado='FALTA' and
	         maestro.codmaestro='$Empresa'order by zona.zona";
      $resulta=mysql_query($consu)or die ("Error de busqueda de primas");
      $registro=mysql_affected_rows();
      if ($registro!=0):?>
		    <center><h4><u>Cerrar Pagos</u></h4></center>
		    <form action="GrabarCerrarPrima.php" method="post" name="f1" id="f1">
		    <input type="hidden" value="<?echo $Desde;?>" name="Desde">
		    <input type="hidden" value="<?echo $Hasta;?>" name="Hasta">
		       <table border="0" align="center" width="150">
		               <tr>
				  <td><b>Estado:</b></td>
			          <td><select name="Validar" class="cajas">
			          <option value="PAGADO">PAGADO
				  </select></td>
		      </tr>
               </table>
		       <table border="0" align="center" width="450">
		          <tr class="cajas">
			   <th><b>Item</b></td><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Nro_Prima</b></th><th>Documento</th><th><b>Empleado</b></th><th><b>Cuenta</b></th><th><b>Zona</b></th>
		          </tr>
			  <?
			  $i=1;
			  echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");
			  while ($filas_Z = mysql_fetch_array($resulta)):
			           ?>
			           <tr class="cajas">
		                   <th><?echo $i;?></th>

			              <?
			              echo ("<td class=\"cajas\"><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $filas_Z['nroprima'] ."\"\">");?>
                                       <td class="cajas"><input type="text" value="<?echo $filas_Z["nroprima"];?>" name="nrop[<? echo $i;?>]"id="nrop[<? echo $i;?>]" size="9" readonly class="cajas"></td>
                                      <td class="cajas"><input type="text" value="<?echo $filas_Z["cedemple"];?>" name="cedula[<? echo $i;?>]"id="cedula[<? echo $i;?>]" size="13" readonly class="cajas"></td>
                                      <td class="cajas"><input type="text" value="<?echo $filas_Z["nombre"];?>" name="nombres[<? echo $i;?>]"id="nombres[<? echo $i;?>]" size="45" readonly class="cajas"></td>
									  <td class="cajas"><input type="text" value="<?echo $filas_Z["cuenta"];?>" name="CtaBanco[<? echo $i;?>]"id="CtaBanco[<? echo $i;?>]" size="13" readonly class="cajas"></td>
                                      <td class="cajas"><input type="text" value="<?echo $filas_Z["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="45" readonly class="cajas"></td>

			            <tr>
			           <?
			           $i=$i+1;
			  endwhile;
		          ?>
		          <tr><td><br></td></tr>
		       <td colspan="5">
		          <input type="submit" value="Cerrar Pago" class="boton" ></td>
		       </table><?
      else:
		       ?>
		       <script language="javascript">
		            alert("No hay empresas activas por pago de primas, desde el <?echo $Desde;?> hasta el <?echo $Hasta;?>.")
		            history.back()
		       </script>
		       <?
      endif;
 endif;
 ?>
</body>
</html>
