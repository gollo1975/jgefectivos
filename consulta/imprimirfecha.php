<?
 session_start();
?>
<html>
        <head>
                <title>Empleados por Zona</title>
                <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
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
         $variable="select zona.zona from zona where
                 zona.codzona='$campo'";
        $resultado=mysql_query($variable)or die("consulta incorrecta ");
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
               <table border="0" align="center" >
                <tr>
                  <td colspan="25"></td><td>ZONA:&nbsp;<?echo $filas["zona"];?></td>
                </tr>
                 </table>
             <?
           endwhile;
           endif;

           include("../conexion.php");
          $variable1="select empleado.codemple,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,eps.eps,pension.pension,zona.zona,contrato.fechainic,contrato.salario,contrato.cargo from empleado,zona,contrato,eps,pension where
                 zona.codzona=empleado.codzona and
                 empleado.codemple=contrato.codemple and
                 empleado.codeps=eps.codeps and
                 empleado.codpension=pension.codpension and
                 contrato.fechater='0000-00-00'and
                 contrato.fechainic between '$desde'and'$hasta' and
                 zona.codzona='$campo'";

       $resultado1=mysql_query($variable1)or die("consulta incorrecta");
        $registro1=mysql_num_rows($resultado1);
        if ($registro1==0):
          ?>
          <script language="javascript">
            alert("No Hay empleados ingresados por esta Zona ?")
            history.back()
          </script>
         <?
         else:
         ?>
         <br>
         <table border="0" align="center" width="730">
          <tr>
             <td colspan="15" ><br></td>
             </tr>
             <tr class="cajas">
                  <td><b>Codigo<b></td>
                  <td><b>Ducumento:<b></td>
                  <td><b>Nombres<b></td>
                  <td><b>Apellidos<b></td>
                  <td><b>Eps<b></td>
                  <td><b>Pensión<b></td>
                  <td><b>Zona<b></td>
                  <td><b>Fecha Ing.<b></td>
                  <td><b>Salario<b></td>
                  <td><b>Cargo</b></td>
              </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado1)):
             ?>
               <tr class="cajas">
              <td><?echo $filas_s["codemple"];?></td>
                 <td><?echo $filas_s["cedemple"];?></td>
                 <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?></td>
                 <td><?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                 <td><?echo $filas_s["eps"];?></td>
                 <td><?echo $filas_s["pension"];?></td>
                 <td><?echo $filas_s["zona"];?></td>
                 <td><?echo $filas_s["fechainic"];?></td>
                 <td><?echo $filas_s["salario"];?></td>
                 <td><?echo $filas_s["cargo"];?></td>
                 </tr>
                 <?
                 $total=$total+1;
              endwhile;
              ?>
             </table>
                         <table border="0" align="center">
              <tr><br>
                <td colspan="10"><br></td><td class="cajas">Total Registro:&nbsp;<?echo $total;?></td>
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
