<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<center><h4><u>Asociados por Eps</u></h4></center>
<form action="" method="post">
  <table border="0" align="center" width="400">
    <tr>
    <tr><td><br></td></tr>
        <?
        include("../conexion.php");?>
        <td colspan="5"><b>Nombre de Eps:</b></td><td><select name="select" onChange="location.href=this.value" class="cajas">
        <option>Seleccione Una Eps</option>
        <?$con="select eps.codeps,eps.eps from eps order by eps";
        $resu=mysql_query($con)or die("Error de busqueda");
        while($filas=mysql_fetch_array($resu)):
        ?>
           <option value="dato1.php?codigo=<? echo $filas["codeps"];?>"><?echo $filas["eps"];?>
        <?
        endwhile;?>
        </select></td>
       </tr>
           <tr><td><br></td></tr>
     </table>
   </form>
</body>
</html>
