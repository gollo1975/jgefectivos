 <head>
                <title>Modificar datos</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <script language="javascript">
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
         ?>
         <center><h4><u>Modificar Datos</u></h4></center>
                               <form action="" method="post" id ="imacentro">
                                        <table border="0" align="center"
                                          <tr><td><br></td></tr>
                                       <tr>
                                        <td><b>Documento de identidad:</b></td>
                                        <td><input type="text" name="cedemple" value="" size="15" maxlength="15"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="cedemple"></td>
                                       </tr>
                                       <tr>
                                          <td><b>Tipo Proceso:</b></td>
                                          <td><input type="radio" value="actualizar" name="estado">Actualizar<input type="radio" value="adicionar" name="estado">Adicionar</td>
                                       <tr>
                                       <tr><td><br></td></tr>
                                        <tr><td ><input type="button" Value="Buscar" class="boton" onClick="enviar()"></td></tr>
                                     </table>
                                 </form>
        <?
 elseif(empty($estado)):
     ?>
     <script language="javascript">
              alert("Debe de seleccion el tipo de proceso a realizar.")
              history.back()
     </script>
     <?
 else:
                           include("../conexion.php");
                           $con="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where
                                  empleado.cedemple='$cedemple'";
                           $resu=mysql_query($con)or die ("Consulta Incorrecta");
                           $reg=mysql_num_rows($resu);
                           $filas_s = mysql_fetch_array($resu);
                           if($reg!=0):
                             include("../conexion.php");
                             $con1="select detallempleado.*,zona.codzona from detallempleado,empleado,zona where
                                    zona.codzona=empleado.codzona and
                                    empleado.cedemple=detallempleado.cedemple and
                                    empleado.cedemple='$cedemple'";
                             $resu1=mysql_query($con1)or die ("Consulta Incorrecta 1");
                             $reg1=mysql_num_rows($resu1);
                             $filas = mysql_fetch_array($resu1);
                             if($reg1!=0):
                                ?>
                                <form action="GrabarGeneral.php" method="post">
                                <input type="hidden" name="cedemple" value="<? echo $cedemple;?>">
                                <input type="hidden" name="estado" value="<? echo $estado;?>">
                                <table border="0" align="center">
                                     <tr class="cajas">
                                         <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                                       </tr>
                                </table>
                                   <table border="0" align="center">
                                    <tr class="cajas">
                                     <tr>
			                <td><b>Documento:</b></td>
			               <td><input type="text" name="cedula" value="<? echo $filas["cedemple"];?>"class="cajas" size="15" maxlenght="15" readonly></td>
			             </tr>
			             <tr>
			                <td><b>Empleado:</b></td>
			               <td colspan="5"><input type="text" name="empleado" value="<? echo $filas["empleado"];?>" class="cajas"size="53" readonly></td>
			             </tr>
			              <tr>
                                           <td><b>Zona:</b></td>
                                            <td colspan="5"><select name="codzona" class="cajasletra">
                                           <?
                                            $AuxZona=$filas["codzona"];
                                            $consulta_b="select zona,codzona from zona where zona.nomina='SI' and zona.estado='ACTIVA'";
                                            $resultado_b=mysql_query($consulta_b) or die("consulta de zona incorrecta");
                                             while ($filas_b=mysql_fetch_array($resultado_b)):
                                                 if ($AuxZona==$filas_b["codzona"]):
                                                     ?>
                                                     <option value="<?echo $filas_b["codzona"];?>" selected><?echo $filas_b["zona"];?>
                                                     <?
                                                 else:
                                                     ?>
                                                     <option value="<?echo $filas_b["codzona"];?>"><?echo $filas_b["zona"];?>
                                                    <?
                                                 endif;
                                             endwhile;
                                             ?>
			             </select></td>
                                       </tr>
			             <tr>
			                <td><b>Nivel_Estudio:</b></td>
			                <td><select name="nivel" class="cajasletra">
			                <option value="<?echo $filas["nivelestudio"];?>" selected><?echo $filas["nivelestudio"];?>
			                    <option value="PRIMARIA">PRIMARIA
			                    <option value="SECUNDARIA">SECUNDARIA
			                    <option value="TECNICA">TECNICA
			                    <option value="TECNOLOGIA">TECNOLOGIA
			                    <option value="UNIVERSITARIO">UNIVERSITARIO
			                    <option value="POSGRADO">POSGRADO
			                    <option value="MAGISTER">MAGISTER
			                    <option value="OTRA">OTRA
			                   </select></td>
			                    <td><b>Cabeza_Familia:</b></td>
			                    <td><select name="cabeza" class="cajasletra">
			                    <option value="<?echo $filas["cabezafamilia"];?>" selected><?echo $filas["cabezafamilia"];?>
			                    <option value="NO">NO
			                    <option value="SI">SI
			                    </select></td>
			             </tr>
			             <tr>
			                <td><b>Padre_Familia:</b></td>
			                <td><select name="padre" class="cajasletra">
			                <option value="<?echo $filas["padrefamilia"];?>" selected><?echo $filas["padrefamilia"];?>
			                    <option value="NO">NO
			                    <option value="SI">SI
			                    <td><b>Nro_Hijos:</b></td>
			                   <td><input type="text" name="nro" value="<?echo $filas["nrohijo"];?>" class="cajas" size="5" maxlenght="5"></td>
			                    </select></td>
			             </tr>
			             <tr>
			                <td><b>Rango_Salario:</b></td>
			                <td><select name="rango" class="cajasletra">
			                  <option value="<?echo $filas["rangosalario"];?>" selected><?echo $filas["rangosalario"];?>
			                    <option value="MAYOR A 0 HASTA 1">MAYOR A 0 HASTA 1
			                    <option value="MAYOR A 1 HASTA 2">MAYOR A 1 HASTA 2
			                    <option value="MAYOR A 2 HASTA 3">MAYOR A 2 HASTA 3
			                    <option value="MAYOR A 3 HASTA 4">MAYOR A 3 HASTA 4
			                    <option value="MAYOR A 4 HASTA 6">MAYOR A 4 HASTA 6
			                    <option value="MAYOR A 6 HASTA 8">MAYOR A 6 HASTA 8
			                    <option value="MAYOR A 8 HASTA 11">MAYOR A 8 HASTA 11
			                    <option value="MAYOR A 11 HASTA 17">MAYOR A 11 HASTA 17
			                    </select></td>
			             </tr>
                                     <tr><td><br></td></tr>
                                     <tr>
                                        <td align="right" colspan="2"><input type="submit" value="Actualizar" class="boton"></td>
                                       </tr>
                                    </table>
                                 </form>
                                  <form action="GrabarGeneral.php" method="post">
                                  <input type="hidden" name="cedemple" value="<? echo $cedemple;?>">
                                  <input type="hidden" name="estado" value="<? echo $estado;?>">
			               <table border="0" align="center" width="510">
			              <tr>
			                <td><b>Tipo_Id.:</b></td>
			                <td><select name="tipo" class="cajasletra">
			                 <option value="0">Seleccione el tipo
			                    <option value="RC">R. CIVIL
			                    <option value="NUIT">N. UNICO DE ID.
			                    <option value="TI">T.IDENTIDAD
			                    <option value="CC">C.CIUDADANIA
			                    <option value="CE">C.EXTRANJERIA
			                    <option value="PA">PASAPORTE
			                    </select>
			                    <b>Documento:</b>
			                    <input type="text" name="documento" value="" class="cajas" size="13" maxlength="11">
                                            <b>Parent.:</b>
			                    <select name="parentezco" class="cajasletra">
						<option value="HIJA">HIJA
                      	<option value="HIJO">HIJO
                     	<option value="ESPOSA">ESPOSA
						<option value="ESPOSO">ESPOSO
                    	<option value="MADRE">MADRE
                    	<option value="PADRE">PADRE
                    	<option value="HIJASTRA">HIJASTRA
						<option value="HIJASTRO">HIJASTRO
                    	<option value="OTRO">OTRO
			                    </select></td>
                                          </tr>
			                  <tr>
			                   <td><b>Nombres:</b></td>
			                   <td><input type="text" name="nombres" value="" class="cajas" size="40" maxlength="40">
			                   <b>F_Nac.:</b>
			                    <input type="text" name="fechan" value="<?echo date("Y-m-d");?>" class="cajas" size="10" maxlength="10"></td>
			                  </tr>
                                          <tr><td><br></td></br>
                                       <tr>
                                        <td align="right" colspan="2"><input type="submit" value="Agregar" class="boton"></td>
                                       </tr>
                                    </table>
                                  </form>
                                  <?
		                  $conH="select detallehijo.* from detallehijo,detallempleado where detallempleado.cedemple='$cedemple' and detallempleado.cedemple=detallehijo.cedemple order by detallehijo.tipo";
				  $resuH=mysql_query($conH)or die ("Error al buscar el detalle");
				  $regH=mysql_num_rows($resuH);
		                   ?>
                                    <form action="eliminarhijo.php" method="post">
                                     <input type="hidden" name="cedemple" value="<?echo $cedemple;?>">
                                      <input type="hidden" name="estado" value="<?echo $estado;?>">  
			                   <table border="0" align="center" width="550">
			                     <tr>
			                        <th><br></th><th><br></th><th><b><u>Tipo_Doc.</u></b></th><th><b>&nbsp;<u>Documento</u></b></th><th><b><u>Nombres</u></b></th><th><b><u>F_Nac.</u></b></th> <th><b><u>Parent.</u></b></th>
			                     </tr>
			                     <?
			                     while ($filas=mysql_fetch_array($resuH)):
			                  ?>
			                   <tr class="cajas">
	                                     <input type="hidden" name="cedemple" value="<? echo $cedemple;?>">
	                                         <td>&nbsp;<input type="checkbox" name="busca[]" value="<?echo $filas["codigo"];?>"></td>
	                                         <td>&nbsp;&nbsp;<a href="editar.php?datos=<?echo $filas["codigo"];?>&cedemple=<?echo $cedemple;?>&estado=<?echo $estado;?>"><img src="../image/mod.jpg" border="0" alt="Permite Modificar el Registro"></a></td><td>&nbsp;&nbsp;<?echo $filas["tipo"];?></td>
	                                         <td>&nbsp;&nbsp;<?echo $filas["documento"];?></td>
	                                         <td>&nbsp;&nbsp;<?echo $filas["nombre"];?></td>
	                                         <td>&nbsp;&nbsp;<?echo $filas["fechanac"];?></td>
                                                  <td>&nbsp;&nbsp;<?echo $filas["parentezco"];?></td>
			                   </tr>
			                   <?
			                endwhile;
	                                 ?>
                                         <tr><td><br></td></br>
                                         <tr>
                                        <td align="right" colspan="2"><input type="submit" value="Eliminar" class="boton"></td>
                                       </tr>
                                 </table>
                               </form>
                               <div align="center"><a href="ModificarDetalle.php"><b><h3><font color="red"><u>Volver</u></font></h3></b></a></div>
                               <?
                        else:
                           ?>
                           <script language="javascript">
                              alert("No hay registro de este empleado en sistema")
                              history.back()
                           </script>
                            <?
                        endif;
                   else:
                      ?>
                           <script language="javascript">
                              alert("Este documento digitado no existe en sistema.")
                              history.back()
                           </script>
                            <?
                   endif;
 endif;
     ?>

</body>
</html>
