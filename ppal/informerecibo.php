<?
 session_start();
?>
<html>

<head>
<title>Consulta de recibo de Caja</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='informerecibo.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<?
if(session_is_registered("xzona")):
           include("../conexion.php");
            $variable1="select recibo.nrocaja,recibo.nrofactura,recibo.fechare,recibo.abono,factura.nsaldo from factura,recibo where
                    factura.nrofactura=recibo.nrofactura and
                     factura.nrofactura='$nrofactura'";
        $resultado1=mysql_query($variable1)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado1);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No existen Recibos de cajas para esta Factura.")
            history.back()
          </script>
         <?
         else:
         ?>
         <center><h4>Datos del Recibo de Caja</h4></center>
         <table align="center">
          <tr>
             <td class="cajas">Para ver el Informe del Recibo de Caja, Presione Click Sobre el Nro de Recibo.. </td>
          </tr>
         </table>
         <tr><td><br></td></tr>
         <table align="center">
         <table border="0" align="center">
           <tr>
             <td colspan="9" class="fondo"> </td>
           </tr>
           <tr class="cajas">
              <th class="fondo">Nro_Recibo</th>
              <th class="fondo">Nro_Factura</th>
              <th class="fondo">Fecha_Pago</th>
              <th class="fondo">Abono</th>
              <th class="fondo">Nuevo_Saldo</th>
           </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado1)):
             ?>
               <tr class="cajas">
                 <td><a href="../recibocaja/ImprimirRecibo.php?NroRecibo=<?echo $filas_s["nrocaja"];?>"><?echo $filas_s["nrocaja"];?></a></td>
                 <td><?echo $filas_s["nrofactura"];?></td>
                 <td><?echo $filas_s["fechare"];?></td>
                 <td><?echo $filas_s["abono"];?></td>
                 <td><?echo $filas_s["nsaldo"];?></td>
                 </tr>
                <?
              endwhile;
              ?>
              </table>

               <?
           endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/accesozona.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;           
       ?>

        </table>
       </body>
  </html>
