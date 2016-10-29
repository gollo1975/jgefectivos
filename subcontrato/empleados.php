<html>

<head>
  <title>Cargando Empleados</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
include("../conexion.php");
   $con="select subcontrato.item,subcontrato.cedemple,subcontrato.nombre,subcontrato.contratista from subcontrato
                            where subcontrato.cedemple='$cedula'";
    $re=mysql_query($con)or die ("Error de Busqueda");
    while($filas=mysql_fetch_array($re)):
    ?>
      <center><h4>Modificar Registros</h4></center>
      <form action="grabarmodificado.php" method="post" id="matcargar">
      <input type="hidden" name="item" value="<? echo $filas["item"];?>">
        <table border="0" align="center">
        <tr><td><br></td></tr>
          <tr>
             <td><b>Cedula:</b></td>
             <td><input type="text" name="ced" value="<? echo $filas["cedemple"];?>" size="12" class="cajas" readonly></td>
          </tr>
           <tr>
             <td><b>Empleado:</b></td>
             <td><input type="text" name="nom" value="<? echo $filas["nombre"];?>" size="40" class="cajas"readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
          </tr>
           <tr>
         <td><b>Contratista:</b></td>
          <td><select name="contrato" class="cajas">
                 <?
                  $aux=$filas["contratista"];
                   $consulta_z="select empleado.cedemple,empleado.apemple,empleado.nomemple from empleado,zona,contrato
                                  where zona.codzona=empleado.codzona and
                                        empleado.codemple=contrato.codemple and
                                        contrato.fechater='0000-00-00' and
                                        zona.codzona='$codzona' and
                                        empleado.nomina='SI' order by empleado.nomemple,empleado.apemple";
                    $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                  while ($filas_z=mysql_fetch_array($resultado_z)):
                       if ($aux==$filas_z["cedemple"]):
                          ?>
                          <option value="<?echo $filas_z["cedemple"];?>" selected><?echo $filas_z["nomemple"];?>&nbsp;<?echo $filas_z["apemple"];?>
                          <?
                       else:
                         ?>
                         <option value="<?echo $filas_z["cedemple"];?>"><?echo $filas_z["nomemple"];?>&nbsp;<?echo $filas_z["apemple"];?>
                         <?
                       endif;
                  endwhile;
                         ?>
              </select></td>
      </tr>
     <tr><td><br></td></tr>
     <tr>
        <td colspan="5">
          <input type="submit" value="Grabar" class="boton">
        </td>
     </tr>
    </table>
  </form>
  <?
   endwhile;
?>

</body>

</html>
