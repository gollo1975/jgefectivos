        <html>
        <head>
                <title>Matricula de Mercado</title>
             <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
              <script type="text/javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                         function ValidarCuota()
		         {
		              var  pago =  document.getElementById("FormaPago").value;
		              var Valor = document.getElementById("cupo").value;
		              var TotalC = 0;
                              if(pago=='SEMANAL'){
                                 TotalC = parseFloat(Valor/4);
                                 document.getElementById("Cuota").value = TotalC.toFixed(0);
                              }else{
                                   if(pago=='DECADAL'){
                                      TotalC = parseFloat(Valor/3);
                                      document.getElementById("Cuota").value = TotalC.toFixed(0);
                                   }else{
                                        if(pago=='CATORCENAL'){
	                                    TotalC = parseFloat(Valor/2);
	                                    document.getElementById("Cuota").value = TotalC.toFixed(0);
                                        }else{
                                              if(pago=='QUINCENAL'){
		                                  TotalC = parseFloat(Valor/2);
		                                  document.getElementById("Cuota").value = TotalC.toFixed(0);
                                              }else{
                                                     TotalC = parseFloat(Valor);
		                                     document.getElementById("Cuota").value = TotalC.toFixed(0);
		                              }
                                        }
                                   }
                              }
		         }

                </script>
       </head>
        <body>
                <?
                if (!isset($cedemple)):
                     ?>
                   <center><h4>Autorizar Mercados</h4></center>
                   <form action="" method="post" id="mercado">
                        <table border="0" align="center"
                                <tr>
                                   <td colspan="9" class="fondo"></td>
                                </tr>
                                <tr><td><br></td></tr>
                                 <tr>
                                  <td><b>Documento Identidad:</b></td>
                                    <td><input type="text" name="cedemple" value="" size="15" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
                                </tr>
                                <tr><td><br></td></tr>
                               <tr>
                                        <td colspan="8"><input type="submit" Value="Buscar" class="boton">&nbsp;<input type="reset" Value="Limpiar"  class="boton"></td>
                                </tr>
                        </table>
                   </form>
                   <?
                   elseif(empty($cedemple)):
                     ?>
                     <script language="javascript">
                       alert("Debe de Digitar el Documento de Identidad ?")
                       history.back()
                     </script>
                     <?
                    else:
                       include("../conexion.php");
                        $estado=false;
                       $consu1="select empleado.cedemple from empleado
                        where empleado.nomina='SI'
                              and empleado.cedemple='$cedemple'";
                        $resu1=mysql_query($consu1)or die("Consulta incorrecta 1");
                         if(mysql_num_rows($resu1)!=0):
                           $consu2="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,contrato
                                   where empleado.codemple=contrato.codemple
                                       and contrato.fechater='0000-00-00'
                                       and empleado.cedemple='$cedemple'";
                           $resu2=mysql_query($consu2)or die("Consulta incorrecta 2");
                           $reg=mysql_num_rows($resu2);
                           if($reg!=0):
                              $consu3="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1, mercado.* from mercado,empleado
                                   where empleado.cedemple=mercado.cedemple
                                         and mercado.nsaldo > 0
                                         and empleado.cedemple='$cedemple'";
                                         $resu3=mysql_query($consu3)or die("Consulta incorrecta 3");
                               if(mysql_num_rows($resu3)==0):
                                 $estado=true;
                               else:
                                  ?>
                                  <script language="javascript">
                                    alert("Este Empleado tiene que estar a PAZ Y SALVO en el sistema de Mercado ?")
                                    history.back()
                                  </script>
                                 <?
                               endif;
                           else:
                            ?>
                              <script language="javascript">
                                alert("Este Empleado Esta retirado del Sistema, O Inactivo con la Empresa ?")
                                history.back()
                              </script>
                            <?
                           endif;
                         else:
                          ?>
                           <script language="javascript">
                             alert("El documento No existe en el sistema / O no pertenece a Nomina ?")
                             history.back()
                           </script>
                            <?
                         endif;
                       if($estado==true):
                            $consu="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,parametromercado.cupo,empleado.periodo from empleado,parametromercado
                                   where empleado.cedemple='$cedemple'";
                           $resu2=mysql_query($consu)or die("Consulta incorrecta 2");
                           $filas=mysql_fetch_array($resu2);
                             ?>
                                 <center><h4><u>Autorizar Mercados</u></h4></center>
                                 <form action="guardar.php"method="post" id="f1">
                                 <input type="hidden" name="FormaPago" value="<?echo $filas["periodo"];?>" size="15" maxlength="15" id="FormaPago">
                                     <table border="0" align="center">
                                     <tr><td><br></td></tr>
                                        <tr>
                                            <td><b>Documento:</b></td>
                                              <td><input type="text" name="cedemple" value="<?echo $cedemple?>" size="15" maxlength="15" readonly class="cajas" id="cedemple"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Empleado:</b></td>
                                              <td><input type="text"  value="<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?>" size="50" mexlength="50" class="cajas"readonly ></td>
                                        </tr>
                                           <tr>
                                            <td><b>F_Grabado:</b></td>
                                              <td><input type="text" name="fecha" value="<?echo date("Y-m-d");?>" size="15" maxlength="10" class="cajas" readonly  id="fecha"></td>
                                           </tr>
                                           <td><b>Cupo:</b></td>
                                              <td><input type="text" name="cupo" value="" size="15" mexlength="11" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cupo"></td>
                                           </tr>
                                            <td><b>Cuota:</b></td>
                                              <td><input type="text" name="Cuota" value="" size="15" mexlength="11" class="cajas" onfocus= "ValidarCuota()" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Cuota"  ></td>
                                           </tr>
                                              <td><input type="hidden" name="cuporeal" value="<?echo $filas["cupo"];?>" ></td>
                                           </tr>
                                           <tr>
                                               <td><b>Estado:</b></td>
                                                 <td><select name="estado" class="cajas" id="estado">
                                                      <option value="ACTIVO">ACTIVO
                                                </select></td>
                                            </tr>
                                            <tr>
                                              <td><b>Autorización:</b></td>
                                              <td><input type="text" name="autoriza" value="" size="50" mexlength="50" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="autoriza"></td>
                                             <tr>
                                             <tr>
                                        <td><b>Alianza:</b></td>
                                        <td>    <select name="codigo" class="cajas" id="codigo">
                                                <option value="0">Seleccione la Alianza
                                                    <?
                                                     $consulta_b="select codsala,desala from salario,parametro where parametro.codigo=salario.codsala and parametro.nivel='3' order by desala";
                                                     $resultado_b=mysql_query($consulta_b) or die("consulta de codigos de nomina Incorrecta");
                                                     while ($filas_b=mysql_fetch_array($resultado_b)):
                                                        ?>
                                                        <option value="<?echo $filas_b["codsala"];?>"><?echo $filas_b["desala"];?>
                                                        <?
                                                     endwhile;
                                                    ?>
                                                </select></td>
                                        </tr>
                                        <tr><td><br></td></tr>
                                           <tr>
                                                    <td colspan="8"><input type="submit" Value="Guardar" class="boton" id="grabar">&nbsp;<input type="reset" Value="Limpiar"  class="boton"></center></td>
                                            </tr>
                            </table>

                        </form>
                       <?
                  endif;
             endif;
                  ?>

       </body>
</html>
