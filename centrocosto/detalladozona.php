<?
 session_start();
?>
<html>

<head>
  <title>Empleados por zona</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
      <script language="javascript">
        function volver()// para declara funcion
        {
                pagina='buscar.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }
      </script>

</head>
<body>
<?
if(session_is_registered("validar")):
     include("../conexion.php");
         $consu="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,contrato.fechainic,contrato.salario from empleado,costo,zona,contrato
          where zona.codzona=empleado.codzona and
          empleado.codcosto=costo.codcosto and
          empleado.codemple=contrato.codemple and
          contrato.fechater='0000-00-00' and
         costo.codcosto='$codcosto' and
         zona.codzona='$codzona'order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
          $resulta=mysql_query($consu)or die ("Consulta incorrecta");
          $registro=mysql_num_rows($resulta);
          $registro=mysql_affected_rows();
          if ($registro!=0):
     ?>
            <center><h4>Listado de Empleados</h4></center>
               <table border="0" align="center">
                <tr class="cajas">
                  <th>Cedula</th>
                  <th>Empleado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                  <th>Salario</th>
                  <th>Fecha_Ingreso</th>
                  </tr>
    <?
            while($filas_s=mysql_fetch_array($resulta)):
                        ?>
         <tr  class="cajas">
                 <td><?echo $filas_s["cedemple"];?></a></td>
                <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["salario"];?></td>
                 <td>&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas_s["fechainic"];?></td>
                 </tr>

           <?
           $suma=$suma+1;
            endwhile;
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
             <center><td class="cajas"><b>Nro_Registro:</b>&nbsp;&nbsp;<?echo $suma;?></td></center>
             <tr><td><br></td></tr>
             <th><center><a href="imprimirlistado.php?codcosto=<?echo $codcosto;?>&codzona=<? echo $codzona;?>" target="_blank" onclick="volver()" class="fondo"><b>Imprimir</b></a></center></th>
            <?
          else:
            ?>
              <script language="javascript">
                alert("No Existen empleados con este Centro de costo")
                history.back()
             </script>
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
</table>

</body>
</html>
