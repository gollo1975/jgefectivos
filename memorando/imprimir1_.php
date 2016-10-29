<html>
        <head>
                <title>Impresión de Memorando</title>
              <LINK  REL="stylesheet" HREF="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
        <body onLoad="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
               <?

        include("../conexion.php");
         $variable="select maestro.web,maestro.dirmaestro,maestro.telmaestro,sucursal.dirsucursal,sucursal.telsucursal,sucursal.faxsucursal,sucursal.codmuni as codigo,sucursal.sucursal,municipio.municipio,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,memorando.* from municipio,zona,sucursal,empleado,memorando,maestro
          where      maestro.codmaestro=sucursal.codmaestro and
                     sucursal.codsucursal=zona.codsucursal and
                     zona.codzona=empleado.codzona and
                     empleado.cedemple=memorando.cedemple and
                     memorando.codmuni=municipio.codmuni and
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

               <table align="center" width="700">
               
               <tr><td width="118"><br></td></tr>
               <tr>
                  <td colspan="30" rowspan="8" class="cajas"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    
                    <tr>
                      <td width="125" rowspan="4" valign="top" style="border-top: 1px solid; border-left: 1px solid; border-bottom: 1px solid;border-right: 1px solid;"><img src="../image/logounico.png" border="0" heigth="120" width="120"></td>
                      <td width="376" height="22" align="center" style="border-top: 1px solid; border-right: 1px solid; font-family:verdana; font-size:8pt"><b>Grupo Empresarial</b> </td>
					  <td width="186" rowspan="2" style="border-top: 1px solid; border-right: 1px solid;font-family:verdana; font-size:8pt">C&oacute;digo: REG GH PD 05</td>
                    </tr>
                    <tr>
                      <td height="22" align="center"  style="border-right: 1px solid;font-family:verdana; font-size:9pt"><b>JGEFECTIVOS S.A.S &quot;E.S.T.</b>&quot; </td>
				    </tr>
                    
                    <tr>
                      <th height="44" bgcolor="#c4c4c4" style="border-top: 1px solid; border-right: 1px solid; border-bottom: 1px solid;"><b>PROCESOS DISCIPLINARIOS</b></th>
					  <td style="border-top: 1px solid; border-right: 1px solid; font-family:verdana; font-size:8pt">Actualizaci&oacute;n: Enero 2013</td>
                    </tr>
                    
                    <tr>
                      <td height="44" align="center"  style="border-right: 1px solid; border-bottom: 1px solid;font-family:verdana; font-size:9pt">Regimen Organizacional Interno </td>
                      <td style="border-top: 1px solid; border-right: 1px solid; border-bottom: 1px solid;font-family:verdana; font-size:8pt">Version: 2 </td>
                    </tr>
                    
                  </table></td><td width="1" class="cajas">&nbsp;</td>
                </tr>
               <tr>
                 <td class="cajas">&nbsp;</td>
               </tr>
               <tr>
                 <td class="cajas"></td>
               </tr>
               <tr>
                 <td class="cajas">&nbsp;</td>
               </tr>
               <tr>
                 <td class="cajas">&nbsp;</td>
               </tr>
               <tr>
                 <td class="cajas">&nbsp;</td>
               </tr>
               <tr>
                 <td class="cajas">&nbsp;</td>
               </tr>
               <tr>
                 <td class="cajas">&nbsp;</td>
               </tr>
                <tr>
                  <td class="cajas" colspan="20"><?echo $filas["municipio"];?>&nbsp;<?echo $filas["fecha"];?></td><td class="cajas">&nbsp;</td>
                  <td class="cajas" colspan="40"><div align="center"></div></td>
                </tr>
                 <td><br></td>
                <td width="219">
                <td colspan="20">
                <td width="4"></td><td width="124" class="cajas"><b>
                  <div align="center">Rad.:</b>&nbsp;<?echo $filas["radicado"];?></div></td>
                </tr>
                 <tr>
                  <td><?echo $filas["senor"];?></td>
                 </tr>
                <tr class="cajas">
                 <td><b><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></b>                </tr>
                <tr class="cajas">
                 <td><b><?echo $filas["dirigida"];?></b>                </tr>
                <tr class="cajas">
                  <td><b><?echo $filas["cedemple"];?></b>                </tr>
                 <tr class="cajas">
                  <td><?echo $filas["remitente"];?></td>
                </tr>
                <tr class="cajas">
                 <td>&nbsp;</td>
               </tr>
                 
                  <table border="0" align="center" width="700">
                   <tr class="cajas">
                    <td colspan="40"><b> <div align="center"><?echo $filas["asunto"];?></div></b></td>
                    </tr>
                 </table>
                   <table border="0" align="center" width="700">
                    <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <tr>
                     <td colspan="0" style="font-family:verdana; font-size:9pt"><p align="justify"><?echo $filas["nota"];?></p></td>
                </tr>

                <table border="0" align="center" width="700">
                    <tr>
                  <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                     <tr class="cajas">
                     <td>Atentamente,</td>
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
                  <tr class="cajas">
                     <td colspan="30"><?echo $filas["firma"];?></td>
                </tr>
                <tr class="cajas">
                     <td colspan="30"><?echo $filas["cargo"];?></td>
                </tr>
                <tr class="cajas">
                     <td colspan="30"><?echo $filas["empresa"];?></td>
                </tr>
                <tr class="cajas">
                     <td colspan="30"><b>PBX:&nbsp;</b><?echo $filas["telmaestro"];?></td>
                </tr>
                <tr class="cajas">
                     <td colspan="30"><b>Dir.:&nbsp;</b><?echo $filas["dirmaestro"];?></td>
                </tr>
                  <tr class="cajas">
                     <td colspan="30"><b>Web.:&nbsp;</b><?echo $filas["web"];?></td>
                </tr>
                </table>
                </table>
        </table>
             <?
           endwhile;
      endif;
            ?>
			<table  border="0" align="center" width="700">
			<tr><td colspan="20"><hr></td></tr>
			<tr><td colspan="20">&nbsp;</td></tr>
			<tr><td colspan="20">&nbsp;</td></tr>
				 <tr><td colspan="20"  style="font-family:verdana; font-size:7pt">Este Documento es de confidencialidad alta.</td></tr>
				 <tr><td colspan="20" style="font-family:verdana; font-size:7pt">Solo puede ser manipulado y modificado por este Departamento</td></tr>
			</table>

</body>
</html>
