<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<center><h4><u>Comprobantes Egreso[Prestaiones]</u></h4></center>
<form action="DetalladoPrestacion.php" method="post" name="vacacion" id="vacacion">
   <input type="hidden" name="empresa" value="<?echo $NitEmpresa;?>">
   <input type="hidden" name="TipoNomina" value="<?echo $TipoNomina;?>">
   <input type="hidden" value="<?echo $Usuario;?>" name="Usuario" id="Usuario">
  <input type="hidden" name="codbanco" value="<?echo $codbanco;?>">

   <table border="0" align="center" width="580">
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
       <td><input type="text" name="empresa" value="<?echo $Empresa;?>" size="47" class="cajas" readonly></td>
    </tr>
    <tr>
       <td><b>Municipio:</b></td>
       <td colspan="5"><select name="municipio" class="cajas" id="municipio">
       <option value="0">Seleccione
       <?
       $consulta="select codmuni,municipio from municipio order by municipio";
       $resultado=mysql_query($consulta) or die("error al buscar empresa");
       while ($filas=mysql_fetch_array($resultado)):
             ?>
             <option value="<?echo $filas["codmuni"];?>"><?echo $filas["municipio"];?>
             <?
       endwhile;
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
               <option value="0">Seleccione un Item
	       <option value="AHORRO">AHORRO
	       <option value="CORRIENTE">CORRIENTE
               <option value="OFICINA">OFICINA
               <option value="OTRA">OTRA
	   </select></td>
       </tr>
       <tr>
           <td><b>Banco:</b></td>
           <td><select name="codbanco" class="cajas" id="codbanco">
           <option value="0">Seleccione el banco
           <?$con="select codbanco,bancos from banco order by bancos";
           $resu=mysql_query($con)or die("Error de busqueda de bancos");
           while($filas=mysql_fetch_array($resu)):
                   ?>
                    <option value="<? echo $filas["codbanco"];?>"><?echo $filas["bancos"];?>
                  <?
           endwhile;?>
         </select> </td>
      </tr>
       <tr>
          <td><b>Tipo_Comprobante:</b></td>
            <td  colspan="10"><select name="TipoComprobante" class="cajas" id="TipoComprobante">
	       <option value="0">Seleccione
	        <?
                 $consulta="select tipocomprobante.descripcion,tipocomprobante.id  from tipocomprobante  where tipocomprobante.estado='ACTIVO' order by descripcion";
	          $resultado=mysql_query($consulta) or die("error al buscar el tipo de comprobante");
	          while ($filas=mysql_fetch_array($resultado)):
	             ?>
	            <option value="<?echo $filas["id"];?>"><?echo $filas["descripcion"];?>
                    <?
                  endwhile;
            ?>
            </select></td>
      </tr>
      <tr>
       <td><b>Nota:</b></td>
         <td colspan="5"><input type="text" value="PAGO DE PRESTACIONES " name="Nota" size="48" maxlength="35" class="cajas" id="Nota"></td>
       </tr>
       <tr>
         <td><b>Nro_Pago:</b></td>
         <td><input type="text" name="NroPago" value="" size="13" maxlength="10" class="cajas" id="NroPago"></td>

      </tr>
           <tr><td><br></td></tr>
        <td colspan="5">
          <input type="submit" value="Buscar" class="boton" id="buscar" name="buscar">&nbsp;<input type="reset" value="Limpiar" class="boton" ></td>
     </table>
   </form>
</body>
</html>