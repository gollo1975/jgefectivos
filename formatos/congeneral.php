<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<center><h4><u>Auxilios por Fondo</u></h4></center>
<?
if (!isset($desde)):
?>
  <form action="" method="post">
   <table border="0" align="center" width="400">
     <tr><td><br></td></tr>
     <tr>
       <td><b>Desde:</b></td>
       <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
        <td><b>Hasta:</b></td>
        <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
     </tr>
      <tr><td><br></td></tr>
       <tr>
          <td colspan="2"><input type="submit" Value="Buscar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
       </tr>
   </table>
  </form>
<?
elseif(empty($desde)):
  ?>
   <script language="javascript">
     alert("Debe de digitar la fecha de Inico ?")
     history.back()
   </script>
  <?
  else:
  ?>
    <form action="" method="post">
      <table border="0" align="center" width="400">
      <tr><td><br></td></tr>   
      <?include("../conexion.php");?>
        <td colspan="10"><b>Nombre del fondo:</b></td>
        <td colspan="5"><select name="select" onChange="location.href=this.value" class="cajas">
        <option>Seleccione el fondo</option>
        <?$con="select itemfondo.codigo,itemfondo.concepto from itemfondo order by concepto";
        $resu=mysql_query($con)or die("Error de busqueda");
        while($filas=mysql_fetch_array($resu)):
        ?>
           <option value="detallado.php?codigo=<? echo $filas["codigo"];?>&fondo=<?echo $filas["concepto"];?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>"><?echo $filas["concepto"];?>
        <?
        endwhile;?>
        </select></td>
       </tr>
           <tr><td><br></td></tr>
     </table>
   </form>
   <?
   endif;
   ?>
</body>
</html>
