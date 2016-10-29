<html>

<head>
  <title>Listado de Empleados</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
    function ActualizarSaldo()
         {
         var totalitem = 0
         var pagado = 0
         var totalitem =  document.getElementById("tActualizaciones").value
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
include("../conexion.php");
?>
<div align="center"><b><u><h4>Centro de Nomina</h4></u></b></div>
<form action="ActualizarDatos.php" name="f1"  method="post" id"f1">
  <input type="hidden" name="Zona" value="<?echo $Zona;?>">
  <table border="0" align="center">
	    <tr>
	      <td class="cajas"><b>Cód_Zona:</b>&nbsp;<? echo $CodZona;?></td>
	    </tr>
	    <tr>
	      <td class="cajas"><b>Zona:</b>&nbsp;<? echo $Zona;?></td>
	    </tr>
        <tr>
        <td><b>Auxilio:</b>
             <select name="CodUnico" class="cajas">
                  <?
                  $consulta="select codsala,desala from salario where salario.formapago='DIAS'";
                   $resultado=mysql_query($consulta)or die ("consulta incorrecta");
                    while($filas=mysql_fetch_array($resultado)){?>
                        <option value="<?echo $filas["codsala"];?>"> <?echo $filas["desala"];?>
                       <?
                    }
                       ?>
              </select></td>
        </tr>
   </table>
   <?
   $con="select empleado.cedemple,concat(empleado.nomemple, ' ' ,empleado.nomemple1) as Nombres,concat(empleado.apemple, ' ' ,empleado.apemple1) as Apellidos,contrato.fechainic,contrato.salario from empleado, zona, contrato
      where zona.codzona=empleado.codzona and
      empleado.codemple=contrato.codemple and
      zona.codzona='$CodZona' and
      contrato.fechater='0000-00-00' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
   $Re=mysql_query($con)or die("Error en la busqueda de Empleados");
   $regis=mysql_num_rows($Re);
  if($regis==0):
    ?>
    <script language="javascript">
       alert("No hay empleados activos en esta zona")
       history.back()
    </script>
    <?
else:
    ?>
          <table border="0" align="center">
             <tr class="cajas">
		       <th>Item</th><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Documento</b></th><th><b>Empleado</b></th><th><b>Fecha_Ing</b></th> <th><b>Salario</b></th>
		  </tr>
	   <?
           $i=1;
           echo ("<input type=\"hidden\" id=\"TotalV\" name=\"TotalV\" value=\"" . mysql_num_rows($Re) . "\">");
	  while($filas=mysql_fetch_array($Re)):
             $aux=number_format($filas["salario"],0);
	      ?>
              <tr  class="cajas">
	             <th><?echo $i;?></th><?
	                 echo ("<td><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $filas['cedemple'] ."\"></td>");?>
	                  <td class="cajas"><?echo $filas["cedemple"];?></td>
	                  <td class="cajas"><?echo $filas["Nombres"];?>&nbsp;<?echo $filas["Apellidos"];?></td>
	                  <td><div align="center"><?echo $filas["fechainic"];?></div></td>
	                 <td><div align="right">$<?echo $aux;?></div></td>
	           </tr>
	      <?
               $i=$i+1;
	  endwhile;
          $regis=$regis-$Con;
           echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . $regis . "\">");
	  ?>
           <tr><td><br></td></tr>
                <td colspan="5">
	          <input type="submit" value="Actualizar" class="boton" name="actualizar" id="actualizar" ></td>
	  </table>
        </form>
	  <?
	 endif;
?>
</body>

</html>
