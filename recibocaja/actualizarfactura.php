<html>
<head>
  <title> Actualizar saldo</title>
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
                        if (document.getElementById("nrofactura").value.length <=0)
                        {
                         alert ("Favor digitar el Nro de Factura para la busqueda");
                            document.getElementById("nrofactura").focus();
                            return;
                        }
                    document.getElementById("NroF").submit();
                   }
</script>
</head>
<body>
<?
if (!isset($nrofactura)):
  ?>
  <form action="" method="post" id="NroF">
  <center><h4><u>Actualizar</u></h4></center>
    <table border="0" align="center" >
    <tr><td><br></td></tr>
      <tr>
        <td><b>Nro_Factura:</b></td>
        <td><input type="text" name="nrofactura" value="" size="15" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nrofactura"></td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
         <td colspan="5"><input type="button" value="Buscar" class="boton" onclick="chequearcampos()"></td>
      </tr>
    </table>
  </form>
  <?
else:
  include("../conexion.php");
  $cons="select factura.nrofactura,factura.nsaldo,factura.estado from  factura
    where  factura.nrofactura='$nrofactura'";
  $resu=mysql_query($cons)or die("Error de Consulta");
  $regi=mysql_num_rows($resu);
  if ($regi!=0):
    while($filas=mysql_fetch_array($resu)):
     ?>
     <center><h4><u>Datos de la Factura</u></h4></center>
     <form action="saldar.php" method="post">
       <table border="0" align="center">
       <tr><td><br></td></tr>
         <tr>
           <td><b>Nro_Factura:</b></td>
           <td><input type="text" name="nrofactura" value="<? echo $filas["nrofactura"];?>" size="11" readonly></td>
         </tr>
          <tr>
              <td><b>Estado:</b></td>
              <td><select name="validador" class="cajas">
              <option value="<?echo $filas["estado"];?>" selected><?echo $filas["estado"];?>
              <option value="ABONADA">ABONADA
              <option value="CANCELADA">CANCELADA
              <option value="ANULADA">ANULADA
              </select></td>
           </tr>
         <tr>
           <td><b>Saldo_Actual:</b></td>
           <td><input type="text" name="saldo" value="<? echo $filas["nsaldo"];?>" size="13" class="cajas"></td>
         </tr>
         <tr>
           <td><b>Valor_Abono:</b></td>
           <td><input type="text" name="valor" value="" size="13" maxlength="11" class="cajas"></td>
         </tr>
        <tr><td><br></td></tr>
        <td colspan="5"><input type="submit" value="Validar" class="boton"></td>
       </table>
     </form>
     <?
    endwhile;
  else:
  ?>
   <script language="javascript">
     alert("El Nro De la Factura No existe o no se Puede saldar ?")
     history.back()
   </script>
  <?
  endif;
endif;
?>

</body>

</html>
