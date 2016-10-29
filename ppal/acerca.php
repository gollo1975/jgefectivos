<html>

<head>
  <title>a cerca de.</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
include("../conexion.php");
$consulta=" select zona.iva,zona.prestacion,zona.admon,zona.caja,zona.fechaini,zona.sena,zona.icbf,zona.nitzona,zona.dirzona,zona.telzona,zona.zona from zona
         where zona.codzona='$codigo'";
$resu=mysql_query($consulta)or die("Error de Busqueda");
while($filas=mysql_fetch_array($resu)):
  ?>
  <center><h4><u>Ficha Técnica</u></h4></center>
   <form action="" method="post">
      <table border="0" align="center">
      <tr><td><br></td></tr>
       <tr><td><b><font family="arial" size="3pt">Datos de la Empresa</font></b></td></tr></center>
       <tr><td><br></td></tr>
        <tr>
           <td><b>Nit:</b></td>
           <td class="cajas"><? echo $filas["nitzona"];?></td>
        </tr>
         <tr>
           <td><b>Zona:</b></td>
           <td class="cajas"><? echo $filas["zona"];?></td>
        </tr>
        <tr>
           <td><b>Dirección:</b></td>
           <td class="cajas"><? echo $filas["dirzona"];?></td>
        </tr>
        <tr>
           <td><b>Telefono:</b></td>
           <td class="cajas"><? echo $filas["telzona"];?></td>
        </tr>
          <tr>
           <td><b>Registro:</b></td>
           <td class="cajas"><? echo $codigo;?></td>
        </tr>
         <tr>
           <td><b>Fecha_Radicado:</b></td>
           <td class="cajas"><? echo $filas["fechaini"];?></td>
        </tr>
        <tr><td><br></td></tr>
         <tr><td><b><font family="arial" size="3pt">Datos de Facturación</font></b></td></tr></center>
           <tr><td><br></td></tr>
        <tr>
           <td><b>Iva:</b></td>
           <td class="cajas"><? echo $filas["iva"];?>%</td>
        </tr>
         <tr>
           <td><b>Admon:</b></td>
           <td class="cajas"><? echo $filas["admon"];?></td>
        </tr>
        <tr>
           <td><b>Caja:</b></td>
           <td class="cajas"><? echo $filas["caja"];?>%</td>
        </tr>
        <tr>
           <td><b>Sena:</b></td>
           <td class="cajas"><? echo $filas["sena"];?>%</td>
        </tr>
        <tr>
           <td><b>Icbf:</b></td>
           <td class="cajas"><? echo $filas["icbf"];?>%</td>
        </tr>
          <tr>
           <td><b>Prestación:</b></td>
           <td class="cajas"><? echo $filas["prestacion"];?>%</td>
        </tr>
        <tr><td><br></td></tr>
      </table>
   </form>
  <?
endwhile;
?>
</body>
</html>
