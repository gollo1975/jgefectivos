<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<center><h4><u>Asociado por Fondo</u></h4></center>
<form action="" method="post">
  <table border="0" align="center" width="300">
    <tr>
    <tr><td><br></td></tr>
        <?
        include("../conexion.php");?>
        <td><b>Nombre del Fondo:</b></td><td><select name="select" onChange="location.href=this.value" class="cajas">
        <option>Seleccione Un Fondo</option>
        <?$con="select pension.codpension,pension.pension from pension order by pension";
        $resu=mysql_query($con)or die("Error de busqueda");
        while($filas=mysql_fetch_array($resu)):
        ?>
           <option value="datopension.php?codigo=<? echo $filas["codpension"];?>"><?echo $filas["pension"];?>
        <?
        endwhile;?>
        </select></td>
       </tr>
           <tr><td><br></td></tr>
     </table>
   </form>
</body>
</html>
