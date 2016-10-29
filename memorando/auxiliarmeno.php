<html>
<head>
<title>Detallado del Memorando</title>
<LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
</head>
<body>
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='modificar.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<?
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
       <center><h3>Información del Memorando</h3></center>
       <form action="" method="post">
        <table border="1" align="center">
         <tr>
           <td colspan="2"><br></td>
         </tr>
          <tr>
            <td><b>Asunto:</b></td>
            <td><center><input type="text" name="asunto" value="<?echo $filas["asunto"];?>"readonly size="40" maxlength="40"></center></td>
            </tr>
             <tr>
                   <td><b>Nota:</b></td>
                   <td colspan="5"><textarea name="nota" cols="75" rows="10" class="cajas"> <?echo $filas["nota"];?></textarea></td>
             </tr>
                 <tr>
                   <td><b>Firma:</b></td>
                   <td><input type="text" name="firma" value="<?echo $filas["firma"];?>" readonly
                      size="40" maxlength="40"></td>
                 </tr>
        <?
     endwhile;
   endif;

 ?>
 </table>
 <th><center><a href="imprimir1.php?radicado=<?echo $radicado;?>" target="_blank" onclick="volver()" class="fondo">Imprimir</a></center></th>
 </form>
</body>
</html>
