<html>
        <head>
                <title>Impresión de Memorando por Empleado</title>
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

        include("../conexion.php");
         $variable="select sucursal.dirsucursal,sucursal.telsucursal,sucursal.faxsucursal,musucursal,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,memorando.* from zona,sucursal,empleado,memorando where
                     sucursal.codsucursal=zona.codsucursal and
                      zona.codzona=empleado.codzona and
                     empleado.cedemple=memorando.cedemple and
                     memorando.radicado='$radicado'";
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
               <img src="../image/logotipo.png" border="0" width="110" heigth="110" cellpadding="0"cellspacing="0" >
                <tr>
                  <td class="cajas"><?echo $filas["ciudad"];?>&nbsp;<?echo $filas["fecha"];?></td>
                </tr>
                 <td><br></td>
                <td colspan="5"</td><td class="cajas">&nbsp;<?echo $filas["radicado"];?></td>
                </tr>
                 <tr>
                  <td><?echo $filas["senor"];?></td>
                 </tr>
                <tr>
                  <td><b><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></b>
                </tr>
                <tr>
                  <td><b><?echo $filas["dirigida"];?></b>
                </tr>
                <tr>
                  <td><b><?echo $filas["cedemple"];?></b>
                </tr>
                 <tr>
                  <td><?echo $filas["remitente"];?></td>
                </tr>
                 <tr>
                   <td><br></td>
                 </tr>
                  <table border="0" align="center" width="700">
                   <tr>
                    <td colspan="40"></td><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas["asunto"];?></b></td>
                    </tr>
                   </table>
                   <table border="0" align="center" width="700">
                    <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <tr>
                     <td colspan="0"><p align="justify"><?echo $filas["nota"];?></p></td>
                </tr>

                <table border="0" align="center" width="700">
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
                     <td>Atentamente,</td>
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
                   <td><br></td>
                  </tr>
                  <tr>
                     <td colspan="30"><?echo $filas["firma"];?></td>
                </tr>
                <tr>
                     <td colspan="30"><?echo $filas["cargo"];?></td>
                </tr>
                <tr>
                     <td colspan="30"><?echo $filas["empresa"];?></td>
                </tr>

                </table>
                </table>
               </table>
             <?
           endwhile;
      endif;
            ?>

                   </body>
</html>
