<html>
<head>
<title> Datos del Empleado</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>

<?
     include("../conexion.php");
     $consulta="select empleado.* from empleado where cedemple='$cedemple'";
     $resultado=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resultado);
     if($registros==0):
     ?>
      <script language="javascript">
          alert("El Documento no existe en la base de datos:")
          history.back()
        </script>
<?
    else:
      while($filas=mysql_fetch_array($resultado)):
?>
      <center><h4>Datos de un Empleado</h4></center>
      <form action="" method="post">
        <table border="0" align="center">
         <tr class="fondo">
           <td colspan="2"><br></td>
         </tr>
          <tr>
            <td><b>Cod_Empleado:</b></td>
            <td><input type="text" name="codemple" value="<?echo $filas["codemple"];?>"readonly class="cajas"></td>
            </tr>
             <tr>
                   <td><b>Cédula:</b></td>
                   <td><input type="text" name="cedemple" value="<?echo $filas["cedemple"];?>" readonly
                      size="15" maxlength="11" class="cajas"></td>
                 </tr>
                 <tr>
                   <td><b>Nombre:</b></td>
                   <td><input type="text" name="nomemple" value="<?echo $filas["nomemple"];?>" readonly
                      size="25" maxlength="25" class="cajas"></td>
                 </tr>
                 <td><b>Apellido:</b></td>
                   <td><input type="text" name="apemple" value="<?echo $filas["apemple"];?>" readonly
                      size="25" maxlength="25" class="cajas"></td>
                 </tr>
                 <tr>
                   <td><b>Dirección:</b></td>
                   <td><input type="text" name="diremple" value="<?echo $filas["diremple"];?>" readonly
                      size="40" maxlength="40" class="cajas"></td>
                 </tr>
                 <tr>
                   <td><b>Teléfono:</b></td>
                   <td><input type="text" name="telemple" value="<?echo $filas["telemple"];?>" readonly
                      size="10" maxlength="7" class="cajas"></td>
                 </tr>
                 <tr>
                   <td><b>Municipio:</b></td>
                   <td><input type="text" name="municipio" value="<?echo $filas["municipio"];?>"readonly
                      size="25" maxlength="25" class="cajas"></td>
                 </tr>
                 <td><b>Sexo:</b></td>
                   <td><input type="text" name="sexo" value="<?echo $filas["sexo"];?>" readonly
                      size="10" maxlength="10" class="cajas"></td>
                 </tr>
                 <td><b>Estado_Civil:</b></td>
                   <td><input type="text" name="estcivil" value="<?echo $filas["estcivil"];?>" readonly
                      size="10" maxlength="10" class="cajas"></td>
                 </tr>
                 <td><b>Cuenta:</b></td>
                   <td><input type="text" name="cuenta" value="<?echo $filas["cuenta"];?>" readonly
                      size="20" maxlength="20" class="cajas"></td>
                 </tr>
                 <td><b>Celular:</b></td>
                   <td><input type="text" name="celular" value="<?echo $filas["celular"];?>" readonly
                      size="15" maxlength="15" class="cajas"></td>
                 </tr>

 <?
     endwhile;
   endif;

 ?>
 </table>
 
 </form>
</body>
</html>
