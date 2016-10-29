<html>
<head>
<title>Consulta de Factura </title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<script language="javascript">
        function imprimir(numero)// para declara funcion
        {
                pagina='../factura/imprimir.php?nrofactura=' + numero 
                tiempo=50
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }
        function volver()// para declara funcion
        {
                pagina='facturaventa.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<?
if (!isset($nrofactura)):

?>
<center><h4>Consulta de Factura</h4></center>
  <form action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2" class="fondo"></td>
      </tr>
       <tr><td><br></td></tr>
       <tr>
        <td><b>Nro de Factura:&nbsp;</b></td>
         <td><input type="text" name="nrofactura" value="" size="10" maxlength="10">&nbsp;</td>
       </tr>
        <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar"class="boton"></td>

       </tr>
       <tr><td><br></td></tr>
    </table>
   </form>
  <?
elseif (empty($nrofactura)):
   ?>
   <script language="javascript">
     alert("Digite el nro de Factura a Consultar")
     history.back()
   </script>
   <?
   else:
       include("../conexion.php");
       $variable1="select zona.zona,factura.nrofactura,factura.fechaini,factura.fechaven,factura.fechagra,factura.subtotal,factura.iva,factura.grantotal,
                    factura.nsaldo,factura.estado from zona,factura,sucursal where
                     sucursal.codsucursal=zona.codsucursal and
                     zona.codzona=factura.codzona and
                     sucursal.codsucursal='$codigo' and
                     factura.nrofactura='$nrofactura'";
        $resultado1=mysql_query($variable1)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado1);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("La factura no existe en la base de datos/ o no esta autorizado para imprimir esta factura ?")
            history.back()
          </script>
         <?
         else:
         ?>
         <center><h4>Datos de la Factura</h4></center>
         <table border="0" align="center">
           <tr class="cajas">
             <td>Para ver las Notas Creditos de la Factura, Presione click sobre el Campo [NRO_FACTURA]..</td>
           </tr>
         </table>
         <table border="0" align="center">
           <tr>
             <td colspan="12" class="fondo"> </td>
           </tr>
           <tr class="cajas">
                 <td><br></td>
              <td><b>&nbsp;&nbsp;Nro_Factura</b></td>
              <td><b>&nbsp;&nbsp;Zona</b></td>
              <td><b>&nbsp;&nbsp;F_Inicio</b></td>
              <td><b>&nbsp;&nbsp;F_Vencimiento</b></td>
              <td><b>&nbsp;&nbsp;F_Proceso</b></td>
              <td><b>&nbsp;&nbsp;Subtotal</b></td>
              <td><b>&nbsp;&nbsp;Iva</b></td>
              <td><b>&nbsp;&nbsp;Total</b></td>
              <td><b>&nbsp;&nbsp;N_Saldo</b></td>
              <td><b>&nbsp;&nbsp;Estado</b></td>
              </tr>
              <?
              $estado=1;
             while($filas_s=mysql_fetch_array($resultado1)):
             $aux=number_format($filas_s["subtotal"],0);
             $aux1=number_format($filas_s["iva"],0);
             $aux2=number_format($filas_s["grantotal"],0);
             $aux3=number_format($filas_s["nsaldo"],0);
             ?>
               <tr class="cajas">
                <td><input type="button" value="Imprimir" onclick="imprimir('<?echo $filas_s["nrofactura"];?>&estado=1')"></td>
               <td>&nbsp;&nbsp;<a href="consultanota.php?nrofactura=<?echo $filas_s["nrofactura"];?>"><?echo $filas_s["nrofactura"];?></a></td>
                <td>&nbsp;&nbsp;<?echo $filas_s["zona"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["fechaini"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["fechaven"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["fechagra"];?></td>
                 <td>&nbsp;&nbsp;<?echo $aux;?></td>
                 <td>&nbsp;&nbsp;<?echo $aux1;?></td>
                 <td>&nbsp;&nbsp;<?echo $aux2;?></td>
                 <td>&nbsp;&nbsp;<?echo $aux3;?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["estado"];?></td>
                 </tr>
                <?
              endwhile;
              ?>
              </table>

               <?
           endif;
         endif;
        ?>

        </table>
       </body>
  </html>
