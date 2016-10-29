
<html>
<head>
  <title>Consulta de Carnets</title>
  <link rel="stylesheet" href="../estilo.css" type="text/css">
<script language="javascript">
  function ColorFoco(obj)
      {
      document.getElementById(obj).style.background="#9DFF9D"
      }
      function QuitarFoco(obj)
      {
      document.getElementById(obj).style.background="white"
      }
       function Validar()
           {
           if (document.getElementById("NroVenta").value.length <=0)
             {
               alert ("Digitar el Nro de la Factura de Venta!");
               document.getElementById("NroVenta").focus();
              return;
             }
             document.getElementById("F1").submit();
          }
</script>

</head>
<body>

<?
 if (!isset($NroVenta)){
  ?>
 <center><h4><u>Actualizar Reembolso</u></h4></center>
<form action="" method="post" id="F1" name="F1">
 <input type="hidden" name="Nit" value="<? echo $Nit;?>">
  <table border="0" align="center">
  <tr><td><br></td></tr>
  <tr>
     <td><b>Factura_Compra:</b></td>
     <td><input type="text" name="FacturaCompra" value="<?echo $NroF;?>" size="15" maxlength="12" readonly class="cajas" onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="FacturaCompra"></td>
   </tr>
   <tr>
     <td><b>Factura_Venta:</b></td>
     <td><input type="text" name="NroVenta" value="" size="15" maxlength="12" class="cajas" onfocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="NroVenta"></td>
   </tr>
   <tr><td><br></td></tr>
  <tr>
    <td colspan="2">
      <input type="button" value="Buscar" class="boton" onclick="Validar()" id="buscar" name="buscar">

    </td>
  </tr>
</table>

</form>
<?
}else{
    include("../conexion.php");
    $consulta="select factura.nrofactura from factura where factura.nrofactura ='$NroVenta'";
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta ");
    $registro=mysql_num_rows($resultado);
    if ($registro==0){
       ?>
        <script language="javascript">
          alert ("Este Nro de Factura no existe en el sistema!")
          history.back()
       </script>
       <?
    }else{
       include("../conexion.php");
       $Editar="update pagar set estadofactura='CANCELADA',facturacompra='$NroVenta' where pagar.nrofactura='$FacturaCompra' and pagar.nitprove='$Nit'";
       $Res=mysql_query($Editar)or die("Error al actualizar");
       $registro=mysql_affected_rows();
       echo "<script language=\"javascript\">";
                 echo "open (\"../pie.php?msg=Se actualizó $registro registros para el Nit: $Nit\",\"pie\");";
      echo "open (\"ListadoReembolso.php\",\"_self\");";
      echo "</script>";
    }
 }
    ?>
</body>
</html>
