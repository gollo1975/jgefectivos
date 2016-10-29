<html>

<head>
  <title>Contrato Comercial</title>
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
                         if (document.getElementById("Nit").value == 0)
                        {
                            alert ("Digite el Nit/Cedula de la Empresa cliente.!");
                            document.getElementById("Nit").focus();
                            return;
                        }
                         if (document.getElementById("Dv").value == "")
                        {
                            alert ("Digite el digito de Verificación.!");
                            document.getElementById("Dv").focus();
                            return;
                        }
                         document.getElementById("matlibra").submit();
                     }
                     function valide()
                      {
                         if (document.getElementById("Empresa").value == 0)
                          {
                            alert ("Digite el nombre de la Empresa a contratar.!");
                            document.getElementById("Empresa").focus();
                            return;
                          }
                          if (document.getElementById("Direccion").value == 0)
                          {
                            alert ("Digite la dirección de la Empresa a contratar.!");
                            document.getElementById("Direccion").focus();
                            return;
                          }
                          if (document.getElementById("RepresentanteLegal").value == 0)
                          {
                            alert ("Digite el Representante Legal de la Empresa a contratar.!");
                            document.getElementById("RepresentanteLegal").focus();
                            return;
                          }
                           if (document.getElementById("Proceso").value == 0)
                          {
                            alert ("Digite el proceso a contratar con la Empresa.!");
                            document.getElementById("Proceso").focus();
                            return;
                          }
                           if (document.getElementById("CotizacionLetra").value == 0)
                          {
                            alert ("Digite el Número de la cotización que se negoció con la Empresa.!");
                            document.getElementById("CotizacionLetra").focus();
                            return;
                          }
                           if (document.getElementById("Documento").value == 0)
                          {
                            alert ("Digite el Documento del Representante Legal de la Empresa.!");
                            document.getElementById("Documento").focus();
                            return;
                          }
                            if (document.getElementById("NroC").value == 0)
                          {
                            alert ("Digite el Número de cotización que se negoció con la Empresa.!");
                            document.getElementById("NroC").focus();
                            return;
                          }
                            if (document.getElementById("CotizacionNro").value == 0)
                          {
                            alert ("Digite el Número de cotización que se negoció con la Empresa en Numeros.!");
                            document.getElementById("CotizacionNro").focus();
                            return;
                          }
                         document.getElementById("matcon").submit();
                     }
   </script>
</head>

<body>

<?
if (!isset($Nit)){
?>
<center><h4><u>Contrato Comercial</u></h4></center>
  <form  action="" method="post" id="matlibra">
    <table border="0" align="center">
       <tr><td><br></td></tr>
       <tr>
        <td><b>Digite el Nit/Cédula:&nbsp;</b></td>
         <td><input type="text" name="Nit" size="15" maxlength="13" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Nit"></td>
       </tr>
        <tr>
        <td><b>Dv:&nbsp;</b></td>
         <td><input type="text" name="Dv" size="15" maxlength="13" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Dv"></td>
       </tr>
         <tr><td><br></td></tr>
    <tr>
         <td colspan="2">
           <input type="button" value="Buscar" class="boton" onclick="chequearcampos()"></td>
       </tr>

    </table>
    <br>
 </form>
  <?
}else{
      include("../conexion.php");
      $Sql="select cotizacioncomercial.* from cotizacioncomercial where cotizacioncomercial.nitempresa='$Nit'";
      $Rs=mysql_query($Sql)or die("Error en la busqueda del contrato");
      $Cont=mysql_num_rows($Rs);
      if($Cont != 0){
		  ?>
		  <center><h4><u>Contrato Comercial</u></h4></center>
		  <table border="0" align="center">
			  <tr class="cajas">
				  <th>#</th>
				  <th>Nro_Cotización</th>
				  <th>Nit/Cedula</th>
				  <th>Empresa</th>
				  <th>Admon</th>
				  <th>F_Proceso</th>
			  </tr>  
			  <?
			  $a =1;
			  while($fila=mysql_fetch_array($Rs)){
				  ?>
				   <tr class="cajas">
					   <th><?echo $a;?></th>
					   <td><a href="DetalleContratoComercial.php?IdCotizacion=<?echo $fila["idcotizacion"];?>&Dv=<?echo $Dv;?>"><?echo $fila["idcotizacion"];?></a></td>
					   <td><?echo $fila["nitempresa"];?></td>
					   <td><?echo $fila["razonsocial"];?></td>
					   <td><div align="center"><?echo $fila["porcentajeadmon"];?></div></td>
					   <td><?echo $fila["fechaproceso"];?></td>
				   </tr>
				  <?
				  $a +=1;
			  }
			?>
			</table>
            <?			
	  }else{
		   ?>
		  <script language="javascript">
			alert("Este tipo de documento no tiene propuesta comercial.!")
			history.back()
		  </script>
		  <?  
	  }
}
?>

</body>

</html>
