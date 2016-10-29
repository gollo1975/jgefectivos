<?
 session_start();
?>
<html>
<head>
<title> Datos del Empleado</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>

<?
 if(session_is_registered("xsession")):
     include("../conexion.php");
     $consulta="select dato.* from dato where dato.contrato='$nrocontrato'";
     $resultado=mysql_query($consulta)or die("Error de busqueda");
     $registros=mysql_num_rows($resultado);
     if($registros==0):
     ?>
      <script language="javascript">
          alert("No hay observaciones para este contrato ?")
          history.back()
        </script>
<?
    else:
      while($filas=mysql_fetch_array($resultado)):
?>
      <center><h4><u>Datos del Retiro</u></h4></center>
        <table border="0" align="center">
         <tr><td><br></td></tr>
                 <tr>
                   <td><b>Nombre:</b></td>
                   <td><input type="text" value="<?echo $filas["nombre"];?>" readonly
                      size="50"  class="cajas"></td>
                 </tr>
                <tr>
                 <td><b>Fecha_proceso:</b></td>
                   <td><input type="text" value="<?echo $filas["fechap"];?>" readonly
                      size="10" maxlength="10" class="cajas"></td>
                 </tr>
                 <tr>
                   <td><b>Observaciones:</b></td>
                   <td><textarea  cols="50" rows="8"class="cajas"><?echo $filas["nota"];?> </textarea></td>
                 </tr>
                    <tr><td><br></td></tr>
      </table>

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
</body>
</html>
