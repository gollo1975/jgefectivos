<html>

<head>
  <title>Consulta de Beneficiarios por Empleado</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($cedemple)):
     include("../conexion.php");
  ?>
  <center><h3>Consulta por Empleado</h3></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Documento:</b></td>
     <td><input type="text" name="cedemple" value="" size="15" maxlegth="15">
     </tr>
     <tr><td></td></tr>
      <tr><td></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
   <tr><td></td></tr>
    <tr><td></td></tr>
</table>

</form>
<?
elseif (empty($cedemple)):
?>
  <script language="javascript">
    alert ("Digite el documento del empleado ?")
    history.back()
  </script>
    <?
     else:
       include("../conexion.php");
     $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where cedemple='$cedemple'";
     $resultado=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resultado);
     if($registros!=0):
        $con="select empleado.cedemple from empleado,funeraria where empleado.cedemple=funeraria.cedemple and
              empleado.cedemple='$cedemple'";
        $res=mysql_query($con)or die("Consulta incorrecta uno");
        $reg=mysql_num_rows($resultado);
        $reg=mysql_affected_rows();
        if ($reg!=0):
           ?>
            <table border="0" align="center">
                <?
            while($filas=mysql_fetch_array($resultado)):
             ?>
             <tr>
              <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
               </tr>
              <?
            endwhile;
            ?>
            </table>
            <?
            include("../conexion.php");
             $consu="select funeraria.* from empleado,funeraria where
                empleado.cedemple=funeraria.cedemple and
                empleado.cedemple='$cedemple'";
             $resu=mysql_query($consu)or die("Consulta incorrecta dos");
             $registros=mysql_num_rows($resu);
             ?>
              <center><h3>Listado de Beneficiarios</h3></center>
              <table border="0" align="center">
               <tr  class="fondo">
                <td colspan="9"><br></td>
              </tr>
              <tr  class="cajas">
                  <th>Tipo Doc:</th>
                  <th>Ducumento:</th>
                  <th>Nombres</th>
                  <th>Parentezco</th>
                   <th>Fecha_Proceso</th>
              </tr>
              <?
               while($filas_s=mysql_fetch_array($resu)):
                ?>

              <tr  class="cajas">
                 <td><?echo $filas_s["tipo"];?></td>
                 <td><?echo $filas_s["documento"];?></td>
                 <td><?echo $filas_s["nombres"];?></td>
                 <td><?echo $filas_s["parentezco"];?></td>
                  <td><?echo $filas_s["fecha"];?></td>
               </tr>
              <?
              $suma=$suma+1;
            endwhile;
            ?>
            </table>
            <tr><td>&nbsp;</td></tr> 
            <center><td class="cajas"><b>Nro_Registro:</b>&nbsp;&nbsp;<?echo $suma?></td></center>
            <?
         else:
         ?>
           <script language="javascript">
             alert("Este empleado no tiene beneficiarios en el sistema ?")
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
</table>

</body>
</html>
