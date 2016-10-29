
 <head>
                <title>Comisión Cartera</title>
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
                        include("../conexion.php");
                          ?>
                               <center><h4>Comisión cartera</h4></center>
                               <form action="" method="post" id ="imacentro">
                                        <table border="0" align="center"
                                          <tr><td><br></td></tr>
                                       <tr>
                                        <td><b>&nbsp;Documento:&nbsp;</b></td>
                                        <td colspan="1"><input type="text" name="cedula" value="" size="15" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"&nbsp;></td>
                                       </tr>
                                        <tr>
                                        <td><b>&nbsp;Desde:&nbsp;</b></td>
                                        <td colspan="1"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde"&nbsp;></td>
                                        <td><b>&nbsp;Hasta:&nbsp;</b></td>
                                        <td colspan="1"><input type="text" name="hasta" value="<?echo date("Y-m-d");?>" size="10" maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta"&nbsp;></td>
                                       </tr>
                                       <tr>
				         <td><b>Servicios:</b></td>
				            <td colspan="5"><select name="servicio" class="cajas">
                                            <option value="0">Seleccion el servicio
				            <?
				             $consulta_s="select codcom,concepto from item";
				             $resultado_s=mysql_query($consulta_s)or die ("Error en la busqueda de Items");
				             while($filas_s=mysql_fetch_array($resultado_s))
				             {
				              ?>
				              <option value="<?echo $filas_s["codcom"];?>"> <?echo $filas_s["concepto"];?>
				              <?
				              }
				              ?></select></td>
				       </tr>
                                        <tr>
				        <td><b>Empresa:</b></td>
				          <td colspan="5"><select name="empresa" class="cajas">
				          <option value="0">Seleccione Principal
				          <?
				            $consulta_e="select codmaestro,nomaestro from maestro";
				            $resultado_e=mysql_query($consulta_e)or die ("Consulta de empresa incorrecta");
				            while($filas_e=mysql_fetch_array($resultado_e)):
				              ?>
				              <option value="<?echo $filas_e["codmaestro"];?>"> <?echo $filas_e["nomaestro"];?>
				              <?
				              endwhile;
				              ?></select></td>
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
                               open("agregarcartera.php","_self")
                             </script>
                             <?
                            endif;
                            include("../conexion.php");
                            $consu = "select relacioncomision.*,vendedor.nombreven from maestro,vendedor,relacioncomision
                                 where  maestro.codmaestro=vendedor.codmaestro and
                                        vendedor.cedulaven=relacioncomision.cedulaven and
                                        vendedor.cedulaven='$cedula' and
                                        relacioncomision.estado='ACTIVA' and
                                        maestro.codmaestro='$empresa' order by relacioncomision.zona";
                                  $res= mysql_query($consu) or die ("Error en la consulta de zonas ");
                                  $reg=mysql_num_rows($res);
                                   if ($reg!=0):

                                        ?>
                                        <div align="center"><h5><u>Zonas con cartera</u></h5></div>
                                        <form action="cargar.php" method="post">
                                         <input type="hidden" name="codigo" value="<? echo $codigo;?>">
                                         <input type="hidden" name="desde" value="<? echo $desde;?>">
                                         <input type="hidden" name="hasta" value="<? echo $hasta;?>">
                                         <table border="0" align="center">
                                                 <tr>
                                                 <th>Item</th><th><br></th><th><b>&nbsp;Cod_Zona</b></th><th><b>&nbsp;&nbsp;Zona</b></th>
                                                </tr>
                                                  <?
                                                      $a=1;
                                                     while ($registro = mysql_fetch_array($res))
                                                    {
                                                   ?>
                                                     <tr class="cajas">
                                                     <th> <?echo $a;?></th>
                                                       <td>&nbsp;&nbsp;<a href="cargarcartera.php?codigo=<?echo $codigo;?>&empresa=<?echo $empresa;?>&codzona=<?echo $registro["codzona"];?>&porcentaje=<?echo $registro["comision"]?>&servicio=<?echo $servicio;?>&cedula=<?echo $cedula;?>&zona=<?echo $registro["zona"];?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>"><img src="../image/mod.jpg" border="0" alt="Permite Enviar el Registros para agregar la comisión"></a></td><td>&nbsp;&nbsp;<?echo $registro["codzona"];?></td>
                                                       <td>&nbsp;&nbsp;&nbsp;<?echo $registro["zona"];?></td>
                                                     </tr>
                                                    <?
                                                    $a=$a+1;
                                                     }
                                                  ?>


                                          </table>
                                          <br>
                                         <tr><td><br></td></tr>
                                        <center><td ><a href="agregarcartera.php"><b>Volver<b></a></td></center>
                                       </form>
                                       <?
	                             else:
	                               ?>
	                             <script language="javascript">
	                               alert("No zonas a cargo de este Vendedor ?")
	                               open("agregarcartera.php","_self")
	                             </script>
	                             <?
	                             endif;
              endif;
?>
</body>
</html>
