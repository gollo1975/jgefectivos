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
     if(document.getElementById("nro").value.length ==0)
       {
       alert ("Digite el Nro del comprobante de Egreso ?");
       document.getElementById("nro").focus();
       return;
       }
       document.getElementById("f1").submit();
    }

  </script>
</head>
<body>
<?
if(!isset($nro)):
?>
  <center><h4><u>Editar Comprobante</u></h4></center>
  <form action="" method="post" id="f1" name="f1">
   <input type="hidden" name="Usuario" value="<?echo $Usuario;?>">
    <table border="0" align="center">
      <tr><td><br></td></tr>
      <tr>
         <td><b>Nro de Comprobante:&nbsp;</b></td>
         <td><input type="text" name="nro" size="15" maxlength="10" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nro"></td>
      </tr>
       <tr><td><br></td></tr>
      <td cospan="3"><input type="button" value="Buscar Datos" class="boton" onclick="chequearcampos()"</td>
    </table>
  </form>
<?
else:
    include ("../conexion.php");
     $con="select maestrocomprobante.*,tipocomprobante.descripcion  from maestrocomprobante,tipocomprobante
	     where  maestrocomprobante.id=tipocomprobante.id and
                     maestrocomprobante.nro='$nro'";
	  $resu=mysql_query($con)or die("Error en la busqueda de Factura");
	  $regi=mysql_num_rows($resu);
	  $filas=mysql_fetch_array($resu);
	  $abono=number_format($filas["vlrpagado"],0);
	  if ($regi==0):
	    ?>
	     <script language="javascript">
	      alert("El Nro del comprobante digitado no existe en Sistema ?")
	      history.back()
	      </script>
	     <?
	  else:
	       ?>
	        <center><h4><b><u>Editar Comprobante</u></b></h4></center>
	        <table border="0" align="center">
	          <tr>
	            <th><div align="center">Nro_Comprobante</div></th>
	            <th><div align="center">Fecha_Pago</div></th>
	            <th><div align="right">Vlr_Pago</div></th>
                    <th><div align="right">Tipo_Doc.</div></th>
	          </tr>
	            <tr class="cajas">
	              <td><a href="ModificarComprobante.php?NroC=<?echo $filas["nro"];?>&Usuario=<?echo $Usuario;?>"><div align="center"><?echo $filas["nro"];?></div></a></td>
	               <td><div align="center"><?echo $filas["fechapago"];?></a></div></td>
	              <td><div align="center"><?echo $abono;?></div></td>
                      <td><div align="center"><?echo $filas["descripcion"];?></a></div></td>
	            </tr>
	        </table>
	        <?
	     endif;
 endif;
?>

</body>

</html>
