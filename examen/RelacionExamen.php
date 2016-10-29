<html>
        <head>
                <title>Parametros de Examen</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                <?
                        if (!isset($Zona)):
                                include("../conexion.php");
                ?>
                <center><h4><u>Parámetros de Examen</u></h4></center>
                <form action="" method="post">
                        <table border="0" align="center"
                                 <tr><td><br></td></tr>
                                 <tr>
			         <td><b>Zona:</b></td>
			         <td colspan="1"><select name="Zona" class="cajasletra">
			               <option value="0">Seleccione la zona
			               <?
			               $consulta_z="select codzona,zona from zona where estado='ACTIVA' and nomina='SI'  order by zona";
			               $resultado_z=mysql_query($consulta_z) or die("Error al buscar zonas");
			                while ($filas_z=mysql_fetch_array($resultado_z)):
			                   ?>
			                   <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
			                   <?
			               endwhile;
			                    ?>
			             </select></td>
			     </tr>
                               <tr>
                                       <td><b>Tipo_Pago:</b></td>
                                        <td><select name="Pago" class="cajas">
                                        <option value="0">Seleccione
                                               <option value="USUARIA">USUARIA
                                                <option value="TEMPORAL">TEMPORAL
                                                <option value="EMPLEADO">EMPLEADO
                                                </select></td>
                                 </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                                <td colspan="2"><input type="submit" Value="Guardar" class="boton">&nbsp;<input type="reset" Value="Limpiar"class="boton"></td>
                                        </tr>
                                        <tr><td><br></td></tr>

                        </table>

                </form>
                 <?
                elseif(empty($Zona)):
                  ?>
                  <script language="javascript">
                     alert("Seleccion la zona de la lista.")
                     history.back()
                  </script>
                  <?
                  elseif(empty($Pago)):
                  ?>
                  <script language="javascript">
                     alert("Seleccione quien paga el examen de ingreso..")
                     history.back()
                  </script>
                  <?
                else:
                    $fechap=date("Y-m-d");
                    $concepto=strtoupper($concepto);
                     include("../conexion.php");
                    $consulta="select parametroexamen.codzona from parametroexamen where Codzona='$Zona'";
	            $resultado=mysql_query($consulta) or die("consulta incorrecta");
	            $registros=mysql_num_rows($resultado);
	            if ($registros==0):
	                     $consulta="insert into parametroexamen (codzona,tipopago)
	                                value('$Zona','$Pago')";
	                     $resultado=mysql_query($consulta) or die("Insercion incorrecta");
	                     $re=mysql_affected_rows();
	                     echo "<script language=\"javascript\">";
	                     echo "open (\"../pie.php?msg=Se Grabo el registro del código: $Zona\",\"pie\");";
	                     echo "open(\"RelacionExamen.php\",\"_self\");";
	                     echo "</script>";
                    else:
                     ?>
                       <script language="javascript">
                         alert("Esta empresa ya tiene el pàrametro establecido")
                         history.back()
                       </script>
                  <?
                    endif;
               endif;
                 ?>
        </body>
</html>
