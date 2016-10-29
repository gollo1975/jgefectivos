<head>
                <title>Crear Centro de Costo</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <script type="text/javascript">
 function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
         function enviar()
        {
               if (document.getElementById("cedemple").value.length <=0)
           {
                alert ("Digite el Documento del Empleado");
                document.getElementById("cedemple").focus();
                return;
           }
             document.getElementById("imacentro").submit();
        }

</script>
                <?
            if (!isset($cedemple)):
            include("../conexion.php");
                         ?>
                               <center><h4><u>Centro de Costo</u></h4></center>
                               <form action="" method="post" id ="imacentro">
                                        <table border="0" align="center"
                                          <tr>
                                              <td colspan="6"><br></td>
                                           </tr>
                                       <tr>
                                        <td><b>Documento de identidad:</b></td>
                                        <td><input type="text" name="cedemple" value="" size="15" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
                                       </tr>
                                        <tr>
                                        <td><b>Tipo_Salario:</b></td>
                                        <td><select name="TipoSalario" class="cajasletra">
                                                <option value="VARIABLE">VARIABLE
                                                <option value="FIJO">FIJO
                                          </select></td>
                                       </tr>
                                        <td><b>Auxilio_Trans.:</b></td>
                                        <td>  <select name="AuxilioT" class="cajasletra">
                                                    <?
                                                                $consulta_b="select parametroauxilio.* from parametroauxilio where estado='ACTIVO'";
                                                                $resultado_b=mysql_query($consulta_b) or die("eRRORR");
                                                                while ($filas_b=mysql_fetch_array($resultado_b))
                                                                {
                                                        ?>
                                                                <option value="<?echo $filas_b["valor"];?>"><?echo $filas_b["valor"];?>
                                                        <?
                                                                }
                                                        ?>
                                                </select></td>
                                        </tr>
                                        <tr><td ><input type="button" Value="Buscar" class="boton" onclick="enviar()"></td></tr>
                                     </table>
                                 </form>
                        <?
          else:
              include("../conexion.php");
              $conE="select empleado.pagarp from empleado where empleado.cedemple='$cedemple' and empleado.pagarp='SI'";
              $resuE=mysql_query($conE)or die ("Consulta Incorrecta de Empleado");
              $PagarP=mysql_num_rows($resuE);
              if($PagarP == 0):
                  $conP="select parametropension.estado from empleado,parametropension
                        where empleado.cedemple='$cedemple' and
                        empleado.cedemple=parametropension.cedemple and
                        parametropension.estado='ACTIVO'";
                  $resuP=mysql_query($conP)or die ("Consulta Incorrecta de PARAMETRO DE PENSION");
                  $ConP=mysql_num_rows($resuP);
                  if($ConP==0):
                        ?>
                             <script language="javascript">
                               alert("A este empleado no se le paga pensión, favor subir el parametro al sistema!")
                                history.back()
                             </script>
                             <?
                  else:
                        $con="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,zona.zona,empleado.pagarp from empleado,zona where
                                  zona.codzona=empleado.codzona and
                                  empleado.nomina='SI'and
                                  empleado.cedemple='$cedemple'";
	                   $resu=mysql_query($con)or die ("Consulta Incorrecta");
	                   $reg=mysql_num_rows($resu);
	                   if($reg!=0):
		                       while ($filas = mysql_fetch_array($resu)):
		                             $PagarPension=$filas["pagarp"];
		                             ?>
		                             <center><h4><u>Centro de Costo</u></h4></center>
		                             <form action="" method="post">
		                               <table border="0" align="center">
		                               <tr>
		                                       <td><b>Documento:</b></td>
		                                       <td><input type="text" name="cedemple" value="<? echo $cedemple;?>" size="15" class="cajas"readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
		                                     </tr>
		                                     <tr>
		                                       <td><b>Empleado:</b></td>
		                                       <td><input type="text"  value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>" name="nombre" class="cajas" size="50"  readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
		                                     </tr>
		                                      <tr>
		                                       <td><b>Zona:</b></td>
		                                       <td><input type="text"  value="<? echo $filas["zona"];?>" name="zona" class="cajas" size="50"  readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona"></td>
		                                     </tr>
		                                </table>
		                              </form>
		                             <?
	                               endwhile;
	                   else:
	                       ?>
	                       <script language="javascript">
	                               alert("Este Empleado No existe en la Base de datos / o No Pertenece al Sistema de Nomina ?")
	                               open("agregar.php","_self")
	                             </script>
	                             <?
	                       endif;
	                       $con1="select empleado.apemple from empleado,centro where
	                                  empleado.cedemple=centro.cedemple
	                                  and empleado.cedemple='$cedemple'";
	                       $resu1=mysql_query($con1)or die ("Consulta Incorrecta");
	                       $reg=mysql_num_rows($resu1);
	                       if($reg==0):
	                              $consulta = "select salario.* from salario where estado='ACTIVO' order by codsala,egreso";
	                              $resultado = mysql_query ($consulta) or die ("Error en la consulta " )
	                              ?>
	                              <form action="GrabarCentro.php" method="post">
	                              <input type="hidden" name="Cedula" value="<?echo $cedemple;?>">
	                              <input type="hidden" name="TipoSalario" value="<?echo $TipoSalario;?>">
	                              <input type="hidden" name="AuxilioT" value="<?echo $AuxilioT;?>">
	                              <input type="hidden" name="PagarPension" value="<?echo $PagarPension;?>">
	                              <table border="0" align="center">
	                                   <tr>
	                                       <th>&nbsp;</th> <th>Cod_Sala.</th><th><b>Concepto</b></th><th><b>%Por.</b></th><th><b>Prest.</b></th><th><b>C.C_Vis.</b></th><th><b>Control</b></th><th><b>S_Cred.</b></th><th><b>Activo</b></th><th><b>Agru.</b></th>

	                                   </tr>
	                                   <?
	                                   $i=1;
	                                   echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resultado) . "\">");
	                                   while ($registro = mysql_fetch_array($resultado)):
	                                         ?>
						 <tr class="cajas">
						     <?
						     echo ("<td><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $registro['codsala'] ."\" \"></td>");?>
						     <td class="cajas"><input type="text" value="<?echo $registro["codsala"];?>"  size="9" readonly class="cajas"></td>
						     <td class="cajas"><input type="text" value="<?echo $registro["desala"];?>" name="Concepto<? echo $i;?>]"id="Concepto[<? echo $i;?>]" size="50" readonly class="cajas"></td>
	                                             <td class="cajas"><input type="text" value="<?echo $registro["porcentaje"];?>" name="porcentaje<? echo $i;?>]"id="porcentaje[<? echo $i;?>]" size="5" readonly class="cajas"></td>
	                                             <td class="cajas"><input type="text" value="<?echo $registro["prestacion"];?>" name="Prestacion<? echo $i;?>]"id="Prestacion[<? echo $i;?>]" size="3" readonly class="cajas"></td>
	                                             <td class="cajas"><input type="text" value="<?echo $registro["control"];?>" name="Visible<? echo $i;?>]"id="Visible[<? echo $i;?>]" size="3" readonly class="cajas"></td>
	                                             <td class="cajas"><input type="text" value="<?echo $registro["insertar"];?>" name="Insertar<? echo $i;?>]"id="Insertar[<? echo $i;?>]" size="3" readonly class="cajas"></td>
	                                             <td class="cajas"><input type="text" value="<?echo $registro["sumarcupo"];?>" name="SumarC<? echo $i;?>]"id="Insertar[<? echo $i;?>]" size="3" readonly class="cajas"></td>
	                                             <td class="cajas"><input type="text" value="<?echo $registro["estado"];?>" name="Estado<? echo $i;?>]"id="Estado[<? echo $i;?>]" size="9" readonly class="cajas"></td>
												 <td class="cajas"><input type="text" value="<?echo $registro["agrupado"];?>" name="Agrupado<? echo $i;?>]"id="Agrupado[<? echo $i;?>]" size="3" readonly class="cajas"></td>
						 <tr>
					         <?
						 $i=$i+1;
	                                   endwhile;
	                                    ?>
	                                    <tr><td><br></td></tr>
	                                    <tr><td colspan="15"><div align="left"><input type="submit" Value="Grabar Detalle" class="boton"></div></td></tr>
	                              </table>
	                              <tr><td><br></td></tr>
	                              <center><td ><a href="agregar.php"><h4><u><font color="blue">Cargar Empleado</font></u></h4></a></td></center>
	                              </form>
	                             <?
	                       else:
	                               ?>
	                             <script language="javascript">
	                               alert("Este Empleado Ya tiene cento de costo procesado?")
	                               open("agregar.php","_self")
	                             </script>
	                             <?
	                       endif;
	                   endif;
              else:
                   $con="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,zona.zona,empleado.pagarp from empleado,zona where
                                  zona.codzona=empleado.codzona and
                                  empleado.nomina='SI'and
                                  empleado.cedemple='$cedemple'";
                   $resu=mysql_query($con)or die ("Consulta Incorrecta");
                   $reg=mysql_num_rows($resu);
                   if($reg!=0):
	                       while ($filas = mysql_fetch_array($resu)):
	                             $PagarPension=$filas["pagarp"];
	                             ?>
	                             <center><h4><u>Centro de Costo</u></h4></center>
	                             <form action="" method="post">
	                               <table border="0" align="center">
	                               <tr>
	                                       <td><b>Documento:</b></td>
	                                       <td><input type="text" name="cedemple" value="<? echo $cedemple;?>" size="15" class="cajas"readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
	                                     </tr>
	                                     <tr>
	                                       <td><b>Empleado:</b></td>
	                                       <td><input type="text"  value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>" name="nombre" class="cajas" size="50"  readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
	                                     </tr>
	                                      <tr>
	                                       <td><b>Zona:</b></td>
	                                       <td><input type="text"  value="<? echo $filas["zona"];?>" name="zona" class="cajas" size="50"  readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona"></td>
	                                     </tr>
	                                </table>
	                              </form>
	                             <?
                               endwhile;
                   else:
                       ?>
                       <script language="javascript">
                               alert("Este Empleado No existe en la Base de datos / o No Pertenece al Sistema de Nomina ?")
                               open("agregar.php","_self")
                             </script>
                             <?
                       endif;
                       $con1="select empleado.apemple from empleado,centro where
                                  empleado.cedemple=centro.cedemple
                                  and empleado.cedemple='$cedemple'";
                       $resu1=mysql_query($con1)or die ("Consulta Incorrecta");
                       $reg=mysql_num_rows($resu1);
                       if($reg==0):
                              $consulta = "select salario.* from salario where estado='ACTIVO' order by codsala,egreso";
                              $resultado = mysql_query ($consulta) or die ("Error en la consulta " )
                              ?>
                              <form action="GrabarCentro.php" method="post">
                              <input type="hidden" name="Cedula" value="<?echo $cedemple;?>">
                              <input type="hidden" name="TipoSalario" value="<?echo $TipoSalario;?>">
                              <input type="hidden" name="AuxilioT" value="<?echo $AuxilioT;?>">
                              <input type="hidden" name="PagarPension" value="<?echo $PagarPension;?>">
                              <table border="0" align="center">
                                   <tr>
                                       <th>&nbsp;</th> <th>Cod_Sala.</th><th><b>Concepto</b></th><th><b>%Por.</b></th><th><b>Prest.</b></th><th><b>C.C_Vis.</b></th><th><b>Control</b></th><th><b>S_Cred.</b></th><th><b>Activo</b></th><th><b>Agru.</b></th>
                                   </tr>
                                   <?
                                   $i=1;
                                   echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resultado) . "\">");
                                   while ($registro = mysql_fetch_array($resultado)):
                                         ?>
					 <tr class="cajas">
					     <?
					     echo ("<td><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $registro['codsala'] ."\" \"></td>");?>
					     <td class="cajas"><input type="text" value="<?echo $registro["codsala"];?>"  size="9" readonly class="cajas"></td>
					     <td class="cajas"><input type="text" value="<?echo $registro["desala"];?>" name="Concepto<? echo $i;?>]"id="Concepto[<? echo $i;?>]" size="50" readonly class="cajas"></td>
                                             <td class="cajas"><input type="text" value="<?echo $registro["porcentaje"];?>" name="porcentaje<? echo $i;?>]"id="porcentaje[<? echo $i;?>]" size="5" readonly class="cajas"></td>
                                             <td class="cajas"><input type="text" value="<?echo $registro["prestacion"];?>" name="Prestacion<? echo $i;?>]"id="Prestacion[<? echo $i;?>]" size="3" readonly class="cajas"></td>
                                             <td class="cajas"><input type="text" value="<?echo $registro["control"];?>" name="Visible<? echo $i;?>]"id="Visible[<? echo $i;?>]" size="3" readonly class="cajas"></td>
                                             <td class="cajas"><input type="text" value="<?echo $registro["insertar"];?>" name="Insertar<? echo $i;?>]"id="Insertar[<? echo $i;?>]" size="3" readonly class="cajas"></td>
                                             <td class="cajas"><input type="text" value="<?echo $registro["sumarcupo"];?>" name="SumarC<? echo $i;?>]"id="Insertar[<? echo $i;?>]" size="3" readonly class="cajas"></td>
                                             <td class="cajas"><input type="text" value="<?echo $registro["estado"];?>" name="Estado<? echo $i;?>]"id="Estado[<? echo $i;?>]" size="9" readonly class="cajas"></td>
											 <td class="cajas"><input type="text" value="<?echo $registro["agrupado"];?>" name="Agrupado<? echo $i;?>]"id="Agrupado[<? echo $i;?>]" size="3" readonly class="cajas"></td>
					 <tr>
				         <?
					 $i=$i+1;
                                   endwhile;
                                    ?>
                                    <tr><td><br></td></tr>
                                    <tr><td colspan="15"><div align="left"><input type="submit" Value="Grabar Detalle" class="boton"></div></td></tr>
                              </table>
                              <tr><td><br></td></tr>
                              <center><td ><a href="agregar.php"><h4><u><font color="blue">Cargar Empleado</font></u></h4></a></td></center>
                              </form>
                             <?
                       else:
                               ?>
                             <script language="javascript">
                               alert("Este Empleado Ya tiene cento de costo procesado?")
                               open("agregar.php","_self")
                             </script>
                             <?
                       endif;
                   endif;
             endif;
?>
</body>
</html>
