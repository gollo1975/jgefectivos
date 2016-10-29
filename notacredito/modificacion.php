<html>
        <head>
                <title>Nota Crédito</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
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
                        if (document.getElementById("ValorP").value.length <=0)
                        {
                            alert ("El campo [valor], no puede estar vacío");
                            document.getElementById("ValorP").focus();
                            return;
                        }
                        if (document.getElementById("nota").value.length <=0)
                        {
                            alert ("El campo [concepto], no puede estar vacío");
                            document.getElementById("nota").focus();
                            return;
                        }
                        document.getElementById("matnota").submit();
                    }

                   </script>
            </head>
        <body>
<?
include("../conexion.php");
$consulta="select factura.*,zona.codzona,zona.zona,zona.nitzona,zona.dvzona,zona.vlrfte,zona.vlriva,zona.porcre,zona.iva as ivaestado,zona.dirzona
from factura,zona,tipofactura
where factura.codzona=zona.codzona and
     tipofactura.nroservicio=factura.nroservicio and
    factura.nrofactura='$cod'";
$resultado=mysql_query($consulta)or die("Consulta incorrecta");
$filas=mysql_fetch_array($resultado);
?><center><h4><u>Nota Crédito</u></h4></center><?
  ?>
    <form action="guardar.php" method="post" id="matnota">
	 <td ><input type="hidden" name="porfte" value="<?echo $filas["vlrfte"];?>"</td>
	 <td ><input type="hidden" name="poreteiva" value="<?echo $filas["vlriva"];?>"></td>
	 <td ><input type="hidden" name="porcre" value="<?echo $filas["porcre"];?>"></td>
	 <td ><input type="hidden" name="Cons" value="<?echo $filas["nsaldo"];?>"></td>
     <td ><input type="hidden" name="SubTotal" value="<?echo $filas["subtotal"];?>"></td>
	 <td ><input type="hidden" name="ConF" value="<?echo $filas["rfte"];?>"></td>
	 <td ><input type="hidden" name="ConR" value="<?echo $filas["rteiva"];?>"></td>
	 <td ><input type="hidden" name="SaldoIva" value="<?echo $filas["iva"];?>"</td>
	 <td ><input type="hidden" name="ConC" value="<?echo $filas["vlrcre"];?>"></td>
	 <td ><input type="hidden" name="IvaEstado" value="<?echo $filas["ivaestado"];?>"></td>
         <td ><input type="hidden" name="TipoFactura" value="<?echo $filas["nroservicio"];?>"></td>
         <td ><input type="hidden" name="PorFuente" value="<?echo $filas["porfuente"];?>"></td>
    	 <table border="0" align="center">
              <tr>
               <td><b>Nro_Factura:</b></td>
               <td colspan="2"><input type="text"class="cajas" value="<?echo $filas["nrofactura"];?>" name="nrofactura"size="10" maxlength="10" readonly></td>
               </tr>
               <tr>
               <td><b>Zona:</b></td>
               <td colspan="5"><input type="text" value="<?echo $filas["zona"];?>" class="cajas"name="zona" size="60" maxlength="60"readonly></td>
             </tr>
            <tr>
              <td><b>Nit:</b></td>
               <td colspan="3"><input type="text" value="<?echo $filas["nitzona"];?>"name="nitzona" size="10" maxlength="10" class="cajas" readonly></td>
            </tr>
            <td><b>Dv:</b></td>
               <td colspan="2"><input type="text" value="<?echo $filas["dvzona"];?>"name="dvzona" size="2" maxlength="1" class="cajas" readonly></td>
               </tr>
               <tr>
             <td><b>Dirección:</b></td>
               <td colspan="3"><input type="text" value="<?echo $filas["dirzona"];?>"name="dirzona" size="50" maxlength="50" class="cajas" readonly></td>
              </tr>
              <tr>
              <td><b>Fecha_Grabado:</b></td>
               <td colspan="2"><input type="text" value="<?echo date("Y-m-d");?>"name="fecha" size="10" maxlength="10" class="cajas" readonly></td>
              </tr>
              <tr>
              <td><b>Base:</b></td>
              <td colspan="1"><select name="AplicaBase" class="cajas" id="AplicaBase">
                  <?
                     $consulta="select concepto,nro,estado from parametroiva ";
                     $resultado=mysql_query($consulta) or die("Error al buscar");
                      while ($filas=mysql_fetch_array($resultado)):
                          ?>
                          <option value="<?echo $filas["nro"];?>"><?echo $filas["concepto"];?>
                          <?
                     endwhile;
                        ?>
               </select>           </td>
        </tr>
              <tr>
               <td><b>valor:</b></td>
               <td colspan=3><input type="text" value="" name="ValorP" size="11" maxlength="11" class="cajas"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="ValorP"></td>
               <td colspan=3><input type="hidden" value="10" name="base" size="11" ></td>
               </tr>
               <tr>
               <td><b>Concepto:</b></td>
               <td colspan="5"><textarea name="nota" cols="60" rows="6" class="cajas"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nota"></textarea></td>
             </tr>
            <tr><td><br></td></tr>
             <tr>
               <td colspan="2">
               <input type="button" value="Guardar" class="boton" onClick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
             </tr>
  </table>
 </form>
</body>
</html>
