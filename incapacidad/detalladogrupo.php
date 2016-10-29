<html>
<head>
<title>Datos del codigo</title>
<LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
</head>
<body>
<?
    include("../conexion.php");
     $consulta="select control.codigo,control.concepto from control where control.codigo='$cod'";
     $resultado=mysql_query($consulta)or die ("Error en la busqueda de datos");
     $registro=mysql_num_rows($resultado);
     if ($registro==0):
     ?>
       <script language="javascript">
        alert("El dato no existe en la base de dato ?")
        history.back()
       </script>
     <?
     else:
       while($filas=mysql_fetch_array($resultado)):
       ?>
       <center><h4>Datos a Modificar</h4></center>
       <form action="guardargrupo.php" method="post">
       <table border="0" align="center">  
       <tr>
         <td  colspan="2" ><br></td>
       </tr>
       <tr>
         <td><b>Código:</b></td>
         <td><input type="text" name="codigo" value="<?echo $filas["codigo"];?>"size="12" class="cajas" readonly></td>
       </tr>
       <tr>
         <td><b>Diagnóstico:</b></td>
         <td><input type="text" name="concepto" value="<?echo $filas["concepto"];?>"
         size="67" maxlength="60" class="cajas"></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Guardar" class="boton">
         </td>
       </tr>
      <?
     endwhile;
   endif;
  ?>
 </table>
 </form>
</body>
</html>
