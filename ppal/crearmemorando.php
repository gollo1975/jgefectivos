<html>
        <head>
                <title>Agregar Memorando</title>
               <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">

        </head>
        <body>
         <script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimirmemo.php?radicado=' + numero
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
                </script>
                <?
                        if (!isset($ciudad))
                        {
                                include("../conexion.php");
                ?>
                <center><h4>Ingreso de Memorando</h4></center>
                <form action="" method="post">
                   <td><input type="hidden" name="codigo" value="<?echo $codigo;?>" </td>
                        <table border="0" align="center"
                                <tr><td><br></td></tr>
                                <tr>
                                        <td><b>Fecha_Proceso:</b></td>
                                        <td><input type="text" name="fecha" value="<?echo date("Y-m-d");?>" size="10" mexlength="10" class="cajas"></td>
                                        <td><b>Ciudad:</b></td>
                                        <td><input type="text" name="ciudad" value="" size="20" mexlength="20" class="cajas"></td>
                                       </tr>
                                       <tr>
                                        <td><b>Señor:</b></td>
                                        <td><input type="text" name="senor" value="" size="20" mexlength="15" class="cajas"></td>
                                    <td><b>Empleado:</b></td>
                                   <td><select name="empleado" class="cajas">
                                      <option value="0">Seleccione un empleado
                                         <?
                                         $consulta_e="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple1,empleado.apemple from zona,empleado,contrato
                                          where zona.codzona=empleado.codzona and
                                          empleado.codemple=contrato.codemple and
                                          contrato.fechater='0000-00-00' and
                                          zona.codzona='$codigo' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
                                         $resultado_e=mysql_query($consulta_e) or die("consulta Incorrecta");
                                          while ($filas_e=mysql_fetch_array($resultado_e))
                                            {
                                            ?>
                                            <option value="<?echo $filas_e["cedemple"];?>"><?echo $filas_e["nomemple"];?>&nbsp;<?echo $filas_e["nomemple1"];?>&nbsp;<?echo $filas_e["apemple"];?>&nbsp;<?echo $filas_e["apemple1"];?>
                                            <?
                                           }
                                          ?>
                                       </select></td>
                                    </tr>
                                   <tr>
                                     <td><b>Dirigida:</b></td>
                                    <td><input type="text" name="dirigida" value="" size="40" mexlength="40"class="cajas" ></td>
                                   </tr>
                                  <tr>
                                        <td><b>Remitente:</b></td>
                                        <td><input type="text" name="remitente" value="" size="25" mexlength="25"class="cajas"></td>
                                        <td><b>Motivo</b></td>
                                        <td><input type="text" name="asunto" value="" size="40" mexlength="40"class="cajas"></td>
                                </tr>
                                <tr>
                                  <td><b>Motivo:</b></td>
                                     <td colspan="5"><textarea name="nota" cols="100" rows="6" class="cajas"></textarea></td>
                                </tr>
                                <tr>
                                  <td><b>Firma:</b></td>
                                     <td><input type="text" name="firma" value="" size="40" mexlength="40"class="cajas"></td>
                                     <td><b>Cargo:</b></td>
                                   <td><input type="text" name="cargo" value="" size="40" mexlength="40" class="cajas"></td>
                                </tr>
                                <tr>
                                 <td><b>Empresa:</b></td>
                                        <td><input type="text" name="empresa" value="" size="40" mexlength="40" class="cajas"></td>
                                </tr>
                                                                <tr><td><br></td></tr>
                                <tr>
                                  <td colspan="6">
                                  <input type="submit" Value="Guardar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                </tr>
                        </table>

                </form>
                <?
                        }
                        elseif(empty($ciudad))
                        {
                ?>       <script language="javascript">
                           alert("Digite la  ciuda de Origen " )
                           history.back()
                         </script>
              <?
                      }
                        elseif(empty($dirigida))
                        {
                ?>
                          <script language="javascript">
                            alert("Digite el destinatario " )
                            history.back()
                          </script>
              <?
                      }
                        elseif(empty($remitente))
                        {
                ?>
                          <script language="javascript">
                             alert("Digite el remitente del memorando " )
                             history.back()
                          </script>
              <?
                      }
                        elseif(empty($asunto))
                        {
                ?>
                          <script language="javascript">
                            alert("Digite el asunto del memorando" )
                            history.back()
                          </script>
              <?
                      }
                        elseif(empty($nota))
                        {
                ?>
                          <script language="javascript">
                             alert("Digite el motivo " )
                             history.back()
                          </script>
              <?
                        }
                        elseif(empty($firma))
                        {
                ?>
                          <script language="javascript">
                             alert("Digite quien firma el memorando" )
                             history.back()
                          </script>
              <?
                      }
                        elseif(empty($cargo))
                        {
              ?>
                         <script language="javascript">
                           alert("Digite el cargo de la firma" )
                           history.back()
                                </script>
              <?
                        }
                         elseif(empty($empresa))
                        {
                ?>
                           <script language="javascript">
                              alert("Digite el nombre de la empresa de quien lo envia ?" )
                              history.back()
                           </script>
              <?
                        }
                        else
                        {
                                include("../conexion.php");
                                 $consulta = "select count(*) from memorando";
                                 $result = mysql_query ($consulta);
                                 $answ = mysql_fetch_row($result);
                                 $asunto=strtoupper($asunto);
                                    $ciudad=strtoupper($ciudad);
                                    $dirigida=strtoupper($dirigida);
                                    $firma=strtoupper($firma);
                                    $empresa=strtoupper($empresa);
                                 if ($answ[0] > 0):
                                    $consulta = "select max(cast(radicado as unsigned)) + 1 from memorando";
                                    $result2 = mysql_query($consulta);
                                    $codc = mysql_fetch_row($result2);
                                    $radicado= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
                                 else:
                                     $radicado="00001";
                                 endif;
                                     $cons="insert into memorando(radicado,fecha,ciudad,senor,cedemple,dirigida,remitente,asunto,nota,firma,cargo,empresa)
                                            values('$radicado','$fecha','$ciudad','$senor','$empleado','$dirigida','$remitente','$asunto','$nota','$firma','$cargo','$empresa')";
                                    $resul=mysql_query($cons) or die("Insercion incorrecta");
                                    $regis=mysql_affected_rows();
                                    echo ("<script language=\"javascript\">");
                                          echo ("open (\"imprimirmemo.php?radicado=$radicado\" ,\"\");");
                                          echo "open (\"../menuzona.php?op=memorando&codigo=$codigo\",\"contenido\");";
                                          echo ("</script>");

                        }
                 ?>
        </body>
</html>
