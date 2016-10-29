    <html>
        <head>
                <title>Modificacion de Empleados</title>
                <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
                <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                    function Calculo()
                       {
                       var Suma = 0
                       var AuxS = 0
                       var AuxS = document.getElementById("salario").value;
                       if (document.getElementById("periodo").value=='SEMANAL')
                         {
                         Suma=(AuxS/30)* 7
                         document.getElementById("base").value=Suma.toFixed(0);
                       }
                       if (document.getElementById("periodo").value=='DECADAL')
                         {
                         Suma=(AuxS/30)* 10
                         document.getElementById("base").value=Suma.toFixed(0);
                       }
                       if (document.getElementById("periodo").value=='CATORCENAL')
                         {
                         Suma=(AuxS/30)* 14
                         document.getElementById("base").value=Suma.toFixed(0);
                       }
                       if (document.getElementById("periodo").value=='QUINCENAL')
                         {
                         Suma=(AuxS/30)* 15
                         document.getElementById("base").value=Suma.toFixed(0);
                       }
                       if (document.getElementById("periodo").value=='MENSUAL')
                         {
                         Suma=(AuxS/30)* 30
                         document.getElementById("base").value=Suma.toFixed(0);
                       }
                     }  
                 </script>

        </head>
        <body>
        <?
                if (!isset($cedemple))
                {
        ?>
                          <center><h4><u>Modificar Datos</u> </h4></center>
                           <form action="" method="post" id="f1" name="f1">
                                <table border="0" align="center">
                                  <tr><td><br></td></tr> 
                                 <tr>
                                                <td><b>Digite el Documento:</b></td>
                                                <td><input type="text" name="cedemple" value="" size="15" maxleng="15"></td>
                                        </tr>
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td colspan="2"><input type="submit" Value="Buscar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></th>
                                        </tr>
                                </table>
                                  
                        </form>
        <?
                }
                elseif (empty($cedemple))
                {
        ?>
                        <script language="javascript">
                                alert("Digite un Valor a Buscar")
                                history.back()
                        </script>

              <?
                }
                else
                {
                        include("../conexion.php");
                        $consulta="select empleado.*,banco.bancos,zona.codzona,zona.zona,costo.centro from empleado,banco,zona,eps,pension,costo,municipio where
                        empleado.codbanco=banco.codbanco and
                        empleado.codzona=zona.codzona and
                        empleado.codeps=eps.codeps and
                        empleado.codpension=pension.codpension and
                        empleado.codmuni=municipio.codmuni and
                        empleado.codcosto=costo.codcosto and empleado.cedemple='$cedemple'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
        ?>
                                <script language="javascript">
                                        alert("No Existen Registros")
                                        history.back()
                                </script>
        <?
                        }
                        else
                        {
                                while ($filas=mysql_fetch_array($resultado))
                                {
									
        ?>
                                             <center><h4><u>Datos del Empleado</u></h4></center>
                                             <form action="guardar.php" method="post" width="350">
                                             <input type="hidden"  value="<?echo $filas["codemple"];?>" name="codemple">
					     <input type="hidden"  value="<?echo $filas["codcosto"];?>" name="CodAnterior">
                                                <table border="0" align="center">
                                                          <tr>
			                                        <td><b>Documento:</b></td>
			                                        <td colspan="1"><input type="text" name="cedemple" value="<?echo $filas["cedemple"];?>" size="25"  class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
			                                        <td><b>Tipo_Doc.:</b></td>
			                                          <td><select name="TipoD" class="cajasletra" style="width: 258px" id="TipoD">
			                                          <option value="<?echo $filas["tipod"];?>" selected><?echo $filas["tipod"];?>
			                                                <option value="CC">Cédula Ciudadania
			                                                <option value="TI">Tarjeta Identidad
			                                                <option value="CE">Cédula Extranjeria
			                                                <option value="PS">Pasaporte
			                                       </select></td>
                                                            </tr>
                                                               <tr>
                                                                        <td><b>Nombre 1:</b></td>
                                                                        <td><input type="text" name="nomemple" value="<?echo $filas["nomemple"];?>" class="cajas" size="25" class="cajas"maxlength="25"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nomemple"></td>
                                                                        <td><b>Nombre 2:</b></td>
                                                                        <td><input type="text" name="nomemple1" value="<?echo $filas["nomemple1"];?>" class="cajas" size="40" class="cajas"maxlength="25" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nomemple1"></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>Apellido 1:</b></td>
                                                                        <td><input type="text" name="apemple" value="<?echo $filas["apemple"];?>" class="cajas" size="25"class="cajas" maxlength="25" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="apemple"></td>
                                                                        <td><b>Apellido 2:</b></td>
                                                                        <td><input type="text" name="apemple1" value="<?echo $filas["apemple1"];?>" class="cajas" size="40"class="cajas" maxlength="25" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="apemple1"></td>
                                                                </tr>
                                                               <tr>
                                                                        <td><b>Teléfono:</b></td>
                                                                        <td><input type="text" name="telemple" value="<?echo $filas["telemple"];?>" class="cajas" size="25" class="cajas"maxlength="7" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telemple"></td>
                                                                        <td><b>Dirección:</b></td>
                                                                        <td><input type="text" name="diremple" value="<?echo $filas["diremple"];?>" class="cajas" size="40"class="cajas" maxlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="diremple"></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>Municipio:</b></td>
                                                                        <td colspan="10"><select name="codmunicipio"class="cajas" style="width: 528px" id="codmunicipio">
                                                                                        <?
                                                                                                $aux=$filas["codmuni"];
                                                                                                $consulta_c="select codmuni,municipio from municipio order by municipio";
                                                                                                $resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
                                                                                                while ($filas_c=mysql_fetch_array($resultado_c))
                                                                                                {
                                                                                                        if($aux==$filas_c["codmuni"])
                                                                                                        {
                                                                                        ?>
                                                                                                                <option value="<?echo $filas_c["codmuni"];?>" selected><?echo $filas_c["municipio"];?>
                                                                                        <?
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                        ?>
                                                                                                                <option value="<?echo $filas_c["codmuni"];?>"><?echo $filas_c["municipio"];?>
                                                                                        <?
                                                                                                        }
                                                                                                }
                                                                                        ?>
                                                                                </select></td>
									</tr>
									<tr>
                                                                           <td><b>Barrio:</b></td>
                                                                          <td><input type="text" name="municipio" value="<?echo $filas["municipio"];?>" class="cajas" size="25" class="cajas"maxlength="30" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="municipio"></td>
                                                                          <td><b>Celular:</b></td>
                                                                          <td><input type="text" name="celular" value="<?echo $filas["celular"];?>" class="cajas" size="40" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="celular"></td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td><b>Sexo:</b></td>
                                                                        <td><select name="sexo" class="cajas"  style="width: 170px" id="sexo">
                                                                                <option value="<?echo $filas["sexo"];?>" selected><?echo $filas["sexo"];?>
                                                                                <option value="MASCULINO">MASCULINO
                                                                                <option value="FEMENINO">FEMENINO
                                                                            </select></td>
                                                                        <td><b>Fecha Nac:</b></td>
                                                                        <td><input type="text" name="fechanac" value="<?echo $filas["fechanac"];?>" class="cajas" size="40" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechanac"></td>
                                                                </tr>
                                                                 </tr>
                                                                <tr>
                                                                        <td><b>Email:</b></td>
                                                                        <td colspan="10"><input type="text" name="email" value="<?echo $filas["email"];?>" size="85"class="cajas"  maxlength="40" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="email"></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>Estado Civil:</b></td>
                                                                        <td><select name="estcivil" class="cajas" style="width: 170px" id="estcivil">
                                                                                <option value="<?echo $filas["estcivil"];?>" selected><?echo $filas["estcivil"];?>
                                                                                <option value="SOLTERO">SOLTERO
                                                                                <option value="CASADO">CASADO
                                                                                 <option value="UNION LIBRE">UNION LIBRE
                                                                                <option value="VIUDO">VIUDO
                                                                                 <option value="DIVORCIADO">DIVORCIADO
                                                                            </select></td>
                                                                            <td><strong>RH</strong></td>
							                    <td><select name="rh"  style="width: 258px" id="rh">
                                                                            <option value="<?echo $filas["rh"];?>" selected><?echo $filas["rh"];?>
							                        <option value="O-">O-</option>
							                        <option value="O+">O+</option>
							                        <option value="A-">A-</option>
							                        <option value="A+">A+</option>
							                        <option value="B-">B-</option>
							                        <option value="B+">B+</option>
							                        <option value="AB-">AB-</option>
							                        <option value="AB+">AB+</option>
													<option value="NI">NI</option>
							                    </select></td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td><b>Cuenta:</b></td>
                                                                        <td><input type="text" name="cuenta" value="<?echo $filas["cuenta"];?>" class="cajas" size="25" maxlength="20" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cuenta"></td>
                                                                        <td><b>Banco:</b></td>
                                                                        <td colspan="10"> <select name="codbanco" class="cajas" style="width: 258px" id="codbanco">

                                                                                        <?
                                                                                                $bancoaux=$filas["codbanco"];
                                                                                                $consulta_b="select banco.* from banco where banco.nomina='SI'";
                                                                                                $resultado_b=mysql_query($consulta_b) or die("consulta de banco Incorrecta");
                                                                                                while ($filas_b=mysql_fetch_array($resultado_b))
                                                                                                {
                                                                                                        if ($bancoaux==$filas_b["codbanco"])
                                                                                                        {
                                                                                        ?>
                                                                                                                <option value="<?echo $filas_b["codbanco"];?>" selected><?echo $filas_b["bancos"];?>
                                                                                        <?
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                        ?>
                                                                                                                <option value="<?echo $filas_b["codbanco"];?>"><?echo $filas_b["bancos"];?>
                                                                                        <?
                                                                                                        }
                                                                                                }
                                                                                        ?>
                                                                                </select></td>
                                                                </tr>
                                                                 <tr>
                                                                        <td><b>Zona:</b></td>
                                                                        <td colspan="10">    <select name="codzona" class="cajas" style="width: 528px" id="codzona">
                                                                                        <?
                                                                                                $zonaaux=$filas["codzona"];
                                                                                                $consulta_z="select * from zona";
                                                                                                $resultado_z=mysql_query($consulta_z) or die("consulta de Zona Incorrecta");
                                                                                                while ($filas_z=mysql_fetch_array($resultado_z))
                                                                                                {
                                                                                                        if ($zonaaux==$filas_z["codzona"])
                                                                                                        {
                                                                                        ?>
                                                                                                                <option value="<?echo $filas_z["codzona"];?>" selected><?echo $filas_z["zona"];?>
                                                                                        <?
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                        ?>
                                                                                                                <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
                                                                                        <?
                                                                                                        }
                                                                                                }
                                                                                        ?>
                                                                                </select></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>Eps:</b></td>
                                                                        <td colspan="10">    <select name="codeps" class="cajas" style="width: 528px" id="codeps">
                                                                                        <?
                                                                                                $epsaux=$filas["codeps"];
                                                                                                $consulta_e="select * from eps";
                                                                                                $resultado_e=mysql_query($consulta_e) or die("consulta de Eps Incorrecta");
                                                                                                while ($filas_e=mysql_fetch_array($resultado_e))
                                                                                                {
                                                                                                        if ($epsaux==$filas_e["codeps"])
                                                                                                        {
                                                                                        ?>
                                                                                                                <option value="<?echo $filas_e["codeps"];?>" selected><?echo $filas_e["eps"];?>
                                                                                        <?
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                        ?>
                                                                                                                <option value="<?echo $filas_e["codeps"];?>"><?echo $filas_e["eps"];?>
                                                                                        <?
                                                                                                        }
                                                                                                }
                                                                                        ?>
                                                                                </select></td>
                                                                       </tr>
                                                                       <tr>
                                                                        <td><b>Pension:</b></td>
                                                                        <td colspan="10">    <select name="codpension" class="cajas" style="width: 528px" id="codpension" >
                                                                                        <?
                                                                                                $pensionaux=$filas["codpension"];
                                                                                                $consulta_p="select * from pension";
                                                                                                $resultado_p=mysql_query($consulta_p) or die("consulta de pension Incorrecta");
                                                                                                while ($filas_p=mysql_fetch_array($resultado_p))
                                                                                                {
                                                                                                        if ($pensionaux==$filas_p["codpension"])
                                                                                                        {
                                                                                        ?>
                                                                                                                <option value="<?echo $filas_p["codpension"];?>" selected><?echo $filas_p["pension"];?>
                                                                                        <?
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                        ?>
                                                                                                                <option value="<?echo $filas_p["codpension"];?>"><?echo $filas_p["pension"];?>
                                                                                        <?
                                                                                                        }
                                                                                                }
                                                                                        ?>
                                                                                </select></td>
                                                                </tr>
                                                                         <tr>
                                                                        <td><b>Nomina:</b></td>
                                                                         <td><select name="nomina" class="cajasletra" id="nomina"  style="width: 170px">
                                                                                <option value="<?echo $filas["nomina"];?>" selected><?echo $filas["nomina"];?>
                                                                                <option value="SI">SI
                                                                                <option value="NO">NO
                                                                        <td><b>Costo:</b></td>
                                                                        <td colspan="10"><select name="codcosto"class="cajas" style="width: 258px" id="codcosto">
                                                                                        <?
                                                                                                $costoaux=$filas["codcosto"];
                                                                                                $consulta_c="select * from costo where costo.estado = 'ACTIVO' order by costo.centro";
                                                                                                $resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
                                                                                                while ($filas_c=mysql_fetch_array($resultado_c))
                                                                                                {
                                                                                                        if($costoaux==$filas_c["codcosto"])
                                                                                                        {
                                                                                        ?>
                                                                                                                <option value="<?echo $filas_c["codcosto"];?>" selected><?echo $filas_c["centro"];?>-<?echo $filas_c["codcosto"];?>
                                                                                        <?
                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                        ?>
                                                                                                                <option value="<?echo $filas_c["codcosto"];?>"><?echo $filas_c["centro"];?>--<?echo $filas_c["codcosto"];?>
                                                                                        <?
                                                                                                        }
                                                                                                }
                                                                                        ?>
                                                                                </select></td>
                                                                </tr>
                                                                <tr>
                                                                         <td><b>% Arl:</b></td>
                                                                         <td><select name="nivel" class="cajasletra" id="nivel" style="width: 170px">
                                                                                <option value="<?echo $filas["nivel"];?>" selected><?echo $filas["nivel"];?>
                                                                                <option value="0.522">0.522
                                                                                <option value="1.044">1.044
                                                                                <option value="2.436">2.436
                                                                                 <option value="4.350">4.350
                                                                                <option value="6.96">6.96
                                                                            </select></td>
                                                                       <td><b>% Eps:</b></td>
                                                                        <td><select name="eps" class="cajasletra" id="eps"  style="width: 258px">
                                                                                <option value="<?echo $filas["eps"];?>" selected><?echo $filas["eps"];?>
                                                                                <option value="0">0-Sin Eps
                                                                                <option value="8.5">8.5
                                                                                <option value="12.5">12.5
                                                                            </select></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>% Pensión:</b></td>
                                                                         <td><select name="pension" class="cajasletra" id="pension"  style="width: 170px" >
                                                                                <option value="<?echo $filas["pension"];?>" selected><?echo $filas["pension"];?>
                                                                                <option value="0">0-Sin Pensión
                                                                                <option value="12">12
                                                                                <option value="16">16
                                                                                 <option value="26">26
                                                                            </select></td>
                                                                <td><b>P_Pago:</b></td>
                                                                    <td><select name="periodo" class="cajasletra" id="periodo"  style="width: 258px">
                                                                                <option value="<?echo $filas["periodo"];?>" selected><?echo $filas["periodo"];?>
                                                                                <option value="SEMANAL">SEMANAL
                                                                                <option value="DECADAL">DECADAL
                                                                                <option value="CATORCENAL">CATORCENAL
                                                                                 <option value="QUINCENAL">QUINCENAL
                                                                                <option value="MENSUAL">MENSUAL
                                                                            </select></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>Salario:</b></td>
                                                                        <td><input type="text" name="salario" value="<?echo $filas["basico"];?>" size="25" class="cajas" maxlength="13" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="salario"></td>
                                                                        <td><b>Salario_Base:</b></td>
                                                                        <td><input type="text" name="base" value="<?echo $filas["vlrpagado"];?>" size="40" class="cajas" maxlength="13" onfocus="Calculo()" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="base"></td>
                                                          </tr>
                                                          <tr>
                                                                <td><b>Tiempo_Serv.:</b></td>
                                                                    <td><select name="tiempo" class="cajasletra"  style="width: 170px">
                                                                                <option value="<?echo $filas["tiempo"];?>" selected><?echo $filas["tiempo"];?>
                                                                                <option value="NORMAL">NORMAL
                                                                                <option value="MEDIO TIEMPO">MEDIO TIEMPO
                                                                                <option value="SABATINO">SABATINO
                                                                            </select></td>
									<td><b>Pagar_Pensión:</b></td>
                                                                         <td><select name="PagarP" class="cajasletra"  style="width: 258px">
                                                                                <option value="<?echo $filas["pagarp"];?>" selected><?echo $filas["pagarp"];?>
                                                                                <option value="SI">SI
                                                                                <option value="NO">NO
                                                                            </select></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Tipo_Empleado:</b></td>
                                                                         <td><select name="TipoEmpleado" class="cajasletra"  style="width: 170px" id="TipoEmpleado">
                                                                                <option value="<?echo $filas["tipoempleado"];?>" selected><?echo $filas["tipoempleado"];?>
                                                                                <option value="MISIONAL">MISIONAL
                                                                                <option value="EMPLEADO">EMPLEADO
                                                                            </select></td>
                                                                </tr>
                                                                <tr><td><br></td></tr>
                                                                <tr>
                                                                        <td colspan="2"><input type="submit" Value="Guardar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></th>
                                                                </tr>
        <?
                                }
                        }
                }
        ?>
                                </form>
                </table>
        </body>
</html>
