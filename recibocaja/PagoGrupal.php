<html>
<head>
  <title>Recibo de Caja</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if(!isset($empresa)){
include("../conexion.php");
?>
  <center><h4><u>Recibo de Caja</u></h4></center>
  <form action="" method="post">
     <table border="0" align="center" width="450">
      <tr><td><br></td></tr> 
       <tr>
          <td><b>Empresa:</b></td>
              <td><select name="empresa" class="cajas" >
                 <option value="0">Seleccione la Empresa
                    <?
                     $consulta="select codmaestro,nomaestro from maestro order by nomaestro";
                     $resultado=mysql_query($consulta) or die("error al buscar empresa");
                      while ($filas=mysql_fetch_array($resultado)){
                          ?>
                          <option value="<?echo $filas["codmaestro"];?>"><?echo $filas["nomaestro"];?>
                          <?
                     }
                        ?>
               </select>
           </td>
        </tr>
        <tr>
          <td><b>Tipo_Proceso:</b></td>
          <td><input type="radio" value="SI" name="estado" id="estado">Causado<input type="radio" value="NO" name="estado" id="estado">No Causado</td>
        </tr>
        <tr>
          <td><b>Tipo_Pago:</b></td>
          <td><input type="radio" value="venta" name="tipopago">Ventas<input type="radio" value="empleado" name="tipopago">Empleado<td>
        </tr>
          <tr>
          <td><b>Zona:</b></td>
              <td colspan="10"><select name="CodZona" class="cajas" id="CodZona">
                 <option value="0">Seleccione la Empresa
                    <?
                     $consulta="select codzona,zona from zona where zona.estado='ACTIVA' order by zona";
                     $resultado=mysql_query($consulta) or die("error al buscar empresa");
                      while ($filas=mysql_fetch_array($resultado)){
                          ?>
                          <option value="<?echo $filas["codzona"];?>"><?echo $filas["zona"];?>
                          <?
                      }
                        ?>
               </select>
           </td>
        </tr>
      <tr><td><br></td></tr>
        <td colspan="5">
          <input type="submit" value="Buscar" class="boton" >&nbsp;<input type="reset" value="Limpiar" class="boton" ></td>
    </table>
  </form>
<?
}elseif(empty($empresa)){
  ?>
  <script language="javascript">
    alert("Seleccione la empresa para continuar.?")
    history.back()
  </script>
  <?
}elseif(empty($estado)){
  ?>
  <script language="javascript">
    alert("Seleccione el tipo de proceso?")
    history.back()
  </script>
  <?
}else{
     if($estado=='NO' and $tipopago!=''){
        ?>
	  <script language="javascript">
	    alert("No seleccionar el tipo de pago?")
	    history.back()
	  </script>
	  <?
     }else{
        if($estado=='NO' and $tipopago ==''){
                include("../conexion.php");
                $con1="select  maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio from maestro,municipio
	         where  maestro.codmuni=municipio.codmuni and
	         maestro.codmaestro='$empresa'";
	         $resu1=mysql_query($con1)or die("Error de busqueda de empresa 'NO CAUSADO'");
		 $reg1=mysql_affected_rows();
		 $filas=mysql_fetch_array($resu1);
		 $Empresa=$filas["nomaestro"];
		 $NitEmpresa=$filas["codmaestro"];
		 $Dv=$filas["dvmaestro"];
		 $Direccion=$filas["dirmaestro"];
		 $Telefono=$filas["telmaestro"];
		 $Municipio=$filas["municipio"];
	        header("location: CrearPagoRecibo.php?NitEmpresa=$NitEmpresa&Dv=$Dv&TipoPago=$tipopago&estado=$estado&Direccion=$Direccion&Telefono=$Telefono&Municipio=$Municipio&Empresa=$Empresa");
         }else{
             if($estado=='SI' and $tipopago==''){
                 ?>
	         <script language="javascript">
	            alert("Favor seleccionar el tipo de pago?")
	            history.back()
	         </script>
	          <?
             }else{
                  if($estado=='SI' and $tipopago=='venta'){
                      if(empty($CodZona)){
                          ?>
                           <script language="javascript">
		            alert("Seleccione la Empresa o Zona para hacer el respectivo recibo de caja.!")
		            history.back()
		          </script>
                          <?
                      }else{
		            include("../conexion.php");
	                    $con1="select  maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio from maestro,municipio
		            where  maestro.codmuni=municipio.codmuni and
		            maestro.codmaestro='$empresa'";
		            $resu1=mysql_query($con1)or die("Error de busqueda de empresa");
			    $reg1=mysql_affected_rows();
			    $filas=mysql_fetch_array($resu1);
			    $Empresa=$filas["nomaestro"];
			    $NitEmpresa=$filas["codmaestro"];
			    $Dv=$filas["dvmaestro"];
			    $Direccion=$filas["dirmaestro"];
			    $Telefono=$filas["telmaestro"];
			    $Municipio=$filas["municipio"];
		            header("location: PagoGrupalFactura.php?NitEmpresa=$NitEmpresa&Dv=$Dv&CodZona=$CodZona&Empresa=$Empresa");
                       }
                  }else{
                         include("../conexion.php");
	                 $con1="select  maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio from maestro,municipio
		         where  maestro.codmuni=municipio.codmuni and
		         maestro.codmaestro='$empresa'";
		         $resu1=mysql_query($con1)or die("Error de busqueda de empresa");
			 $reg1=mysql_affected_rows();
			 $filas=mysql_fetch_array($resu1);
			 $Empresa=$filas["nomaestro"];
			 $NitEmpresa=$filas["codmaestro"];
			 $Dv=$filas["dvmaestro"];
			 $Direccion=$filas["dirmaestro"];
			 $Telefono=$filas["telmaestro"];
			 $Municipio=$filas["municipio"];
		        header("location: CrearPagoRecibo.php?NitEmpresa=$NitEmpresa&Dv=$Dv&TipoPago=$tipopago&estado=$estado&Direccion=$Direccion&Telefono=$Telefono&Municipio=$Municipio&Empresa=$Empresa");
                  }
             }
         }
     }
}
  ?>
</body>
</html>
