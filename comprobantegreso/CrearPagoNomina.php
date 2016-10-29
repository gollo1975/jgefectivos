<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<center><h4><u>Comprobantes Egreso</u></h4></center>
<form action="DetalladoNomina.php" method="post">
  <input type="hidden" name="empresa" value="<?echo $NitEmpresa;?>">
   <input type="hidden" name="TipoNomina" value="<?echo $TipoNomina;?>">
   <input type="hidden" value="<?echo $Usuario;?>" name="Usuario" id="Usuario">
  <input type="hidden" name="codbanco" value="<?echo $codbanco;?>">

   <table border="0" align="center" width="610">
    <tr>
    <tr><td><br></td></tr>
        <?
    include("../conexion.php");?>
    <tr>
       <td><b>Nit/Cedula:</b></td>
       <td><input type="text" name="nit" value="<? echo $NitEmpresa;?>" size="13" readonly class="cajas"></td>
       <td><b>Empresa:</b></td>
       <td><input type="text" name="empresa" value="<?echo $Empresa;?>" size="38" class="cajas" readonly></td>
    </tr>
    <tr>
       <td ><b>Municipio:</b></td>
       <td  colspan="5"><select name="municipio" class="cajas">
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
         <td><b>Fecha_Pago:</b></td>
         <td><input type="text" name="fechapago" value="<?echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas"></td>
         <td><b>Vlr_Pago:</b></td>
         <td><input type="text" name="valorP" value="" size="13" maxlength="11" class="cajas"></td>
      </tr>
      <tr>
        <td><b>Desde:</b>
        <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="13"  class="cajas" maxlength="10"></td>
        <td><b>Hasta:</b></td>
        <td><input type="text" name="hasta" value="<?echo date("Y-m-d");?>" size="13" class="cajas" maxlength="10"></td>
      </tr>
      <tr>
      <td><b>Forma_Pago:</b></td>
       <td><select name="TipoCta" class="cajas">
        <option value="0">Seleccione un Item
	<option value="AHORRO">AHORRO
	<option value="CORRIENTE">CORRIENTE
        <option value="OFICINA">OFICINA
        <option value="OTRA">OTRA 
	</select></td>
       <td><b>Banco:</b>
       <td><select name="codbanco" class="cajas">
           <option value="0">Seleccione el banco
           <?$con="select codbanco,bancos from banco order by bancos";
           $resu=mysql_query($con)or die("Error de busqueda de bancos");
           while($filas=mysql_fetch_array($resu)):
           ?>
           <option value="<? echo $filas["codbanco"];?>"><?echo $filas["bancos"];?>
           <?
           endwhile;?>
           </select></td>
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
           <td> <b>Nota:</b></td>
               <td colspan="10"><input type="text" value="NOMINA DEL " name="nota" size="37" maxlength="35" class="cajas"></td>
      <tr>
      <td><b>Zona:</b></td>
      <td colspan="10"><select name="CodZona" class="cajas">
      <option value="0">Seleccione la Zona
       <?$con="select codzona,zona from zona where estado='ACTIVA' and nomina='SI' and tipoempresa='NO' order by zona";
      $resu=mysql_query($con)or die("Error de busqueda de zonas");
        while($filas=mysql_fetch_array($resu)):
        ?>
           <option value="<? echo $filas["codzona"];?>"><?echo $filas["zona"];?>
        <?
        endwhile;?>
        </select></td>
       </tr>
           <tr><td><br></td></tr>
        <td colspan="5">
          <input type="submit" value="Buscar" class="boton" >&nbsp;<input type="reset" value="Limpiar" class="boton" ></td>
     </table>
   </form>
</body>
</html>
