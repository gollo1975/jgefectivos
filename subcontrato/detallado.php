<html>

<head>
  <title>Cargando Empleados</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
include("../conexion.php");
$con1="select empleado.cedemple from subcontrato,empleado
                        where empleado.cedemple=subcontrato.cedemple and
                         empleado.cedemple='$cedula'";
$re1=mysql_query($con1)or die ("Error de Busqueda");
$reg1=mysql_num_rows($re1);
if ($reg1==0):
    $con="select empleado.cedemple,concat(empleado.nomemple,' ', empleado.nomemple1,' ', empleado.apemple, ' ',empleado.apemple1) as nombre from empleado
                            where empleado.cedemple='$cedula'";
    $re=mysql_query($con)or die ("Error de Busqueda");
    while($filas=mysql_fetch_array($re)):
    ?>
      <center><h4>Crear Sucontratos</h4></center>
      <form action="grabarcarga.php" method="post" id="matcargar">
        <table border="0" align="center">
        <tr><td><br></td></tr>
          <tr>
             <td><b>Cedula:</b></td>
             <td><input type="text" name="cedula" value="<? echo $filas["cedemple"];?>" size="12" class="cajas" readonly></td>
          </tr>
           <tr>
             <td><b>Empleado:</b></td>
             <td><input type="text" name="nombre" value="<? echo $filas["nombre"];?>" size="40" class="cajas"readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
          </tr>
           <tr>
         <td><b>Contratista:</b></td>
            <td colspan="12"><select name="contratista" class="cajas">
                              <option value="0">Seleccione el Contratista
                                <?
                                 $consulta_z="select empleado.cedemple,empleado.apemple,empleado.apemple1,empleado.nomemple,empleado.nomemple1 from empleado,zona,contrato
                                  where zona.codzona=empleado.codzona and
                                        empleado.codemple=contrato.codemple and
                                        contrato.fechater='0000-00-00' and
                                        zona.codzona='$codzona' and
                                        empleado.nomina='SI' order by empleado.nomemple,empleado.apemple";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["cedemple"];?>"><?echo $filas_z["nomemple"];?>&nbsp;<?echo $filas_z["nomemple1"];?>&nbsp;<?echo $filas_z["apemple"];?>&nbsp;<?echo $filas_z["apemple1"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
      </tr>
     <tr><td><br></td></tr>
     <tr>
        <td colspan="5">
          <input type="submit" value="Adiccionar" class="boton">
        </td>
     </tr>
    </table>
  </form>
  <?
   endwhile;
else:
  ?>
  <script language="javascript">
    alert ("Este empleado ya esta Ingresado a un Subcontratista ?")
    history.back()
  </script>
    <?
endif;

?>

</body>

</html>
