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
      if(session_is_registered("xsession")):
        include("../conexion.php");
         $variable="select zona.zona,zona.codzona from zona where
                 zona.codzona='$campo'";
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
               <table border="1" align="center" width="500">
                <tr><td>
                  <table border="0" align="center" width="500">
                  <tr>
                  <td class="cajas"><b>Cod_Zona:</b>&nbsp;<?echo $filas["codzona"];?></td>
                </tr>
                <tr>
                  <td class="cajas"><b>Zona:</b>&nbsp;<?echo $filas["zona"];?></td>
                </tr>
                 </table>
             <?
           endwhile;
           endif;

           include("../conexion.php");
          $variable1="select factura.nrofactura,factura.fechaini,factura.fechaven,factura.fechagra,factura.subtotal,factura.iva,factura.grantotal,
                    factura.nsaldo,factura.estado from zona,factura where
                    zona.codzona=factura.codzona and
                    factura.fechaini between '$desde'and'$hasta' and
                    zona.codzona='$campo'";

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
         <table border="1" align="center" width="650">
         <td>
          <table border="0" align="center" width="650">
           <tr>
             <th colspan="9" ><u>Listado de Facturas</u></th>
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
             $aux=number_format($filas_s["subtotal"],0);
             $aux1=number_format($filas_s["iva"],0);
             $aux2=number_format($filas_s["grantotal"],0);
             $aux3=number_format($filas_s["nsaldo"],0);
             ?>
               <tr class="cajas">
               <td><?echo $filas_s["nrofactura"];?></td>
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
                 $Saldo=$Saldo + $filas_s["nsaldo"];
                $Subtotal=$Subtotal + $filas_s["subtotal"];
                $TotalF=$TotalF + $filas_s["grantotal"];
                $IvaF=$IvaF + $filas_s["iva"];
              endwhile;
               $Saldo=number_format($Saldo,0);
              $Subtotal=number_format($Subtotal,0);
              $TotalF=number_format($TotalF,0);
              $IvaF=number_format($IvaF,0);
              ?>
             </table>
             </td>
              </table>
              <table border="0" align="center">
              <td class="cajas"><div align="center"><h4><b>Subtotal:</b>&nbsp;<?echo $Subtotal;?>&nbsp;<b>Iva:</b>&nbsp;<?echo $IvaF;?>&nbsp;<b>Total_Pagar:</b>&nbsp;<?echo $TotalF;?>&nbsp;<b>Cartera:</b>&nbsp;<font color="red"><?echo $Saldo;?></font>&nbsp;</h4></div>
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
