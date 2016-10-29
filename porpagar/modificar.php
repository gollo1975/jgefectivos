<html>
<head>
<title>Modificar facturas por pagar</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
     function calculodcto()
                        {
                         var uno = 0
                         var dos = 0
                         var tres = 0
                         uno = document.getElementById("subtotal").value;
                         dos = document.getElementById("dcto").value;
                         tres = (uno * dos)/100;
                         document.getElementById("totalbase").value = tres.toFixed(0);
                    }
         function calculocre()
                        {
                         var aux = 0
                         var aux1 = 0
                         var aux  = document.getElementById("subtotal").value;
                         aux1 = document.getElementById("porcre").value;
                         aux2 = (aux * aux1)/100;
                         document.getElementById("basecre").value = aux2.toFixed(0);
                    }
       function calculobase()
                        {
                         var suma = 0
                         var suma1 = 0
                         var suma2 = 0
                         var suma3 = 0
                         var suma4 = 0
                         var suma = document.getElementById("subtotal").value;
                         suma1 = document.getElementById("totalbase").value;
                         suma2 = document.getElementById("rfte").value;
                         suma3 = (suma - suma1);
                         suma4 = (suma3 * suma2)/100;
                         document.getElementById("baserfte").value = suma4.toFixed(0);
                    }
                    function calculototal()
                        {
                         var xl = 0
                         var xl1 = 0
                         var xl2 = 0
                         var negativo = 0
                         xl = parseFloat(document.getElementById("subtotal").value) + parseFloat(document.getElementById("ivapagado").value);
                         negativo = parseFloat(document.getElementById("baserfte").value) + parseFloat(document.getElementById("totalbase").value) + parseFloat(document.getElementById("basecre").value);
                         document.getElementById("totalpagar").value = parseFloat(xl-negativo);
                    }
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
if (!isset($nrofactura)):
?>
<center><h4><u>Editar Compras</u></h4></center>
  <form action="" method="post" id="Modi" name="Modi">
    <table border="0" align="center">
      <tr>
        <td colspan="2" class="fondo"></td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
        <td><b>Nro_Factura:&nbsp;</b></td>
        <td><input type="text" name="nrofactura" value="" size="12" class="cajas" maxlength="12"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nrofactura">&nbsp;</td>
      </tr>
      <tr>
        <td><b>Nit/Cedula:&nbsp;</b></td>
        <td><input type="text" name="nit" value="" size="12" class="cajas" maxlength="12"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nit">&nbsp;</td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton" id="buscar" name="buscar">
      </td>
    </tr>
   </table>
    </form>
<?
elseif(empty($nrofactura)):
?>
  <script language="javascript">
    alert("Digite el Nro  de Factura a consultar!")
    history.back()
  </script>
<?
elseif(empty($nit)):
?>
  <script language="javascript">
    alert("Digite el Nit/Cedula del Proveedor ?")
    history.back()
  </script>
