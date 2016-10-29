<?
 session_start();
?>
<html>
<head>
  <title> Saldar cuenta de Cobros</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
 if(session_is_registered("validar")):
if (!isset($cuenta)):
  ?>
  <form action="" method="post">
  <center><h4>Busqueda de Cuentas de Cobro</h4></center>
    <table border="0" align="center">
    <tr><td><br></td></tr>
      <tr>
        <td><b>Cuenta de Cobro:</b></td>
        <td><input type="text" name="cuenta" value="" size="10" maxlength="10"></td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
         <td colspan="5"><input type="submit" value="Buscar" class="boton"></td>
      </tr>
    </table>
  </form>
  <?
elseif(empty($cuenta)):
  ?>
   <script language="javascript">
     alert("Debe de Digita el Nro de la cuenta de cobro ?")
     history.back()
   </script>
  <?
else:
  include("../conexion.php");
  $cons="select cuenta.nrocuenta from  cuenta
    where cuenta.estado='ACTIVA' and
          cuenta.nrocuenta='$cuenta'";
  $resu=mysql_query($cons)or die("Error de Consulta");
  $regi=mysql_num_rows($resu);
  if ($regi!=0):
    while($filas=mysql_fetch_array($resu)):
     ?>
     <center><h4>Datos de la Cuenta de Cobro</h4></center>
     <form action="validar1.php" method="post">
       <table border="0" align="center">
       <tr><td><br></td></tr>
         <tr>
           <td><b>Nro_Factura:</b></td>
           <td><input type="text" name="cuenta" value="<? echo $filas["nrocuenta"];?>" size="10" readonly></td>
         </tr>
         <tr>
           <td><b>Validador:</b></td>
             <td><select name="validador" class="cajas">
                <option value="anulada">ANULADA
             </select></td>
         </tr>
         <tr>
           <td><b>Valor_Saldo:</b></td>
           <td><input type="text" name="valor" value="" size="11"></td>
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
     alert("El Nro De la cuenta de Cobro No existe o no se Puede Anular ?")
     history.back()
   </script>
  <?
  endif;
endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
?>

</body>

</html>
