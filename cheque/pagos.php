<?
 session_start();
?>
<html>
<head>
<title> Listado de Pagos a Factura</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
 <?
 if(session_is_registered("validar") or session_is_registered("xsession")):
      include("../conexion.php");
      $consu="select cheque.*,pagar.saldo,pagar.nitprove from cheque,pagar where
                pagar.nrofactura=cheque.nrofactura and
                pagar.nrofactura='$nrofactura'";
             $resu=mysql_query($consu)or die("Consulta incorrecta");
             $registros=mysql_num_rows($resu);
             ?>
              <center><h3>Listado de Pagos</h3></center>
              <table border="0" align="center">
               <tr  class="fondo">
                <td colspan="9"><br></td>
              </tr>
              <tr  class="cajas">
                  <th>Nro_Pago</th>
                  <th>Fecha_Pago</th>
                  <th>Valor_Pagado</th>
                  <th>Nro_Factura</th>
                  <th>Nuevo_Saldo</th>
               </tr>
              <?
               while($filas=mysql_fetch_array($resu)):
                ?>

              <tr class="cajas" align="center">
                  <td><?echo $filas["nropago"];?></td>
                 <td><?echo $filas["fechapro"];?></td>
                 <td><?echo $filas["abonado"];?></td>
                  <td><?echo $filas["nrofactura"];?></td>
                  <td><?echo $filas["saldo"];?></td>
                  </tr>
              <?
              $suma=$suma+$filas["abonado"];
            endwhile;
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
            </table>
            <tr><td>&nbsp;</td></tr>
            <center><td class="cajas"><b>Cancelado:</b>&nbsp;&nbsp;<?echo $suma?></td></center>
           
  </table>

</body>
</html>
