<html>
<head>
  <title>Pago de Incapacidad</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

</head>
<body>
<?
if(!isset($cedula)):
?>
   <center><h4><u>Pagar Incapacidad</u></h4></center>
   <form action="" method="post" width="200">
     <table border="0" align="center">
     <tr><td><br></td></tr>
       <tr>
          <td><b>Documento de Identidad:<b></td>
         <td><input type="text" name="cedula" value="" size="15" maxlength="15"></td>
        </tr>
        <tr><td><br></td></tr>
       <tr>
          <td colspan="5">
          <input type="submit" value="Buscar Bato" class="boton"></td>
       </tr>
     </table>
   </form>
<?
elseif(empty($cedula)):
  ?>
  <script language="javascript">
    alert("Debe de Digitar el Documento de Indentidad ?")
    history.back()
  </script>
  <?
else:
   include("../conexion.php");
   $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where empleado.cedemple='$cedula'";
    $resulta=mysql_query($consulta)or die ("Error de Consulta");
    $regi=mysql_num_rows($resulta);
    if($regi!=0):
       while($filas_s=mysql_fetch_array($resulta)):
         ?>
         <tr>
           <center><td><b><? echo $filas_s["nomemple"];?>&nbsp;<? echo $filas_s["nomemple1"];?>&nbsp;<? echo $filas_s["apemple"];?>&nbsp;<? echo $filas_s["apemple1"];?></b></td></center>
         </tr>
         <?
       endwhile;
       $cons="select incapacidad.*,tipoinca.concepto,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1
       from incapacidad,empleado,tipoinca
       where empleado.cedemple=incapacidad.cedemple and
       tipoinca.tipoinca=incapacidad.tipoinca and
       empleado.cedemple='$cedula'";
       $resu=mysql_query($cons)or die ("Error de Consulta");
       $reg=mysql_num_rows($resu);
       if($reg!=0):
       ?>
          <center><h4>Listado de Incapacidades</h4></center>
          <table border="0" align="center">
            <tr class="cajas">
              <td>Presione Click, en el Nro_Incapacidad para procesar el Pago..</td>
            </tr>
          </table>
          <tr><td><br></td></tr>
          <table border="0" align="center">
           <tr class="cajas">
             <th>Item</th>
             <th>Nro_Incap.</th>
             <th>F_Inicio</th>
             <th>F_Final</th>
             <th>Dias</th>
             <th>Pagada</th>

           </tr>
         <?
          $a=1;
          while($filas=mysql_fetch_array($resu)):
            ?>
            <tr class="cajas">
              <th><?echo $a;?></th>
              <td><a href="detalladopagar.php?codigo=<?echo $filas["nroinca"];?>"><?echo $filas["nroinca"];?></a></td>
              <td><?echo $filas["fechaini"];?></td>
              <td><?echo $filas["fechater"];?></td>
              <td><?echo $filas["dias"];?></td>
              <td><?echo $filas["pagada"];?></td>
            </tr>
            <?                 $a=$a+1;
          endwhile;
          ?>
          </table>
          <?
        else:
          ?>
         <script language="javascript">
           alert("No hay incapacidades en el Sistema para este Empleado ?")
           history.back()
         </script>
      <?
        endif;
    else:
      ?>
      <script language="javascript">
       alert("El documento no existe en la base de datos ?")
       history.back()
     </script>
      <?
    endif;
 endif;
 ?>
</body>
</html>
