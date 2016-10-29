<html>
        <head>
                <title>Modificacion Caja de Compensación</title>
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
</script>
        </head>
        <body>
      <?
                        include("../conexion.php");
                        $consulta="select * from caja where caja.codigo_caja_pk='$cod'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                                while ($filas=mysql_fetch_array($resultado)):
        ?>
                                        <center><h4><u>Datos a Modificar</u></h4></center>
                                        <form action="GrabarEditarCaja.php" method="post" id="caja" name="caja">
                                                <table border="0" align="center">
                                                        <tr>
                                                                <td colspan="2"><br></th>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Id_Caja:</B></td>
                                                                <td><input type="text" name="Id" value="<? echo $cod;?>" size="13"class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Id"></td>
                                                        </tr>
                                                         <tr>
                                                                <td><b>Nit_Caja:</b></td>
                                                                <td><input type="text" name="Nit" value="<?echo $filas["nit"];?>"class="cajas" size="13" maxlength="13" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Nit"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Caja:</b></td>
                                                                <td><input type="text" name="Caja" value="<?echo $filas["nombre"];?>"class="cajas" size="45" maxlength="45" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Caja"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Direccion</b></td>
                                                                <td><input type="text" name="DirCaja" value="<?echo $filas["direccion"];?>" class="cajas" size="45" maxlength="45" id="DirCaja"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Telefono</b></td>
                                                                <td><input type="text" name="Telefono" value="<?echo $filas["telefono"];?>" class="cajas"size="13" maxlength="7" id="Telefono"></td>
                                                        </tr>
                                                       <tr>
                                                        <td><b>Estado:</b></td>
			                                          <td><select name="Estado" class="cajasletra" id="Estado">
			                                          <option value="<?echo $filas["estado"];?>" selected><?echo $filas["estado"];?>
			                                                <option value="ACTIVA">ACTIVA
			                                                <option value="INACTIVA">INACTIVA
	                                               </select></td>
                                                       </tr>
                                                       <tr>
					               <td><b>Municipio:</b></td>
					               <td><select name="CodMuni" class="cajas">
					                 <?
					                 $depaux=$filas["codmuni"];
					                 $consulta_d="select * from municipio";
					                 $resultado_d=mysql_query($consulta_d)or die("error al buscar municipios");
					                 while($filas_d=mysql_fetch_array($resultado_d)):
					                   if ($depaux==$filas_d["codmuni"]):
					                 ?>
					                 <option value="<?echo $filas_d["codmuni"];?>" selected><?echo $filas_d["municipio"];?>
					                 <?
					                   else:
					                   ?>
					                     <option value="<?echo $filas_d["codmuni"];?>"><?echo $filas_d["municipio"];?>
					                   <?
					                   endif;
					                 endwhile;
					                 ?> </selet></td>
					             </tr>
                                                        <tr><td><br></td></tr>
                                                        <tr>
                                                                  <td colspan="2"><input type="submit" value="Guardar" class="boton" id="grabar"></td>
                                                        </tr>
        <?
                                         endwhile;
        ?>
                                </form>
                </table>
        </body>
</html>
