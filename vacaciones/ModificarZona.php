<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<center><h4>Editar Primas</h4></center>
<form action="" method="post">
  <table border="0" align="center" width="300">
    <tr>
    <tr><td><br></td></tr>
        <?
        include("../conexion.php");?>
        <td colspan="10	"><b>Zona:</b></td><td colspan="30"><select name="select" onChange="location.href=this.value" class="cajas">
        <option>Seleccione la Zona</option>
        <?$con="select zona.codzona,zona.zona from zona where zona.estado='ACTIVA' and zona.nomina='SI' order by zona.zona";
        $resu=mysql_query($con)or die("Error de busqueda de zonas");
        while($filas=mysql_fetch_array($resu)):
       ?>
         <option value="ListadoZona.php?CodZona=<? echo $filas["codzona"];?>"><?echo $filas["zona"];?>
        <?
        endwhile;?>
               </select></td>
       </tr>
       <tr><td><br></td></tr> 
     </table>
   </form>
</body>
</html>
