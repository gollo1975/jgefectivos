<html>
<head>
<title>Compras</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
                     function calculorfte()
                        {
                        var aux = 0
                        var aux1 = 0
                        var aux = document.getElementById("subtotal").value;
                        var aux1 = document.getElementById("dcto").value;
                        var aux2 = (aux * aux1)/100;
                         //aux3 = (aux - aux2);
                         document.getElementById("totalbase").value = aux2.toFixed(0);
                    }
                    function calculobase()
                        {
                         var aux = 0
                         var aux1 = 0
                         var aux3 = 0
                         var Total = 0
                         aux = document.getElementById("subtotal").value;
                         aux1 = document.getElementById("rfte").value;
                         aux3 = document.getElementById("totalbase").value;
                         Total = (aux - aux3);
                         aux4 = (Total * aux1)/100;
                         document.getElementById("baserfte").value = aux4.toFixed(0);
                    }
                    function calculototal()
                        {
                         var xl = 0
                         var xl1 = 0
                         var xl2 = 0
                         var negativo = 0
                         xl = parseFloat(document.getElementById("subtotal").value) + parseFloat(document.getElementById("ivapagado").value);
                         negativo = parseFloat(document.getElementById("totalbase").value)+ parseFloat(document.getElementById("basecree").value) + parseFloat(document.getElementById("baserfte").value);
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
                      function chequearcampos()
                      {
                        if (document.getElementById("nrofactura").value.length <=0)
                        {
                            alert ("Digite el Nro de Factura a grabar en sistema !");
                            document.getElementById("nrofactura").focus();
                            return;
                        }
                        if (document.getElementById("subtotal").value.length <=0)
                        {
                            alert ("Digite el subtotal de la factura o cta de Cobro !");
                            document.getElementById("subtotal").focus();
                            return;
                        }
                          document.getElementById("matpagar").submit();
                      }
                      function Validar()
                      {
                        if (document.getElementById("fechaini").value.length <=0)
                        {
                            alert ("El campo FECHA INICIO no puede estar vacio?");
                            document.getElementById("fechaini").focus();
                            return;
                        }
                        if (document.getElementById("fechaven").value.length <=0)
                        {
                            alert ("El campo FECHA VENCIMIENTO no puede estar vacio?");
                            document.getElementById("fechaven").focus();
                            return;
                        }
                        if (document.getElementById("fechagra").value.length <=0)
                        {
                            alert ("El campo FECHA GRABADO no puede estar vacio?");
                            document.getElementById("fechagra").focus();
                            return;
                        }
                        if (document.getElementById("subtotal").value.length <=0)
                        {
                            alert ("El campo Subtotal no puede estar vacio?");
                            document.getElementById("subtotal").focus();
                            return;
                        }
                        if (document.getElementById("totalpagar").value.length <=0)
                        {
                            alert ("El campo TOTAL PAGAR no puede estar vacio?");
                            document.getElementById("totalpagar").focus();
                            return;
                        }
                         if (document.getElementById("nota").value.length <=0)
                        {
                            alert ("El campo Observaciones no puede estar vacio?");
                            document.getElementById("nota").focus();
                            return;
                        }

                        document.getElementById("matvalidar").submit();

                    }
                </script>
</head>
<body>
<?
if (empty($nrofactura)){
  include("../conexion.php");
?>
<center><h4><u>Cuentas X Pagar</u></h4></center>
  <form action="" method="post"id="matpagar">
    <table border="0" align="center" width="400">
     <tr><td><br></td></tr>
     <tr>
       <td><b>Nro_Factura:</b></td>
       <td><input type="text" name="nrofactura" value="" size="15" class="cajas" maxlength="10"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nrofactura"></td>
     </tr>
     <tr>
       <td><b>Proveedor:</b></td>
          <td colspan="10"><select name="nitprove" class="cajas">
          <option value="0">Seleccione un Proveedor
          <?
            $consulta_d="select provedor.nitprove,provedor.nomprove from provedor where estado='ACTIVO' order by nomprove";
            $resultado_d=mysql_query($consulta_d)or die ("Consulta incorrecta");
            while($filas_d=mysql_fetch_array($resultado_d)):
             $aux=$filas["provedor"];
              ?>
              <option value="<?echo $filas_d["nitprove"];?>"> <?echo $filas_d["nomprove"];?>
              <?
              endwhile;
              ?></select></td>
           <tr>
           <tr>
	       <td><b>Subotal_Factura:</b></td>
	       <td><input type="text" name="subtotal" value="" size="15" class="cajas" maxlength="10"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="subtotal"></td>
	     </tr>
             <tr>
                <td><b>Tipo_Factura:</b></td>
                    <td><select name="TipoFactura" class="cajas" id="TipoFactura">
		        <option value="0">Seleccione
		           <option value="COMPRA">COMPRA
		           <option value="REEMBOLSO">REEMBOLSO
		    </select></td>
             </tr>
                  <tr><td><br></td></tr>
         <td colspan="8" class="fondo">
           <input type="button" value="Guardar"class="boton"onclick="chequearcampos()">
           <input type="reset" value="Limpiar" class="boton">
         </td>
       </tr>
     <tr>
  </table>
</form>
<?
}elseif(empty($nitprove)){
  ?>
  <script language="javascript">
    alert("Seleccion un Provedor de la lista de para asignarla a la factura de Compra.!");
    history.back()
  </script>
<?
  }elseif(empty($TipoFactura)){
  ?>
  <script language="javascript">
    alert("Seleccion el tipo de factura de compra.!");
    history.back()
  </script>
  <?
}else{
    include("../conexion.php");
    $con="select provedor.nitprove,provedor.nomprove,provedor.codigocre from provedor where provedor.nitprove='$nitprove'";
    $res=mysql_query($con)or die("Error proveedor");
    $filas=mysql_fetch_array($res);
    $provedor=$filas["nomprove"];
    $Cree=$filas["codigocre"];
    if($Cree==''){
        ?>
	  <script language="javascript">
	    alert("Debe de Actualizar la actividad ecónomica de la Empresa.!");
	    history.back()
	  </script>
	  <?
    }else{
            $conC="select cree.valor from provedor,cree
            where provedor.codigocre=cree.codigocre and
                  cree.codigocre='$Cree'";
	    $resC=mysql_query($conC)or die("Error Cree");
	    $filasC=mysql_fetch_array($resC);
	    $valor=$filasC["valor"];
            $Totalcre=round(($subtotal*$valor)/100);
            $conF="select pagar.nitprove,pagar.nrofactura from pagar where pagar.nrofactura='$nrofactura' and pagar.nitprove='$nitprove'";
	    $resuF=mysql_query($conF)or die("Consulta de busqueda incorrecta");
	    $regF=mysql_num_rows($resuF);
	    if ($regF=='0'){
		?>
                <center><h4><u>Compras</u></h4></center>
		 <form action="grabarfactura.php" method="post"id="matvalidar">
                 <input type="hidden" name="nitprove" value="<?echo $nitprove;?>">
                 <input type="hidden" name="TipoFactura" value="<?echo $TipoFactura;?>">
		    <table border="0" align="center" width="400">
		     <tr>
		       <td colspan="8" class="fondo"></td>
		     </tr>
		     <tr><td><br></td></tr>
	             <tr>
	               <td><b>Nro_Factura:</b></td>
		       <td><input type="text" name="nrofactura" value="<?echo $nrofactura;?>" class="cajas" size="11" maxlength="10"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nrofactura"></td>
	            </tr>
	            <tr>
		        <td><b>Proveedor:</b></td>
		       <td colspan="10"><input type="text" name="nombrep" class="cajas" value="<?echo $provedor;?>" size="60" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nombrep"></td>
		     </tr>
		     <td><b>Fecha_Inicio:</b></td>
		       <td><input type="text" name="fechaini" value="<?echo date("Y-m-d");?>" size="11" maxlength="10"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="fechaini" class="cajas"></td>
		        <td><b>Fecha_Vencimiento:</b></td>
		       <td><input type="text" name="fechaven" value="<?echo date("Y-m-d");?>" size="11" maxlength="10"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="fechaven" class="cajas"></td>
		     </tr>
		     <tr>
		       <td><b>Fecha_Grabado:</b></td>
		       <td><input type="text" name="fechagra" value="<?echo date("Y-m-d");?>" size="11" class="cajas" maxlength="10" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechagra" class="cajas" /></td>
		        <td><b>Subtotal:</b></td>
		       <td><input type="text" name="subtotal" value="<?echo $subtotal?>" size="11" class="cajas" maxlength="11"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="subtotal" readonly="yes"></td>
		     </tr>
                      <tr>
		      <td><b>%Cree:</b></td>
		       <td><input type="text" name="porcre" value="<?echo $valor;?>" size="5" class="cajas" maxlength="5"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="porce"></td>
		          <td><b>Total_Dcto:</b></td>
		          <td><input type="text" name="basecree" value="<?echo $Totalcre;?>" class="cajas" size="11" maxlength="11"onfocus="ColorFoco(this.id)" id="basecree"></td>
		       </tr>
		     <tr>
		      <td><b>Dcto:</b></td>
		       <td><input type="text" name="dcto" value="0" size="5" maxlength="5" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="dcto"></td>
		          <td><b>Total_Dcto:</b></td>
		          <td><input type="text" name="totalbase" value="0" size="11" class="cajas" maxlength="11"onfocus="calculorfte()" id="totalbase"></td>
		       </tr>
		       <td><b>Rfte:</b></td>
		       <td><input type="text" name="rfte" value="0" size="11" class="cajas" maxlength="11"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="rfte"></td>
		       <td><b>Base Rfte:</b></td>
		      <td><input type="text" name="baserfte" value="0" size="11" class="cajas" maxlength="11" onFocus="calculobase()" id="baserfte"></td>
		       </tr>
		       <tr>
		         <td><b>Iva:</b></td>
		         <td><input type="text" name="ivapagado" value="0" size="11" maxlength="11"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="ivapagado"></td>
		         <td><b>Total_Pagar:</b></td>
		         <td><input type="text" name="totalpagar" value="" size="11" maxlength="11"onfocus="calculototal()" id="totalpagar"></td>
		       </tr>
		       <tr>
		         <td><b>Estado:</b></td>
		         <td><select name="estado" class="cajas" id="estado">
		           <option value="0">Seleccione el Estado
		           <option value="1">Factura
		         </select></td>
		        </tr>
                 <tr>
			     <td><b>G_Causación:</b></td>
				 <td><input type="radio" name="Generar" value="SI" id="Generar"><b>SI</b><input type="radio" name="Generar" value="NO" id="Generar"><b>NO</b></td>
			 </tr> 
				<tr>
		          <td><b>Observación:</b></td>
		          <td colspan="5" class="cajas"><textarea name="nota" cols="58" rows="4" class="cajas"onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nota" ></textarea></td></tr>
		       </tr>
		       <tr><td><br></td></tr>
		       <tr>
		         <td colspan="8" class="fondo">
		           <input type="button" value="Guardar"class="boton"onclick="Validar()">
		           <input type="reset" value="Limpiar" class="boton">
		         </td>
		       </tr>
		      </table>
		     </form>
	 <?
	      }else{
	          ?>
		  <script language="javascript">
		    alert("Esta Factura ya fue cargada a este proveedor, Favor verificar.!");
		    history.back()
		  </script>
		  <?
	      }
   }
}
 ?>
 </body>
</html>


