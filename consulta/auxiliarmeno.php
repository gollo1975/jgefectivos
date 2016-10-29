<?
 session_start();
?>
<html>
<head>
<title></title>
</head>
<body>

<?
 if(session_is_registered("validar")):
     include("../conexion.php");
     $consulta="select memorando.* from memorando where radicado='$radicado'";
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
       <form action="" method="post">
        <table border="1" align="center">
         <tr>
           <th colspan="2">Información del Memorando</th>
         </tr>
          <tr>
            <td>Asunto:</td>
            <td><center><input type="text" name="asunto" value="<?echo $filas["asunto"];?>"readonly size="40" maxlength="40"></center></td>
            </tr>
             <tr>
                   <td>Nota:</td>
                   <td colspan="5"><textarea name="nota" cols="75" rows="6"></textarea></td>
             </tr>
                 <tr>
                   <td>Firma:</td>
                   <td><input type="text" name="firma" value="<?echo $filas["firma"];?>" readonly
                      size="40" maxlength="40"></td>
                 </tr>
        <?
     endwhile;
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
 <center><a href="../index.php">Regresar al Menu</a></center>
 </form>
</body>
</html>