<?
  else:
    include("../conexion.php");
    $consulta="select * from pagar where nrofactura='$nrofactura' and nitprove='$nit'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta1");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
     ?>
     <script language="javascript">
       alert("El Nro de Factura digitado no existe en Sistema o no hace parte de esta empresa ?")
       history.back()
     </script>
    <?
     else:
        $con="select pagar.* from pagar,comprobante where comprobante.nrofactura=pagar.nrofactura and pagar.nrofactura='$nrofactura'";
        $res=mysql_query($con)or die("Consulta incorrecta");
        $reg=mysql_num_rows($res);
        if($reg==0):
           while($filas=mysql_fetch_array($resultado)):
           ?>
           <center><h4><u>Editar Compras</u></h4></center>
             <form action="guardareditar.php" method="post">
             <input type="hidden" name="nit" value="<? echo $nit;?>">
               <table border="0" align="center" width="400">
                 <tr class="fondo">
                   <td colspan="8"></td>
             </tr>
             <tr><td><br></td></tr>
             <tr>
               <td><b>Nro_Factura:</b></td>
               <td><input type="text" value="<?echo $filas["nrofactura"];?>" name="nrofactura" size="10" class="cajas" maxlength="10"readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nrofactura"></td>
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
                 ?> </select></td>
             <tr>
               <td><b>Fecha_Inicio:</b></td>
               <td><input type="text" value="<?echo $filas["fechaini"];?>"name="fechaini" size="11" maxlength="10" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechaini"></td>
                <td><b>F_Vcto:</b></td>
               <td><input type="text" value="<?echo $filas["fechaven"];?>"name="fechaven" size="11" maxlength="10" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechaven"></td>
             </tr>
             <tr>
               <td><b>Fecha_Grabado:</b></td>
               <td><input type="text" value="<?echo $filas["fechagra"];?>"name="fechagra" size="11" maxlength="10" class="cajas"readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechagra"></td>
                 <td><b>Subtotal:</b></td>
               <td><input type="text" value="<?echo $filas["subtotal"];?>"name="subtotal" size="11" maxlength="11" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="subtotal"></td>
             </tr>
             <tr>
               <td><b>Dcto_Cree:</b></td>
               <td><input type="text" value="<?echo $filas["porcre"];?>"name="porcre" size="5" maxlength="5" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="porcre"></td>
                <td><b>Total_Dcto:</b></td>
               <td><input type="text" value="<?echo $filas["basecre"];?>"name="basecre" size="11" class="cajas" maxlength="11"onfocus="calculocre()" id="basecre"></td>
             </tr>
             <tr>
               <td><b>Dcto:</b></td>
               <td><input type="text" value="<?echo $filas["dcto"];?>"name="dcto" size="5" maxlength="5" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dcto"></td>
                <td><b>Total_Base:</b></td>
               <td><input type="text" value="<?echo $filas["valor"];?>"name="totalbase" size="11"class="cajas" maxlength="11"onfocus="calculodcto()" id="totalbase"></td>
             </tr>

             </tr>
               <td><b>Rfte:</b></td>
               <td><input type="text" name="rfte" value="<?echo $filas["rfte"];?>" size="11" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="rfte"></td>
               <td><b>Base Rfte:</b></td>
              <td><input type="text" name="baserfte" value="<?echo $filas["baserfte"];?>" size="11" class="cajas" maxlength="11" onfocus="calculobase()" id="baserfte"></td>
            </tr>
             <tr>
               <td><b>Iva_Pagado:</b></td>
               <td><input type="text" value="<?echo $filas["ivapagado"];?>"name="ivapagado" size="10" class="cajas"  maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ivapagado"></td>
                <td><b>Total_Pagar:</b></td>
               <td><input type="text" value="<?echo $filas["total"];?>"name="totalpagar" size="11" class="cajas"  maxlength="11"onfocus="calculototal()" id="totalpagar"></td>
             </tr>
             <tr>
                  <td><b>Estado:</b></td>
                  <td><select name="estado" class="cajas">
                  <option value="<?php echo $filas["estado"];?>" selected><?php echo $filas["estado"];?>
                  <option value="1">Factura
                  <option value="2">Cta de Cobro
                </select></td>
                 <td><b>Tipo_Factura:</b></td>
                  <td><select name="TipoFactura" class="cajas">
                  <option value="<?php echo $filas["tipofactura"];?>" selected><?php echo $filas["tipofactura"];?>
                  <option value="COMPRA">COMPRA
                  <option value="REEMBOLSO">REEMBOLSO
                </select></td>
             </tr>
               <tr>
                  <td><b>Estado:</b></td>
                  <td><select name="EstadoF" class="cajas">
                  <option value="<?php echo $filas["estadofactura"];?>" selected><?php echo $filas["estadofactura"];?>
                  <option value="">
                  <option value="ACTIVA">ACTIVA
                </select></td>
             </tr>
             <td><b>Observación:</b></td>
               <td colspan="5"><textarea name="nota" cols="55" rows="4" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nota"><?echo $filas["nota"];?></textarea></td></tr>
                <tr>
               <td colspan="8" class="fondo">
                 <input type="submit" value="Guardar" class="boton" id="grabar" name="grabar">

               </td>
              </tr>
            <?
            endwhile;
          else:
            ?>
              <script language="javascript">
                alert("Esta Factura No se puede Modificar Por que tiene Abonos ?")
                open("modificar.php","_self")
              </script>
            <?
          endif;
          endif;
        endif;
       ?>
     </table>
     </form>
</body>
</html>
