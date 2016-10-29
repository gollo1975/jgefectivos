        <html>
        <head>
                <title>Modificacion Factura</title>
                  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
                  <script language="javascript">
            function sumarTotal()
        {
               total = document.getElementById("cantidad").value
               total1 = document.getElementById("vlruni").value
               subtotal = parseFloat (total) * parseFloat(total1);
               document.getElementById("total").value =  parseFloat(subtotal);
         }
</script>
        </head>
        <body>
        <?
                if (!isset($Servicio)):
                        include("../conexion.php");
                        $consulta="select * from defactura where remision='$datos' ";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        $filas=mysql_fetch_array($resultado);
                        if ($registros==0):
                          ?>
                                <script language="javascript">
                                        alert("No Existen Registros")
                                        history.back()
                                </script>
                          <?
                        else:
                          ?>
                             <center><h4><u>Modificar Registro</u></h4></center>
                                <form action="" method="post">
                               <td><input type="hidden" name="nrofactura" value="<?echo $nrofactura;?>"</td>
                               <td><input type="hidden" name="BaseFactura" value="<?echo $BaseFactura;?>"</td>
                               <td><input type="hidden" name="datos" value="<?echo $datos;?>"</td>
                               <td><input type="hidden" name="TipoFactura" value="<?echo $TipoFactura;?>"</td>
                                        <table border="0" align="center">
                                         <tr><td><br></td></tr>
                                          <tr>
					                  <td colspan="10"><b>T_Factura:</b>
					                  <select name="Servicio"class="cajas">
						                 <?
						                 $Cod=$filas["codcom"];
						                 $consulta_e="select codcom,concepto from item  order by concepto";
						                 $resultado_e=mysql_query($consulta_e)or die("Consulta  incorrecta");
						                 while($filas_e=mysql_fetch_array($resultado_e)):
						                 if ($Cod==$filas_e["codcom"]):
						                 ?>
						                 <option value="<?echo $filas_e["codcom"];?>" selected><?echo $filas_e["concepto"];?>
						                 <?
						                   else:
						                   ?>
						                     <option value="<?echo $filas_e["codcom"];?>"><?echo $filas_e["concepto"];?>
						                   <?
						                   endif;
						                 endwhile;
						                 ?> </selet></td>
						              </tr>
                                         <tr>
                                         <tr>
                                              <td><b>Cant.:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                                              <input type="text" name="cantidad" value="<?echo $filas["cantidad"];?>" class="cajas" size="6" mexlength="6" id="cantidad">
                                               <b>Vlr_Unit:&nbsp;</b><input type="text" name="vlruni" value="<?echo $filas["vlruni"];?>" class="cajas" size="10" mexlength="10"  id="vlruni">
                                               <b>Total:&nbsp;</b><input type="text" name="total" value="<?echo $filas["total"];?>" class="cajas" size="10" mexlength="10" Onfocus="sumarTotal()"id="total"></td>

                                        </tr>
                                        <tr><td><br></td></tr>
                                                <tr>
                                                        <td colspan="5"><input type="submit" value="Guardar" class="boton"></td>
                                                </tr>

                                          <?
                                       endif;
                                           ?>
                                   </table>
                           </form>
               <?else:
                     include("../conexion.php");
                     $consulta="update defactura set codcom='$Servicio',cantidad='$cantidad',vlruni='$vlruni',total='$total' where nrofactura='$nrofactura' and remision='$datos'";
                     $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                     $registros=mysql_affected_rows();
                     if ($registros==0):?>
                          <script language="javascript">
                            alert("No se Actualizo el Registro")
                            history.go(-2)
                         </script>
                     <?else:
                          header("location: Modificar.php?nrofactura=$nrofactura&BaseFactura=$BaseFactura&TipoFactura=$TipoFactura");
                     endif;
               endif;
?>

        </body>
</html>
