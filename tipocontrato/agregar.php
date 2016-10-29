<html>
<head>
<title>Tipo de contratos de contratos</title>
</head>
<body>
<?
if(!isset($tipo)):
  include("../conexion.php");
?>
  <form action="" method="post">
    <table border="1" align="center">
      <tr>
        <th colspan="2">Agregar tipos de Contratos</th>
      </tr>
      <tr>
        <td>Tipo_Contrato:</td>
        <td><input type="text" value="" name="tipo" size="6" maxlength="2"></td>
      </tr>
      <tr>
        <td>Descripción:</td>
        <td><input type="text" value="" name="concepto" size="40" maxlength="40"></td>
      </tr>
      <tr>
        <th colspan="2">
          <input type="submit" value="Guardar">
          <input type="reset" value="limpiar">
        </th>
   </table>
   </form>
   <?
   elseif(empty($tipo)):
   ?>
       <script language="javascript">
         alert("Debe de digita el codigo del contrato")
         history.back()
       </script>
   <?
       elseif(empty($concepto)):
   ?>
         <script language="javascript">
           alert("Debe de digitar la descripción del contrato")
           history.back()
         </script>
     <?
          else:
           include("../conexion.php");
           $consulta="select * from tipocontrato where tipo='$tipo'";
           $resultado=mysql_query($consulta)or die("Consulta incorrecta");
           $registro=mysql_num_rows($resultado);
           if ($registro==0):
             $consulta="insert into tipocontrato(tipo,concepto)values('$tipo','$concepto')";
             $resultado=mysql_query($consulta)or die("Consulta incorrecta");
         ?>
             <script language="javascript">
               alert("Registros almacenados con éxitos ?")
              history.back()
             </script>
       <?
           else:
       ?>
             <script language="javascript">
               alert("El Registros ya existe en la base de datos ?")
               history.back()
              </script>
        <?
           endif;
      endif;
?>
</body>
</html>
