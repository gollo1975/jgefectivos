<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>

<center><h4><u>Pago de Incapacidades</u></h4></center>
<form action="" method="post">
  <table border="0" align="center" width="300">
    <tr>
    <tr><td><br></td></tr>
        <?
        include("../conexion.php");?>
        <td><b>Zona:</b></td><td><select name="select" onChange="location.href=this.value" class="cajas">
        <option>Seleccione la zona</option>
        <?$con="select codzona,zona from zona where zona.estado='ACTIVA' and zona.tiponegociacion='MISIONAL' order by zona ASC";
        $resu=mysql_query($con)or die("Error de busqueda en la tabla zoan");
        while($filas=mysql_fetch_array($resu)):
        ?>
           <option value="ListadoIncapacidadReconocida.php?CodZona=<? echo $filas["codzona"];?>"><?echo $filas["zona"];?>
        <?
        endwhile;?>
        </select></td>
       </tr>
           <tr><td><br></td></tr>
     </table>
   </form>
</body>
</html>

