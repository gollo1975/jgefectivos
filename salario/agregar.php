<html>
        <head>
                <title>Agregar Salario</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
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
                        if (document.getElementById("codsala").value.length <=0)
                        {
                            alert ("Digite el Codigo del Salario");
                            document.getElementById("codsala").focus();
                            return;
                        }
                       if (document.getElementById("desala").value.length <=0)
                        {
                            alert ("El campo Descripción no puede estar vacío");
                            document.getElementById("desala").focus();
                            return;
                        }

                         document.getElementById("matsala").submit();

                    }
                </script>
        </head>
        <body>
                <?
                        if (!isset($desala))
                        {
                                include("../conexion.php");
                ?>
                <center><h4><u>Matricular Código</u></h4></center>
                <form action="" method="post"id="matsala">
                        <table border="0" align="center"

                                <tr>
                                <tr>
                                        <td><b>Cod_Salario:</b></td>
                                        <td><input type="text" name="codsala" value="" size="10" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codsala">
                                        <td><b>Descripción:</b></td>
                                        <td><input type="text" name="desala" value="" size="50" maxlength="45" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desala">
                                </tr>
                                <tr>
                                        <td><b>Porcentaje:</b></td>
                                        <td><input type="text" name="porcentaje" value="" size="5" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="porcentaje">
                                        <td><b>A_Transporte:</b></td>
                                        <td><input type="text" name="ayuda" value="" size="15" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ayuda">
                                </tr>
                                <tr>
                                        <td><b>Prestac.:</b></td>
                                        <td><select name="prestacion" class="cajas">
                                            <option value="NO">NO
                                            <option value="SI">SI
                                         </select></td>
                                        <td><b>C.Costo_Visi:</b></td>
                                        <td><select name="control" class="cajas">
                                            <option value="NO">NO
                                            <option value="SI">SI
                                         </select></td>
                                </tr>
                                  <tr>
                                        <td><b>Modulo_N.:</b></td>
                                        <td><select name="insertar" class="cajas">
                                            <option value="NO">NO
                                            <option value="SI">SI
                                         </select></td>
                                        <td><b>Sumar_Credito:</b></td>
                                        <td><select name="SumarC" class="cajas">
                                            <option value="NO">NO
                                            <option value="SI">SI
                                         </select></td>
                                </tr>
                                 <tr>
                                        <td><b>Ingreso:</b></td>
                                        <td><select name="Ingreso" class="cajas">
                                            <option value="NO">NO
                                            <option value="SI">SI
                                         </select></td>
                                        <td><b>Egreso:</b></td>
                                        <td><select name="Egreso" class="cajas">
                                            <option value="NO">NO
                                            <option value="SI">SI
                                         </select></td>
                                </tr>
                                  <tr>
                                        <td><b>Forma_Pago:</b></td>
                                        <td><select name="FormaPago" class="cajas">
                                            <option value="DIAS">DIAS
                                            <option value="HORAS">HORAS
                                            <option value="NINGUNA">NINGUNA
                                             <option value="COMISION">COMISION
                                             <option value="DEDUCCION">DEDUCCION
                                             <option value="ANUAL">ANUAL    
                                           </select></td>
                                        <td><b>Acumular_Horas:</b></td>
                                        <td><select name="TotalHoras" class="cajas">
                                            <option value="NO">NO
                                            <option value="SI">SI
                                            <option value="IGUAL">IGUAL
                                            <option value="ING">ING
                                         </select></td>
                                </tr>
                                  <tr>
                                        <td><b>Activos:</b></td>
                                        <td><select name="Activo" class="cajas">
                                            <option value="NO">NO
                                            <option value="SI">SI
                                         </select></td>
                                            <td><b>Permanente:</b></td>
                                        <td><select name="Permanente" class="cajas">
                                            <option value="NO">NO
                                            <option value="SI">SI
                                         </select></td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                                <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar"class="boton"></td>
                                        </tr>

                        </table>
             
                </form>
                      <?
                        }
                        else
                        {
                                include("../conexion.php");
                                $consulta="select * from salario where codsala='$codsala'";
                                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                                $registros=mysql_num_rows($resultado);
                                $desala=strtoupper($desala);
                                if ($registros==0)
                                {
                                        $consulta="insert into salario (codsala,desala,porcentaje,ayuda,prestacion,control,insertar,sumarcupo,ingreso,egreso,formapago,totalhoras,activo,permanente)
                                                        value('$codsala','$desala','$porcentaje','$ayuda','$prestacion','$control','$insertar','$SumarC','$Ingreso','$Egreso','$FormaPago','$TotalHoras','$Activo','$Permanente')";
                                        $resultado=mysql_query($consulta) or die("Insercion incorrecta");
                                         $re=mysql_affected_rows();
                                         echo "<script language=\"javascript\">";
                                        echo "open (\"../pie.php?msg=Se Grabo registros de la cuenta  Nro: $codsala\",\"pie\");";
                                              echo "open(\"agregar.php\",\"_self\");";
                                        echo "</script>";

                                }
                                else
                                {
                ?>

                                        <script language="javascript">
                                                alert("El Registro ya Existe")
                                                open("agregar.php","_self");
                                        </script>
                 <?
                                }
                        }
                 ?>
        </body>
</html>
