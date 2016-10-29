<html>
<head>
<title>Modificar facturas por pagar</title>
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
</script>
</head>
<body>
<?
 include("../conexion.php");
    $consulta="select * from pagar where nrofactura='$xbusca' and nitprove='$nit'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta1");
    $registro=mysql_num_rows($resultado);
      while($filas=mysql_fetch_array($resultado)):
           ?>
           <center><h5>Detallado de la Factura o Documento</h5></center>
             <form action="" method="post">
               <table border="0" align="center" width="400">
              <tr><td><br></td></tr>
             <tr>
             <tr>
               <td><b>Nro_Factura:</b></td>
               <td><input type="text" value="<?echo $filas["nrofactura"];?>" name="nrofactura" size="10" maxlength="10"readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nrofactura"></td>
             </tr>
             <tr>
              <td><b>Proveedor:</b></td>
               <td colspan="5"><select name="provedor" class="cajas">
                 <?
                 $paux=$filas["nitprove"];
                 $consulta_e="select provedor.nitprove,provedor.nomprove from provedor order by nomprove";
                 $resultado_e=mysql_query($consulta_e)or die("Consulta de incorrecta");
                 while($filas_e=mysql_fetch_array($resultado_e)):
                   if ($paux==$filas_e["nitprove"]):
                 ?>
                 <option value="<?echo $filas_e["nitprove"];?>"selected> <?echo $filas_e["nomprove"];?>
                 <?
                   else:
                   ?>
                    <option value="<?echo $filas_e["nitprove"];?>"><?echo $filas_e["nomprove"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             <tr>
               <td><b>Fecha_Inicio:</b></td>
               <td><input type="text" value="<?echo $filas["fechaini"];?>"name="fechaini" size="11" maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechaini"></td>
                <td><b>Fecha_Vencimiento:</b></td>
               <td><input type="text" value="<?echo $filas["fechaven"];?>"name="fechaven" size="11" maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechaven"></td>
             </tr>
             <tr>
               <td><b>Fecha_Grabado:</b></td>
               <td><input type="text" value="<?echo $filas["fechagra"];?>"name="fechagra" size="11" maxlength="10"readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechagra"></td>
                 <td><b>Subtotal:</b></td>
               <td><input type="text" value="<?echo $filas["subtotal"];?>"name="subtotal" size="11" maxlength="11"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="subtotal"></td>
             </tr>
             <tr>
               <td><b>Dcto:</b></td>
               <td><input type="text" value="<?echo $filas["dcto"];?>"name="dcto" size="5" maxlength="5"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dcto"></td>
                <td><b>Total_Base:</b></td>
               <td><input type="text" value="<?echo $filas["valor"];?>"name="totalbase" size="11" maxlength="11"onfocus="calculorfte()" id="totalbase"></td>
             </tr>
             </tr>
               <td><b>Rfte:</b></td>
               <td><input type="text" name="rfte" value="<?echo $filas["rfte"];?>" size="11" maxlength="11"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="rfte"></td>
               <td><b>Base Rfte:</b></td>
              <td><input type="text" name="baserfte" value="<?echo $filas["baserfte"];?>" size="11" maxlength="11" onfocus="calculobase()" id="baserfte"></td>
            </tr>
             <tr>
               <td><b>Iva_Pagado:</b></td>
               <td><input type="text" value="<?echo $filas["ivapagado"];?>"name="ivapagado" size="11" maxlength="11"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ivapagado"></td>
                <td><b>Total_Pagar:</b></td>
               <td><input type="text" value="<?echo $filas["total"];?>"name="totalpagar" size="11" maxlength="11"onfocus="calculototal()" id="totalpagar"></td>
             </tr>
             <tr>
                  <td><b>Estado:</b></td>
                  <td><select name="estado" class="cajas">
                  <option value="<?echo $filas["estado"];?>" selected><?echo $filas["estado"];?>
                  <option value="1">Factura
                  <option value="2">Cta de Cobro
                </select></td>
             </tr>
             <td><b>Observación:</b></td>
               <td colspan="5"><textarea name="nota" cols="55" rows="4" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"><?echo $filas["nota"];?></textarea></td></tr>
                <tr>
             <?
            endwhile;
       ?>
     </table>
     </form>
</body>
</html>
