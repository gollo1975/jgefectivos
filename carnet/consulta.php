
<html>
<head>
  <title>Consulta de Carnets</title>
  <link rel="stylesheet" href="../estilo.css" type="text/css">
</head>
<body>
<?
 if (!isset($campo)):
  ?>
 <center><h4> Consulta de Carnets</h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"></td>
  </tr>
  <tr><td><br></td></tr>
   <tr>
     <td><b>Campo de Consulta:</b></td>
     <td><select name="campo" class="cajas">
        <option value="0">Seleccione la Opción
        <option value="1">Documento
        </select></td>
   </tr>
   <tr>
     <td><b>Valor de Consulta:</b></td>
     <td><input type="text" name="valor" value="" size="20" maxlength="20"></td>
   </tr>
   <tr><td><br></td></tr>
  <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>
</table>

</form>
<?
elseif (empty($valor)):
?>
  <script language="javascript">
    alert ("Digite Dato a Consultar ?")
    history.back()
  </script>
 <?
  else:
  include("../conexion.php");
    if($codigo==''):
      $consulta="select empleado.codemple,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,zona.zona from empleado,zona
            where zona.codzona=empleado.codzona and
                empleado.cedemple='$valor'";
      $resultado=mysql_query($consulta)or die ("Consulta incorrecta ");
      $registro=mysql_num_rows($resultado);
      if ($registro==0):
       ?>
        <script language="javascript">
          alert ("El empleado no existe en la bd. ?")
          history.back()
       </script>
      <?
      else:
     ?>
      <center><h4>Datos Consultados</h4></center>
       <table border="0" align="center">
         <tr>
           <td colspan="9"></td>
          </tr>
          <tr class="cajas">
            <th>Código</th>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Zona</th>
          </tr>
          <?
            while($filas=mysql_fetch_array($resultado)):
          ?>
           <tr class="cajas">
           <td><?echo $filas["codemple"];?></td>
           <td><a href="../modulodepartamento/auxiliarempleado.php?cedemple=<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?></a></td>
           <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
            <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
            <td>&nbsp;<?echo $filas["zona"];?></td>
            </tr>
          <?
          endwhile;
          ?>
        </table>
       <?
      endif;
      include("../conexion.php");
       $consulta1="select carnet.codcarnet,empleado.codemple,empleado.cedemple,empleado.nomemple,empleado.apemple,carnet.fecha,carnet.tipocarnet from empleado,carnet where
              empleado.cedemple=carnet.cedemple and
              empleado.cedemple='$valor'";
        $resultado1=mysql_query($consulta1)or die ("Consulta incorrecta 12");
        $registro1=mysql_num_rows($resultado1);
        ?>
        <center><h4>Información del Carnet</h4></center>
        <table border="0" align="center">
         <tr class="cajas">
         <td colspan="9"></td>
         </tr>
          <tr class="cajas">
            <th>Cód_Entrada</th>
            <th>Fecha_Proceso</th>
            <th>Tipo Carnet</th>
          </tr>
         <?
         while($filas_s=mysql_fetch_array($resultado1)):
         ?>
           <tr class="cajas">
              <td><?echo $filas_s["codcarnet"];?></td>
             <td><?echo $filas_s["fecha"];?></td>
             <td><?echo $filas_s["tipocarnet"];?></td>
           </tr>
         <?
         endwhile;
         ?>
       </table>
       <?
    else:
       $consulta="select empleado.codemple,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,zona.zona from empleado,zona,sucursal
            where sucursal.codsucursal=zona.codsucursal and
                 sucursal.codsucursal='$codigo' and
                 zona.codzona=empleado.codzona and
                empleado.cedemple='$valor'";
      $resultado=mysql_query($consulta)or die ("Consulta incorrecta ");
      $registro=mysql_num_rows($resultado);
      if ($registro==0):
       ?>
        <script language="javascript">
          alert ("El empleado no existe en la bd o no esta autorizado para ver esta informacion ?")
          history.back()
       </script>
      <?
      else:
     ?>
      <center><h4>Datos Consultados</h4></center>
       <table border="0" align="center">
         <tr>
           <td colspan="9"></td>
          </tr>
          <tr class="cajas">
            <th>Código</th>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Zona</th>
          </tr>
          <?
            while($filas=mysql_fetch_array($resultado)):
          ?>
           <tr class="cajas">
           <td><?echo $filas["codemple"];?></td>
           <td><a href="../modulodepartamento/auxiliarempleado.php?cedemple=<?echo $filas["cedemple"];?>&codigo=<?echo $codigo;?>"><?echo $filas["cedemple"];?></a></td>
           <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
            <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
            <td>&nbsp;<?echo $filas["zona"];?></td>
            </tr>
          <?
          endwhile;
          ?>
        </table>
       <?
      endif;
      include("../conexion.php");
       $consulta1="select carnet.codcarnet,empleado.codemple,empleado.cedemple,empleado.nomemple,empleado.apemple,carnet.fecha,carnet.tipocarnet from empleado,carnet where
              empleado.cedemple=carnet.cedemple and
              empleado.cedemple='$valor'";
        $resultado1=mysql_query($consulta1)or die ("Consulta incorrecta 12");
        $registro1=mysql_num_rows($resultado1);
        ?>
        <center><h4>Información del Carnet</h4></center>
        <table border="0" align="center">
         <tr class="cajas">
         <td colspan="9"></td>
         </tr>
          <tr class="cajas">
            <th>Cód_Entrada</th>
            <th>Fecha_Proceso</th>
            <th>Tipo Carnet</th>
          </tr>
         <?
         while($filas_s=mysql_fetch_array($resultado1)):
         ?>
           <tr class="cajas">
              <td><?echo $filas_s["codcarnet"];?></td>
             <td><?echo $filas_s["fecha"];?></td>
             <td><?echo $filas_s["tipocarnet"];?></td>
           </tr>
         <?
         endwhile;
         ?>
       </table>
       <?
    endif;
  endif;

    ?>
</body>
</html>
