<html>

<head>
<title>incapacidades</title>
 <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
</head>
<body>
<?
if (!isset($cedula)):
?>
<center><h4>Incapacidades</h4></center>
  <form action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2"></td>
      </tr>
      <tr><td><br></td></tr>
       <tr>
        <td><b>Documento Empleado:<b></td>
         <td><input type="text" name="cedula" value="" size="15" maxlength="15"></td>
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
elseif (empty($cedula)):
   ?>
   <script language="javascript">
     alert("Debe de Digitar un valor a consultar")
     history.back()
   </script>
   <?
   else:
     include("../conexion.php");
       $vari="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,eps.eps from eps,empleado
                 where empleado.codeps=eps.codeps and
                    empleado.cedemple='$cedula'";
         $result=mysql_query($vari)or die("consulta incorrecta");
        $filas_s=mysql_fetch_array($result);
        ?>
           <table border="0" align="center">
           <tr>
            <td class="cajas"><b>Cedula:&nbsp;</b><?echo $filas_s["cedemple"];?></td> </tr>
            <tr>
            <td class="cajas"><b>Empleado:&nbsp;</b><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
           </tr>
             <tr>
            <td class="cajas"><b>Eps:&nbsp;</b><?echo $filas_s["eps"];?></td> </tr>
           </table>
           <?
           $nombre=$filas_s["nomemple"];
           $apellido=$filas_s["apemple"];
           $variable="select incapacidad.*,tipoinca.concepto,eps.eps,control.concepto as Diagnostico from incapacidad,empleado,eps,tipoinca,control where
                    empleado.cedemple=incapacidad.cedemple and
                    empleado.codeps=eps.codeps and
                     incapacidad.tipoinca=tipoinca.tipoinca and
					 incapacidad.codigo=control.codigo and
                    empleado.cedemple='$cedula' order by incapacidad.fechaini DESC";
        $resultado=mysql_query($variable)or die("consulta incorrecta");
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
         <center><h4>Datos de la Incapacidad</h4></center>
         <table border="0" align="center">
           <tr><td class="cajas">Para ver el diagnóstico de la incapacidad, presione Click en el Nro_Incapacidad..</td></tr>
         </table>
         <table border="0" align="center">
          <tr class="cajas">
		       <th>#</th>
              <th>Nro_Incapacidad</th>
              <th>F_Inicio</th>
              <th>F_Término</th>
              <th>F_Proceso</th>    
              <th>Dias</th>
              <th>Descripción</th>
			  <th>Código</th>
			  <th>Diagnostico</th>
              <th>Estado</th>
              </tr>
              <? $a=1;
             while($filas_s=mysql_fetch_array($resultado)):
             ?>
               <tr class="cajas">
                  <th><?echo $a;?></th>
                 <td><a href="auxiliar.php?nro=<?echo $filas_s["nroinca"];?>&nombre=<?echo $nombre;?>&apellido=<?echo $apellido;?>"><?echo $filas_s["nroinca"];?></a></td>
                 <td><?echo $filas_s["fechaini"];?></td>
                 <td><?echo $filas_s["fechater"];?></td>
                 <td><?echo $filas_s["fechapro"];?></td>
                 <td><?echo $filas_s["dias"];?></td>
                 <td><?echo $filas_s["concepto"];?></td>
				 <td><?echo $filas_s["codigo"];?></td>
				 <td><?echo $filas_s["Diagnostico"];?></td>
                 <td><?echo $filas_s["estado"];?></td>
                 </tr>
                <? $a=$a+1;
              endwhile;
              ?>
              </table>
               <td><center><a href="imprimir1.php?cedula=<?echo $cedula;?>" target="_blank" onClick="volver()" class="fondo">Imprimir</a></center></td>
               <?
           endif;
         endif;
         ?>

        </table>
       </body>
  </html>
