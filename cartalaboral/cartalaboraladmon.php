<html>

<head>
  <title>Consulta carta laboral</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
   if (!isset($dato)):
  ?>
  <center><h4><u>Carta Laboral</u></h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Documento de Identidad:</b></td>
     <td><input type="text" name="dato" value="" size="15" maxlegth="15">
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
elseif (empty($dato)):
?>
  <script language="javascript">
    alert ("Digite el documento de identidad. ?")
    history.back()
  </script>
  <?
     else:
      include("../conexion.php");
                $consu="select carta.* from carta,empleado
                  where empleado.cedemple=carta.cedemple and
                      empleado.cedemple='$dato' order by carta.codigo DESC";
                       $resu=mysql_query($consu)or die("Consulta incorrecta cartas");
                       $regis=mysql_num_rows($resu);
                       if($regis!=0):
                                       ?>
                                      <center><h4><u>Carta Laborales</u></h45></center>
                                      <tr><td>&nbsp;</td></tr>
                                      <table border="0" align="center">
                                       <tr><td><br></td></tr>
                                      <tr>
                                          <th>Item</th>
                                          <th>Radicado</th>
                                          <th>F_Proceso</th>
                                          <th>Firma</th>
                                          <th>Cargo</th>
                                      </tr>
                                      <?$a=1;
                                       while($filas_s=mysql_fetch_array($resu)):
                                       $Variable=$filas_s["tipoempleado"];
                                        ?>

                                      <tr  class="cajas">
                                          <th><?echo $a;?></th>
                                          <?if($Variable==''){?>
                                                <td><a href="cartalaboralpdf.php?Radicado=<?echo $filas_s["codigo"];?>"><?echo $filas_s["codigo"];?></a></td>
                                          <?}else{?>
                                                 <td><a href="NuevaCartaLaboralpdf.php?Radicado=<?echo $filas_s["codigo"];?>"><?echo $filas_s["codigo"];?></a></td>
                                          <?}?>       
                                         <td><?echo $filas_s["fecha"];?></td>
                                         <td><?echo $filas_s["firma"];?></td>
                                         <td><?echo $filas_s["cargo"];?></td>
                                      </tr>
                                      <?
                                      $a=$a+1;
                                    endwhile;
                                    ?>
                                    </table>

                                    <?
                         else:
                                 ?>
                                   <script language="javascript">
                                     alert("Este empleado no tiene certificaci�n de  trabajo ?")
                                     history.back()
                                     </script>
                                  <?
                         endif;
   endif;
 ?>
</table>

</body>
</html>