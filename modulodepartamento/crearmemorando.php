<html>
        <head>
                <title>Agregar Memorando</title>
               <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
                <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                      function chequearcampos()
                    {
                        if (document.getElementById("ciudad").value.length <=0)
                        {
                            alert ("Digite la ciudad destino");
                            document.getElementById("ciudad").focus();
                            return;
                        }
                        if (document.getElementById("dirigida").value.length <=0)
                        {
                            alert ("Digite a quien va dirigida ?");
                            document.getElementById("dirigida").focus();
                            return;
                         }
                            if (document.getElementById("asunto").value.length <=0)
                            {
                            alert ("Digite el asunto del proceso disciplinario?");
                            document.getElementById("asunto").focus();
                            return;
                            }
                            if (document.getElementById("nota").value.length <=0)
                            {
                            alert ("Digite la descripcion del proceso?");
                            document.getElementById("nota").focus();
                            return;
                            }
                            if (document.getElementById("firma").value.length <=0)
                            {
                            alert ("Digite el nombre de quien firma el proceso");
                            document.getElementById("firma").focus();
                            return;
                            }
                            if (document.getElementById("cargo").value.length <=0)
                            {
                            alert ("Digite el cargo de la persona.?");
                            document.getElementById("cargo").focus();
                            return;
                            }
                            document.getElementById("matmemo").submit();

                    }
                </script>

        </head>
        <body>
         <script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimirmemorando.php?radicado=' + numero
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
                </script>
                <?
                        if (!isset($ciudad))
                        {
                                include("../conexion.php");
                ?>
                <center><h4><u>Proceso Disciplinario</u></h4></center>
                <form action="" method="post" id="matmemo">
                   <td><input type="hidden" name="codigo" value="<?echo $codigo;?>"> </td>
                        <table border="0" align="center">
                                <tr><td><br></td></tr>
                                <tr>
                                        <td><b>Fecha_Proceso:</b></td>
                                        <td><input type="text" name="fecha" value="<?echo date("Y-m-d");?>" size="10" maxlength="10" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="fecha"></td>
                                        <td><b>Ciudad:</b></td>
                                        <td><input type="text" name="ciudad" value="" size="20" mexlength="20" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="ciudad"></td>
                                       </tr>
                                       <tr>
                                        <td><b>Señor:</b></td>
                                        <td><input type="text" name="senor" value="" size="20" mexlength="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="senor"></td>
                                    <td><b>Empleado:</b></td>
                                   <td><select name="empleado" class="cajas">
                                      <option value="0">Seleccione un empleado
                                         <?
                                         $consulta_e="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple1,empleado.apemple from sucursal,zona,empleado,contrato
                                          where sucursal.codsucursal=zona.codsucursal and
                                          zona.codzona=empleado.codzona and
                                          empleado.codemple=contrato.codemple and
                                          contrato.fechater='0000-00-00' and
                                          sucursal.codsucursal='$codigo' order by nomemple";
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
                                    <td><input type="text" name="dirigida" value="" size="40" mexlength="40"class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="dirigida" ></td>
                                   </tr>
                                  <tr>
                                        <td><b>Remitente:</b></td>
                                        <td><input type="text" name="remitente" value="La Ciudad" size="25" mexlength="25"class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="remitente"></td>
                                        <td><b>Motivo</b></td>
                                        <td><input type="text" name="asunto" value="" size="40" mexlength="40"class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="asunto"></td>
                                </tr>
                                <tr>
                                  <td><b>Descripción:</b></td>
                                     <td colspan="5"><textarea name="nota" cols="95" rows="6" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nota"></textarea></td>
                                </tr>
                                <tr>
                                  <td><b>Firma:</b></td>
                                     <td><input type="text" name="firma" value="" size="40" mexlength="40"class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="firma"></td>
                                     <td><b>Cargo:</b></td>
                                   <td><input type="text" name="cargo" value="" size="40" mexlength="40" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="cargo"></td>
                                </tr>
                                <tr>
                                 <td><b>Empresa:</b></td>
                                        <td><input type="text" name="empresa" value="JGEFECTIVOS S.A.S." size="40" mexlength="40" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="empresa" readonly></td>
                                </tr>
                               <tr><td><br></td></tr>
                                <tr>
                                  <td colspan="6">
                                  <input type="button" Value="Guardar" class="boton" onClick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                </tr>
                        </table>

                </form>
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
                                          echo ("open (\"imprimirmemorando.php?radicado=$radicado\" ,\"\");");
                                          echo "open (\"../menudepartamento.php?op=memorando&codigo=$codigo\",\"contenido\");";
                                          echo ("</script>");

                        }
                 ?>
        </body>
</html>
