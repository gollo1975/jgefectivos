
 <head>
                <title>Crear Comisión</title>
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
               if (document.getElementById("cedula").value.length <=0)
           {
                alert ("Digite el Documento del Empleado");
                document.getElementById("cedula").focus();
                return;
           }
             document.getElementById("imacentro").submit();
        }

</script>
                <?
                     if (!isset($cedula)):
                          ?>
                               <center><h4>Generar Comisión</h4></center>
                               <form action="" method="post" id ="imacentro">
                                        <table border="0" align="center"
                                          <tr><td><br></td></tr>
                                       <tr>
                                        <td><b>&nbsp;Documento:&nbsp;</b></td>
                                        <td><input type="text" name="cedula" value="" size="15" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"&nbsp;></td>
                                       </tr>
                                        <tr>
                                        <td><b>&nbsp;Desde:&nbsp;</b></td>
                                        <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde"&nbsp;></td>
                                        <td><b>&nbsp;Hasta:&nbsp;</b></td>
                                        <td><input type="text" name="hasta" value="<?echo date("Y-m-d");?>" size="10" maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta"&nbsp;></td>
                                       </tr>
                                       <tr><td><br></td></tr>
                                        <tr><td ><input type="button" Value="Buscar Dato" class="boton" onclick="enviar()"></td></tr>
                                     </table>
                                 </form>
                        <?
                        else:
                           include("../conexion.php");
                           $con="select vendedor.cedulaven,vendedor.nombreven from vendedor where
                                  vendedor.cedulaven='$cedula'";
                           $resu=mysql_query($con)or die ("Consulta Incorrecta");
                           $reg=mysql_num_rows($resu);
                           if($reg!=0):

                             while ($filas = mysql_fetch_array($resu)):
                             ?>
                          <center><h5>Generar Comisión</h5></center>
                             <form action="" method="post">
                              <input type="hidden" name="codigo" value="<? echo $codigo;?>">
                               <table border="0" align="center">
                                <tr><td><br></td></tr>
                               <tr>
                                       <td><b>Documento:</b></td>
                                       <td><input type="text" name="cedula" value="<? echo $cedula;?>" size="12" class="cajas"  readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
                                     </tr>
                                     <tr>
                                       <td><b>Vendedor:</b></td>
                                       <td colspan="5"><input type="text"  value="<? echo $filas["nombreven"];?>" name="nombre" size="40" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
                                     </tr>
                                     <tr>
                                       <td><b>Desde:</b></td>
                                       <td><input type="text"  value="<? echo $desde;?>" name="desde" size="10" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde"></td>
                                       <td><b>Hasta:</b></td>
                                       <td><input type="text"  value="<? echo $hasta;?>" name="hasta" size="10" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta"></td>
                                     </tr>
                                </table>
                              </form>
                             <?
                             endwhile;
                           else:
                              ?>
                             <script language="javascript">
                               alert("Este Vendedor No existe en la Base de datos  ?")
                               open("agregar.php","_self")
                             </script>
                             <?
                            endif;
                            include("../conexion.php");
                            $consu = "select sucursal.codsucursal,zona.codzona,zona.zona,zona.fechaini,vendedor.nombreven from vendedor,sucursal,zona
                                 where  sucursal.codsucursal=vendedor.codsucursal and
                                        zona.codsucursal=sucursal.codsucursal and
                                        vendedor.cedulaven='$cedula'and
                                        zona.estado='ACTIVA' and
                                        zona.genere='SI'";
                                  $res= mysql_query($consu) or die ("Error en la consulta de zonas ");
                                  $reg=mysql_num_rows($res);
                                   if ($reg!=0):

                                        ?>
                                        <div align="center"><h5>Listado de Zonas</h5></div>
                                        <form action="cargar.php" method="post">
                                         <input type="hidden" name="codcomision" value="<? echo $codcomision;?>">
                                         <input type="hidden" name="desde" value="<? echo $desde;?>">
                                         <input type="hidden" name="hasta" value="<? echo $hasta;?>">
                                         <table border="0" align="center">
                                                <tr><td>&nbsp;</td></tr>
                                                 <tr>
                                                <td><br></td><td><b>&nbsp;Cod_Zona</b></td><td><b>&nbsp;&nbsp;Zona</b></td><td><b>&nbsp;&nbsp;Fecha_Inicio</b></td>
                                                </tr>
                                                <tr>
                                                        <td><br></td>
                                                </tr>

                                                  <?

                                                     while ($registro = mysql_fetch_array($res))
                                                    {
                                                   ?>
                                                     <tr class="cajas">
                                                       <td>&nbsp;&nbsp;<a href="cargar.php?datos=<?echo $registro["codzona"];?>&codcomision=<?echo $codcomision;?>&cedula=<?echo $cedula;?>&zona=<?echo $registro["zona"];?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>"><img src="../image/mod.jpg" border="0" alt="Permite Enviar el Registros para agregar la comisión"></a></td><td>&nbsp;&nbsp;<?echo $registro["codzona"];?></td>
                                                       <td>&nbsp;&nbsp;&nbsp;<?echo $registro["zona"];?></td>
                                                       <td>&nbsp;&nbsp;&nbsp;<?echo $registro["fechaini"];?></td>
                                                     </tr>
                                                    <?
                                                     }
                                                  ?>


                                          </table>
                                          <br>
                                         <tr><td><br></td></tr>
                                        <center><td ><a href="agregar.php"><b>Volver<b></a></td></center>
                                       </form>
                                       <?
	                             else:
	                               ?>
	                             <script language="javascript">
	                               alert("No zonas a cargo de este Vendedor ?")
	                               open("agregar.php","_self")
	                             </script>
	                             <?
	                             endif;
              endif;
?>
</body>
</html>
