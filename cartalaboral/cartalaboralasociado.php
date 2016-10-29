<html>

<head>
  <title>Consulta carta laboral</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
     include("../conexion.php");
                $consu="select carta.* from carta,empleado
                  where empleado.cedemple=carta.cedemple and
                      empleado.cedemple='$xcodigo'";
                       $resu=mysql_query($consu)or die("Consulta incorrecta cartas");
                       $regis=mysql_num_rows($resu);
                       if($regis!=0):
                                       ?>
                                      <center><h4><u>Certificado Laboral</u></h4></center>
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
                                        ?>

                                      <tr  class="cajas">
                                          <th><?echo $a;?></th>
                                         <td><a href="cartalaboralpdf.php?Radicado=<?echo $filas_s["codigo"];?>"><?echo $filas_s["codigo"];?></a></td>
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
                                     alert("Este empleado no tiene certificación de  trabajo ?")
                                     history.back()
                                     </script>
                                  <?
                         endif;

 ?>
</table>

</body>
</html>
