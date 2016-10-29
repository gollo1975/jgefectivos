<html>

<head>
<title>Modificar Incapacidad</title>
<LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
</head>
<body>
<?
if (!isset($opcion)):
?>
    <center><h4><u>Modificar Registro</u></h4></center>
  <form action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2" class="fondo"><br></td>
      </tr>
      <tr>
        <td><b>Tipo de Selección</b></td>
        <td><select name="opcion" class="cajas" id="opcion">
          <option value="0">Seleccióne Una Opción
          <option value="1">Nro_Incapacidad
          <option value="2">Documento
        </select></td>
      </tr>
      <tr>
        <td><b>Digite el Dato: </b></td>
         <td><input type="text" name="valor" value="" size="20" id="valor"></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar" class="boton">
           </td>
         </tr>
    </table>
    <br>
  </form>
  <?
elseif (empty($valor)):
   ?>
   <script language="javascript">
     alert("Debe de Digitar un valor a consultar")
     history.back()
   </script>
     <?
elseif (empty($opcion)):
   ?>
   <script language="javascript">
     alert("Debe de seleccionar una Opción")
     history.back()
   </script>
   <?
else:
    include("../conexion.php");
     $aux=$opcion;
     switch($aux)
       {
       case 1:
        $variable="select incapacidad.*,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.apemple,eps.*,tipoinca.* from incapacidad,empleado,eps,tipoinca where
                   empleado.cedemple=incapacidad.cedemple and
                    empleado.codeps=eps.codeps and
                    incapacidad.tipoinca=tipoinca.tipoinca and
                   incapacidad.nroinca='$valor'";
         break;
       case 2:
          $variable="select incapacidad.*,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.apemple,eps.*,tipoinca.* from incapacidad,empleado,eps,tipoinca where
                    empleado.cedemple=incapacidad.cedemple and
                    empleado.codeps=eps.codeps and
                     incapacidad.tipoinca=tipoinca.tipoinca and
                    empleado.cedemple='$valor' order by incapacidad.fechaini DESC";
         break;
       }
        $resultado=mysql_query($variable)or die("consulta incorrecta del selector");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El dato No existe en la BD.")
            history.back()
          </script>
         <?
         else:
         ?>
			 <center><h4><u>Datos de la Incapacidad</u></h4></center>
			 <table border="0" align="center">
			  <tr class="cajas">
				  <th>#</th>
				  <th>Nro_Inca.</th>
				  <th>Documento</th>
				  <th>Nombre 1</th>
				  <th>Nombre 2</th>
				  <th>Apellido 1</th>
				  <th>Apellido 2</th>
				  <th>F_Inicio</th>
				  <th>F_Final</th>
				  <th>Dias</th>
				  <th>D_Nómina</th>
				   <th>Reconocer</th>
				  <th>Descripción</th>
				  <th>Eps</th>
				  <th>Estado</th>
				</tr>
    		    
			    <? $a=1;
				 while($filas=mysql_fetch_array($resultado)):
				 ?>
				   <tr class="cajas">
					 <th><?echo $a;?></th>
					 <td><a href="detallado.php?nroinca=<?echo $filas["nroinca"];?>&valor=<?echo $valor;?>&opcion=<?echo $opcion;?>"> <?echo $filas["nroinca"];?></td>
					 <td><?echo $filas["cedemple"];?></td>
					 <td><?echo $filas["nomemple"];?></td>
					 <td><?echo $filas["nomemple1"];?></td>
					 <td><?echo $filas["apemple"];?></td>
					  <td><?echo $filas["apemple1"];?></td>
					 <td><?echo $filas["fechaini"];?></td>
					 <td><?echo $filas["fechater"];?></td>
					 <td><div align="center"><?echo $filas["dias"];?></div></td>
					  <td><div align="center"><?echo $filas["diasnomina"];?></div></td>
					 <td><div align="center"><?echo $filas["reconocerusuaria"];?></div></td>
					 <td><?echo $filas["concepto"];?></td>
					 <td><?echo $filas["eps"];?></td>
					 <td><?echo $filas["estado"];?></td>
					 </tr>
					<?
					$a=$a+1;
				  endwhile;
				  
			?>
			</table>
			<div align="center"><a href="modificar.php"><img src="../image/regresar.png" border="0" alt="Regresar al menu de consulta"></div>
           <?			
	   endif;
endif;
?>	
 </body>
</html>
