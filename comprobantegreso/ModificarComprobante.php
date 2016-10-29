<html>
        <head>
                <title>Editar Comprobante</title>
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
                        if (document.getElementById("fechapago").value.length <=0)
                        {
                            alert ("Digite la fecha de pago para este documento");
                            document.getElementById("fechapago").focus();
                            return;
                         }
                         if (document.getElementById("pagado").value.length <=0)
                        {
                            alert ("Digite el valor de pago para este documento");
                            document.getElementById("pagado").focus();
                            return;
                         }

                        document.getElementById("f1").submit();
                    }

                   </script>


        </head>
        <body>
        <?
include("../conexion.php");
$con="select maestrocomprobante.*  from maestrocomprobante
   where maestrocomprobante.nro='$NroC'";
$resu=mysql_query($con)or die("Error en la busqueda de Factura");
$regi=mysql_num_rows($resu);
$filas=mysql_fetch_array($resu);
            ?>
                <center><h4><u>Editar Comprobante</u></h4></center>
                <form action="GrabarEditar.php" id="f1" method="post" name="f1">
                <input type="hidden" name="Usuario" value="<?echo $Usuario;?>"> 
                        <table border="0" align="center">

                                <tr>
                                        <td><b>Nro_Comp.:</b></td>
                                        <td><input type="text" name="Nro" value="<?echo $NroC;?>" size="13" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nro">
                               </tr>
                               <tr>
                                        <td ><b>F_Pago:</b></td>
                                        <td><input type="text" name="fechapago" value="<?echo $filas["fechapago"]?>" size="13" maxlength="10"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechapago">
                                </tr>
                               <tr>
                                        <td ><b>Vlr_Pagado:</b></td>
                                        <td><input type="text" name="pagado" value="<?echo $filas["vlrpagado"]?>" size="13" maxlength="10"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="pagado">
                                </tr>
                                <tr>
			               <td><b>Tipo_Comprobante:</b></td>
			               <td><select name="TipoC"class="cajas" id="TipoC" >
			                 <?
			                 $Aux=$filas["id"];
			                 $con="select id,descripcion from tipocomprobante where estado='ACTIVO'order by descripcion";
			                 $res=mysql_query($con)or die("Consulta  incorrecta");
			                 while($fila=mysql_fetch_array($res)):
			                   if ($Aux==$fila["id"]):
			                      ?>
				                 <option value="<?echo $fila["id"];?>" selected><?echo $fila["descripcion"];?>
				                 <?
				           else:
				           ?>
				                     <option value="<?echo $fila["id"];?>"><?echo $fila["descripcion"];?>
				             <?
				            endif;
				         endwhile;
			                 ?> </selet></td>
		               </tr>
                                <tr>
			               <td><b>Municipio:</b></td>
			               <td><select name="CodMuni"class="cajas" id="CodMuni" >
			                 <?
			                 $AuxM=$filas["codmuni"];
			                 $conM="select codmuni,municipio from municipio,departamento where municipio.codepart=departamento.codepart order by municipio";
			                 $resM=mysql_query($conM)or die("Consulta  incorrecta de municipios");
			                 while($filaM=mysql_fetch_array($resM)):
			                   if ($AuxM==$filaM["codmuni"]):
				                 ?>
				                 <option value="<?echo $filaM["codmuni"];?>" selected><?echo $filaM["municipio"];?>
				                 <?
				           else:
				                   ?>
				                     <option value="<?echo $filaM["codmuni"];?>"><?echo $filaM["municipio"];?>
				                   <?
			                   endif;
			                 endwhile;
			                 ?> </selet></td>
		               </tr>
                              <tr><td><br></td></tr>
                              <tr>
                              <td cospan="3"><input type="button" value="Enviar" class="boton"  id="buscar" onclick="chequearcampos()"</td>
                              </tr>
                </table>
        </form>
        </body>
</html>
