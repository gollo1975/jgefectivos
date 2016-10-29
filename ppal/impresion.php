<?
 session_start();
?>
<html>
        <head>
                <title>Facturas por Zona</title>
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
      if(session_is_registered("xzona")):
        include("../conexion.php");
         $variable="select zona.zona from zona where
                 zona.codzona='$codigo'";
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
                  <th colspan="35"></th><td class="cajas">Zona:&nbsp;<?echo $filas["zona"];?></td>
                </tr>
                 </table>
             <?
           endwhile;
           endif;

           include("../conexion.php");
          $variable1="select factura.nrofactura,factura.fechaini,factura.fechaven,factura.fechagra,factura.subtotal,factura.iva,factura.grantotal,
                    factura.nsaldo,factura.estado from zona,factura where
                    zona.codzona=factura.codzona and
                    factura.nsaldo > 0 and
                    zona.codzona='$codigo'";
       $resultado1=mysql_query($variable1)or die("consulta incorrecta");
        $registro1=mysql_num_rows($resultado1);
        if ($registro1==0):
          ?>
          <script language="javascript">
            alert("No existe cartera de factura para esta Zona ?")
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
             ?>
               <tr class="cajas">
               <td><?echo $filas_s["nrofactura"];?></td>
                 <td><?echo $filas_s["fechaini"];?></td>
                 <td><?echo $filas_s["fechaven"];?></td>
                 <td><?echo $filas_s["fechagra"];?></td>
                 <td><?echo $filas_s["subtotal"];?></td>
                 <td><?echo $filas_s["iva"];?></td>
                 <td><?echo $filas_s["grantotal"];?></td>
                 <td><?echo $filas_s["nsaldo"];?></td>
                 <td><?echo $filas_s["estado"];?></td>
                 </tr>
                 <?
                 $total=$total+$filas_s["nsaldo"];
              endwhile;
              ?>
             </table>
             </td>
              </table>
              <table border="0" align="center">
              <tr>
                <th colspan="20"></th><td class="cajas">Total Cartera:&nbsp;<?echo $total;?></td>
                </tr>
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

                   </body>
</html>
