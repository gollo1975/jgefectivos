<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
                    function ColorFoco(obj)	{

                        document.getElementById(obj).style.background="#9DFF9D"
                    }

                    function QuitarFoco(obj)	{

                        document.getElementById(obj).style.background="white"
                    }

		      function Validar()	{

                        if (document.getElementById("Vlr_Pagado").value.length <=0)	{

                            alert ("Digite el valor pagado por la Empresa.!");
                            document.getElementById("Vlr_Pagado").focus();
                            return;
                        }

                        	document.getElementById("f1").submit();
		}
                </script>
</head>
<body>
<center><h4><u>Recibo de caja[FACTURAS]</u></h4></center>
  <form action="PagoFacturaNormal.php" method="post" name="f1" id="f1">
  <input type="hidden" name="empresa" value="<?echo $NitEmpresa;?>">
  <input type="hidden" name="CodZona" value="<?echo $CodZona;?>">
  <input type="hidden" name="codbanco" value="<?echo $codbanco;?>">
  <table border="0" align="center" width="460">
    <tr>
    <tr><td><br></td></tr>
        <?
    include("../conexion.php");?>
    <tr>
       <td><b>Nit/Cedula:</b></td>
       <td><input type="text" name="NitEmpresa" value="<? echo $NitEmpresa;?>" size="13" readonly class="cajas"></td>
    </tr>
    <tr>
       <td><b>Empresa:</b></td>
       <td><input type="text" name="empresa" value="<?echo $Empresa;?>" size="47" class="cajas" readonly id="empresa"></td>
    </tr>
    <tr>
       <td><b>Municipio:</b></td>
       <td colspan="5"><select name="CodMuni" class="cajas" id="CodMuni">
       <option value="0">Seleccione
       <?
       $consulta="select codmuni,municipio from municipio order by municipio";
       $resultado=mysql_query($consulta) or die("error al buscar empresa");
       while ($filas=mysql_fetch_array($resultado)){
             ?>
             <option value="<?echo $filas["codmuni"];?>"><?echo $filas["municipio"];?>
             <?
       }
       ?>
      </select></td>
      </tr>
      <tr>
         <td><b>F_Pago:</b></td>
         <td><input type="text" name="fechapago" value="<?echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas" id="fechapago"></td>
      </tr>
      <tr>
          <td><b>Forma_Pago:</b></td>
           <td width="8"><select name="FormaPago" class="cajas" id="FormaPago">
               <option value="0">Seleccione un Item
	       <option value="BANCO">BANCO
	       <option value="CHEQUE">CHEQUE
               <option value="EFECTIVO">EFECTIVO
               <option value="OTRA">OTRA
	   </select></td>
       </tr>
      <tr>
          <td><b>Tipo_Producto:</b></td>
           <td width="8"><select name="TipoCta" class="cajas" id="TipoCta">
               <option value="0">Seleccione
	       <option value="AHORRO">AHORRO
	       <option value="CORRIENTE">CORRIENTE
               <option value="OFICINA">OFICINA
               <option value="OTRA">OTRA
	   </select></td>
       </tr>
       <tr>
           <td><b>Banco:</b></td>
           <td><select name="CodBanco" class="cajas" id="CodBanco">
           <option value="0">Seleccione el banco
           <?$con="select codbanco,bancos from banco order by bancos";
           $resu=mysql_query($con)or die("Error de busqueda de bancos");
           while($filas=mysql_fetch_array($resu)){
                   ?>
                    <option value="<? echo $filas["codbanco"];?>"><?echo $filas["bancos"];?>
                  <?
          }?>
         </select> </td>
      </tr>
      <tr>
           <td><b>Tipo_Recibo:</b></td>
           <td><select name="TipoRecibo" class="cajas" id="TipoRecibo">
           <option value="0">Seleccione
           <?$con="select idrecibo,descripcion from tiporecibo where estado='ACTIVO' order by descripcion ";
           $resu=mysql_query($con)or die("Error de busqueda de tipos de recibo");
           while($fila=mysql_fetch_array($resu)){
                   ?>
                    <option value="<? echo $fila["idrecibo"];?>"><?echo $fila["descripcion"];?>
                  <?
          }?>
         </select> </td>
      </tr>
        <tr>
          <td><b>Tipo_Pago:</b></td>
           <td width="8"><select name="TipoPago" class="cajas" id="TipoPago">
           <option value="0">Seleccione
	       <option value="NORMAL">NORMAL
               <option value="DESCUENTO">DESCUENTO
               <option value="RETEIVA">RETE IVA
               <option value="RETEICA">RETE ICA
               <option value="RETEIVARETEICA">RETE IVA Y ICA
               <option value="TODO"> RETE IVA,ICA Y DCTO
	   </select></td>
       </tr>
        </tr>
      <tr>
         <td><b>Vlr_Pagado:</b></td>
         <td><input type="text" name="Vlr_Pagado" value="" size="15" maxlength="11" class="cajas"  onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Vlr_Pagado"  style="text-align:right;background-color:#9BCDFF"></td>
      </tr>

            <tr><td><br></td></tr>
        <td colspan="5">
          <input type="button" value="Enviar" class="boton" id="buscar" name="buscar" id="buscar" name="buscar" onClick="Validar()"></td>
     </table>
   </form>
</body>
</html>
