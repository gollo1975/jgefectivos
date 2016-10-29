<html>
        <head>
                <title>Agregar Empleado</title>
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
                         document.getElementById("salariopago").value=Suma.toFixed(0);
                       }
                       if (document.getElementById("periodo").value=='DECADAL')
                         {
                         Suma=(AuxS/30)* 10
                         document.getElementById("salariopago").value=Suma.toFixed(0);
                       }
                       if (document.getElementById("periodo").value=='CATORCENAL')
                         {
                         Suma=(AuxS/30)* 14
                         document.getElementById("salariopago").value=Suma.toFixed(0);
                       }
                       if (document.getElementById("periodo").value=='QUINCENAL')
                         {
                         Suma=(AuxS/30)* 15
                         document.getElementById("salariopago").value=Suma.toFixed(0);
                       }
                       if (document.getElementById("periodo").value=='MENSUAL')
                         {
                         Suma=(AuxS/30)* 30
                         document.getElementById("salariopago").value=Suma.toFixed(0);
                        }
                     }
                 </script>
        </head>
        <body>
                <?
          if (!isset($cedemple)):
                ?>
               <center><h4><u>Matricular Empleado</u></h4></center>
                <form action="" method="post">
                      <table border="0" align="center">
                                <tr><td><br></td></tr>
                                <tr>
                                        <td><b>Documento de Identidad:&nbsp;<b></td>
                                        <td><input type="text" name="cedemple" value="" size="15" maxlength="15" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="cedemple"></td>
                                </tr>
                                <tr><td><br></td></tr>
                                 <tr>
                                        <td colspan="9"><input type="submit" Value="Buscar Dato" class="boton"></td>
                                </tr>
                  </table>
               </form>
          <?
   elseif(empty($cedemple)):
             ?>
            <script language="javascript">
              alert("Digite el documento de Identidad para el ingreso.")
              history.back()
            </script>
          <?
   else:
           include("../conexion.php");
           $consulta="select empleado.cedemple from empleado where cedemple='$cedemple'";
           $resultado=mysql_query($consulta) or die("consulta incorrecta");
           $registros=mysql_num_rows($resultado);
           if ($registros==0):
             ?>
	             <center><h4><u>Matricular Empleado</u></h4></center>
	              <form action="GrabarNuevo.php" method="post">
	                <table border="0" align="center" width="340">
	                  <tr>
	                    <td><b>Documento:</b></td>
	                    <td><input type="text" name="cedemple" value="<?echo $cedemple;?>" size="25"  class="cajas" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="cedemple"></td>
	                    <td><b>Tipo_Doc.:</b></td>
	                    <td><select name="TipoD" class="cajasletra" id="TipoD" style="width: 258px">
	                        <option value="0">Seleccione
	                      <option value="CC">Cédula Ciudadania
	                      <option value="TI">Tarjeta Identidad
	                      <option value="CE">Cédula Extranjeria
	                      <option value="PS">Pasaporte
	                      </select></td>
	                  </tr>
	                  <tr>
	                    <td><b>Nombre 1:</b></td>
	                    <td><input type="text" name="nomemple" value="" size="25" maxlength="25" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nomemple"></td>
	                    <td><b>Nombre 2:</b></td>
	                    <td><input type="text" name="nomemple1" value="" size="40" maxlength="25" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nomemple1"></td>
	                  </tr>
	                  <tr>
	                    <td><b>Apellido 1:</b></td>
	                    <td colspan="1"><input type="text" name="apemple" value="" size="25" maxlength="25" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="apemple"></td>
	                    <td><b>Apellido 2:</b></td>
	                    <td colspan="1"><input type="text" name="apemple1" value="" size="40" maxlength="25" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="apemple1"></td>
	                  </tr>
	                  <tr>
	                    <td><b>Telefono:</b></td>
	                    <td><input type="text" name="telemple" value="" size="25" maxlength="7" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="telemple"></td>
	                    <td><b>Direccion:</b></td>
	                    <td><input type="text" name="diremple" value="" size="40" maxlength="40" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="diremple"></td>
	                  </tr>
	                  <tr>
	                    <td><b>Municipio</b></td>
	                    <td colspan="10"><select name="munici" class="cajasletra"  style="width: 528px">
	                        <option value="0">Seleccione el Municipio
	                          <?
	                                                                $consulta_z="select codmuni,municipio from municipio  order by municipio";
	                                                                $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
	                                                                while ($filas_z=mysql_fetch_array($resultado_z))
	                                                                {
	                                                        ?>
	                        <option value="<?echo $filas_z["codmuni"];?>"><?echo $filas_z["municipio"];?>
	                        <?
	                                                                }
	                                                        ?>
	                                    </select></td>
			</tr>
			<tr>
			    <td><b>Barrio:</b></td>
	                    <td><input type="text" name="barrio" value="" size="25" maxlength="25" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="barrio"></td>
                             <td><b>Celular:</b></td>
	                    <td><input type="text" name="celular" value="" size="40" maxlength="15" class="cajasletra" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="celular"></td>
                        </tr>
	                    <td><b>Sexo:</b></td>
	                    <td><select name="sexo" class="cajasletra"  style="width: 170px" id="sexo">
	                        <option value="MASCULINO">MASCULINO
	                        <option value="FEMENINO">FEMENINO
	                    <td><strong>RH</strong></td>
	                    <td><select name="rh"  style="width: 258px" id="rh">
			    <option value="0">Seleccione</option>
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
	                    <td><b>Email:</b></td>
	                    <td colspan="10"><input type="text" name="email" value="" size="85" maxlength="45" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="email"></td>
	                  </tr>
	                  <tr>
	                    <td><b>Fecha Nac.:</b></td>
	                    <td><input type="text" name="fechanac" value="<?echo date("Y-m-d");?>" size="25" maxlength="10" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="fechanac"></td>
	                    <td><b>Estado_Civil:</b></td>
	                    <td><select name="estcivil" class="cajas"  style="width: 258px" id="sexo">
	                        <option value="SOLTERO">SOLTERO
	                      <option value="CASADO">CASADO
	                      <option value="VIUDO">VIUDO
	                      <option value="UNION LIBRE">UNION LIBRE
	                      <option value="DIVORCIADO">DIVORCIADO
	                      </select></td>
	                  </tr>
	                  <tr>
	                    <td><b>Cuenta:</b></td>
	                    <td><input type="text" name="cuenta" value="" size="25" maxlength="15" class="cajasletra" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="cuenta"></td>
	                    <td><b>Banco:</b></td>
	                    <td><select name="codbanco" class="cajasletra"  style="width: 258px" id="codbanco">
	                        <option value="0">Seleccione el Banco
	                          <?
	                                                                $consulta_b="select * from banco where banco.nomina='SI' order by banco.bancos";
	                                                                $resultado_b=mysql_query($consulta_b) or die("consulta de banco Incorrecta");
	                                                                while ($filas_b=mysql_fetch_array($resultado_b))
	                                                                {
	                                                        ?>
	                        <option value="<?echo $filas_b["codbanco"];?>"><?echo $filas_b["bancos"];?>
	                        <?
	                                                                }
	                                                        ?>
	                                    </select></td>
	                  </tr>
	                  <tr>
	                    <td><b>Zona</b></td>
	                    <td colspan="10"><select name="codzona" class="cajasletra"  style="width: 528px" id="codzona">
	                        <option value="0">Seleccione la Zona
	                          <?
	                                                                $consulta_z="select * from zona where zona.estado='ACTIVA' and nomina='SI' order by zona.zona";
	                                                                $resultado_z=mysql_query($consulta_z) or die("consulta de Zona Incorrecta");
	                                                                while ($filas_z=mysql_fetch_array($resultado_z))
	                                                                {
	                                                        ?>
	                        <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
	                        <?
	                                                                }
	                                                        ?>
	                                    </select></td>
	                  </tr>
	                  <tr>
	                    <td><b>Eps:</b></td>
	                    <td colspan="10"><select name="codeps" class="cajasletra" style="width: 528px" id="codeps">
	                        <?
	                                                                $consulta_e="select * from eps order by eps.eps";
	                                                                $resultado_e=mysql_query($consulta_e) or die("consulta de Eps Incorrecta");
	                                                                while ($filas_e=mysql_fetch_array($resultado_e))
	                                                                {
	                                                        ?>
	                        <option value="<?echo $filas_e["codeps"];?>"><?echo $filas_e["eps"];?>
	                        <?
	                                                                }
	                                                        ?>
	                                    </select></td>
                            </tr>
                            <tr>
	                    <td><b>Pension:</b></td>
	                    <td><select name="codpension"class="cajasletra" style="width: 170px" id="codpension">
	                        <?
	                                                                $consulta_p="select * from pension order by pension.pension";
	                                                                $resultado_p=mysql_query($consulta_p) or die("consulta de pension Incorrecta");
	                                                                while ($filas_p=mysql_fetch_array($resultado_p))
	                                                                {
	                                                        ?>
	                        <option value="<?echo $filas_p["codpension"];?>"><?echo $filas_p["pension"];?>
	                        <?
	                                                                }
	                                                        ?>
	                                    </select></td>
	                  </tr>
	                  <tr>
	                   <td><b>Nomina:</b></td>
	                     <td><select name="nomina" class="cajasletra" id="nomina" style="width: 170px">
	                      <option value="SI">SI
	                      <option value="NO">NO
	                      </select></td>
	                   <td><b>Costo:</b></td>
	                    <td><select name="CodCosto" class="cajasletra" id="CodCosto" style="width: 258px">
	                        <option value="0">Seleccione el centro de Costo
	                          <?
	                                                                $consulta_c="select * from costo where costo.estado = 'ACTIVO'order by centro";
	                                                                $resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
	                                                                while ($filas_c=mysql_fetch_array($resultado_c))
	                                                                {
	                                                        ?>
	                        <option value="<?echo $filas_c["codcosto"];?>"><?echo $filas_c["centro"];?>-<?echo $filas_c["codcosto"];?>
	                        <?
	                                                                }
	                                                        ?>
	                                    </select></td>
	                  </tr>
	                  <tr>
					    <td><b>% Arl:</b></td>
	                    <td><select name="nivel" class="cajasletra" id="nivel" style="width: 170px">
	                      <option value="0.522">0.522
						  <option value="1.044">1.044
						  <option value="2.436">2.436
						  <option value="4.350">4.350
						  <option value="6.96">6.96
	                      </select></td>
	                   <td><b>% Eps:</b></td>
	                     <td><select name="eps" class="cajasletra" id="eps" style="width: 258px">
	                      <option value="0">0-Sin Eps
	                      <option value="8.5">8.5
	                      <option value="12.5">12.5
	                      </select></td>
	                  </tr>
	                  <tr>
	                    <td><b>% Pensión:</b></td>
	                    <td><select name="pension" class="cajasletra" id="pension" style="width: 170px">
	                    <option value="0">0-Sin pension
	                    <option value="12">12
	                    <option value="16">16
	                    <option value="26">26
	                    </select></td>
	                  </tr>
	                  <tr>
	                    <td colspan="10">--------------------------------------------------------------<b>Datos de pago</b>------------------------------------------------------------------------</td>
	                  </tr>
	                  <tr>
	                    <td><b>Periodo_Pago:</b></td>
	                    <td><select name="periodo" class="cajasletra" id="periodo" style="width: 170px">
	                        <option value="0">Seleccione
	                      <option value="SEMANAL">SEMANAL
	                      <option value="DECADAL">DECADAL
	                      <option value="CATORCENAL">CATORCENAL
	                      <option value="QUINCENAL">QUINCENAL
	                      <option value="MENSUAL">MENSUAL
	                      </select></td>
	                    <td><b>S_Básico:</b></td>
	                    <td><input type="text" name="salario" value="" size="40" maxlength="11" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="salario"></td>
	                  </tr>
	                  <tr>
	                    <td><b>Salario_Quin.:</b></td>
	                    <td><input type="text" name="salariopago" value="" size="25" maxlength="11" class="cajas" onFocus="Calculo()"  id="salariopago"></td>
	                    <td><b>Tipo_Servicio:</b></td>
	                    <td><select name="tiempo" class="cajasletra" style="width: 258px">
	                        <option value="0">Seleccione
	                      <option value="NORMAL">NORMAL
	                      <option value="MEDIO TIEMPO">MEDIO TIEMPO
	                      <option value="SABATINO">SABATINO
	                      </select></td>
	                  </tr>
	                    <tr>
	                  </tr>
	               <tr>
	                   <td><b>Pagar_Pension:</b></td>
	                    <td><select name="PagarP" class="cajasletra" style="width: 170px" id="PagarP">
	                      <option value="SI">SI
	                      <option value="NO">NO
	                      </select></td>
                               <td><b>Tipo_Empleado:</b></td>
	                    <td><select name="TipoEmpleado" class="cajasletra" style="width: 258px" id="TipoEmpleado">
	                      <option value="MISIONAL">MISIONAL
	                      <option value="EMPLEADO">EMPLEADO
	                      </select></td>
	                  </tr>
	                  <tr>
	                    <td><br></td>
	                  </tr>
	                  <tr>
	                    <td colspan="9"><input name="submit" type="submit" class="boton" value="Guardar">
	                      &nbsp;
	                      <input name="reset" type="reset" class="boton" value="Limpiar"></td>
	                  </tr>
	                </table>
	              </form>
            <?
            else:
              ?>
               <script language="javascript">
                  alert("Este documento ya existe en sistema, favor Verificar los contratos.")
                  history.back()
               </script>
              <?
            endif;
         endif;
       ?>
        </body>
</html>

