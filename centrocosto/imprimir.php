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
        $variable="select costo.codcosto,costo.centro from costo where
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
               <img src="../image/logotipo.png" border="0"
               <tr>
                 <td colspan="1"></td><td class="cajas"><b>Nit:&nbsp;811.034.496-8</b></td>
               </tr>
                 <tr>
                  <td colspan="2"><td class="cajas"><b>ASOCIADOS POR CENTRO DE COSTO</b></td>
                </tr>
                 <td>&nbsp;</td>
                <td>&nbsp;</td>
                <tr>
                  <td colspan="1"><td class="cajas"><b>Cod_Costo:</b>&nbsp;<?echo $filas["codcosto"];?></td>
                  </tr>
                  <tr>
                  <td colspan="1"><td class="cajas"><b>Centro de Costo:</b>&nbsp;<?echo $filas["centro"];?> </td>
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
            $buscar="select empleado.cedemple,empleado.apemple,empleado.nomemple,zona.zona,zona.codzona from empleado,costo,zona
                where zona.codzona=empleado.codzona and
                  empleado.codcosto=costo.codcosto and
                  costo.codcosto='$codcosto'order by zona.zona";
              $resul=mysql_query($buscar)or die("consulta incorrecta uno");
             $reg=mysql_num_rows($resul);
                       ?>
                      <table border="0" align="center" width="700">
                         <tr align="center" class="cajas">
                             <td><b>Cedula<b></td>
                             <td><b>Asociado</b></td>
                             <td><b>Zona</b></td>
                                                 </tr>
                        <?
                     while ($filas_s=mysql_fetch_array($resul)):
                       ?>
                       <tr align="center" class="cajas">
                          <td><?echo $filas_s["cedemple"];?></td>
                          <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["apemple"];?></td>
                          <td align="right"><?echo $filas_s["zona"];?></td>
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
