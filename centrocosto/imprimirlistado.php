<?
 session_start();
?>
<html>
        <head>
                <title>Impresión de empleados</title>
                  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

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
        $variable="select costo.codcosto,costo.centro,zona.zona from costo,zona where
                  zona.codzona='$codzona' and
                  costo.codcosto='$codcosto'";
        $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No hay registro para Mostrar ?")
            history.back()
          </script>
         <?
        else:
            while ($filas=mysql_fetch_array($resultado)):
             ?>
               <table border="0" align="center" width="700">
               <img src="../image/logotipo.png" border="0" cellpadding="0" cellspacing="0" height="100" widht="100">
               <tr>
                 <td colspan="1"></td><td class="cajas"><b>Nit:&nbsp;811.034.496-8</b></td>
               </tr>
                 <tr>
                  <td colspan="2"><td class="cajas"><b>ASOCIADOS POR ZONA</b></td>
                </tr>
                 <td>&nbsp;</td>
                <td>&nbsp;</td>
                <tr>
                  <td colspan="1"><td class="cajas"><b>Cod_Costo:</b>&nbsp;<?echo $filas["codcosto"];?></td>
                  </tr>
                  <tr>
                  <td colspan="1"><td class="cajas"><b>Centro de Costo:</b>&nbsp;<?echo $filas["centro"];?> </td>
                </tr>
                </tr>
                  <tr>
                  <td colspan="1"><td class="cajas"><b>Zona:</b>&nbsp;<?echo $filas["zona"];?> </td>
                </tr>
              </table>
                 <td>&nbsp;</td>
                 <tr>
                   <table border="0" align="center">
                      <tr aling="center">
                        <td colspan="2"></td><td class="cajas"><b>Listado De Asociados </b></td>
                      </tr>
                   </table>
                 <td>&nbsp;</td>

             <?
           endwhile;
            $buscar="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,contrato.fechainic,contrato.salario from empleado,costo,zona,contrato
                  where zona.codzona=empleado.codzona and
                  empleado.codcosto=costo.codcosto and
                  empleado.codemple=contrato.codemple and
                  contrato.fechater='0000-00-00' and
                 costo.codcosto='$codcosto' and
                 zona.codzona='$codzona'order by empleado.nomemple,empleado.apemple";
              $resul=mysql_query($buscar)or die("consulta incorrecta uno");
             $reg=mysql_num_rows($resul);
                       ?>
                      <table border="0" align="center" width="700">
                         <tr align="center" class="cajas">
                             <td><b>Cedula<b></td>
                             <td><b>Asociado</b></td>
                             <td><b>Salario</b></td>
                              <td><b>Fecha_Ingreso</b></td>
                          </tr>
                        <?
                     while ($filas_s=mysql_fetch_array($resul)):
                     $salario=number_format($filas_s["salario"],0);
                       ?>
                       <tr align="center" class="cajas">
                          <td><?echo $filas_s["cedemple"];?></td>
                          <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                          <td align="right">$<?echo $salario;?></td>
                          <td align="right"><?echo $filas_s["fechainic"];?></td>
                        </tr>
                       <?
                        $con=$con+1;
                     endwhile;
                     ?>
                     </table>
                       <td>&nbsp;</td>
                      <tr >
                        <center><td class="cajas"><b>Total_Registros:</b>&nbsp;<?echo $con;?></td></center>
                      </tr>
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
