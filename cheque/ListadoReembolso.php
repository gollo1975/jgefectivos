<html>
    <head>
        <title>Compras _ Reembolso</title>
        <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
    </head>
   <body>
        <center><h4><u>Compras _ Reembolso</u> </h4></center>
        <form action="" method="post">
            <table border="1" align="center">
                 <tr>
                     <td>    <select name="campo">
                             <option value="0">Seleccion una opcion
                             <option value="nrofactura">Nro_Factura
                             <option value="nomprove">Proveedor
                     </select></td>
                 <td><input type="text" name="valor" value="" size="40" maxlength="40"></td>
                 </tr>
                 <tr>
                     <td colspan="2"><input type="submit" value="Buscar" class="boton"><input type="reset" value="Limpiar"class="boton"></th>
                 </tr>
            </table>
        </form>
        <?
         include("../conexion.php");
                if (empty($valor))
                {
                        $consulta="select pagar.nrofactura,pagar.nitprove,provedor.nomprove,pagar.total,pagar.tipofactura from pagar,provedor where provedor.nitprove=pagar.nitprove and pagar.estadofactura='ACTIVA' and pagar.tipofactura='REEMBOLSO' order by pagar.fechagra";
                }
                elseif ($campo=='nrofactura')
                {
                       $consulta="select pagar.nrofactura,pagar.nitprove,provedor.nomprove,pagar.total,pagar.tipofactura from pagar,provedor where provedor.nitprove=pagar.nitprove and pagar.estadofactura='ACTIVA' and pagar.tipofactura='REEMBOLSO' and pagar.nrofactura = '$valor'";

                }
                else
                {
                       $consulta="select pagar.nrofactura,pagar.nitprove,provedor.nomprove,pagar.total,pagar.tipofactura from pagar,provedor where provedor.nitprove=pagar.nitprove and pagar.estadofactura='ACTIVA' and pagar.tipofactura='REEMBOLSO' and provedor.nomprove like '%$valor%' order by provedor.nomprove";

                }
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                $registros=mysql_affected_rows();
                if ($registros==0)
                {
                 ?>
                   <script language="javascript">
                                alert("No hay facturas de Reembolso para mostrar!")
                  </script>
                 <?
                }
                else
                {
                      ?>
                      <table border="1" align="center">
                                <tr>
                                        <th>&nbsp;</th>
                                        <th><b>Nro_Factura</b></th>
                                        <th><b>Nit_Proveedor</b></th>
                                        <th><b>Proveedor</th>
                                        <th><b>Vlr_Pagar</b></th>
                                        <th><b>Tipo_Factura</b></th>
                                </tr>
                     <?
                      $i=$i+1;
                        while ($filas=mysql_fetch_array($resultado))
                            {
                            $Total=number_format($filas["total"],0);
                            ?><tr class="cajas">
                                        <th><? echo $i;?></th>
                                         <td>&nbsp;<a href="Actualizar.php?NroF=<?echo $filas["nrofactura"];?>&Nit=<?echo $filas["nitprove"];?>"><?echo $filas["nrofactura"];?></a></td>
                                        <td>&nbsp;<?echo $filas["nitprove"];?></td>
                                        <td>&nbsp;<?echo $filas["nomprove"];?></td>
                                        <td><div align="right"><?echo $Total;?></div></td>
                                        <td>&nbsp;<?echo $filas["tipofactura"];?></td>

                             </tr>
                            <?
                            $i=$i+1;
                            $Saldo=$Saldo+$filas["total"];
                         }
                         $Saldo=number_format($Saldo,0);
                       ?>
                        </table>
                        <div align="center"><h4><b><font color="red">Total_Valor:&nbsp;<?echo $Saldo;?></font></b></h4></div>
                     <?
                 }
                 ?>
                        </body>
</html>
