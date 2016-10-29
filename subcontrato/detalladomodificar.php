<html>

<head>
  <title>Cargando Empleados</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
   include("../conexion.php");
    $con="select subcontrato.nombre,subcontrato.cedemple from subcontrato
             where subcontrato.contratista='$cedula'";
    $re=mysql_query($con)or die ("Error de Busqueda 1");
     $regi=mysql_num_rows($re);
     if ($regi!=0):
        ?>

          <center><h4>Listado de Empleados</h4></center>
          <table border="0" align="center">
             <tr class="cajas"><td>Para modificar el empleado, presione Click sobre el Documento [cedula]..</td></tr>
           </table>
          <table border="0" align="center">
              <tr class="cajas">
                  <td><b>Cedula</b></td>
               <td><b>Empleado</b></td>
            </tr>
            <?
            while($filas=mysql_fetch_array($re)):
            ?>
             <tr class="cajas">
               <td><a href="empleados.php?cedula=<? echo $filas["cedemple"];?>&codzona=<? echo $codzona;?>"><? echo $filas["cedemple"];?></a></td>
              <td><? echo $filas["nombre"];?></td>
            </tr>
            <?
            $i=$i+1;
         endwhile;
         ?>
           </table>
           <center><td><b>Nro:</b>&nbsp;<? echo $i;?></td></center>
           <center><td><a href="modificar.php" title="Permite Modificar otro registro">Volver </a></td></center>  
         <?
        else:
          ?>
          <script language="javascript">
            alert ("Este contratista no tiene empleados a cargo ?")
            history.back()
          </script>
            <?
endif;
?>

</body>

</html>
