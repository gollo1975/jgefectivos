<html>
<head>
<title>Detallado del Memorando</title>
<LINK  REL="stylesheet" HREF="../estiloa.css" type="text/css">
</head>
<body>

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
       <center><h4><u>Información del Memorando</u></h4></center>
       <form action="" method="post">
        <table border="0" align="center">
         <tr>
           <td colspan="2"><br></td>
         </tr>
          <tr>
            <td><b>Asunto:</b></td>
            <td><center><input type="text" name="asunto" value="<?echo $filas["asunto"];?>" class="cajas" readonly size="40" maxlength="40"></center></td>
            </tr>
             <tr>
                   <td><b>Nota:</b></td>
                   <td colspan="5"><textarea name="nota" cols="75" rows="10" class="cajas"> <?echo $filas["nota"];?></textarea></td>
             </tr>
                 <tr>
                   <td><b>Firma:</b></td>
                   <td><input type="text" name="firma" value="<?echo $filas["firma"];?>"class="cajas" readonly
                      size="40" maxlength="40"></td>
                 </tr>
        <?
     endwhile;
   endif;

 ?>
 </table>
 <th><center><a href="../memorando/imprimir1.php?radicado=<?echo $radicado;?>&xcodigo=<?echo $xcodigo;?>">Imprimir</a></center></th>
 </form>
</body>
</html>
