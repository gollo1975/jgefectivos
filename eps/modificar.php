<html>
        <head>
                <title>Modificacion de Eps</title>
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
                        $consulta="select * from eps where codeps='$cod'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                                while ($filas=mysql_fetch_array($resultado)):
        ?>
                                        <center><h4><u>Datos a Modificar</u></h4></center>
                                        <form action="guardar.php" method="post">
                                                <table border="0" align="center">
                                                        <tr>
                                                                <td colspan="2"><br></th>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Cód_Eps:</B></td>
                                                                <td><input type="text" name="codeps" value="<? echo $cod;?>" size="13"class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codeps"></td>
                                                        </tr>
                                                         <tr>
                                                                <td><b>Nit_Eps:</b></td>
                                                                <td><input type="text" name="Nit" value="<?echo $filas["nit"];?>"class="cajas" size="13" maxlength="13" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Nit"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Eps:</b></td>
                                                                <td><input type="text" name="eps" value="<?echo $filas["eps"];?>"class="cajas" size="40" maxlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="eps"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Direccion</b></td>
                                                                <td><input type="text" name="direps" value="<?echo $filas["direps"];?>" class="cajas" size="40" maxlength="40"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Telefono</b></td>
                                                                <td><input type="text" name="teleps" value="<?echo $filas["teleps"];?>" class="cajas"size="10" maxlength="7"></td>
                                                        </tr>
                                                       <tr>
					               <td><b>Municipio:</b></td>
					               <td><select name="municipio" class="cajas">
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
                                                                  <td colspan="2"><input type="submit" value="Guardar" class="boton" ></td>
                                                        </tr>
        <?
                                         endwhile;
        ?>
                                </form>
                </table>
        </body>
</html>
