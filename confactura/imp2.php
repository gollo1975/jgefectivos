<?
 session_start();
?>
<html>
        <head>
                <title>Facturas por Sucursales</title>
                <link rel="stylesheet" href="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
        <body onload="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
               <?
      if(session_is_registered("validar")):
        include("../conexion.php");
         $variable="select sucursal.sucursal from sucursal where
                 sucursal.codsucursal='$campo'";
        $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("La Zona no existe en la base de datos.")
            history.back()
          </script>
         <?
        else:
            while ($filas=mysql_fetch_array($resultado)):
             ?>
               <table border="0" align="center" width="700">
                <tr>
                  <th colspan="35"></th><td class="cajas">Sucursal:&nbsp;<?echo $filas["sucursal"];?></td>
                </tr>
                 </table>
             <?
           endwhile;
           endif;

           include("../conexion.php");
          $variable1="select zona.zona,factura.nrofactura,factura.fechaini,factura.fechaven,factura.fechagra,factura.subtotal,factura.iva,factura.grantotal,
                    factura.nsaldo,factura.estado from sucursal,zona,factura where
                    sucursal.codsucursal=zona.codsucursal and
                    zona.codzona=factura.codzona and
                    factura.fechaini between '$desde'and'$hasta' and
                    sucursal.codsucursal='$campo'order by zona.zona";

       $resultado1=mysql_query($variable1)or die("consulta incorrecta");
        $registro1=mysql_num_rows($resultado1);
        if ($registro1==0):
          ?>
          <script language="javascript">
            alert("No existe cartera de facturacion ?")
            history.back()
          </script>
         <?
         else:
         ?>
         <br>
         <table border="1" align="center">
         <td>
          <table border="0" align="center">
           <tr>
             <th colspan="9" >Datos de la Factura</th>
             </tr>
             <tr class="cajas">
              <th>Nro_Factura</th>
               <th>Zona</th>
              <th>F_Inicio</th>
              <th>F_Vencimiento</th>
              <th>F_Proceso</th>
              <th>Subtotal</th>
              <th>Iva</th>
              <th>Total</th>
              <th>N_Saldo</th>
              <th>Estado</th>
              </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado1)):
             $aux=number_format($filas_s["subtotal"],0);
             $aux1=number_format($filas_s["iva"],0);
             $aux2=number_format($filas_s["grantotal"],0);
             $aux3=number_format($filas_s["nsaldo"],0);
             ?>
               <tr class="cajas">
               <td><?echo $filas_s["nrofactura"];?></td>
                <td><?echo $filas_s["zona"];?></td>
                 <td><?echo $filas_s["fechaini"];?></td>
                 <td><?echo $filas_s["fechaven"];?></td>
                 <td><?echo $filas_s["fechagra"];?></td>
                 <td><?echo $aux;?></td>
                 <td><?echo $aux1;?></td>
                 <td><?echo $aux2;?></td>
                 <td><?echo $aux3;?></td>
                 <td><?echo $filas_s["estado"];?></td>
                 </tr>
                 <?
                 $total=$total+$filas_s["nsaldo"];
              endwhile;
               $total=number_format($total,0);
              ?>
             </table>
             </td>
              </table>
              <table border="0" align="center">
              <tr>
                <th colspan="20"></th><td class="cajas"><b>Total Cartera:</b>&nbsp;<?echo $total;?></td>
                </tr>
              </table>
                <?
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
