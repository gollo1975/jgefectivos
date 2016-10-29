<html>

<head>
<title>Modificar el registro del contrato</title>
</head>
<body>
<?
if (!isset($tipo)):
?>
  <form action="" method="post">
    <table border="1" align="center">
      <tr>
        <th colspan="2">Consulta de Registros</th>
       </tr>
       <tr>
        <td>Tipo_Contrato:</td>
        <td><input type="text" value="" name="tipo" size="6" maxlength="2"></td>
      </tr>
      <tr>
        <th colspan="2">
          <input type="submit" value="Buscar">
          <input type="reset" value="Limpiar">
        </th>
       </tr>
    </table>
   </form>
<?
 elseif(empty($tipo)):
 ?>
   <script language="javascript">
     alert("Debe de digitar el codigo del contrato")
     history.back()
   </script>
   <?
   else:
     include("../conexion.php");
     $consulta="select * from tipocontrato where tipo='$tipo'";
     $resultado=mysql_query($consulta)or die("Consulta incorrecta no lo reconoce");
     $registro=mysql_num_rows($resultado);
     if ($registro==0):
       ?>
       <script language="javascript">
         alert("El código del contrato no existe en la base de datos ?")
         history.back()
       </script>
       <?
     else:
       while($filas=mysql_fetch_array($resultado)):
       ?>
        <form action="guardar.php" method="post">
          <table border="1" align="center">
            <tr>
              <th colspan="2">Modificar Registros</th>
            </tr>
            <tr>
              <td>Código_Contrato:</td>
              <td><input type="text" name="tipo" value="<?echo $filas["tipo"];?>" readonly></td>
            </tr>
            <tr>
              <td>Descripción:</td>
              <td><input type="text" name="concepto" value="<?echo $filas["concepto"];?>" size="40" maxlength="40"></td>
            </tr>
            <tr>
               <th colspan="2"><input type="submit" value="Guardar"></th>
           </tr>
          </table>
        </form>
        <?
       endwhile;
     endif;
   endif;
   ?>
</body>

</html>
