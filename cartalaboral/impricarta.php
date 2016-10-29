<?
 session_start();
?>
<html>
        <head>
                <title>Impresión de carta laboral</title>
              <LINK  REL="stylesheet" HREF="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
        <body onload="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
               <?
if(session_is_registered("xsession")):
  include("../conexion.php");
  if($auxFirma!=''):
      $variable="select sucursal.sucursal,maestro.dirmaestro,maestro.telmaestro,maestro.faxmaestro,municipio.municipio,empleado.cedemple,empleado.nomemple,empleado.apemple,carta.* from municipio,maestro,zona,sucursal,empleado,carta where
                     maestro.codmaestro=sucursal.codmaestro and
                    maestro.codmuni=municipio.codmuni and
                        sucursal.codsucursal=zona.codsucursal and
                      zona.codzona=empleado.codzona and
                     empleado.cedemple=carta.cedemple and
                    carta.codigo='$codigo'";
      $resultado=mysql_query($variable)or die("consulta incorrecta uno");
      $registro=mysql_num_rows($resultado);
      if ($registro==0):
          ?>
          <script language="javascript">
            alert("El Radicado no existe en la b.d.")
            history.back()
          </script>
         <?
        else:
            while ($filas=mysql_fetch_array($resultado)):
             ?>
               <table border="0" align="center" width="710">
                 <td colspan="50"</td><td class="cajas">&nbsp;<?echo $filas["sucursal"];?>&nbsp;<?echo $filas["codigo"];?></td>
                 </tr>
                <tr>
                 <td>&nbsp;</td>
                </tr>
                 <tr>
                 <td>&nbsp;</td>
                </tr>

                 <tr>
                 <td>&nbsp;</td>
                </tr>
                <tr>
                 <td>&nbsp;</td>
                </tr>
                <tr>
                 <td>&nbsp;</td>
                </tr>
                 <tr>
                 <td>&nbsp;</td>
                </tr>
                <tr>
                 <td>&nbsp;</td>
                </tr>
               <tr>
                  <td colspan="100"><b><div align="center"><?echo $filas["asunto"];?></div></b></td>
                </tr>
                  <tr>
                 <td>&nbsp;</td>
                </tr>
                 <tr>
                 <td>&nbsp;</td>
                </tr>
                 <tr>
                 <td>&nbsp;</td>
                </tr>
                 <tr>
                 <td>&nbsp;</td>
                </tr>
                     <tr>
                  <td colspan="100"><b><div align="center"><?echo $filas["registro"];?></div></b></td>
                </tr>
                  <table border="0" align="center" width="710">
                  <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <td colspan="100"><p align="justify"><?echo $filas["nota"];?></p></td>
                  <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                    <tr>
                     <td colspan="100">Firmada el&nbsp;<?echo $filas["fecha"];?>, a los interesados.</td>
                   <tr>
                   <td>&nbsp;</td>
                  </tr>
                    <tr>
                   <td>&nbsp;</td>
                    </tr>
                   <tr>
                   <td><b><? echo "<img src=\"../image/firmaWalter.PNG\"/border=\"0\"/widht=\"90\"/height=\"140\"/>"?></b></td>
                <tr>
                  <tr>
                   <td colspan="100"><?echo $filas["firma"];?></td>
                <tr>
                     <td colspan="100"><?echo $filas["cargo"];?></td>
                </tr>
                <tr>
                     <td colspan="100"><?echo $filas["empresa"];?></td>
                </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                   <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                     <tr>
                   <td>&nbsp;</td>
                   </tr>
                   </tr>

                    <tr>
                    <td colspan="100" class="cajas"><div align="center">ANTIOQUIA-&nbsp;<?echo $filas["municipio"];?>&nbsp;&nbsp;<?echo $filas["dirmaestro"];?>&nbsp;&nbsp; PBX:&nbsp;<?echo $filas["telmaestro"];?>&nbsp;FAX:&nbsp;<?echo $filas["faxmaestro"];?></div></td>
                   </tr>
                   <tr>
                   <td colspan="25"><div align="center">www.coopiser.com</div></td>
                   </tr>
                </table>
               </table>
             <?
           endwhile;
      endif;
  else:
     $variable="select sucursal.sucursal,maestro.dirmaestro,maestro.telmaestro,maestro.faxmaestro,municipio.municipio,empleado.cedemple,empleado.nomemple,empleado.apemple,carta.* from municipio,maestro,zona,sucursal,empleado,carta where
                     maestro.codmaestro=sucursal.codmaestro and
                     municipio.codmuni=maestro.codmuni and   
                     sucursal.codsucursal=zona.codsucursal and
                     zona.codzona=empleado.codzona and
                     empleado.cedemple=carta.cedemple and
                    carta.codigo='$codigo'";
      $resultado=mysql_query($variable)or die("consulta incorrecta dos");
      $registro=mysql_num_rows($resultado);
      if ($registro==0):
          ?>
          <script language="javascript">
            alert("El Radicado no existe en la b.d.")
            history.back()
          </script>
         <?
        else:
            while ($filas=mysql_fetch_array($resultado)):
             ?>
               <table border="0" align="center" width="710">
                 <td colspan="50"</td><td class="cajas">&nbsp;<?echo $filas["sucursal"];?>&nbsp;<?echo $filas["codigo"];?></td>
                 </tr>
                <tr>
                 <td>&nbsp;</td>
                </tr>
                 <tr>
                 <td>&nbsp;</td>
                </tr>

                 <tr>
                 <td>&nbsp;</td>
                </tr>
                <tr>
                 <td>&nbsp;</td>
                </tr>
                <tr>
                 <td>&nbsp;</td>
                </tr>
                 <tr>
                 <td>&nbsp;</td>
                </tr>
                <tr>
                 <td>&nbsp;</td>
                </tr>
               <tr>
                  <td colspan="100"><b><div align="center"><?echo $filas["asunto"];?></div></b></td>
                </tr>
                  <tr>
                 <td>&nbsp;</td>
                </tr>
                 <tr>
                 <td>&nbsp;</td>
                </tr>
                 <tr>
                 <td>&nbsp;</td>
                </tr>
                 <tr>
                 <td>&nbsp;</td>
                </tr>
                     <tr>
                  <td colspan="100"><b><div align="center"><?echo $filas["registro"];?></div></b></td>
                </tr>
                  <table border="0" align="center" width="710">
                  <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <td colspan="100"><p align="justify"><?echo $filas["nota"];?></p></td>
                  <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                    <tr>
                     <td colspan="100">Firmada el&nbsp;<?echo $filas["fecha"];?>, a los interesados.</td>
                   <tr>
                   <td>&nbsp;</td>
                  </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                     <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  <tr>
                   <td colspan="100"><?echo $filas["firma"];?></td>
                <tr>
                     <td colspan="100"><?echo $filas["cargo"];?></td>
                </tr>
                <tr>
                     <td colspan="100"><?echo $filas["empresa"];?></td>
                </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                   <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                     <tr>
                   <td>&nbsp;</td>
                   </tr>

                        <tr>
                   <td>&nbsp;</td>
                   </tr>

                    <tr>
                    <td colspan="100" class="cajas"><div align="center">ANTIOQUIA-&nbsp;<?echo $filas["municipio"];?>&nbsp;&nbsp;<?echo $filas["dirmaestro"];?>&nbsp;&nbsp; PBX:&nbsp;<?echo $filas["telmaestro"];?>&nbsp;FAX:&nbsp;<?echo $filas["faxmaestro"];?></div></td>
                   </tr>
                   <tr>
                   <td colspan="25"><div align="center">www.coopiser.com</div></td>
                   </tr>
                </table>
               </table>
             <?
           endwhile;
      endif;
   endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
            ?>

                   </body>
</html>
